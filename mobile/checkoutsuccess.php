<?php include 'header.php'; ?>

<h1 id="checkoutSuccessHeading">Thank You! We Appreciate your Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php

$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_CHECKOUT_SUCCESS, 'false');

/**
 * require the html_defined text for checkout success
 */
  require($define_page);
?>

<?php include 'returntodesktop.php' ?>
