<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Form\Add;

class AddController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
	public function indexAction( Request $req)
    {
		try {
			$this->get("session")->start();
		
    		$form = $this->createForm(Add::class);
    	
    		$form->handleRequest($req);
    		
    		$user = $this->get("session")->get("id");
    		
    		if ($form->isSubmitted() && $form->isValid()) {    			
    	
    			if ( $form->getData()["dating_start"]->getTimestamp() < time()) {
    				$form->addError( new FormError("Mauvais horaires."));
    				throw new \Exception();
    			}
    			if ( $form->getData()["dating_end"]->getTimestamp() == time()) {
    				$form->addError( new FormError("Entrer une durée."));
    				throw new \Exception();
    			}
    			
    			$dating = $this->get("followme.dating");
    			$dating->setDatingTitle(
    					$form->getData()["dating_title"]
    					);
    			$dating->setDatingDescription(
    					$form->getData()["dating_description"]
    					);
    			$dating->setDatingStart(
    					$form->getData()["dating_start"]->getTimestamp()
    					);    			
    			$dating->setDatingEnd(
    					$form->getData()["dating_end"]->getTimestamp()+$dating->getDatingStart()+3600
    					);
    			$dating->setUser(    					
    					$this->getDoctrine()
    					->getManager()
    					->getRepository(User::class)
    					->find($this->get("session")->get("id"))    					
    					);
    			
    			$this->getDoctrine()->getManager()->persist($dating);
    			$this->getDoctrine()->getManager()->flush();    			
    			
    			throw new \RuntimeException;
    	}    	
			}catch (\Exception $e) {
    			dump($e);    		
			}catch (\RuntimeException $e) {
			return $this->redirectToRoute("main");
			}catch (\Throwable $e) {				
    		dump($e);
    		}
    	return $this->render('FollowMeBundle:Add:index.html.twig',
    			[
    					"form"=> $form->createView()
    			]
    	);
	}
}
