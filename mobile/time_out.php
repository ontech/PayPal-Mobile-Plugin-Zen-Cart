<!-- Need to program the timeout function which is to login, but if not existent to then goto the login page which allows a new customer.-->

<?php include 'header.php'; 
//include zen_href_link(FILENAME_TIME_OUT);
//echo zen_href_link(FILENAME_TIME_OUT);

?>


Time out function still needs to be fully developed.  At the moment, you have been brought to here, but may navigate away from it using the toolbar above or by going/continuing to the full site by the link below.<BR/>

<?PHP 
/**
 * We now load the html_header.php file. This file contains code that would appear within the HTML <head></head> code 
 * it is overridable on a template and page basis. 
 * In that a custom template can define its own common/html_header.php file 
 */
  require($template->get_template_dir('html_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/html_header.php');
?> 
<?PHP // $directory_array = $template->get_template_part($code_page_directory, '/^time_out/');
//  foreach ($directory_array as $value) { 
/**
 * We now load header code for a given page. 
 * Page code is stored in includes/modules/pages/PAGE_NAME/directory 
 * 'header_php.php' files in that directory are loaded now.
 */
//    require($code_page_directory . '/' . $value);
//  }
//	$directory_array = $template->get_template_part(DIR_WS_MODULES . 'pages/checkout_success', '/^header_php/');
	$directory_array = $template->get_template_part($code_page_directory, '/^header_php/');
echo $directory_array . '/n';
  foreach ($directory_array as $value) { 
//    $onload_file = DIR_WS_MODULES . 'pages/checkout_success' . '/' . $value;
	echo $onload_file . '/n';
	echo $code_page_directory . '/' . $value . '/n';
	require $code_page_directory . '/' . $value);
  }
?>
<?php include 'returntodesktop.php' ?>


<?php include 'footer.php'; ?>

