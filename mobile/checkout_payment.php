<?php include 'header.php'; ?>

<h1 id="checkoutPaymentHeading">Thank You! We Appreciate your Payment Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php
include_once (DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
//echo $code_page_directory . ' <-Code_page_directory<BR/>';

//echo 'CurrentPageBase = ' . $current_page_base .'<-Really ' . $template->get_template_dir('tpl_checkout_payment_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_payment_default.php' . '<BR/>';

include ($template->get_template_dir('tpl_checkout_payment_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_payment_default.php');
?>

<?php include 'returntodesktop.php' ?>

