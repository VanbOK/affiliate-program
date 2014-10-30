<?php

namespace Stalk\AffiliateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stalk\AdminBundle\Entity\Transaction;

/**
 * Transaction controller.
 *
 */
class TransactionController extends Controller
{

    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StalkAdminBundle:Transaction')
            ->findBy(array('refId'=>$this->getUser()->getRefId()), array('status'=>'ASC'));
        
        return $this->render('StalkAffiliateBundle:Transaction:index.html.twig', array(
            'entities' => $entities,
            'form' => $this->sendTransactionForm()->createView(),
        ));
        
    }
    
    /**
     * Creates a new Transaction entity.
     *
     */
    public function createAction(Request $request)
    {
        //$request->request->get('a');
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Transaction();
        
        $entity->setName($request->request->get('name'));
        $entity->setRefId($request->request->get('a'));
        $entity->setStatus('notConfirmed'); 
        
        
        $em->persist($entity);
        $em->flush();
        
        
        $response = new Response();
        $response->setContent('123');        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST');

        return $response->send();
        
    }

    /**
     * Creates a form to create a Transaction entity.
     *
     * @param Transaction $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Transaction $entity)
    {
        $form = $this->createForm(new TransactionType(), $entity, array(
            'action' => $this->generateUrl('transaction_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    
    /**
     * Creates a form to send a Transaction.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function sendTransactionForm()
    {
        
        $user = $this->getUser();
        
        $defaultData = array(
            'firstname'=>$user->getFirstName(),
            'surname'=>$user->getSurname(),
            'email'=>$user->getEmail(),
            'phone'=>$user->getPhone(),
            'company'=>$user->getCompany(),            
        );
        
        $webMoneyR = $user->getWebMoneyR() ? ' ('.$user->getWebMoneyR().')' : '';
        $yandexMoney = $user->getYandexMoney() ? ' ('.$user->getYandexMoney().')' : '';
        
        $form = $this->createFormBuilder($defaultData)
            ->add('firstname', 'text', array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))            
            ->add('surname' ,'text', array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'))
            ->add('email' ,'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone' ,'text', array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('company' ,'text', array('label' => 'form.company', 'translation_domain' => 'FOSUserBundle'))
            ->add('paymentMethod', 'choice', array(
                'choices' => array(
                    'webMoneyR' => 'WebMoney R-кошелёк' . $webMoneyR,
                    'yandexMoney' => 'Яндекс.Деньги' . $yandexMoney,
                ),
                'label' => 'Способ получения денег:',
                'required' => true,
            ))
            ->add('payment','hidden', array('label'=>'Сумма платежа'))
            ->getForm();
        
            /*$form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
            }*/
        
        return $form;
        
    }


}
