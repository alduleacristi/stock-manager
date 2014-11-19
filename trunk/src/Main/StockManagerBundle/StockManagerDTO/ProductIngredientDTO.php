<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Validator\Constraints as FormAssert;
use Symfony\Component\Validator\Constraints\Date;
use Main\StockManagerBundle\Entity\Product;
use Main\StockManagerBundle\Entity\Ingredient;

class ProductIngredientDTO{
	/**
	 * 
	 * @Assert\NotNull
	 */
	private $product;
	
	/**
	 * @Assert\NotNull
	 */
	private $ingredient;
	
	public function convertToIngredient($ingredientService){
		$ingredient = $ingredientService->getingredientById($this->ingredient);
		
		return $ingredient;
	}
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name, $value){
		$this->$name = $value;
	}
}

?>