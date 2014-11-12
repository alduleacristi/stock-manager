<?php

namespace Main\StockManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Main\StockManagerBundle\Common\StockManagerRouting;
use Main\StockManagerBundle\Forms\InsertCategoryForm;
use Main\StockManagerBundle\StockManagerDTO\UserDTO;
use Main\StockManagerBundle\StockManagerDTO\CategoryDTO;
use Main\StockManagerBundle\Forms\InsertProductForm;
use Main\StockManagerBundle\StockManagerDTO\ProductDTO;
use Main\StockManagerBundle\Forms\InsertProducerForm;
use Main\StockManagerBundle\StockManagerDTO\ProducerDTO;
use Main\StockManagerBundle\Forms\InsertIngredientForm;
use Main\StockManagerBundle\StockManagerDTO\IngredientDTO;
use Symfony\Component\HttpFoundation\Request;
use Main\StockManagerBundle\Common\StockManagerPaginator;

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
    	 
    	$form = $this->createForm(new InsertProductForm(), $productDTO);
    	 
    	$form->handleRequest($request);
    	 
    	if ($form->isValid()) {
    
    	}
    	 
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProduct.html.twig', array('form' => $form->createView()));
    }
    
    public function insertProducerFormAction(Request $request)
    {
     	$producerDTO = new ProducerDTO();
    
     	$form = $this->createForm(new InsertProducerForm(), $producerDTO);
    	$form->handleRequest($request);
    
     	if ($form->isValid()) {
      	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertProducer.html.twig', array('form' => $form->createView()));
    }
    
    public function insertIngredientFormAction(Request $request)
    {
    	$ingredientDTO = new IngredientDTO();
    
    	$form = $this->createForm(new InsertIngredientForm(), $ingredientDTO);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    	}
    
    	return $this->render('MainStockManagerBundle:Pages/Admin:insertIngredient.html.twig', array('form' => $form->createView()));
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
}
