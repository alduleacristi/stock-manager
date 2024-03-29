<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Entity\Ingredient;

class IngredientDTO{
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 25,
	 *    minMessage = "The category name must have at least 3 characters",
	 *    maxMessage = "The category name can have maximum 25 characters"
	 * ) 	
	 */
	private $ingredientName;
	
	public function convertToIngredient(){
		$ingredient = new Ingredient();
		$ingredient->setIngredientname($this->ingredientName);
		
		return $ingredient;
	}
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name = $value;
	}
}
?>