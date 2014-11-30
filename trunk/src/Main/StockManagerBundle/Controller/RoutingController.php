<?php

namespace Main\StockManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Main\StockManagerBundle\Common\StockManagerRouting;
use Main\StockManagerBundle\Forms\InsertCategoryForm;
use Main\StockManagerBundle\Forms\InsertProductIngredientForm;
use Main\StockManagerBundle\StockManagerDTO\UserDTO;
use Main\StockManagerBundle\StockManagerDTO\CategoryDTO;
use Main\StockManagerBundle\Forms\InsertProductForm;
use Main\StockManagerBundle\StockManagerDTO\ProductDTO;
use Main\StockManagerBundle\Forms\InsertProducerForm;
use Main\StockManagerBundle\StockManagerDTO\ProducerDTO;
use Main\StockManagerBundle\Forms\InsertIngredientForm;
use Main\StockManagerBundle\Forms\UpdateStockForm;
use Main\StockManagerBundle\StockManagerDTO\IngredientDTO;
use Main\StockManagerBundle\StockManagerDTO\StockDTO;
use Main\StockManagerBundle\StockManagerDTO\ProductIngredientDTO;
use Symfony\Component\HttpFoundation\Request;
use Main\StockManagerBundle\Common\StockManagerPaginator;
use Main\StockManagerBundle\Entity\Product;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoutingController extends Controller {
	public function toIndexAction() {
		return $this->render ( 'MainStockManagerBundle:Pages:index.html.twig', array () );
	}
	public function toAdminIndexAction() {
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:index.html.twig', array () );
	}
	public function toAboutAction() {
		$route = StockManagerRouting::ABOUT_KEY;
		
		return $this->render ( 'MainStockManagerBundle:Pages:about.html.twig', array (
				'routing' => $route 
		) );
	}
	public function insertCategoryFormAction(Request $request) {
		$categoryDTO = new CategoryDTO ();
		
		$form = $this->createForm ( new InsertCategoryForm (), $categoryDTO );
		
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$categoryService = $this->get ( 'category_service' );
			
			$category = $categoryDTO->convertToCategory ();
			$categoryService->insertCategory ( $category );
			
			$url = $this->generateurl ( StockManagerRouting::VIEW_CATEGORY_KEY );
			$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Category was added with succes' );
			
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_CATEGORY_KEY ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertCategory.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	public function insertProductFormAction(Request $request) {
		$productDTO = new ProductDTO ();
		
		$form = $this->createForm ( new InsertProductForm ( $this->get ( 'category_service' ), $this->get ( 'producer_service' ) ), $productDTO );
		
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$productService = $this->get ( 'product_service' );
			
			$product = $productDTO->convertToProduct ( $this->get ( 'category_service' ), $this->get ( 'producer_service' ) );
			$productService->insertProduct ( $product );
			
			$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Product was added with succes' );
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCT_KEY, array (
					'category' => $productDTO->category 
			) ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertProduct.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	public function insertProducerFormAction(Request $request) {
		$producerDTO = new ProducerDTO ();
		
		$form = $this->createForm ( new InsertProducerForm (), $producerDTO );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$producerService = $this->get ( 'producer_service' );
			
			$producer = $producerDTO->convertToProducer ();
			$producerService->insertProducer ( $producer );
			
			$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Producer was added with succes' );
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCER_KEY ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertProducer.html.twig', array (
				'form' => $form->createView (),
				'message' => "Insert producer" 
		) );
	}
	public function insertIngredientFormAction(Request $request) {
		$ingredientDTO = new IngredientDTO ();
		
		$form = $this->createForm ( new InsertIngredientForm ( $this->get ( 'ingredient_service' ) ), $ingredientDTO );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$ingredientService = $this->get ( 'ingredient_service' );
			$ingredient = $ingredientDTO->convertToIngredient ();
			$ingredientService->insertIngredient ( $ingredient );
			
			$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Ingredient was added with succes' );
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_INGREDIENTS_KEY ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertIngredient.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	public function insertProductIngredientFormAction(Request $request, $product) {
		$productIngredientDTO = new ProductIngredientDTO ();
		$productIngredientDTO->product = $product;
		
		$form = $this->createForm ( new InsertProductIngredientForm ( $this->get ( 'ingredient_service' ) ), $productIngredientDTO );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$productService = $this->get ( 'product_service' );
			
			$ingredient = $productIngredientDTO->convertToIngredient ( $this->get ( 'ingredient_service' ) );
			try {
				$productService->addIngredient ( $product, $ingredient );
			} catch ( \Exception $e ) {
				$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'Product does not exist anymore' );
			}
			
			$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Ingredient was added with succes' );
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCT_DETAIL_KEY, array (
					'product' => $product 
			) ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertProductIngredient.html.twig', array (
				'form' => $form->createView (),
				'message' => "Insert producer" 
		) );
	}
	public function viewCategoryAction($offset) {
		$categoryService = $this->get ( 'category_service' );
		$categorys = $categoryService->getAllCategory ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $categorys );
		$resultCategory = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultCategory [$i] = $categorys [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array (
				'categorys' => $resultCategory,
				'paginator' => $paginator 
		) );
	}
	public function viewProductAction($category, $offset) {
		$categoryService = $this->get ( 'category_service' );
		$categoryObject = $categoryService->getCategoryById ( $category );
		$products = $categoryObject->getProducts ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $products );
		$resultProducts = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducts [$i] = $products [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProduct.html.twig', array (
				'products' => $resultProducts,
				'paginator' => $paginator,
				'category' => $category 
		) );
	}
	public function viewProducerAction($offset) {
		$producerService = $this->get ( 'producer_service' );
		$producers = $producerService->getAllproducers ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $producers );
		$resultProducers = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducers [$i] = $producers [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProducer.html.twig', array (
				'producers' => $resultProducers,
				'paginator' => $paginator 
		) );
	}
	public function viewProducerDetailsAction($producer) {
		$producerService = $this->get ( 'producer_service' );
		$producer = $producerService->getProducerById ( $producer );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProducerDetail.html.twig', array (
				'producer' => $producer 
		) );
	}
	public function viewingredientsAction($offset) {
		$ingredientService = $this->get ( 'ingredient_service' );
		$ingredients = $ingredientService->getAllIngredients ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $ingredients );
		$resultIngredients = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultIngredients [$i] = $ingredients [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewIngredients.html.twig', array (
				'ingredients' => $resultIngredients,
				'paginator' => $paginator 
		) );
	}
	public function viewProductIngredientAction($product, $offset) {
		$productService = $this->get ( 'product_service' );
		$product = $productService->getProductById ( $product );
		$ingredients = $product->getIdingredient ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $ingredients );
		$resultIngredients = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultIngredients [$i] = $ingredients [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProductIngredient.html.twig', array (
				'ingredients' => $resultIngredients,
				'paginator' => $paginator,
				'product' => $product 
		) );
	}
	public function viewSearchVisitorProductAction($offset) {
		$productName = $_POST ['productName'];
		
		$hits = Product::getLuceneIndex ()->find ( $productName );
		
		$pks = array ();
		foreach ( $hits as $hit ) {
			$pks [] = $hit->pk;
		}
		
		$productService = $this->get ( 'product_service' );
		$products = array ();
		
		for($i = 0; $i < sizeof ( $pks ); $i ++) {
			$productObject = $productService->getProductById ( $pks [$i] );
			$products [$i] = $productObject;
		}
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $products );
		$resultProducts = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducts [$i] = $products [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages:viewSearchProduct.html.twig', array (
				'products' => $resultProducts,
				'paginator' => $paginator 
		) );
	}
	public function viewProductsAction($offset) {
		$productService = $this->get ( 'product_service' );
		$products = $productService->getAllProducts ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $products );
		$resultProducts = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducts [$i] = $products [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages:viewProducts.html.twig', array (
				'paginator' => $paginator,
				'products' => $resultProducts 
		) );
	}
	public function viewProductDetailAction($product) {
		$productService = $this->get ( 'product_service' );
		$product = $productService->getProductById ( $product );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProductDetail.html.twig', array (
				'product' => $product 
		) );
	}
	public function dropProducerAction($producer) {
		$producerService = $this->get ( 'producer_service' );
		
		$producerObject = $producerService->getProducerById ( $producer );
		
		try {
			$producer = $producerService->dropProducer ( $producerObject );
		} catch ( \Exception $e ) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'Producer does not exist anymore' );
		}
		
		$producers = $producerService->getAllproducers ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $producers );
		$resultProducers = array ();
		$offset = 1;
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducers [$i] = $producers [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProducer.html.twig', array (
				'producers' => $resultProducers,
				'paginator' => $paginator 
		) );
	}
	public function dropIngredientAction($ingredient) {
		$ingredientService = $this->get ( 'ingredient_service' );
		
		$ingredientObject = $ingredientService->getIngredientById ( $ingredient );
		$ingredientService->dropIngredient ( $ingredientObject );
		
		$ingredients = $ingredientService->getAllIngredients ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $ingredients );
		$resultIngredients = array ();
		$offset = 1;
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultIngredients [$i] = $ingredients [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewIngredients.html.twig', array (
				'ingredients' => $resultIngredients,
				'paginator' => $paginator 
		) );
	}
	public function dropCategoryAction($category) {
		$categoryService = $this->get ( 'category_service' );
		
		$categoryObject = $categoryService->getCategoryById ( $category );
		
		$error = "";
		if (sizeof ( $categoryObject->getProducts () ) > 0) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'Category can not be deleted because contains products' );
			$categorys = $categoryService->getAllCategory ();
			
			$limit = 7;
			$midrange = 3;
			
			$itemsCount = sizeof ( $categorys );
			$resultCategorys = array ();
			$offset = 1;
			$n = $offset * $limit;
			for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
				$resultCategorys [$i] = $categorys [$i];
			
			$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
			
			return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array (
					'categorys' => $resultCategorys,
					'paginator' => $paginator,
					'error' => $error 
			) );
		}
		
		$categoryService->dropCategory ( $categoryObject );
		
		$categorys = $categoryService->getAllCategory ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $categorys );
		$resultCategorys = array ();
		$offset = 1;
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultCategorys [$i] = $categorys [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array (
				'categorys' => $resultCategorys,
				'paginator' => $paginator,
				'error' => $error 
		) );
	}
	public function dropProductIngredientAction($product, $ingredient) {
		$productService = $this->get ( 'product_service' );
		$ingredientService = $this->get ( 'ingredient_service' );
		
		$ingredientObject = $ingredientService->getIngredientById ( $ingredient );
		try {
			$productService->removeIngredient ( $product, $ingredientObject );
		} catch ( \Exception $e ) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'Product does not exist anymore' );
		}
		
		$productService = $this->get ( 'product_service' );
		$product = $productService->getProductById ( $product );
		$ingredients = $product->getIdingredient ();
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProductDetail.html.twig', array (
				'product' => $product 
		) );
	}
	public function dropProductAction($category, $product, $offset) {
		$productService = $this->get ( 'product_service' );
		$categoryService = $this->get ( 'category_service' );
		
		$productObject = $productService->getProductById ( $product );
		try {
			$productService->dropProduct ( $productObject );
		} catch ( \Exception $e ) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'Product does not exist anymore' );
		}
		
		$products = $categoryService->getCategoryById ( $category )->getProducts ();
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $products );
		$resultProducts = array ();
		$offset = 1;
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducts [$i] = $products [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProduct.html.twig', array (
				'products' => $resultProducts,
				'paginator' => $paginator,
				'category' => $category 
		) );
	}
	public function updateProducerAction($producer, Request $request) {
		$producerDTO = new ProducerDTO ();
		
		$producerService = $this->get ( 'producer_service' );
		$producer = $producerService->getProducerById ( $producer );
		
		if (! $producer) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'The producer does not exist anymore' );
			$producers = $producerService->getAllproducers ();
			
			$limit = 7;
			$midrange = 3;
			
			$itemsCount = sizeof ( $producers );
			$resultProducers = array ();
			$offset = 1;
			$n = $offset * $limit;
			for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
				$resultProducers [$i] = $producers [$i];
			
			$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
			
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCER_KEY, array (
					'producers' => $resultProducers,
					'paginator' => $paginator 
			) ) );
		}
		
		$producerDTO->producerName = $producer->getProducername ();
		$producerDTO->adress = $producer->getAdress ();
		$producerDTO->url = $producer->getUrl ();
		$producerDTO->email = $producer->getEmail ();
		$producerDTO->phone = $producer->getPhone ();
		$producerDTO->id = $producer->getId ();
		
		$form = $this->createForm ( new InsertProducerForm (), $producerDTO );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$producer = $producerDTO->convertToProducer ();
			$producerService->updateProducer ( $producer );
			
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCER_KEY ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:insertProducer.html.twig', array (
				'form' => $form->createView (),
				'message' => "Update producer" 
		) );
	}
	public function updateStockAction($product, Request $request) {
		$stockDTO = new StockDTO ();
		
		$productService = $this->get ( 'product_service' );
		$productObject = $productService->getProductById ( $product );
		
		if (! $productObject) {
			$this->get ( 'session' )->getFlashBag ()->add ( 'error', 'The product does not exist anymore' );
			return $this->redirect ( $this->generateurl ( StockManagerRouting::HOME_ADMIN_KEY, array () ) );
		}
		
		$form = $this->createForm ( new UpdateStockForm (), $stockDTO );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) {
			$productObject->setPieces ( $productObject->getPieces () + $stockDTO->pieces );
			$productService->updateStock ( $productObject );
			
			return $this->redirect ( $this->generateurl ( StockManagerRouting::VIEW_PRODUCT_KEY, array (
					'category' => $productObject->getIdcategory ()->getId (),
					'product' => $productObject->getId () 
			) ) );
		}
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:updateStock.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	public function updateStockPageAction(Request $request) {
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:updateStockPage.html.twig' );
	}
	public function updateStockProcessAction($offset) {
		$productName = $_POST ['productName'];
		
		$hits = Product::getLuceneIndex ()->find ( $productName );
		
		$pks = array ();
		foreach ( $hits as $hit ) {
			$pks [] = $hit->pk;
		}
		
		$productService = $this->get ( 'product_service' );
		$products = array ();
		
		for($i = 0; $i < sizeof ( $pks ); $i ++) {
			$productObject = $productService->getProductById ( $pks [$i] );
			$products [$i] = $productObject;
		}
		
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $products );
		$resultProducts = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducts [$i] = $products [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewSearchProduct.html.twig', array (
				'products' => $resultProducts,
				'paginator' => $paginator 
		) );
	}
	public function sendEmailToProducerAction($producer) {
		$producerService = $this->get ( 'producer_service' );
		$producerObj = $producerService->getProducerById ( $producer );
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:sendEmail.html.twig', array (
				"producer" => $producerObj 
		) );
	}
	public function sendActualEmailToProducerAction($producer, Request $request) {
		$producerService = $this->get ( 'producer_service' );
		$subject = $_POST ['subject'];
		$msg = $_POST ['message'];
		$time = new \DateTime ();
		$producerObj = $producerService->getProducerById ( $producer );
		$message = \Swift_Message::newInstance ()->setSubject ( $subject )->setFrom ( 'gligor.vanessa@gmail.com' )->setTo ( $producerObj->getEmail () )->addPart ( $this->renderView ( 'MainStockManagerBundle:Pages/Admin:email.html.twig', array (
				'message' => $msg,
				'date' => $time 
		) ), 'text/html' )->setBody ( '' );
		$this->get ( 'mailer' )->send ( $message );
		
		$producerService = $this->get ( 'producer_service' );
		$producers = $producerService->getAllproducers ();
		
		$offset = 1;
		$limit = 7;
		$midrange = 3;
		
		$itemsCount = sizeof ( $producers );
		$resultProducers = array ();
		$n = $offset * $limit;
		for($i = $offset * $limit - $limit; $i < $n && $i < $itemsCount; $i ++)
			$resultProducers [$i] = $producers [$i];
		
		$paginator = new StockManagerPaginator ( $itemsCount, $offset, $limit, $midrange );
		
		$url = $this->generateurl ( StockManagerRouting::VIEW_PRODUCER_KEY );
		
		$this->get ( 'session' )->getFlashBag ()->add ( 'notice', 'Email send succesfully' );
		
		return $this->render ( 'MainStockManagerBundle:Pages/Admin:viewProducer.html.twig', array (
				'producers' => $resultProducers,
				'paginator' => $paginator 
		), new RedirectResponse ( $url ) );
	}
}
