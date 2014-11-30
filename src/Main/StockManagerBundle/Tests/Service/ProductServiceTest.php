<?php

namespace Main\StockManagerBundle\Entity;

use Main\StockManagerBundle\Tests\TestCase;
use Main\StockManagerBundle\Entity\Ingredient;
use Main\StockManagerBundle\Entity\Producer;
use Main\StockManagerBundle\Entity\Product;
use Main\StockManagerBundle\Services\ProductService;

require_once dirname ( __DIR__ ) . '\Service\TestCase.php';
class ProductServiceTest extends TestCase {
	
	public function setUp() {
		parent::setUp ();
	}
	public function testInsert() {
		$productService = new ProductService($this->entityManager);
		
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
		
		$productService->insertProduct($product);
		$products = $productService->getAllProducts();
		$this->assertCount(1,$products);
	}
	
	public function testGetById(){
		$productService = new ProductService($this->entityManager);
		
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
		
		$productService->insertProduct($product);
		$aux= $productService->getProductById(1);
		$this->assertNotNull($aux);
	}
	
	public function testDropProduct(){
		$productService = new ProductService($this->entityManager);
		
		$ingredient = new Ingredient();
		$ingredient->setIngredientname("Faina");
		
		$producer = new Producer();
		$producer->setProducername("Velpitar");
		
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
		
		$productService->insertProduct($product);
		$productService->dropProduct($product);
		$products = $productService->getAllProducts();
		$this->assertCount(0,$products);
	}
	
	public function testUpdateStock(){
		$productService = new ProductService($this->entityManager);
		
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
		
		$productService->insertProduct($product);
		$aux= $productService->getProductById(1);
		$this->assertEquals(100,$aux->getPieces());
		
		$product->setPieces(150);
		$productService->updateStock($product);
		$aux= $productService->getProductById(1);
		$this->assertEquals(150,$aux->getPieces());
	}
	
	public function testAddIngredient(){
		$productService = new ProductService($this->entityManager);
		
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
		
		$ingredient = new Ingredient();
		$ingredient->setIngredientname("Faina");
		
		$producer = new Producer();
		$producer->setProducername("Velpitar");
		
		$productService->insertProduct($product);
		$productService->addIngredient($product->getId(),$ingredient);
		
		$aux= $productService->getProductById(1);
		$ingredients = $aux->getIdingredient();
		$this->assertCount(1,$ingredients);
	}
	
	public function testRemoveIngredient(){
		$productService = new ProductService($this->entityManager);
	
		$product = new Product();
		$product->setProductname("Paine");
		$product->setPrice(4.3);
		$product->setAdition(10);
		$product->setPieces(100);
	
		$ingredient = new Ingredient();
		$ingredient->setIngredientname("Faina");
	
		$producer = new Producer();
		$producer->setProducername("Velpitar");
	
		$productService->insertProduct($product);
		$productService->addIngredient($product->getId(),$ingredient);
	
		$aux= $productService->getProductById(1);
		$ingredients = $aux->getIdingredient();
		$this->assertCount(1,$ingredients);
		
		$productService->removeIngredient($product,$ingredient);
		$aux= $productService->getProductById(1);
		$ingredients = $aux->getIdingredient();
		$this->assertCount(0,$ingredients);
	}
}
?>