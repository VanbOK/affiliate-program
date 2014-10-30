<?php

namespace Stalk\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $uri = $this->container->get('request')->getRequestUri();

        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        $menu->addChild('main', array(
            'route' => 'stalk_admin_homepage',
            'label' => '<span class="glyphicon glyphicon-th-large"></span>',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('marketing_materials', array(
            'route' => 'marketing-materials_edit',
            'routeParameters' => array('id' => 1),
            'label' => '<span class="glyphicon glyphicon-cog"></span> Маркет. материалы',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('users', array(
            'route' => 'user',
            'label' => '<span class="glyphicon glyphicon-user"></span> Пользователи',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('news', array(
            'route' => 'news',
            'label' => '<span class="glyphicon glyphicon-book"></span> Новости',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('transaction', array(
            'route' => 'transaction',
            'label' => '<span class="glyphicon glyphicon-usd"></span> Сделки',
            'extras' => array('safe_label' => true)
        ));
        $menu->addChild('faq', array(
            'route' => 'faq',
            'label' => '<span class="glyphicon glyphicon-question-sign"></span> FAQ',
            'extras' => array('safe_label' => true)
        ));     
        
        /*
         * Sub Menu
         */
        $subMenu = $menu->addChild('subMenu', array(
            'uri' => '#',
            'label' => '<span class="glyphicon glyphicon-chevron-down"></span>',
            'extras' => array('safe_label' => true)
        ));
        $subMenu->setLinkAttributes(array(
            'class'=> 'dropdown-toggle', 
            'data-toggle' => 'dropdown'
        ));
        $subMenu->setAttribute('class', 'dropdown');
        $subMenu->setChildrenAttribute('class', 'dropdown-menu');
        
        $subMenu->addChild('feedback', array(
            'route' => 'feedback',
            'label' => '<span class="glyphicon glyphicon-comment"></span> Обратная связь',
            'extras' => array('safe_label' => true)
        ));
        $subMenu->addChild('setting', array(
            'route' => 'admin_setting',
            'label' => '<span class="glyphicon glyphicon-cog"></span> Настройки',
            'extras' => array('safe_label' => true)
        ));

        
        if (preg_match('#\/user#i', $uri)){
            $menu['users']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/news#i', $uri)) {
            $menu['news']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/transaction#i', $uri)) {
            $menu['transaction']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/faq#i', $uri)) {
            $menu['faq']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/marketing-materials#i', $uri)) {
            $menu['marketing_materials']->setAttributes(array('class' => 'active'));
        } else {
            $menu['main']->setAttributes(array('class' => 'active'));
        }
        
        if (preg_match('#\/feedback#i', $uri)) {
            $menu['subMenu']->setAttributes(array('class' => 'active'));
            $subMenu['feedback']->setAttributes(array('class' => 'active'));
        } elseif (preg_match('#\/setting#i', $uri)) {
            $menu['subMenu']->setAttributes(array('class' => 'active'));
            $subMenu['setting']->setAttributes(array('class' => 'active'));
        }
        
        return $menu;
    }
}