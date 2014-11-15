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
	const VIEW_PRODUCER_URL = "/admin/view/producer/{offset}";
	const VIEW_PRODUCER_DETAILS_URL = "/admin/view/producer/detail/{producer}";
	const VIEW_INGREDIENTS_URL = "/admin/view/ingredients/{offset}";
	const DROP_PRODUCER_URL = "/admin/drop/producer/{producer}";
	const DROP_INGREDIENT_URL = "/admin/drop/ingredient/{ingredient}";
	const UPDATE_PRODUCER_URL = "/admin/update/producer/{producer}";

	const HOME_KEY = "main_stock_manager_homepage";
	const HOME_ADMIN_KEY = "main_stock_manager_admin_homepage";
	const ABOUT_KEY = "main_stock_manager_about";
	const INSERT_CATEGORY_KEY = "main_stock_manager_insert_category";
	const INSERT_PRODUCT_KEY = "main_stock_manager_insert_product";
	const INSERT_PRODUCER_KEY = "main_stock_manager_insert_producer";
	const INSERT_INGREDIENT_KEY = "main_stock_manager_insert_ingredient";
	const VIEW_CATEGORY_KEY = "main_stock_manager_view_category";
	const VIEW_PRODUCT_KEY = "main_stock_manager_view_product";
	const VIEW_PRODUCER_KEY = "main_stock_manager_view_producer";
	const VIEW_PRODUCER_DETAILS_KEY = "main_stock_manager_view_producer_detail";
	const VIEW_INGREDIENTS_KEY = "main_stock_manager_view_ingredients";
	const DROP_PRODUCER_KEY = "main_stock_manager_drop_producer";
	const DROP_INGREDIENT_KEY = "main_stock_manager_drop_ingredient";
	const UPDATE_PRODUCER_KEY = "main_stock_manager_update_producer";
	
	const LOGIN_URL = "/login";
	const LOGIN_KEY = "login";
	const LOGIN_CHECK_URL = "/login_check";
	const LOGIN_CHECK_KEY = "login_check";
	const LOGOUT_URL = "/logout";
	const LOGOUT_KEY = "logout";
} 
?>