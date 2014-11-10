<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var string
     */
    private $productname;

    /**
     * @var \DateTime
     */
    private $manufacturedate;

    /**
     * @var \DateTime
     */
    private $expiringdate;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $adition;

    /**
     * @var string
     */
    private $observation;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Main\StockManagerBundle\Entity\Producer
     */
    private $idproducer;

    /**
     * @var \Main\StockManagerBundle\Entity\Category
     */
    private $idcategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idingredient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idingredient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set productname
     *
     * @param string $productname
     * @return Product
     */
    public function setProductname($productname)
    {
        $this->productname = $productname;

        return $this;
    }

    /**
     * Get productname
     *
     * @return string 
     */
    public function getProductname()
    {
        return $this->productname;
    }

    /**
     * Set manufacturedate
     *
     * @param \DateTime $manufacturedate
     * @return Product
     */
    public function setManufacturedate($manufacturedate)
    {
        $this->manufacturedate = $manufacturedate;

        return $this;
    }

    /**
     * Get manufacturedate
     *
     * @return \DateTime 
     */
    public function getManufacturedate()
    {
        return $this->manufacturedate;
    }

    /**
     * Set expiringdate
     *
     * @param \DateTime $expiringdate
     * @return Product
     */
    public function setExpiringdate($expiringdate)
    {
        $this->expiringdate = $expiringdate;

        return $this;
    }

    /**
     * Get expiringdate
     *
     * @return \DateTime 
     */
    public function getExpiringdate()
    {
        return $this->expiringdate;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set adition
     *
     * @param float $adition
     * @return Product
     */
    public function setAdition($adition)
    {
        $this->adition = $adition;

        return $this;
    }

    /**
     * Get adition
     *
     * @return float 
     */
    public function getAdition()
    {
        return $this->adition;
    }

    /**
     * Set observation
     *
     * @param string $observation
     * @return Product
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string 
     */
    public function getObservation()
    {
        return $this->observation;
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
     * Set idproducer
     *
     * @param \Main\StockManagerBundle\Entity\Producer $idproducer
     * @return Product
     */
    public function setIdproducer(\Main\StockManagerBundle\Entity\Producer $idproducer = null)
    {
        $this->idproducer = $idproducer;

        return $this;
    }

    /**
     * Get idproducer
     *
     * @return \Main\StockManagerBundle\Entity\Producer 
     */
    public function getIdproducer()
    {
        return $this->idproducer;
    }

    /**
     * Set idcategory
     *
     * @param \Main\StockManagerBundle\Entity\Category $idcategory
     * @return Product
     */
    public function setIdcategory(\Main\StockManagerBundle\Entity\Category $idcategory = null)
    {
        $this->idcategory = $idcategory;

        return $this;
    }

    /**
     * Get idcategory
     *
     * @return \Main\StockManagerBundle\Entity\Category 
     */
    public function getIdcategory()
    {
        return $this->idcategory;
    }

    /**
     * Add idingredient
     *
     * @param \Main\StockManagerBundle\Entity\Ingredient $idingredient
     * @return Product
     */
    public function addIdingredient(\Main\StockManagerBundle\Entity\Ingredient $idingredient)
    {
        $this->idingredient[] = $idingredient;

        return $this;
    }

    /**
     * Remove idingredient
     *
     * @param \Main\StockManagerBundle\Entity\Ingredient $idingredient
     */
    public function removeIdingredient(\Main\StockManagerBundle\Entity\Ingredient $idingredient)
    {
        $this->idingredient->removeElement($idingredient);
    }

    /**
     * Get idingredient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdingredient()
    {
        return $this->idingredient;
    }
}
