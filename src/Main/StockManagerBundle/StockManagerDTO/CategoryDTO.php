<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;
use Main\StockManagerBundle\Entity\Category;

class CategoryDTO{
	private $id;
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 15,
	 *    minMessage = "The category name must have at least 3 characters",
	 *    maxMessage = "The category name can have maximum 15 characters"
	 * ) 	
	 */
	private $categoryName;
	
	/**
	 * 
	 * @Assert\Length(
	 * 	max = 500,
	 *  maxMessage = "Description must have maximum 500 characters"
	 * )
	 */
	private $description;
	
	public function convertToCategory(){
		$category = new Category();
		
		$category->setCategoryname($this->categoryName);
		$category->setDescription($this->description);
		
		return $category;
	}
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name = $value;
	}
}
?>