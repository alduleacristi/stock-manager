<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Main\StockManagerBundle\Common\StockManagerRouting;

$collection = new RouteCollection();

$collection->add(StockManagerRouting::LOGIN_KEY, new Route(StockManagerRouting::LOGIN_URL, array(
		'_controller' => 'MainStockManagerBundle:Security:login',
)));
$collection->add(StockManagerRouting::LOGIN_CHECK_KEY, new Route(StockManagerRouting::LOGIN_CHECK_URL, array()));
$collection->add(StockManagerRouting::LOGOUT_KEY, new Route(StockManagerRouting::LOGOUT_URL, array()));

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
$collection->add(StockManagerRouting::INSERT_PRODUCT_INGREDIENT_KEY, new Route(StockManagerRouting::INSERT_PRODUCT_INGREDIENT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:insertProductIngredientForm',
)));

$collection->add(StockManagerRouting::VIEW_CATEGORY_KEY, new Route(StockManagerRouting::VIEW_CATEGORY_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewCategory','offset' => 1
)));
$collection->add(StockManagerRouting::VIEW_PRODUCT_KEY, new Route(StockManagerRouting::VIEW_PRODUCT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProduct','offset' => 1
)));
$collection->add(StockManagerRouting::VIEW_PRODUCER_KEY, new Route(StockManagerRouting::VIEW_PRODUCER_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProducer','offset' => 1
)));
$collection->add(StockManagerRouting::VIEW_INGREDIENTS_KEY, new Route(StockManagerRouting::VIEW_INGREDIENTS_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewIngredients','offset' => 1
)));

$collection->add(StockManagerRouting::VIEW_PRODUCER_DETAILS_KEY, new Route(StockManagerRouting::VIEW_PRODUCER_DETAILS_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProducerDetails'
)));
$collection->add(StockManagerRouting::VIEW_PRODUCT_INGREDIENT_KEY, new Route(StockManagerRouting::VIEW_PRODUCT_INGREDIENT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProductIngredient'
)));
$collection->add(StockManagerRouting::VIEW_VISITOR_SEARCH_PRODUCT_KEY, new Route(StockManagerRouting::VIEW_VISITOR_SEARCH_PRODUCT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewSearchVisitorProduct'
)));
$collection->add(StockManagerRouting::VIEW_PRODUCTS_KEY, new Route(StockManagerRouting::VIEW_PRODUCTS_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProducts','offset' => 1
)));
$collection->add(StockManagerRouting::VIEW_PRODUCT_DETAIL_KEY, new Route(StockManagerRouting::VIEW_PRODUCT_DETAIL_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:viewProductDetail'
)));

$collection->add(StockManagerRouting::DROP_PRODUCER_KEY, new Route(StockManagerRouting::DROP_PRODUCER_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:dropProducer'
)));
$collection->add(StockManagerRouting::DROP_INGREDIENT_KEY, new Route(StockManagerRouting::DROP_INGREDIENT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:dropIngredient'
)));
$collection->add(StockManagerRouting::DROP_CATEGORY_KEY, new Route(StockManagerRouting::DROP_CATEGORY_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:dropCategory'
)));
$collection->add(StockManagerRouting::DROP_PRODUCT_INGREDIENT_KEY, new Route(StockManagerRouting::DROP_PRODUCT_INGREDIENT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:dropProductIngredient'
)));
$collection->add(StockManagerRouting::DROP_PRODUCT_KEY, new Route(StockManagerRouting::DROP_PRODUCT_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:dropProduct'
)));

$collection->add(StockManagerRouting::UPDATE_PRODUCER_KEY, new Route(StockManagerRouting::UPDATE_PRODUCER_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:updateProducer'
)));
$collection->add(StockManagerRouting::UPDATE_STOCK_KEY, new Route(StockManagerRouting::UPDATE_STOCK_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:updateStock'
)));
$collection->add(StockManagerRouting::UPDATE_STOCK_PAGE_KEY, new Route(StockManagerRouting::UPDATE_STOCK_PAGE_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:updateStockPage'
)));
$collection->add(StockManagerRouting::UPDATE_STOCK_PROCESS_KEY, new Route(StockManagerRouting::UPDATE_STOCK_PROCESS_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:updateStockProcess','offset'=>1
)));

$collection->add(StockManagerRouting::SEND_EMAIL_KEY, new Route(StockManagerRouting::SEND_EMAIL_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:sendEmailToProducer'
)));
$collection->add(StockManagerRouting::SEND_ACTUAL_EMAIL_KEY, new Route(StockManagerRouting::SEND_ACTUAL_EMAIL_URL, array(
		'_controller' => 'MainStockManagerBundle:Routing:sendActualEmailToProducer'
)));

return $collection;
