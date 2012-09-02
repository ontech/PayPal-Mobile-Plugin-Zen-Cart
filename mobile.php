<?php
	ini_set('display_errors', 'off');

	define('SKIP_SINGLE_PRODUCT_CATEGORIES', 'False');
	require('includes/application_top.php');
//	$_SESSION['paypal_ec_markflow'] = 1;  
	
	if(isset($_GET["main_page"]) && $_GET["main_page"] == "login")
	{
		unset($_SESSION['paypal_ec_token']);
		header("HTTP/1.1 303 See Other");
		header("Location: http://".$_SERVER[HTTP_HOST]."/". DIR_WS_CATALOG ."/ipn_main_handler.php?type=ec");
	}  
  
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
//	echo $requestURI . "<BR/>";

	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	echo $catalogFolder . "<BR/>";

	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
//echo $subject . "<BR/>";
  
	$pattern = '/^\/(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
//	echo $matches . "<BR/>";
	if ($matches) {
//		echo "matches<BR/>";
		return true;
	}
	
	return false;
}

if(matchhome())
{
	$select_column_list = 'pd.products_name, p.products_image, ';
	require(zen_get_index_filters_directory('default_filter.php'));
//	require('includes/index_filters/default_filter.php');
	include 'mobile/index.php';
	die();
}

function matchcart(){
	global $productArray;
	global $cartShowTotal;
	global $currency_code;
	global $template;
  
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);  
  
	$pattern = '/index.php\?main_page=shopping_cart/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/shopping_cart.php';
		die();
	}
}
matchcart();

//Below added to address shipping if shipping is required for item/cart.
function matchcheckoutshipping(){ 
//	global $orders, $define_page, $template, $messageStack, $class, $free_shipping, $quotes, $currencies, $zco_notifier, $db, $current_page_base, $code_page_directory, $editShippingButtonLink, $uri;
	global $template, $define_page, $current_page_base, $messageStack, $displayAddressEdit, $editShippingButtonLink, $quotes, $free_shipping, $currencies, $zco_notifier, $db, $attributes, $uri;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_shipping/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
			include 'mobile/checkout_shipping.php';
			die();
	} 
}
matchcheckoutshipping();	

//Below added as next action from Shipping.
function matchcheckoutpayment(){
	global $orders, $define_page, $template, $messageStack, $class, $free_shipping, $quotes, $currencies, $zco_notifier, $db, $current_page_base, $code_page_directory, $editShippingButtonLink, $payment_modules, $order_total_modules, $zco_notifier;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_payment/';
	preg_match($pattern, $subject, $matches);
	if ($matches && $_POST['action'] != 'submit') {
		include 'mobile/checkout_payment.php';
		die();
	}
}
matchcheckoutpayment();	

// Below added as next function from Payment
function matchcheckoutconfirmation(){
//	global $orders, $define_page, $template, $messageStack, $class, $free_shipping, $quotes, $currencies, $zco_notifier, $db, $current_page_base, $code_page_directory, $editShippingButtonLink, $payment_modules, $order_total_modules;
	global $template, $zco_notifier, $define_page, $current_page_base, $messageStack, $flagDisablePaymentAddressChange, $order, $payment_modules, $editShippingButtonLink, $flagAnyOutOfStock, $stock_check, $currencies, $order_total_modules, $form_action_url;
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_confirmation/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkout_confirmation.php';
		die();
	}
}
matchcheckoutconfirmation();	

//Called after confirmation
function matchcheckoutprocess(){
	global $define_page, $zv_orders_id, $orders_id, $orders, $template;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_process/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkout_process.php';
		die();
	}
}
matchcheckoutprocess();	

// Code that is run if mode is set as IPN (I.e., $_SESSION['paypal_ec_markflow'] = 1) and
//	when done with shipping.
function matchcheckoutsuccess(){
	global $zv_orders_id, $orders_id, $orders, $define_page, $template, $code_page_directory;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_success/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkout_success.php';
		die();
	}
}
matchcheckoutsuccess();

function matchcheckoutshippingaddress(){
//	global $zv_orders_id, $orders_id, $orders, $define_page, $template, $code_page_directory;
	global $messageStack, $process, $error, $addresses_count, $template, $current_page_base, $flag_show_pulldown_states, $selected_country, $zone_id, $state_field_label, $zone_name, $state_field_label, $db;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_shipping_address/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkout_shipping_address.php';
		die();
	}
}
matchcheckoutshippingaddress();

function matchcheckoutpaymentaddress(){
//	global $zv_orders_id, $orders_id, $orders, $define_page, $template, $code_page_directory;
	global $messageStack, $addresses_count, $current_page_base, $template, $process, $flag_show_pulldown_states, $selected_country, $zone_id, $state_field_label, $zone_name, $state_field_label, $db;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/index.php\?main_page=checkout_payment_address/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkout_payment_address.php';
		die();
	}
}
matchcheckoutpaymentaddress();

function matchminicart(){
	global $template, $currencies;
	
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
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
	global $template, $currencies;
	
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
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
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

//	$catalogFolder = DIR_WS_CATALOG;
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
	require(zen_get_index_filters_directory('default_filter.php'));
//	require('includes/index_filters/default_filter.php');
	include 'mobile/category.php';
	die();
}

function matchcookies() {
	global $template;

	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

//	$catalogFolder = DIR_WS_CATALOG;
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
 
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//  $catalogFolder = DIR_WS_CATALOG;
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
	require(zen_get_index_filters_directory('default_filter.php'));
//	require('includes/index_filters/default_filter.php');
	define('TEXT_PRODUCT_OPTIONS', 'Please Choose: ');
	define('ATTRIBUTES_PRICE_DELIMITER_PREFIX', ' (');
	define('ATTRIBUTES_PRICE_DELIMITER_SUFFIX', ') ');
	require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_ATTRIBUTES));
//	require('includes/modules/attributes.php');
	include 'mobile/product.php';
	die();
}

function matchgallery(){
	global $template;
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

//	$catalogFolder = DIR_WS_CATALOG;
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
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}
//	$catalogFolder = DIR_WS_CATALOG;
	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);

	$pattern = '/(^\/search\/?(?:$|\?)|^\/index.php\?main_page=advanced_search)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		$select_column_list = 'pd.products_name, p.products_image, ';
		require('includes/index_filters/default_filter.php');
		include 'mobile/search.php';
		die();
	}
}
matchsearch();

function mobile_image($src)
{
	if($src == DIR_WS_IMAGES && PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1')
	{
		$src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
    }
 
    // if not in current template switch to template_default
    if(!file_exists($src))
    {
	    $src = str_replace(DIR_WS_TEMPLATES . $template_dir, DIR_WS_TEMPLATES . 'template_default', $src);
    }
 
    return $src;
}
?>
