<?php

namespace Stalk\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * MarketingMaterials
 *
 * @ORM\Table(name="marketing_materials")
 * @ORM\Entity
 */
class MarketingMaterials
{
    
    public function __construct()
    {
        $this->pdf = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();
    }
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="presentationDescription", type="text")
     */
    private $presentationDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="portfolioDescription", type="text")
     */
    private $portfolioDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="videoDescription", type="text")
     */
    private $videoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="priceDescription", type="text")
     */
    private $priceDescription;

    /**
     * @ORM\OneToMany(targetEntity="MarketingMaterialsPdf", mappedBy="material", cascade={"all"})
     */
    private $pdf;
    
    /**
     * @ORM\OneToMany(targetEntity="MarketingMaterialsImage", mappedBy="material", cascade={"all"})
     */
    private $image;
    
    /**
     * @ORM\OneToMany(targetEntity="MarketingMaterialsVideo", mappedBy="material", cascade={"all"})
     */
    private $video;

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
     * Set description
     *
     * @param string $description
     * @return MarketingMaterials
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set presentationDescription
     *
     * @param string $presentationDescription
     * @return MarketingMaterials
     */
    public function setPresentationDescription($presentationDescription)
    {
        $this->presentationDescription = $presentationDescription;

        return $this;
    }

    /**
     * Get presentationDescription
     *
     * @return string 
     */
    public function getPresentationDescription()
    {
        return $this->presentationDescription;
    }

    /**
     * Set portfolioDescription
     *
     * @param string $portfolioDescription
     * @return MarketingMaterials
     */
    public function setPortfolioDescription($portfolioDescription)
    {
        $this->portfolioDescription = $portfolioDescription;

        return $this;
    }

    /**
     * Get portfolioDescription
     *
     * @return string 
     */
    public function getPortfolioDescription()
    {
        return $this->portfolioDescription;
    }

    /**
     * Set videoDescription
     *
     * @param string $videoDescription
     * @return MarketingMaterials
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;

        return $this;
    }

    /**
     * Get videoDescription
     *
     * @return string 
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * Set priceDescription
     *
     * @param string $priceDescription
     * @return MarketingMaterials
     */
    public function setPriceDescription($priceDescription)
    {
        $this->priceDescription = $priceDescription;

        return $this;
    }

    /**
     * Get priceDescription
     *
     * @return string 
     */
    public function getPriceDescription()
    {
        return $this->priceDescription;
    }

    /**
     * Add pdf
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsPdf $pdf
     * @return MarketingMaterials
     */
    public function addPdf(\Stalk\AdminBundle\Entity\MarketingMaterialsPdf $pdf)
    {
        $this->pdf[] = $pdf;

        return $this;
    }

    /**
     * Remove pdf
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsPdf $pdf
     */
    public function removePdf(\Stalk\AdminBundle\Entity\MarketingMaterialsPdf $pdf)
    {
        $this->pdf->removeElement($pdf);
    }

    /**
     * Get pdf
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Add image
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsImage $image
     * @return MarketingMaterials
     */
    public function addImage(\Stalk\AdminBundle\Entity\MarketingMaterialsImage $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsImage $image
     */
    public function removeImage(\Stalk\AdminBundle\Entity\MarketingMaterialsImage $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add video
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsVideo $video
     * @return MarketingMaterials
     */
    public function addVideo(\Stalk\AdminBundle\Entity\MarketingMaterialsVideo $video)
    {
        $this->video[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Stalk\AdminBundle\Entity\MarketingMaterialsVideo $video
     */
    public function removeVideo(\Stalk\AdminBundle\Entity\MarketingMaterialsVideo $video)
    {
        $this->video->removeElement($video);
    }

    /**
     * Get video
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideo()
    {
        return $this->video;
    }
    
}
