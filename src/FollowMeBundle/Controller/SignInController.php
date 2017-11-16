<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use FollowMeBundle\Form\SignIn;
use FollowMeBundle\Entity\User;

class SignInController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
	public function indexAction (Request $req)
    {
    	try {
    		
    	$this->get("session")->start();
    	
    	if ($this->get("session")->get("id")) {
    		throw new \RuntimeException;
    	}
    	
    	$form = $this->createForm(SignIn::class);
    	
    	$form->handleRequest($req);
    	
    	if ( !$form->isSubmitted() || !$form->isValid()) {
    		
    		throw new \InvalidArgumentException;
    	}
    	
    	if (($user = $this->getDoctrine()
    					->getManager()
    					->getRepository(User::class)
    					->findOneBy(["userMail" => $form->getData()["user_mail"]]))) {
    						
    			if ( !password_verify(
    				$form->getData()["user_pswd"],
    					$user->getUserPswd())) {
    		throw new \Throwable;
    	}
    		
    		$this->get("session")->set("id", $user->getUserId());
    		
    		throw new \RuntimeException;
    		
    		}
    		
    		throw new \Throwable;
    		
    	} catch (\InvalidArgumentException $e) {    	
    	} catch (\RuntimeException $e) {
    		
    		return $this->redirectToRoute("main");
    		
    	}catch (\Throwable $e) {
    		
    		$form->addError( new FormError("Mauvais identifiants."));
    	} 
    	
    	return $this->render('FollowMeBundle:SignIn:index.html.twig',
    			[
    				"form"=> $form->createView()
    			]
    	);
    }
}
