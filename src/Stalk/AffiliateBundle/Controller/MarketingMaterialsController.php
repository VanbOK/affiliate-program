<?php 

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketingMaterialsController extends Controller
{
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:MarketingMaterials')
            ->find(1);
        
        return $this->render('StalkAffiliateBundle:MarketingMaterials:index.html.twig', array(
            'entity' => $entities,
        ));
        
    }
}
