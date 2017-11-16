<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SignOutController extends Controller
{
    /**
     * @Route("/signout", name="signout")
     */
    public function indexAction()
    {
    	try {
    		
    		if ($this->get("session")->start() && $this->get("session")->get("id")) {
    			throw new \RuntimeException;
    		}
    		
    	} catch (\RuntimeException $e) {
    		
    		$this->get("session")->invalidate();
    		return $this->redirectToRoute("main");
    	}    	
    	
        return $this->render('FollowMeBundle:SignOut:index.html.twig', array(
            // ...
        ));
    }
}
