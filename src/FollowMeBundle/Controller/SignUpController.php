<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use FollowMeBundle\Form\SignUp;
use FollowMeBundle\Entity\User;

class SignUpController extends Controller
{

    /**
     * @Route("/signup", name="signup")
     */
    public function indexAction( Request $req)
    {
    	try {
    		
    	$this->get("session")->start();
    	
    	if ($this->get("session")->get("id")) {
    		throw new \RuntimeException;
    	}
    	    	
        $form = $this->createForm(SignUp::class);
        
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
        	
        	if ( $form->getData()["user_pswd"] != $form->getData()["confirm"]) {
        		$form->get("confirm")->addError ( new FormError("Confirmation invalide."));
        		throw new \InvalidArgumentException;
        	}
        	
        	$user = $this->get("followme.user");
        	$user->setUserMail(
        			$form->getData()["user_mail"]		
        	);
        	$user->setUserPswd(
        			password_hash($form->getData()["user_pswd"], PASSWORD_DEFAULT)
        		);
        		
        	$this->getDoctrine()->getManager()->persist($user);
        	$this->getDoctrine()->getManager()->flush();
        		
        	$this->get("session")->set("id", $user->getUserId());
        		
        	throw new \RuntimeException;
        }
        
    	} catch ( \InvalidArgumentException$e) {        		
        } catch (\RuntimeException $e) {        		
        	return $this->redirectToRoute("main");
        } catch (\Throwable $e) {
        	$form->addError( new FormError("L'utilisateur éxiste déjà."));
        }             

        return $this->render('FollowMeBundle:SignUp:index.html.twig',
        [
            "form"=> $form->createView()
        ]           
        );
    }
}
