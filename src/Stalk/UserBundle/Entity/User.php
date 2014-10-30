<?php

namespace Stalk\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    
    public function __construct() {
        parent::__construct();
        $this->refId = uniqid();
    }

        /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;
    
    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=255, nullable=true)
     */
    private $site;
    
    /**
     * Способы получения денег - WebMoney R-кошелёк
     * @var string
     *
     * @ORM\Column(name="web_maney_r", type="string", length=255, nullable=true)
     */
    private $webMoneyR;
    
    /**
     * Способы получения денег - Яндекс.Деньги
     * @var string
     *
     * @ORM\Column(name="yandex_money", type="string", length=255, nullable=true)
     */
    private $yandexMoney;
    
    /**
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $refId;

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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return User
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set webMoneyR
     *
     * @param string $webMoneyR
     * @return User
     */
    public function setWebMoneyR($webMoneyR)
    {
        $this->webMoneyR = $webMoneyR;

        return $this;
    }

    /**
     * Get webMoneyR
     *
     * @return string 
     */
    public function getWebMoneyR()
    {
        return $this->webMoneyR;
    }

    /**
     * Set yandexMoney
     *
     * @param string $yandexMoney
     * @return User
     */
    public function setYandexMoney($yandexMoney)
    {
        $this->yandexMoney = $yandexMoney;

        return $this;
    }

    /**
     * Get yandexMoney
     *
     * @return string 
     */
    public function getYandexMoney()
    {
        return $this->yandexMoney;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set username
     *
     * @param string $email
     */
    public function setEmail($email){
        parent::setEmail($email);
        
        $this->setUsername($email);
    }
    

    /**
     * Set refId
     *
     * @param guid $refId
     * @return User
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Get refId
     *
     * @return guid 
     */
    public function getRefId()
    {
        return $this->refId;
    }
}
