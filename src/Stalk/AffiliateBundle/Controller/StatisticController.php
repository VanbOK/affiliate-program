<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StatisticController extends Controller
{
    
    public function indexAction() {
        
        return $this->render('StalkAffiliateBundle:Statistic:index.html.twig');
        
    }
    
    public function getJsonStatAction() {

        $arr[] = array(
            "title" => "",
            "firstEl" => rand(100,300),
            "secondEl" => rand(50,99),
            "thirdEl" => rand(1,49)
        );
        
        $response = new Response();
        
        if ( !empty($arr) ){
            $response->setContent(json_encode($arr));
        } else {
            $response->setContent(json_encode(array('notFound' => true)));
        }
        
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
    
}
