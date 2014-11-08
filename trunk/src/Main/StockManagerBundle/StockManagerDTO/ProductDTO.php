<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Validator\Constraints as FormAssert;
use Symfony\Component\Validator\Constraints\Date;

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
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name, $value){
		$this->$name = $value;
	}
}

?>