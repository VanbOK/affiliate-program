<?php
namespace Stalk\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegistrationConfirmedListener implements EventSubscriberInterface
{

    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_CONFIRMED => 'onRegistrationConfirmed',
        );
    }

    public function onRegistrationConfirmed()
    {
        
        /*
        * Отправляем письмо
        */
        
        $settings = $this->container->get('stalk_admin_setting');

        $mailerSubject = $settings->getSetting('registration_confirmed_subject');
        $mailerSenderName = $settings->getSetting('registration_confirmed_sender_name');
        $sendEmail = explode(",", $settings->getSetting('registration_confirmed_email'));
        
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername(
            $this->container->get('security.context')->getToken()->getUser()
        );
        
        $message = \Swift_Message::newInstance()
           ->setContentType("text/html")
           ->setSubject($mailerSubject)
           ->setFrom( $this->container->getParameter('mailer_user'), $mailerSenderName )
           ->setTo($sendEmail)                
           ->setBody(
               $this->container->get('templating')->render('StalkUserBundle:Registration:mailTpl/RegistrationConfirmed.html.twig',  array( 
                   'user' => $user                    
               ))
           );

        return $this->container->get('mailer')->send($message);
        
    }
}