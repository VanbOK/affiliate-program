<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * MarketingMaterialsVideo
 *
 * @ORM\Table(name="marketing_materials_video")
 * @ORM\Entity()
 */
class MarketingMaterialsVideo
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
     * @ORM\ManyToOne(targetEntity="MarketingMaterials", inversedBy="video")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $material;

    /**
     * Ссылка на видеоролик(youtube)
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */

    private $url;
        
    /**
     * Название видеоролика
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * Категория
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;
    
    /**
     * Миниатюра
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=255, nullable=true)
     */
    private $thumbnail;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
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
     * Set url
     *
     * @param string $url
     * @return MarketingMaterialsVideo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MarketingMaterialsVideo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set material
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterials $material
     * @return MarketingMaterialsVideo
     */
    public function setMaterial(\Stalk\AdminBundle\Entity\MarketingMaterials $material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return \Stalk\AdminBundle\Entity\MarketingMaterials 
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return MarketingMaterialsVideo
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return MarketingMaterialsVideo
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /*
     * Определение путей для загрузки файла
     */
    public function getAbsolutePath()
    {
        return $this->getUploadRootDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir();
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'upload/images/marketing_materials/video/'.time();
    }
    
}
