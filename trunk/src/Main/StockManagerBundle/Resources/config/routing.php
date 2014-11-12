<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Main\StockManagerBundle\Common\StockManagerRouting;

$collection = new RouteCollection();

$collection->add(StockManagerRouting::HOME_KEY, new Route(StockManagerRouting::HOME_URL, array(
    '_controller' => 'MainStockManagerBundle:Routing:toIndex',
)));
$collection->add(StockManagerRouting::HOME_ADMIN_KEY, new Route(StockManagerRouting::HOME_ADMIN_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:toAdminIndex',
)));

$collection->add(StockManagerRouting::ABOUT_KEY, new Route(StockManagerRouting::ABOUT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:toAbout',
)));

$collection->add(StockManagerRouting::INSERT_CATEGORY_KEY, new Route(StockManagerRouting::INSERT_CATEGORY_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertCategoryForm',
)));
$collection->add(StockManagerRouting::INSERT_PRODUCT_KEY, new Route(StockManagerRouting::INSERT_PRODUCT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertProductForm',
)));
$collection->add(StockManagerRouting::INSERT_PRODUCER_KEY, new Route(StockManagerRouting::INSERT_PRODUCER_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertProducerForm',
)));
$collection->add(StockManagerRouting::INSERT_INGREDIENT_KEY, new Route(StockManagerRouting::INSERT_INGREDIENT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertIngredientForm',
)));

$collection->add(StockManagerRouting::VIEW_CATEGORY_KEY, new Route(StockManagerRouting::VIEW_CATEGORY_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewCategory','offset' => 1
)));
$collection->add(StockManagerRouting::VIEW_PRODUCT_KEY, new Route(StockManagerRouting::VIEW_PRODUCT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProduct','offset' => 1
)));

return $collection;
