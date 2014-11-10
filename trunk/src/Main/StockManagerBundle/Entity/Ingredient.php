<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 */
class Ingredient
{
    /**
     * @var string
     */
    private $ingredientname;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idproduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idproduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set ingredientname
     *
     * @param string $ingredientname
     * @return Ingredient
     */
    public function setIngredientname($ingredientname)
    {
        $this->ingredientname = $ingredientname;

        return $this;
    }

    /**
     * Get ingredientname
     *
     * @return string 
     */
    public function getIngredientname()
    {
        return $this->ingredientname;
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
     * Add idproduct
     *
     * @param \Main\StockManagerBundle\Entity\Product $idproduct
     * @return Ingredient
     */
    public function addIdproduct(\Main\StockManagerBundle\Entity\Product $idproduct)
    {
        $this->idproduct[] = $idproduct;

        return $this;
    }

    /**
     * Remove idproduct
     *
     * @param \Main\StockManagerBundle\Entity\Product $idproduct
     */
    public function removeIdproduct(\Main\StockManagerBundle\Entity\Product $idproduct)
    {
        $this->idproduct->removeElement($idproduct);
    }

    /**
     * Get idproduct
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdproduct()
    {
        return $this->idproduct;
    }
}
