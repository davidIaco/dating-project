<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\Criteria;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Entity\Dating;

class AdminController extends Controller
{
    /**
     * @Route("/admin" , name="admin")
     */
	public function indexAction(Request $request)
    {
    	$maxResults = 5;
    	$page = (int) $request->get("page") > 1
    	? (int) $request->get("page")
    	: 1;
    	
    	$this->get("session")->start();
    	
    	if (!$this->get("session")->get("id")) {
    		return $this->redirectToRoute("main");
    	}
    	
    	$criteria = new Criteria;
    	$criteria->setMaxResults($maxResults);
    	
    	if ($page) {
    		$criteria->setFirstResult(
    				($page - 1 ) * $maxResults
    		);
    	}
    	
    	$users = $this
    	->getDoctrine()
    	->getManager()
    	->getRepository(User::class)
    	->matching($criteria);
    	
    	if ( !$users[0] && $page > 1) {
    		return $this->redirectToRoute("dating");
    	}    	
    	
        return $this->render('FollowMeBundle:Admin:index.html.twig', [
        		"users" => $users,
        		"page" => $page,
        		"max" => $maxResults
        ]);
    }
    
    /**
     * @route("/admin/user/{id}", name="admin_user")
     */
    public function removeUserAction ($id) {
    	
    	$url = generateUrl("admin");
    	try {    		
    		if (!($user = $this->getDoctrine()
    				->getManager()
    				->find(User::class, $id))) {
    					return $this->redirect($url . "?e=");
    	}
    	if (!($dating = $this->getDoctrine()
    			->getManager()
    			->getRepository(Dating::class)
    			->findBy(["user" => $user]))
    			&& 0!= count($dating)) {
    				
    	foreach ( $dating as $date) {
    		$this->getDoctrine()->getManager()->remove($date);
    		}
    		$this->getDoctrine()->getManager()->flush();
    	}
    	   	
    	$this->getDoctrine()->getManager()->remove($user);
    	$this->getDoctrine()->getManager()->flush();
    	return $this->redirect($url . "?e=" . $id);
    	    
    	} catch (Exception $e) {
    		$this->redirect($url . "?e");
    	}
    }
}
