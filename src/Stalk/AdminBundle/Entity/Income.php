<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Income
 *
 * @ORM\Table(name="transactions_income")
 * @ORM\Entity
 */
class Income
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="payment", type="float")
     */
    private $payment;

    /**
     * @var \Date
     *
     * @ORM\Column(name="closeDate", type="date")
     */
    private $closeDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="Transaction", inversedBy="income")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     */
    private $transaction;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payment
     *
     * @param float $payment
     * @return Income
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return float 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set closeDate
     *
     * @param \DateTime $closeDate
     * @return Income
     */
    public function setCloseDate($closeDate)
    {
        $this->closeDate = $closeDate;

        return $this;
    }

    /**
     * Get closeDate
     *
     * @return \DateTime 
     */
    public function getCloseDate()
    {
        return $this->closeDate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Income
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set transaction
     *
     * @param \Stalk\AdminBundle\Entity\Transaction $transaction
     * @return Income
     */
    public function setTransaction(\Stalk\AdminBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \Stalk\AdminBundle\Entity\Transaction 
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
