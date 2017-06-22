<?php
namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\FrontBundle\Entity\Player;
use App\FrontBundle\Form\PlayerType;
use App\FrontBundle\Helper\FormHelper;

/**
 * Description of PlayerController
 *
 * @author qbuser
 */
class PlayerController extends Controller {
    
    public function indexAction(Request $request) {
        $players = $this->getDoctrine()->getManager()->getRepository('AppFrontBundle:Player')->findAll();
        return $this->render('AppFrontBundle:Player:index.html.twig', array(
            'players' => $players
        ));
    }
    
    public function newAction(Request $request) {
        $dm = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PlayerType(), new Player());
        $code = FormHelper::FORM;
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $player = $form->getData();
                $player->setStatus(Player::NEW_PLAYER);
                $dm->persist($player);
                $dm->flush();
                $this->get('session')->getFlashBag()->add('success', 'player.msg.created');
                $code = FormHelper::REFRESH;
            } else {
                $code = FormHelper::REFRESH_FORM;
            }
        }
        
        $body = $this->renderView('AppFrontBundle:Player:form.html.twig',
            array('form' => $form->createView())
        );
        
        return new Response(json_encode(array('code' => $code, 'data' => $body)));
    }
}
