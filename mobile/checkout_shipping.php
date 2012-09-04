<?php include 'header.php'; ?>

<h1 id="checkoutShippingHeading">Thank You! We Appreciate your Shipping Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php

//$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_CHECKOUT_SHIPPING, 'false');

/**
 * require the html_defined text for checkout shipping
 */
//include ($template->get_template_dir('button_names.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/button_names.php');

//  include($define_page);
//	include (DIR_WS_MODULES . 'pages/checkout_shipping' . '/' . $value);
//	include (DIR_WS_MODULES . 'pages/checkout_shipping_address' . '/' . $value);
?>
<?php
/**
 * We now load the html_header.php file. This file contains code that would appear within the HTML <head></head> code 
 * it is overridable on a template and page basis. 
 * In that a custom template can define its own common/html_header.php file 
 */
//  require($template->get_template_dir('html_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/html_header.php');
?> 
<?php
// $directory_array = $template->get_template_part($code_page_directory, '/^checkout_shipping/');
//  foreach ($directory_array as $value) {
/**
 * We now load header code for a given page. 
 * Page code is stored in includes/modules/pages/PAGE_NAME/directory 
 * 'header_php.php' files in that directory are loaded now.
 */
//    require($code_page_directory . '/' . $value);
//  }
//	$directory_array = $template->get_template_part(DIR_WS_MODULES . 'pages/checkout_success', '/^header_php/');

//	$directory_array = $template->get_template_part($code_page_directory, '/^header_php/');
//var_dump($directory_array);
include_once (DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
//echo $code_page_directory . ' <-Code_page_directory<BR/>';
//  foreach ($directory_array as $value) {
//    $onload_file = DIR_WS_MODULES . 'pages/checkout_success' . '/' . $value;
//	echo $onload_file . '/n';
//	echo DIR_WS_MODULES . 'pages/checkout_shipping' . '/' . $value . '<BR/>';
//	include (DIR_WS_MODULES . 'pages/checkout_shipping' . '/' . $value);
//  }
//$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_MAIN_PAGE, 'false');
//include_once (DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
//echo $define_page . '<BR/>';
//require $define_page;

//echo 'CurrentPageBase = ' . zen_get_file_directory(DIR_WS_TEMPLATES . $current_template, 'tpl_checkout_shipping_default') . '<BR/>';
//include zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_TEMPLATES . $current_template, 'tpl_checkout_shipping_default');

//echo 'CurrentPageBase = ' . $current_page_base .'<-Really ' . $template->get_template_dir('tpl_checkout_shipping_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_shipping_default.php' . '<BR/>';

include ($template->get_template_dir('tpl_checkout_shipping_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_shipping_default.php');
//include ($template->get_template_dir('tpl_checkout_shipping_address_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_shipping_address_default.php');

//include $template->get_template_dir('tpl_checkout_shipping',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_checkout_shipping' ; //   'tpl_'.$current_page_base,DIR_WS_TEMPLATE, $current_page_base,'templates'); 
// zen_get_file_directory();
//echo 'Language = ' . DIR_WS_LANGUAGES . $_SESSION['language'] .'/'. FILENAME_CHECKOUT_SHIPPING . '.php';
//	include (DIR_WS_MODULES . 'pages/checkout_success' . '/' . $value);
?>

<?php include 'returntodesktop.php' ?>