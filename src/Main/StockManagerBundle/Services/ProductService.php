<?php

namespace Main\StockManagerBundle\Services;

class ProductService {
	protected $em;
	public function __construct(\Doctrine\ORM\EntityManager $em) {
		$this->em = $em;
	}
	public function insertProduct($product) {
		$this->em->persist ( $product );
		$this->em->flush ();
	}
	public function getProductById($idProduct) {
		return $this->em->getRepository ( 'MainStockManagerBundle:Product' )->find ( $idProduct );
	}
	public function getAllProducts() {
		return $this->em->getRepository ( 'MainStockManagerBundle:Product' )->findAll ();
	}
	public function addIngredient($product, $ingredient) {
		$oldProduct = $this->getProductById ( $product );
		
		if (! $product)
			throw new \Exception ( 'No product found' );
		
		$oldProduct->addIdingredient ( $ingredient );
		
		$this->em->flush ();
	}
	public function removeIngredient($product, $ingredientObject) {
		$oldProduct = $this->getProductById ( $product );
		
		if (! $product)
			throw new Exception ( 'No product found' );
		
		$oldProduct->removeIdingredient ( $ingredientObject );
		
		$this->em->flush ();
	}
	public function dropProduct($product) {
		if (! $product)
			throw new \Exception ();
		
		$this->em->remove ( $product );
		$this->em->flush ();
	}
	public function updateStock($product) {
		$oldProduct = $this->getProductById ( $product->getId () );
		
		$oldProduct->setPieces = $product->getPieces ();
		
		$this->em->flush ();
	}
}
?>