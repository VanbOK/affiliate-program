<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FaqController extends Controller
{
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:Faq')
            ->findBy(array('enabled'=>true));
        
        return $this->render('StalkAffiliateBundle:Faq:index.html.twig', array(
            'entities' => $entities,
        ));
        
    }
    
}
