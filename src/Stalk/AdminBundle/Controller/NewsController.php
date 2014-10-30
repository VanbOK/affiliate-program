<?php

namespace Stalk\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stalk\AdminBundle\Entity\NewsVisited;
use Stalk\AdminBundle\Entity\News;
use Stalk\AdminBundle\Form\NewsType;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{

    /**
     * Lists all News entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:News')
            ->findBy(array(),array('updated'=>'DESC'));

        return $this->render('StalkAdminBundle:News:index.html.twig', array(
            'entities' => $entities,
            'sendNewNewsCount' => $this->sendMailNewNewsCount(),
        ));
    }
    /**
     * Creates a new News entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new News();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            
            $em->flush();
            
            //Добавляем флаг 'Новая новость' всем пользователям
            if ($entity->getEnabled()) {
                foreach ($em->getRepository('StalkUserBundle:User')->findAll() as $user) {
                    $newsVisited = new newsVisited();
                    $newsVisited->setUserId($user->getId());
                    $newsVisited->setNewsId($entity->getId());
                    $em->persist($newsVisited);
                }
            }
            
            $em->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice-successfully', 
                'Новость "<strong>' . $entity->getTitle() . '</strong>" создана!');

            return $this->redirect($this->generateUrl('news'));
        }

        return $this->render('StalkAdminBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a News entity.
     *
     * @param News $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new News entity.
     *
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createCreateForm($entity);

        return $this->render('StalkAdminBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StalkAdminBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a News entity.
    *
    * @param News $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing News entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            $em->flush();
            
            //Добавляем флаг 'Новая новость' всем пользователям
            if ($entity->getEnabled()) {
                
                $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
                    ->findBy(array('newsId'=>$entity->getId()));
                
                if (empty($newNews)) {
                    foreach ($em->getRepository('StalkUserBundle:User')->findAll() as $user) {
                        $newsVisited = new newsVisited();
                        $newsVisited->setUserId($user->getId());
                        $newsVisited->setNewsId($entity->getId());
                        $em->persist($newsVisited);
                    }
                }
            } else {
                //Удаляем флаги 'Новая новость'
                $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
                    ->findBy(array('newsId'=>$entity->getId()));
                foreach ($newNews as $item){
                    $em->remove($item);
                }
            }
            
            $em->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice-successfully', 
                'Новость "<strong>' . $entity->getTitle() . '</strong>" сохранена!');

            return $this->redirect($this->generateUrl('news'));
        }

        return $this->render('StalkAdminBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StalkAdminBundle:News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }
            
            //Удаляем флаги 'Новая новость'
            $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
                ->findBy(array('newsId'=>$entity->getId()));
            foreach ($newNews as $item){
                $em->remove($item);
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice-successfully', 
                'Новость "<strong>' . $entity->getTitle() . '</strong>" удалена!');
            
        }

        return $this->redirect($this->generateUrl('news'));
    }

    /**
     * Creates a form to delete a News entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Send mail if new news
     *
     */
    public function sendMailNewNewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $userManager = $this->get('fos_user.user_manager');

        $users = $em->getRepository('StalkAdminBundle:NewsVisited')
            ->getUser();
        
        foreach ($users as $user) {
            
            $newNews = $em->getRepository('StalkAdminBundle:NewsVisited')
                ->findByUserId($user);

            $user = $userManager->findUserBy(array('id' => $user['userId']));
                       
            $newsItems = array();            
            foreach ($newNews as $news){
                
                $newsItem = $em->getRepository('StalkAdminBundle:News')
                    ->find($news->getNewsId());
                
                //Новости
                $newsItems[] = $newsItem;
                
            }
            
            /*
            * Отправляем письмо
            */
            $settings = $this->get('stalk_admin_setting');
            
            $mailerSubject = $settings->getSetting('new_news_subject');
            $mailerSenderName = $settings->getSetting('new_news_sender_name');
            
            $message = \Swift_Message::newInstance()
               ->setContentType("text/html")
               ->setSubject($mailerSubject)
               ->setFrom( $this->container->getParameter('mailer_user'), $mailerSenderName )
               ->setTo($user->getEmail())                
               ->setBody(
                   $this->renderView('StalkAdminBundle:News:mailTpl/send-new-news.html.twig',  array( 
                       'user' => $user,
                       'news' => $newsItems,            
                   ))
               );
            
            $this->get('mailer')->send($message);
            
        }
        
        $this->get('session')->getFlashBag()
            ->add('notice-successfully', 
            'Оповещения отправлены!');

        return $this->redirect($this->generateUrl('news'));

    }
    
    /**
     * Send mail if new news count
     *
     */
    public function sendMailNewNewsCount()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('StalkAdminBundle:NewsVisited')
            ->getUser();

        return count($users);
    }
    
}
