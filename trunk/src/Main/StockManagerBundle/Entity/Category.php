<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
	public function __construct()
	{
		$this->products = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
    /**
     * @var string
     */
    private $categoryname;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;
    
    private $products;


    /**
     * Set categoryname
     *
     * @param string $categoryname
     * @return Category
     */
    public function setCategoryname($categoryname)
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    /**
     * Get categoryname
     *
     * @return string 
     */
    public function getCategoryname()
    {
        return $this->categoryname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getProducts(){
    	return $this->products;
    }
    
    public function addProducts(\Main\StockManagerBundle\Entity\Product $product){
    	$this->products[] = $product;
    	
    	return $this;
    }
    
    public function removeProducts(\Main\StockManagerBundle\Entity\Product $product)
    {
    	$this->products->removeElement($product);
    }
}
