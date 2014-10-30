<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('StalkAffiliateBundle:Default:index.html.twig');
    }
}
