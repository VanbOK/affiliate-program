<?php

namespace Stalk\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('StalkAdminBundle:Default:index.html.twig');
    }
}
