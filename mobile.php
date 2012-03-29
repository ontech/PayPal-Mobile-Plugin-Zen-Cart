<?php

	if(isset($_GET["main_page"]) && $_GET["main_page"] == "login")
	{
		unset($_SESSION['paypal_ec_token']);
		header("HTTP/1.1 303 See Other");
		header("Location: http://".$_SERVER[HTTP_HOST]."/ipn_main_handler.php?type=ec");
	}

	define('SKIP_SINGLE_PRODUCT_CATEGORIES', 'False');
	require('includes/application_top.php');
  
	$language_page_directory = DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
	$directory_array = $template->get_template_part($code_page_directory, '/^header_php/');
	foreach ($directory_array as $value) { 
/**
 * We now load header code for a given page. 
 * Page code is stored in includes/modules/pages/PAGE_NAME/directory 
 * 'header_php.php' files in that directory are loaded now.
 */
    require($code_page_directory . '/' . $value);
  }
  
/* Debugging
$device = $_SERVER['template'];
echo "this device is a $device";
$pagename = $_SERVER['REQUEST_URI'];
echo "page url: $pagename";
*/
?>

<?php
function matchhome(){
	global $db, $zco_notifier, $template;
 
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/^\/(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}

if(matchhome())
{
	$select_column_list = 'pd.products_name, p.products_image, ';
	require('includes/index_filters/default_filter.php');
	include 'mobile/index.php';
	die();
}

function matchcart(){
	global $productArray;
	global $cartShowTotal;
	global $currency_code;
	global $template;
  
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);  
  
	$pattern = '/index.php\?main_page=shopping_cart/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/cart.php';
		die();
	}
}
matchcart();

function matchcheckoutsuccess(){
	global $zv_orders_id, $orders_id, $orders, $define_page, $template;

  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_success/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkoutsuccess.php';
		die();
	}
}
matchcheckoutsuccess();

function matchminicart(){
	global $template;
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/minicart.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicart.php';
		die();
	}
}
matchminicart();

function matchminicartview(){
global $template;
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/minicartview.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicartview.php';
		die();
	}
}
matchminicartview();

function matchcategory(){
	global $db, $zco_notifier, $template;
	
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/^\/category\d+_\d+\.htm(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}
if(matchcategory())
{
	$select_column_list = 'pd.products_name, p.products_image, ';
	require('includes/index_filters/default_filter.php');
	include 'mobile/category.php';
	die();
}

function matchcookies() {
global $template;
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/cookies.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/cookies.php';
		die();
	}
}
matchcookies();


function matchproduct(){
	global $sql, $template;

  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/^\/prod\d+\.htm(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}
if(matchproduct())
{
	$select_column_list = 'pd.products_name, p.products_image, ';
	require('includes/index_filters/default_filter.php');
	define('TEXT_PRODUCT_OPTIONS', 'Please Choose: ');
	define('ATTRIBUTES_PRICE_DELIMITER_PREFIX', ' (');
	define('ATTRIBUTES_PRICE_DELIMITER_SUFFIX', ') ');
	require('includes/modules/attributes.php');
	include 'mobile/product.php';
	die();
}

function matchgallery(){
global $template;
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/^\/gallery\d+\.htm(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}

if(matchgallery())
{
	$select_column_list = 'pd.products_name, p.products_image, ';
	require('includes/index_filters/default_filter.php');
	include 'mobile/gallery.php';
	die();
}

function matchsearch(){
	global $result;
	global $db;
	global $list_box_contents;
	global $template; 
	
  $requestURI = $_SERVER['REQUEST_URI']; 
 
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/(^\/search\/?(?:$|\?)|^\/index.php\?main_page=advanced_search)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		$select_column_list = 'pd.products_name, p.products_image, ';
		//require('includes/index_filters/default_filter.php');
		include 'mobile/search.php';
		die();
	}
}
matchsearch();
?>
