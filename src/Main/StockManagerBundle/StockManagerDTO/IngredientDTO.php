<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;

class IngredientDTO{
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 15,
	 *    minMessage = "The category name must have at least 3 characters",
	 *    maxMessage = "The category name can have maximum 15 characters"
	 * ) 	
	 */
	private $ingredientName;
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name = $value;
	}
}
?>