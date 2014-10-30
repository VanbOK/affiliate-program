<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Stalk\AdminBundle\Entity\Feedback;
use Stalk\AffiliateBundle\Form\FeedbackType;

class FeedbackController extends Controller
{
    
    public function indexAction()
    {
        
        $entity = new Feedback();
        $form   = $this->createCreateForm($entity);

        return $this->render('StalkAffiliateBundle:Feedback:index.html.twig', array(
            'form'   => $form->createView(),
        ));
        
    }  
    
    /**
     * Creates a form to create a Feedback entity.
     *
     * @param Feedback $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Feedback $entity)
    {
        return $this->createForm(new FeedbackType(), $entity, array(
            'action' => $this->generateUrl('stalk_affiliate_feedback_create'),
            'method' => 'POST',
        ));
    }
    
    /**
     * Creates a new Feedback entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Feedback();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
             
            /*
            * Отправляем письмо
            */
            $settings = $this->get('stalk_admin_setting');
            
            $mailerSubject = $settings->getSetting('feedback_subject');
            $mailerSenderName = $settings->getSetting('feedback_sender_name');
            $sendEmail = explode(",", $settings->getSetting('feedback_send_email'));
            
            $message = \Swift_Message::newInstance()
               ->setContentType("text/html")
               ->setSubject($mailerSubject)
               ->setFrom( $this->container->getParameter('mailer_user'), $mailerSenderName )
               ->setTo($sendEmail)                
               ->setBody(
                   $this->renderView('StalkAffiliateBundle:Feedback:mailTpl/send-mail.html.twig',  array( 
                       'entity' => $entity                    
                   ))
               );
            
            if ( $this->get('mailer')->send($message) ) {

                $this->get('session')->getFlashBag()
                    ->add('success', 
                    'Спасибо! Ваша заявка отправлена!'); 
                
            } else {
                
                $this->get('session')->getFlashBag()
                    ->add('danger', 
                    'Ваша заявка не отправлена! Обратитесь пожалуйста к администратору!'); 
                
            }
            
            return $this->redirect($this->generateUrl('stalk_affiliate_feedback'));
        }

        return $this->render('StalkAffiliateBundle:Feedback:index.html.twig', array(
            'form'   => $form->createView(),
        ));
    }
    
    
}
