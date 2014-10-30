<?php

namespace Stalk\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stalk\AdminBundle\Entity\Transaction;
use Stalk\AdminBundle\Form\TransactionType;

/**
 * Transaction controller.
 *
 */
class TransactionController extends Controller
{

    /**
     * Lists all Transaction entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:Transaction')->findAll();

        return $this->render('StalkAdminBundle:Transaction:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Displays a form to edit an existing Transaction entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:Transaction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transaction entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StalkAdminBundle:Transaction:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Transaction entity.
    *
    * @param Transaction $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Transaction $entity)
    {
        $form = $this->createForm(new TransactionType(), $entity, array(
            'action' => $this->generateUrl('transaction_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    
    /**
     * Edits an existing Transaction entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StalkAdminBundle:Transaction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transaction entity.');
        }

        //Выборка доходов
        $beforeSaveIncomes = $currentIncomeIds = array();
        foreach ($entity->getIncome() as $income)
            $beforeSaveIncomes[$income->getId()] = $income;
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);      

        if ($editForm->isValid()) {
            
            //Добавляем доходы    
            foreach ($entity->getIncome() as $income) {

                $income->setTransaction($entity); 
                
                $income->setPayment($income->getPayment());
                $income->setCloseDate($income->getCloseDate());
                $income->setStatus($income->getStatus());
  
                //Если доход - не только что занесен (у него есть id)
                if ($income->getId()) $currentIncomeIds[] = $income->getId();

            }
            
            $em->persist($entity);

            //Если доход который был до сохранения отсутствует в текущем наборе - удаляем его
            foreach ($beforeSaveIncomes as $incomeId => $income)
                if (!in_array( $incomeId, $currentIncomeIds)) $em->remove($income);
            
            $em->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice-successfully', 
                'Сделка "<strong>' . $entity->getId() . '</strong>" сохранена!');

            return $this->redirect($this->generateUrl('transaction_edit', array('id' => $id)));
        }

        return $this->render('StalkAdminBundle:Transaction:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Transaction entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StalkAdminBundle:Transaction')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Transaction entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice-successfully', 
                'Сделка "<strong>' . $id . '</strong>" удалена!');
            
        }

        return $this->redirect($this->generateUrl('transaction'));
    }

    /**
     * Creates a form to delete a Transaction entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transaction_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
