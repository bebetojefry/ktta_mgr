<?php
namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\FrontBundle\Entity\Player;
use App\FrontBundle\Form\PlayerType;
use App\FrontBundle\Form\PlayerTransferType;
use App\FrontBundle\Helper\FormHelper;

/**
 * Description of PlayerController
 *
 * @author qbuser
 */
class PlayerController extends Controller {
    
    public function allAction(Request $request) {
        $condition = array();
        if($district = $this->getUser()->getDistrict()){
            $condition['district'] = $district;
        }
        
        $status = array(
            Player::NEW_PLAYER => '<b style="color:#337ab7">New Player</b>',
            Player::SUBMITTED => '<b style="color:#337ab7">Submtted for Approval</b>',
            Player::APPROVED => '<b style="color:#5cb85c">Approved</b>',
            Player::REJECTED =>  '<b style="color:#d9534f">Rejected</b>'
            
        );
        
        $players = $this->getDoctrine()->getManager()->getRepository('AppFrontBundle:Player')->findBy($condition);
        return $this->render('AppFrontBundle:Player:index.html.twig', array(
            'players' => $players,
            'status' => $status
        ));
    }
    
    public function indexAction(Request $request, $status) {
        $condition = array('status' => $status);
        if($district = $this->getUser()->getDistrict()){
            $condition['district'] = $district;
        }
        
        $status = array(
            Player::NEW_PLAYER => '<b style="color:#337ab7">New Player</b>',
            Player::SUBMITTED => '<b style="color:#337ab7">Submtted for Approval</b>',
            Player::APPROVED => '<b style="color:#5cb85c">Approved</b>',
            Player::REJECTED =>  '<b style="color:#d9534f">Rejected</b>'
            
        );
        
        $players = $this->getDoctrine()->getManager()->getRepository('AppFrontBundle:Player')->findBy($condition);
        return $this->render('AppFrontBundle:Player:index.html.twig', array(
            'players' => $players,
            'status' => $status
        ));
    }
    
    public function newAction(Request $request) {
        $dm = $this->getDoctrine()->getManager();
        $player = new Player();
        $player->setDistrict($this->getUser()->getDistrict());
        $form = $this->createForm(new PlayerType(), $player);
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
    
    public function editAction(Request $request, Player $player) {
        $dm = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PlayerType(), $player);
        $code = FormHelper::FORM;
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $player = $form->getData();
                $dm->persist($player);
                $dm->flush();
                $this->get('session')->getFlashBag()->add('success', 'player.msg.updated');
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
    
    public function deleteAction(Player $player){  
        $dm = $this->getDoctrine()->getManager();
        $dm->remove($player);
        $dm->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'player.msg.removed');
        return new Response(json_encode(array('code' => FormHelper::REFRESH)));
    }
    
    public function detailAction(Player $player) {
        $status = array(
            Player::NEW_PLAYER => '<b style="color:#337ab7">New Player</b>',
            Player::SUBMITTED => '<b style="color:#337ab7">Submtted for Approval</b>',
            Player::APPROVED => '<b style="color:#5cb85c">Approved</b>',
            Player::REJECTED =>  '<b style="color:#d9534f">Rejected</b>'
            
        );
        
        return $this->render('AppFrontBundle:Player:detail.html.twig', array(
            'player' => $player,
            'status' => $status
        ));
    }
    
    public function statusAction(Request $request, Player $player) {
        $dm = $this->getDoctrine()->getManager();
        $player->setStatus($request->query->get('status', 0));
        $dm->persist($player);
        $dm->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'player.msg.status');
        return new Response(json_encode(array('code' => FormHelper::REFRESH)));
    }
    
    public function transferAction(Request $request, Player $player) {
        $dm = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PlayerTransferType(), $player);
        $code = FormHelper::FORM;
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $player = $form->getData();
                $player->refreshPlayerId();
                $dm->persist($player);
                $dm->flush();
                $this->get('session')->getFlashBag()->add('success', 'player.msg.transfered');
                $code = FormHelper::REFRESH;
            } else {
                $code = FormHelper::REFRESH_FORM;
            }
        }
        
        $body = $this->renderView('AppFrontBundle:Player:formTransfer.html.twig',
            array('form' => $form->createView())
        );
        
        return new Response(json_encode(array('code' => $code, 'data' => $body)));
    }
    
    public function reportAction() {     
        $obj = new \stdClass();
        $obj->district = '';
        $obj->status = '';
        $obj->gender = '';
        $obj->group = '';
        
        $dm = $this->getDoctrine()->getManager();
        $districts = $dm->getRepository('AppFrontBundle:District')->findAll();
        $district_values = array('' => 'All');
        foreach($districts as $district){
            $district_values[$district->getName()] = $district->getName();
        }
        
        $form = $this->createFormBuilder($obj)
            ->add('district', 'choice', array(
                'choices' => $district_values,
                'multiple' => false,
                'expanded' => false,
                'data_class' => null
            ))
            ->add('group', 'choice', array(
                'choices' => array(
                    '' => 'All',
                    'Veteran' => 'Veteran',
                    'Men' => 'Men',
                    'Youth' => 'Youth',
                    'Juniors' => 'Juniors',
                    'Sub junior' => 'Sub junior',
                    'Cadet' => 'Cadet',
                    'Mini cadet' => 'Mini cadet'
                ),
                'multiple' => false,
                'expanded' => false,
                'data_class' => null
            ))    
            ->add('status', 'choice', array(
                'choices' => array(
                    '' => 'All',
                    'New Player' => 'New Player',
                    'Submtted for Approval' => 'Submtted for Approval',
                    'Approved' => 'Approved',
                    'Rejected' =>  'Rejected'
                ),
                'multiple' => false,
                'expanded' => false,
                'data_class' => null
            ))
            ->add('gender', 'choice', array(
                'choices' => array('' => 'All', 'male' => 'Male', 'female' => 'Female'),
                'multiple' => false,
                'expanded' => false,
                'data_class' => null
            ))
            ->getForm();
        
        $status = array(
            Player::NEW_PLAYER => '<b style="color:#337ab7">New Player</b>',
            Player::SUBMITTED => '<b style="color:#337ab7">Submtted for Approval</b>',
            Player::APPROVED => '<b style="color:#5cb85c">Approved</b>',
            Player::REJECTED =>  '<b style="color:#d9534f">Rejected</b>'
            
        );
        
        $players = $this->getDoctrine()->getManager()->getRepository('AppFrontBundle:Player')->findAll();
        return $this->render('AppFrontBundle:Player:report.html.twig', array(
            'players' => $players,
            'status' => $status,
            'form' => $form->createView()
        ));
    }
}
