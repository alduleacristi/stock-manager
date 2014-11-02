<?php

namespace Main\StockManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Main\StockManagerBundle\Common\StockManagerRouting;

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
}
