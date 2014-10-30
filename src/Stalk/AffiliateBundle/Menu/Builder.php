<?php

namespace Stalk\AffiliateBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    { 
        //Узнаем есть ли новые новости
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $em = $this->container->get('doctrine')->getManager();
        $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
            ->findBy(array('userId'=>$user->getId(), 'visited'=>false)); 

        $newNewsIcon = (!empty($newNews)) ? '&nbsp;&nbsp;<span class="new">New!</span>' : '';
        
        $menu = $factory->createItem('root');
        $uri = $this->container->get('request')->getRequestUri();

        $menu->setChildrenAttribute('class', 'nav nav-sidebar');
        
        $menu->addChild('profile', array(
            'route' => 'fos_user_profile_edit',
            'label' => 'Управление профилем'
        ));
        $menu->addChild('marketing_materials', array(
            'route' => 'stalk_affiliate_marketing_materials',
            'label' => 'Маркетинговые материалы'
        ));
        $menu->addChild('news', array(
            'route' => 'stalk_affiliate_news',
            'label' => 'Новости'.$newNewsIcon,
            'extras' => array('safe_label' => true)
        ));        
        $menu->addChild('transaction', array(
            'route' => 'stalk_affiliate_transaction_list',
            'label' => 'Сделки',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('statistic', array(
            'route' => 'stalk_affiliate_statistic',
            'label' => 'Статистика'
        ));
        $menu->addChild('faq', array(
            'route' => 'stalk_affiliate_faq',
            'label' => 'FAQ'
        ));
        $menu->addChild('feedback', array(
            'route' => 'stalk_affiliate_feedback',
            'label' => 'Обратная связь'
        ));        
        
        if (preg_match('#\/profile\/edit#i', $uri)){
            $menu['profile']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/news#i', $uri)){
            $menu['news']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/transaction#i', $uri)){
            $menu['transaction']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/stat#i', $uri)){
            $menu['statistic']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/faq#i', $uri)){
            $menu['faq']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/feedback#i', $uri)){
            $menu['feedback']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/marketing-materials#i', $uri)){
            $menu['marketing_materials']->setAttributes(array('class' => 'active'));
        }
        
        return $menu;
    }
}