<?php
namespace Main\StockManagerBundle\Services;

class IngredientService{
	protected $em;

	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;
	}

	public function insertIngredient($ingredient){
		$this->em->persist($ingredient);
		$this->em->flush();
	}

	public function getAllIngredients(){
		return $this->em->getRepository('MainStockManagerBundle:Ingredient')->findAll();
	}

	public function getIngredientById($idIngredient){
		return $this->em->getRepository('MainStockManagerBundle:Ingredient')->find($idIngredient);
	}
	
	public function dropIngredient($ingredient) {
		$this->em->remove ( $ingredient );
		$this->em->flush ();
	}
}
?>