<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction()
    {

    	
        return $this->render('FollowMeBundle:Main:index.html.twig', array(
            // ...
        ));
    }
    
    /**
     * @Route("/banner", name="banner"
     *
     * ) 
     */
    public function bannerAction() {
    	
    	return $this->render('FollowMeBundle:Main:banner.html.twig');
    }
}
