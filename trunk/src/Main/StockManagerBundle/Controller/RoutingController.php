<?php

namespace Main\StockManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Main\StockManagerBundle\Common\StockManagerRouting;
use Main\StockManagerBundle\Forms\InsertCategoryForm;
use Main\StockManagerBundle\StockManagerDTO\UserDTO;
use Symfony\Component\HttpFoundation\Request;

class RoutingController extends Controller
{
    public function toIndexAction()
    {	
        return $this->render('MainStockManagerBundle:Pages:index.html.twig', array());
    }
    
    public function toAboutAction()
    {
    	$route = StockManagerRouting::ABOUT_KEY;
    	
    	return $this->render('MainStockManagerBundle:Pages:about.html.twig',array('routing' => $route));
    }
    
    public function insertCategoryAction(Request $request)
    {
    	$userDTO = new UserDTO();
    	
    	$form = $this->createForm(new InsertCategoryForm(), $userDTO);
    	
    	$form->handleRequest($request);
    	
    	if ($form->isValid()) {
    		
    	}
    	
    	return $this->render('MainStockManagerBundle:Pages:insertCategory.html.twig', array('form' => $form->createView()));
    }
}
