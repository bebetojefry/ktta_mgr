<?php
namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\FrontBundle\Entity\Player;

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
}
