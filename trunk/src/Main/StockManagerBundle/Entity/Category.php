<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var string
     */
    private $categoryname;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $iduser;

    /**
     * @var integer
     */
    private $id;


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
     * Set iduser
     *
     * @param string $iduser
     * @return Category
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return string 
     */
    public function getIduser()
    {
        return $this->iduser;
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
}
