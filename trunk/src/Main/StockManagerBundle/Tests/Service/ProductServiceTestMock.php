<?php
use Main\StockManagerBundle\Services\ProductService;

class ProductServiceTest extends \PHPUnit_Framework_TestCase{
	private $em;
	
	private function mockIngredient(){
		$ingredient = $this->getMock('Main\StockManagerBundle\Entity\Ingredient');
		
		return $ingredient;
	}
	
	private function mockProducer($producerName){
		$producer = $this->getMock('Main\StockManagerBundle\Entity\Producer');
		$producer->expects($this->any())
				->method('getProducername')
				->will($this->returnValue($producerName));
		
		return $producer;
	}
	
	private function mockProduct(){
		$ingredients = new Doctrine\Common\Collections\ArrayCollection();
		$ingredients->add($this->mockIngredient());
		$ingredients->add($this->mockIngredient());
		
		$producer = $this->mockProducer("Velpitar");
		
		$product = $this->getMock('Main\StockManagerBundle\Entity\Product');
		$product->expects($this->any())
				->method('getIdingredient')
				->will($this->returnValue($ingredients));
		$product->expects($this->any())
				->method('getIdproducer')
				->will($this->returnValue($producer));
	
		return $product;
	}
	
	private function mockRepository(){
		$productRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
								  ->disableOriginalConstructor()
								  ->getMock();
		
		$productRepository->expects($this->any())
							->method('find')
							->will($this->returnValue($this->mockProduct()));
		$products = new Doctrine\Common\Collections\ArrayCollection();
		$products->add($this->mockProduct());
		$products->add($this->mockProduct());
		$products->add($this->mockProduct());
		$productRepository->expects($this->any())
						  ->method('findAll')
						  ->will($this->returnValue($products));
		
		return $productRepository;
	}
	
	private function mockEntityManager(){
		$this->em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
							  ->disableOriginalConstructor()
							  ->getMock();
		
		$this->em->expects($this->any())
									  ->method('getRepository')
									  ->will($this->returnValue($this->mockRepository()));
		
// 		$this->em->expects($this->any())
// 				 ->method('persist')
// 				 ->will($this->returnCallback(function(){
// 				 	$products = new Doctrine\Common\Collections\ArrayCollection();
// 				 	$products->add($this->mockProduct());
// 				 	$products->add($this->mockProduct());
// 				 	$products->add($this->mockProduct());
// 				 	$products->add($this->mockProduct());
				 	
// 				 	return $products;
// 				 }));
// 		$mockEM->expects($this->any())
// 		->method('flush')
// 		->will($this->returnValue(null));
	}
	
	
	public function testGetAllProducts(){
		$product = $this->mockProduct();
		$this->assertCount(2, $product->getIdingredient());
		$this->assertEquals("Velpitar", $product->getIdproducer()->getProducername());
		
		$this->mockEntityManager();
		$productService = new ProductService($this->em);
		
		$this->assertEquals($this->mockProduct(),$productService->getProductById(1));
		$this->assertCount(2,$productService->getProductById(1)->getIdingredient());
		
		$this->assertCount(3,$productService->getAllProducts());
		
		//$this->assertCount(4,$productService->insertProduct($this->mockProduct()));
	}
}
?>