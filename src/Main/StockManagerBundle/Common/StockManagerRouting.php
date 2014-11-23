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
	const INSERT_PRODUCT_INGREDIENT_URL = "/admin/insert/product_ingredient/{product}";
	const VIEW_CATEGORY_URL = "/admin/view/category/{offset}";
	const VIEW_PRODUCT_URL = "/admin/view/product/{category}/{offset}";
	const VIEW_VISITOR_SEARCH_PRODUCT_URL = "/view/product/{offset}";
	const VIEW_PRODUCER_URL = "/admin/view/producer/{offset}";
	const VIEW_PRODUCER_DETAILS_URL = "/admin/view/producer/detail/{producer}";
	const VIEW_INGREDIENTS_URL = "/admin/view/ingredients/{offset}";
	const VIEW_PRODUCT_INGREDIENT_URL = "/admin/view/product_ingredient/{product}/{offset}";
	const VIEW_PRODUCTS_URL = "/view/products/{offset}";
	const VIEW_PRODUCT_DETAIL_URL = "/admin/view/product_detail/{product}";
	const DROP_PRODUCER_URL = "/admin/drop/producer/{producer}";
	const DROP_INGREDIENT_URL = "/admin/drop/ingredient/{ingredient}";
	const DROP_CATEGORY_URL = "/admin/drop/category/{category}";
	const DROP_PRODUCT_URL = "/admin/drop/category/{category}/{product}/{offset}";
	const DROP_PRODUCT_INGREDIENT_URL = "/admin/drop/product_ingredient/{product}/{ingredient}";
	const UPDATE_PRODUCER_URL = "/admin/update/producer/{producer}";
	const UPDATE_STOCK_URL = "/admin/update/stock/{product}";
	const UPDATE_STOCK_PAGE_URL = "/admin/update/stock";
	const UPDATE_STOCK_PROCESS_URL = "/admin/update/stock_process";

	const HOME_KEY = "main_stock_manager_homepage";
	const HOME_ADMIN_KEY = "main_stock_manager_admin_homepage";
	const ABOUT_KEY = "main_stock_manager_about";
	const INSERT_CATEGORY_KEY = "main_stock_manager_insert_category";
	const INSERT_PRODUCT_KEY = "main_stock_manager_insert_product";
	const INSERT_PRODUCER_KEY = "main_stock_manager_insert_producer";
	const INSERT_INGREDIENT_KEY = "main_stock_manager_insert_ingredient";
	const INSERT_PRODUCT_INGREDIENT_KEY = "main_stock_manager_insert_product_ingredient";
	const VIEW_CATEGORY_KEY = "main_stock_manager_view_category";
	const VIEW_PRODUCT_KEY = "main_stock_manager_view_product";
	const VIEW_VISITOR_SEARCH_PRODUCT_KEY = "main_stock_manager_view_visitor_search_product";
	const VIEW_PRODUCER_KEY = "main_stock_manager_view_producer";
	const VIEW_PRODUCER_DETAILS_KEY = "main_stock_manager_view_producer_detail";
	const VIEW_INGREDIENTS_KEY = "main_stock_manager_view_ingredients";
	const VIEW_PRODUCT_INGREDIENT_KEY = "main_stock_manager_view_product_ingredient";
	const VIEW_PRODUCTS_KEY = "main_stock_manager_view_products";
	const VIEW_PRODUCT_DETAIL_KEY = "main_stock_manager_view_product_detail";
	const DROP_PRODUCER_KEY = "main_stock_manager_drop_producer";
	const DROP_INGREDIENT_KEY = "main_stock_manager_drop_ingredient";
	const DROP_CATEGORY_KEY = "main_stock_manager_drop_category";
	const DROP_PRODUCT_KEY = "main_stock_manager_drop_product";
	const DROP_PRODUCT_INGREDIENT_KEY = "main_stock_manager_drop_product_ingredient";
	const UPDATE_PRODUCER_KEY = "main_stock_manager_update_producer";
	const UPDATE_STOCK_KEY = "main_stock_manager_update_stock";
	const UPDATE_STOCK_PAGE_KEY = "main_stock_manager_update_stock_page";
	const UPDATE_STOCK_PROCESS_KEY = "main_stock_manager_update_stock_process";
	
	const LOGIN_URL = "/login";
	const LOGIN_KEY = "login";
	const LOGIN_CHECK_URL = "/login_check";
	const LOGIN_CHECK_KEY = "login_check";
	const LOGOUT_URL = "/logout";
	const LOGOUT_KEY = "logout";
} 
?>