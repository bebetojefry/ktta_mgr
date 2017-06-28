<?php

namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\FrontBundle\Helper\FormHelper;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        if($this->getUser()){
            $token = $this->get('security.token_storage')->getToken();
            if($token->getProviderKey() == 'admin'){
                return $this->redirect($this->generateUrl('app_front_admin_products'));
            } else {
                return $this->redirect($this->generateUrl('app_front_homepage'));
            }
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
		
        return $this->render('AppFrontBundle:User:login.html.twig', array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function logincheckAction(){

    }

    public function registerAction(){
//		$user = $this->get('app.front.entity.consumer');
//		$user->regenerateSalt();
//		$user->setPassword('bebeto12345');
//		$user->setFirstname('Jasper');
//		$user->setLastname('Prince');
//		echo $user->getSalt().'<br/>';
//		echo $user->getPassword();
            exit;
    }
    
    public function passwordAction(Request $request){
        $user = $this->getUser();
        
        $dm = $this->getDoctrine()->getManager();
        $obj = new \stdClass();
        $obj->password = '';
        $form = $this->createFormBuilder($obj)
            ->add('password', 'repeated', array(
                'type' => 'password',
                'required' => true,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('submit', 'submit', array('attr' => array('class' => 'btn btn-primary')))
            ->getForm();
        
        $code = FormHelper::FORM;
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $obj = $form->getData();
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $password = $encoder->encodePassword($obj->password, $user->getSalt());
                $user->setPassword($password);
                $dm->persist($user);
                $dm->flush();
                $this->get('session')->getFlashBag()->add('success', 'user.msg.reseted');
                $code = FormHelper::REFRESH;
            } else {
                $code = FormHelper::REFRESH_FORM;
            }
        }

        $body = $this->renderView('AppFrontBundle:User:password.html.twig',
            array('form' => $form->createView())
        );
        
        return new Response(json_encode(array('code' => $code, 'data' => $body)));
    }
}
