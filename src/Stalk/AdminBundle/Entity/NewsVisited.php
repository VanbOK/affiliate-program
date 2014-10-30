<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsVisited
 *
 * @ORM\Table(name="news_visited")
 * @ORM\Entity(repositoryClass="Stalk\AdminBundle\Entity\Repositories\NewVisitedRepository")
 */
class NewsVisited
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
     * @var integer
     *
     * @ORM\Column(name="news_id", type="integer")
     */
    private $newsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;    

    /**
     * @var boolean
     *
     * @ORM\Column(name="visited", type="boolean", options={"default":0}, nullable=true)
     */
    private $visited=false;

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
     * Set newsId
     *
     * @param integer $newsId
     * @return NewsVisited
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;

        return $this;
    }

    /**
     * Get newsId
     *
     * @return integer 
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return NewsVisited
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set visited
     *
     * @param boolean $visited
     * @return NewsVisited
     */
    public function setVisited($visited)
    {
        $this->visited = $visited;

        return $this;
    }

    /**
     * Get visited
     *
     * @return boolean 
     */
    public function getVisited()
    {
        return $this->visited;
    }
}
