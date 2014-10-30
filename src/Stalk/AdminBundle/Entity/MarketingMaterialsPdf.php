<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * MarketingMaterialsPdf
 *
 * @ORM\Table(name="marketing_materials_pdf")
 * @ORM\Entity()
 */
class MarketingMaterialsPdf
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
     * @ORM\ManyToOne(targetEntity="MarketingMaterials", inversedBy="pdf")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $material;

    /**
     * Ссылка
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */

    private $link;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Миниатюра
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */

    private $image;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $thumbnail;
    
    /**
     * Название изображения
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return MarketingMaterialsPdf
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
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
    
    /**
     * Sets thumbnail file.
     *
     * @param UploadedFile $thumbnail
     */
    public function setThumbnail(UploadedFile $thumbnail = null)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get thumbnail file.
     *
     * @return UploadedFile
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
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
        return 'upload/pdf/marketing_materials';
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MarketingMaterials
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
     * @return MarketingMaterialsPdf
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
     * @return MarketingMaterialsPdf
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
     * Set image
     *
     * @param string $image
     * @return MarketingMaterialsPdf
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
