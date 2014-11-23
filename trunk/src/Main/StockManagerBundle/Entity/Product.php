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
     * @var integer
     */
    private $pieces;

    /**
     * @var \Main\StockManagerBundle\Entity\Category
     */
    private $idcategory;

    /**
     * @var \Main\StockManagerBundle\Entity\Producer
     */
    private $idproducer;

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
     * Set pieces
     *
     * @param integer $pieces
     * @return Product
     */
    public function setPieces($pieces)
    {
    	$this->pieces = $pieces;
    
    	return $this;
    }
    
    /**
     * Get pieces
     *
     * @return integer
     */
    public function getPieces()
    {
    	return $this->pieces;
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
    
    static public function getLuceneIndex()
    {
    	if (file_exists($index = self::getLuceneIndexFile())) {
    		return \Zend_Search_Lucene::open($index);
    	}
    
    	return \Zend_Search_Lucene::create($index);
    }
    
    static public function getLuceneIndexFile()
    {
    	return __DIR__.'/../../../../web/data/product.index';
    }

    /**
     * @ORM\PostPersist
     */
    public function updateLuceneIndex()
    {	
    	\Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    			new \Zend_Search_Lucene_Analysis_Analyzer_Common_Text_CaseInsensitive());
    	
        $index = self::getLuceneIndex();
 
        // remove existing entries
        foreach ($index->find('pk:'.$this->getId()) as $hit)
        {
          $index->delete($hit->id);
        }
 
        $doc = new \Zend_Search_Lucene_Document();
 
        // store job primary key to identify it in the search results
        $doc->addField(\Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
 
        // index job fields
        $doc->addField(\Zend_Search_Lucene_Field::Text('productName', $this->getProductname(), 'utf-8'));
//         $doc->addField(\Zend_Search_Lucene_Field::UnStored('company', $this->getCompany(), 'utf-8'));
//         $doc->addField(\Zend_Search_Lucene_Field::UnStored('location', $this->getLocation(), 'utf-8'));
//         $doc->addField(\Zend_Search_Lucene_Field::UnStored('description', $this->getDescription(), 'utf-8'));
 
        // add job to the index
        $index->addDocument($doc);
        $index->commit();
    }

    /**
     * @ORM\PreRemove
     */
    public function deleteLuceneIndex()
    {
    	echo $this->getId();
     $index = self::getLuceneIndex();
 
     $query = 'pk:'.$this->getId();
     echo $query;
     foreach ($index->find($query) as $hit) {
     	  echo "in foreach";
     	  echo $hit->id;
          $index->delete($hit->id);
     }
       
     $index->commit();
    }
}
