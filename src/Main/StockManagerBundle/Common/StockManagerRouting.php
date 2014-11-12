<?php
namespace Main\StockManagerBundle\Common;

class StockManagerRouting{
	const HOME_URL = "/index";
	const HOME_ADMIN_URL = "/admin/index";
	const ABOUT_URL = "/about";
	const INSERT_CATEGORY_URL = "/admin/insert/category";
	const INSERT_PRODUCT_URL = "/admin/insert/product";
	const INSERT_PRODUCER_URL = "/admin/insert/producer";
	const INSERT_INGREDIENT_URL = "/admin/insert/ingredient";
	const VIEW_CATEGORY_URL = "/admin/view/category/{offset}";
	const VIEW_PRODUCT_URL = "/admin/view/product/{category}/{offset}";

	const HOME_KEY = "main_stock_manager_homepage";
	const HOME_ADMIN_KEY = "main_stock_manager_admin_homepage";
	const ABOUT_KEY = "main_stock_manager_about";
	const INSERT_CATEGORY_KEY = "main_stock_manager_insert_category";
	const INSERT_PRODUCT_KEY = "main_stock_manager_insert_product";
	const INSERT_PRODUCER_KEY = "main_stock_manager_insert_producer";
	const INSERT_INGREDIENT_KEY = "main_stock_manager_insert_ingredient";
	const VIEW_CATEGORY_KEY = "main_stock_manager_view_category";
	const VIEW_PRODUCT_KEY = "main_stock_manager_view_product";
} 
?>