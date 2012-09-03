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

function mobilematchthis($mainassign)
{
	$requestURI = $_SERVER['REQUEST_URI']; 
	
	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);  
  
	$pattern = '/index.php\?main_page=' . $mainassign . '/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	} else {
		return false;
	}
}

if (mobilematchthis('shopping_cart')) {
	include 'mobile/shopping_cart.php';
	die();
}

//Below added to address shipping if shipping is required for item/cart.
if (mobilematchthis('checkout_shipping')) {
	include 'mobile/checkout_shipping.php';
	die();
}

//Below added as next action from Shipping.
if (mobilematchthis('checkout_payment')) {
	include 'mobile/checkout_payment.php';
	die();
}

// Below added as next function from Payment
if (mobilematchthis('checkout_confirmation')) {
	include 'mobile/checkout_confirmation.php';
	die();
}

//Called after confirmation
if (mobilematchthis('checkout_process')) {
	include 'mobile/checkout_process.php';
	die();
}

// Code that is run if mode is set as IPN (I.e., $_SESSION['paypal_ec_markflow'] = 1) and
//	when done with shipping.
if (mobilematchthis('checkout_success')) {
	include 'mobile/checkout_success.php';
	die();
}

if (mobilematchthis('checkout_shipping_address')) {
	include 'mobile/checkout_shipping_address.php';
	die();
}

if (mobilematchthis('checkout_payment_address')) {
	include 'mobile/checkout_payment_address.php';
	die();
}

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
	require(zen_get_index_filters_directory('default_filter.php'));
//	require('includes/index_filters/default_filter.php');
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
		require(zen_get_index_filters_directory('default_filter.php'));
//		require('includes/index_filters/default_filter.php');
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

function matchtimeout(){
	global $db, $zco_notifier, $template;
 
	$requestURI = $_SERVER['REQUEST_URI']; 

	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/index.php\?main_page=time_out/';
	preg_match($pattern, $subject, $matches);
	
	if ($matches) {
		include 'mobile/timeout.php';
		die();
	}

}
matchtimeout();

function matchlogin(){
	global $db, $zco_notifier, $template;
 
	$requestURI = $_SERVER['REQUEST_URI']; 

	$Secure = $_SERVER['HTTPS'];
	if ($Secure) {
		$catalogFolder = DIR_WS_HTTPS_CATALOG;
	} else {
		$catalogFolder = DIR_WS_CATALOG;
	}

	$catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
	$subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  
	$pattern = '/index.php\?main_page=time_out/';
	preg_match($pattern, $subject, $matches);
	
	if ($matches) {
		include 'mobile/login.php';
		die();
	}

}
matchlogin();

?>
