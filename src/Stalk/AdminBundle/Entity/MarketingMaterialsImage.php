<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * MarketingMaterialsImage
 *
 * @ORM\Table(name="marketing_materials_image")
 * @ORM\Entity()
 */
class MarketingMaterialsImage
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
     * @ORM\ManyToOne(targetEntity="MarketingMaterials", inversedBy="image")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $material;

    /**
     * Ссылка на изображение
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */

    private $image;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Название изображения
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

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
        return 'upload/images/marketing_materials/portfolio/'.time();
    }
    

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
     * Set image
     *
     * @param string $image
     * @return MarketingMaterialsImage
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

    /**
     * Set title
     *
     * @param string $title
     * @return MarketingMaterialsImage
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
     * @return MarketingMaterialsImage
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
}
