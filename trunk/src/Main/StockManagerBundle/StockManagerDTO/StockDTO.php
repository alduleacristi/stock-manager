<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Validator\Constraints as FormAssert;
use Symfony\Component\Validator\Constraints\Date;
use Main\StockManagerBundle\Entity\Product;

class StockDTO{
	/**
	 * @Assert\NotBlank
	 * @Assert\Range(
	 *      min = 1,
	 *      minMessage = "The number of products must be positive",
	 * )
	 */
	private $pieces;
	
	private $idProduct;
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name, $value){
		$this->$name = $value;
	}
}

?>