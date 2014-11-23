<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Validator\Constraints as FormAssert;
use Symfony\Component\Validator\Constraints\Date;
use Main\StockManagerBundle\Entity\Product;

class ProductDTO{
	/**
	 * 
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 15,
	 *    minMessage = "The product name must have at least 3 characters",
	 *    maxMessage = "The product name can have maximum 15 characters"
	 * )
	 */
	private $productName;
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Range(
	 *      min = 0.1,
	 *      max = 500,
	 *      minMessage = "The price must be at least 0.1",
	 *      maxMessage = "The price can not be great than 100"
	 * )
	 */
	private $productPrice;
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Range(
	 *      min = 0.1,
	 *      max = 100,
	 *      minMessage = "The addition must be at least 0.1%",
	 *      maxMessage = "The addition can not be great than 100%"
	 * )
	 */
	private $productAddition;
	
	/**
	 *
	 * @Assert\Length(
	 * 	max = 500,
	 *  maxMessage = "Description must have maximum 500 characters"
	 * )
	 */
	private $description;
	
	/**
	 * @Assert\Date()
	 * @FormAssert\DateSmalThanActual()
     * @author Cristi
     * @var \Date 
     */
	private $manufactureDate;
	
	/**
	 * @Assert\Date()
	 * @FormAssert\DategreatThanActual()
	 */
	private $expiringDate;
	
	/**
	 * @Assert\NotNull()
	 */
	private $category;
	
	/**
	 * @Assert\NotNull()
	 */
	private $producer;
	
	public function convertToProduct($categoryService,$producerService){
		$category = $categoryService->getCategoryById($this->category);
		$producer = $producerService->getproducerById($this->producer);
		
		$product = new product();
		
		$product->setProductname($this->productName);
		$product->setManufacturedate($this->manufactureDate);
		$product->setExpiringdate($this->expiringDate);
		$product->setprice($this->productPrice);
		$product->setAdition($this->productAddition);
		$product->setObservation($this->description);
		$product->setIdcategory($category);
		$product->setIdproducer($producer);
		$product->setPieces(0);
		
		return $product;
	}
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name, $value){
		$this->$name = $value;
	}
}

?>