<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Main\StockManagerBundle\Common\StockManagerRouting;

$collection = new RouteCollection();

$collection->add(StockManagerRouting::HOME_KEY, new Route(StockManagerRouting::HOME_URL, array(
    '_controller' => 'MainStockManagerBundle:Routing:toIndex',
)));

$collection->add(StockManagerRouting::ABOUT_KEY, new Route(StockManagerRouting::ABOUT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:toAbout',
)));

$collection->add(StockManagerRouting::INSERT_CATEGORY_KEY, new Route(StockManagerRouting::INSERT_CATEGORY_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertCategory',
)));

return $collection;
