<?php include 'header.php'; ?>

<h1 id="checkoutSuccessHeading">Thank You! We Appreciate your Success Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php

$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_CHECKOUT_SUCCESS, 'false');

/**
 * require the html_defined text for checkout success
 */
  require($define_page);
?>
<?PHP 
/**
 * We now load the html_header.php file. This file contains code that would appear within the HTML <head></head> code 
 * it is overridable on a template and page basis. 
 * In that a custom template can define its own common/html_header.php file 
 */
//  require($template->get_template_dir('html_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/html_header.php');
?> 
<?PHP // $directory_array = $template->get_template_part($code_page_directory, '/^checkout_success/');
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
//echo $directory_array . '\n';
//  foreach ($directory_array as $value) { 
//    $onload_file = DIR_WS_MODULES . 'pages/checkout_success' . '/' . $value;
//	echo $onload_file . '/n';
//	echo $code_page_directory . '/' . $value . '/n';
//	require $code_page_directory . '/' . $value;
//  }
?>


<?php include 'returntodesktop.php' ?>
