<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FollowMeBundle\Entity\Dating;
use Doctrine\Common\Collections\Criteria;

class DatingController extends Controller
{
    
    /**
     * @Route("/dating", name="dating")
     */
    public function indexAction(Request $request)
    {    	
    	$page = (int) $request->get("page") > 1
          ? (int) $request->get("page")
          : 1;
        $maxResults = 5;
        $this->get("session")->start();
        
        if (!$this->get("session")->get("id")) {
            return $this->redirectToRoute("main");
        }
        $criteria = new Criteria;
        $criteria
        ->where($criteria->expr()->gt("datingEnd", time()))
        ->setMaxResults($maxResults)
        ->orderBy(["datingEnd" => Criteria::ASC]);
        
        if ($page) {
            $criteria->setFirstResult(
            		($page - 1 ) * $maxResults
            );
        }
        
        $dating = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository(Dating::class)
        ->matching($criteria);
        
        if ( !$dating[0] && $page > 1) {
        	return $this->redirectToRoute("dating");
        }
        
        return $this->render('FollowMeBundle:Dating:index.html.twig', [
            "dating" => $dating,
        	"page" => $page,
        	"max" => $maxResults
        ]);
    }    
}
