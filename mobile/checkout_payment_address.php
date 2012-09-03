<?php include 'header.php'; ?>

<h1 id="checkoutPaymentAddressHeading">Thank You! We Appreciate your Payment Address Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php
include_once (DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
include ($template->get_template_dir('tpl_checkout_payment_address_default.php', DIR_WS_TEMPLATES, $current_page_base, 'templates') . '/tpl_checkout_payment_address_default.php');
?>

<?php include 'returntodesktop.php' ?>

