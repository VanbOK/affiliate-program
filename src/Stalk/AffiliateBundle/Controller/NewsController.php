<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:News')
            ->findBy(array('enabled'=>true), array('updated'=>'DESC'));
    
        //Поиск новых новостей
        $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
            ->findBy(array('userId'=>$this->getUser(), 'visited'=>false));     
        $newNewsId = array();
        foreach ($newNews as $item)
            $newNewsId[] = $item->getNewsId();
                
        $pagination = $this->get('knp_paginator')->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),
            5
        );
        
        return $this->render('StalkAffiliateBundle:News:index.html.twig', array(
            'entities' => $pagination,
            'newNewsId' => $newNewsId,
        ));
        
    }
    
    /**
     * View Page.
     *
     */
    public function viewAction($slug)
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:News')
            ->findBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Новость не найдена');
        }
        
        //Устанавливаем флаг просмотра новости
        $news = $em->getRepository('StalkAdminBundle:NewsVisited')
            ->findBy(array('newsId'=>$entity[0]->getId(), 'userId'=>$this->getUser()));
        
        if ( !empty($news[0]) && !$news[0]->getVisited() ) {
            $em->remove($news[0]);
            $em->flush();
        }

        return $this->render('StalkAffiliateBundle:News:view.html.twig', array(
            'entity' => $entity[0]
        ));
        
    }
    
}
