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
use Main\StockManagerBundle\StockManagerDTO\IngredientDTO;
use Main\StockManagerBundle\StockManagerDTO\ProductIngredientDTO;
use Symfony\Component\HttpFoundation\Request;
use Main\StockManagerBundle\Common\StockManagerPaginator;

use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

class RoutingController extends Controller
{
    public function toIndexAction()
    {	
        return $this->render('MainStockManagerBundle:Pages:index.html.twig', array());
    }
    
    public function toAdminIndexAction()
    {
    	return $this->render('MainStockManagerBundle:Pages/Admin:index.html.twig', array());
    }
    
    public function toAboutAction()
    {
    	$route = StockManagerRouting::ABOUT_KEY;
    	
    	return $this->render('MainStockManagerBundle:Pages:about.html.twig',array('routing' => $route));
    }
    
    public function insertCategoryFormAction(Request $request)
    {
    	$categoryDTO = new CategoryDTO();
    	
    	$form = $this->createForm(new InsertCategoryForm(), $categoryDTO);
    	
    	$form->handleRequest($request);
    	
    	if ($form->isValid()) {
    		$categoryService = $this->get('category_service');
    		
    		$category = $categoryDTO->convertToCategory();
    		$categoryService->insertCategory($category);
    		
			
    		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_CATEGORY_KEY));
    	}
    	
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertCategory.html.twig', array('form' => $form->createView()));
    }
    
    public function insertProductFormAction(Request $request)
    {
    	$productDTO = new ProductDTO();
    	 
    	$form = $this->createForm(new InsertProductForm($this->get('category_service'),$this->get('producer_service')), $productDTO);
    	 
    	$form->handleRequest($request);
    	 
    	if ($form->isValid()) {
    		$productService = $this->get('product_service');
    		
    		$product = $productDTO->convertToProduct($this->get('category_service'),$this->get('producer_service'));
    		$productService->insertProduct($product);
    		
    			
    		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_PRODUCT_KEY,array('category' => $productDTO->category)));
    	}
    	 
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProduct.html.twig', array('form' => $form->createView()));
    }
    
    public function insertProducerFormAction(Request $request)
    {
     	$producerDTO = new ProducerDTO();
    
     	$form = $this->createForm(new InsertProducerForm(), $producerDTO);
    	$form->handleRequest($request);
    
     	if ($form->isValid()) {
     		$producerService = $this->get('producer_service');
     		
     		$producer = $producerDTO->convertToProducer();
     		$producerService->insertProducer($producer);
     		
     		 
     		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_PRODUCER_KEY));
      	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProducer.html.twig', array('form' => $form->createView(), 'message' => "Insert producer"));
    }
    
    public function insertIngredientFormAction(Request $request)
    {
    	$ingredientDTO = new IngredientDTO();
    
    	$form = $this->createForm(new InsertIngredientForm($this->get('ingredient_service')), $ingredientDTO);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$ingredientService = $this->get('ingredient_service');
    		$ingredient = $ingredientDTO->convertToIngredient();
    		$ingredientService->insertIngredient($ingredient);
    		
    		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_INGREDIENTS_KEY));
    	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertIngredient.html.twig', array('form' => $form->createView()));
    }
    
    public function insertProductIngredientFormAction(Request $request,$product)
    {
    	$productIngredientDTO = new ProductIngredientDTO();
    	$productIngredientDTO->product = $product;
    
    	$form = $this->createForm(new InsertProductIngredientForm($this->get('ingredient_service')), $productIngredientDTO);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
     		$productService = $this->get('product_service');
    		 
     		$ingredient = $productIngredientDTO->convertToIngredient($this->get('ingredient_service'));
     		$productService->addIngredient($product,$ingredient);
    		 
    
     		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_PRODUCT_INGREDIENT_KEY,array('product' => $product,'offset' => 1)));
    	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProductIngredient.html.twig', array('form' => $form->createView(), 'message' => "Insert producer"));
    }
    
    public function viewCategoryAction($offset)
    {
    	$categoryService = $this->get('category_service');
    	$categorys = $categoryService->getAllCategory();
    	
    	$limit = 7;
    	$midrange = 3;
    	
    	$itemsCount = sizeof($categorys);
    	$resultCategory = array();
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultCategory[$i] = $categorys[$i];
    	
    	$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    	 
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array('categorys' => $resultCategory, 'paginator' => $paginator));
    }
    
    public function viewProductAction($category,$offset)
    {
    	$categoryService = $this->get('category_service');
    	$categoryObject = $categoryService->getCategoryById($category);
		$products = $categoryObject->getProducts();
    	
    	$limit = 7;
    	$midrange = 3;
    	 
    	$itemsCount = sizeof($products);
    	$resultProducts = array();
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultProducts[$i] = $products[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    
    
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewProduct.html.twig', array('products' => $resultProducts, 'paginator' => $paginator, 'category' => $category));
    }
    
    public function viewProducerAction($offset)
    {
    	$producerService = $this->get('producer_service');
    	$producers = $producerService->getAllproducers();
    	 
    	$limit = 7;
    	$midrange = 3;
    
    	$itemsCount = sizeof($producers);
    	$resultProducers = array();
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultProducers[$i] = $producers[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    
    
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewProducer.html.twig', array('producers' => $resultProducers, 'paginator' => $paginator));
    }
    
    public function viewProducerDetailsAction($producer)
    {
    	$producerService = $this->get('producer_service');
    	$producer = $producerService->getProducerById($producer);
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:viewProducerDetail.html.twig', array('producer' => $producer));
    }
    
    public function viewingredientsAction($offset)
    {
    	$ingredientService = $this->get('ingredient_service');
    	$ingredients = $ingredientService->getAllIngredients();
    
    	$limit = 7;
    	$midrange = 3;
    
    	$itemsCount = sizeof($ingredients);
    	$resultIngredients = array();
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultIngredients[$i] = $ingredients[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    
    
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewIngredients.html.twig', array('ingredients' => $resultIngredients, 'paginator' => $paginator));
    }
    
    public function viewProductIngredientAction($product,$offset)
    {
    	$productService = $this->get('product_service');
    	$product = $productService->getProductById($product);
    	$ingredients = $product->getIdingredient();
    
    	$limit = 7;
    	$midrange = 3;
    
    	$itemsCount = sizeof($ingredients);
    	$resultIngredients = array();
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultIngredients[$i] = $ingredients[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    
    
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewProductIngredient.html.twig', array('ingredients' => $resultIngredients, 'paginator' => $paginator, 'product' => $product));
    }
    
    public function dropProducerAction($producer)
    {
    	$producerService = $this->get('producer_service');
    	
    	$producerObject = $producerService->getProducerById($producer);
    	$producer = $producerService->dropProducer($producerObject);
    	
    	$producers = $producerService->getAllproducers();
    	
    	$limit = 7;
    	$midrange = 3;
    	
    	$itemsCount = sizeof($producers);
    	$resultProducers = array();
    	$offset = 1;
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultProducers[$i] = $producers[$i];
    		 
    	$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    	
    	return $this->render('MainStockManagerBundle:Pages/Admin:viewProducer.html.twig', array('producers' => $resultProducers, 'paginator' => $paginator));
    }
    
    public function dropIngredientAction($ingredient)
    {
    	$ingredientService = $this->get('ingredient_service');
    	 
    	$ingredientObject = $ingredientService->getIngredientById($ingredient);
    	$ingredientService->dropIngredient($ingredientObject);
    	 
    	$ingredients = $ingredientService->getAllIngredients();
    	 
    	$limit = 7;
    	$midrange = 3;
    	 
    	$itemsCount = sizeof($ingredients);
    	$resultIngredients = array();
    	$offset = 1;
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultIngredients[$i] = $ingredients[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    		 
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewIngredients.html.twig', array('ingredients' => $resultIngredients, 'paginator' => $paginator));
    }
    
    public function dropCategoryAction($category)
    {
    	$categoryService = $this->get('category_service');
    
    	$categoryObject = $categoryService->getCategoryById($category);
    	
    	$error = "";
    	if(sizeof($categoryObject->getProducts()) > 0){
    		$error = "Category can not be deleted because contains products";
    		
    		$categorys = $categoryService->getAllCategory();
    		
    		$limit = 7;
    		$midrange = 3;
    		
    		$itemsCount = sizeof($categorys);
    		$resultCategorys = array();
    		$offset = 1;
    		$n = $offset * $limit;
    		for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    			$resultCategorys[$i] = $categorys[$i];
    			 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    		
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array('categorys' => $resultCategorys, 'paginator' => $paginator, 'error' => $error));
    	}
    	
    	$categoryService->dropCategory($categoryObject);
    
    	$categorys = $categoryService->getAllCategory();
    
    	$limit = 7;
    	$midrange = 3;
    
    	$itemsCount = sizeof($categorys);
    	$resultCategorys = array();
    	$offset = 1;
    	$n = $offset * $limit;
    	for($i=$offset*$limit-$limit;$i<$n && $i<$itemsCount;$i++)
    		$resultCategorys[$i] = $categorys[$i];
    		 
    		$paginator = new StockManagerPaginator($itemsCount, $offset , $limit, $midrange);
    		 
    		return $this->render('MainStockManagerBundle:Pages/Admin:viewCategory.html.twig', array('categorys' => $resultCategorys, 'paginator' => $paginator, 'error' => $error));
    }
    
    public function dropProductIngredientAction($product,$ingredient)
    {
    	$productService = $this->get('product_service');
    	$ingredientService = $this->get('ingredient_service');
    
    	$ingredientObject = $ingredientService->getIngredientById($ingredient);
    	
    	$productService->removeIngredient($product,$ingredientObject);
    
    	$productService = $this->get('product_service');
    	$product = $productService->getProductById($product);
    	$ingredients = $product->getIdingredient();
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:viewProductIngredient.html.twig', array('ingredients' => $ingredients, 'product' => $product));
    }
    
    public function updateProducerAction($producer,Request $request)
    {
    	$producerDTO = new ProducerDTO();
    	
    	$producerService = $this->get('producer_service');
    	$producer = $producerService->getProducerById($producer);
    	$producerDTO->producerName = $producer->getProducername();
    	$producerDTO->adress = $producer->getAdress();
    	$producerDTO->url = $producer->getUrl();
    	$producerDTO->email = $producer->getEmail();
    	$producerDTO->phone = $producer->getPhone();
    	$producerDTO->id = $producer->getId();
    
    	$form = $this->createForm(new InsertProducerForm(), $producerDTO);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$producer = $producerDTO->convertToProducer();
    		$producerService->updateProducer($producer);
    
    		return $this->redirect($this->generateurl(StockManagerRouting::VIEW_PRODUCER_KEY));
    	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProducer.html.twig', array('form' => $form->createView(), 'message' => "Update producer"));
    }
}