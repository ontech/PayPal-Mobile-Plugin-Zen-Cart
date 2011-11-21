<?php include 'header.php'; ?>

<h1>Cart</h1>
<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product', 'NONSSL')); ?>

<style type="text/css">
table {
	background:#fff;
	border-radius:10px;
	border-collapse:collapse;
}
table th {
	text-align:left;
	background:#eee;
	padding:4px;
}

.update input,
.update span,
.update div {
	display:none;
}
table td {
	padding:4px;
	vertical-align:middle !important;
}
table td input[type="text"] {
	width:28px;
}
</style>

<table>
<tr>
	<th>Qty</th>
	<th> </th>
	<th>Name</th>
	<th>Price</th>
	<th>Delete </th>
</tr>
<?php
  foreach ($productArray as $product) {
?>
<tbody style="border-bottom:2px solid #ccc;">
<tr>
	<td>
		<?php
		  if ($product['flagShowFixedQuantity']) {
			echo $product['showFixedQuantityAmount'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
		  } else {
			echo $product['quantityField'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
		  }
		?>
	</td>
	<td class="update">
	<?php
		if ($product['buttonUpdate'] == '') {
		echo '' ;
		} else {
		echo $product['buttonUpdate'];
		}
	?>
	</td>
	<td><?php echo $product['productsName']; ?> </td>
	<td><?php echo $product['productsPrice']; ?> </td>
	<td>
           <a href="/index.php?main_page=shopping_cart&action=remove_product&product_id=<?php echo $product['id']; ?>"><img src="mobile/images/delete.png" /></a>
	</td>
</tr>
<tr>
	<td colspan="4">
		<?php
		  echo $product['attributeHiddenField'];
		  if (isset($product['attributes']) && is_array($product['attributes'])) {
		  echo '<ul style="margin:0px;" padding:0px;">';
			reset($product['attributes']);
			foreach ($product['attributes'] as $option => $value) {
		?>

		<li><?php echo $value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']); ?></li>

		<?php
			}
		  echo '</ul>';
		  }
		?>
	</td>
</tr>
</tbody>
<?php
}
?>
<tr>
	<td colspan="3" align="right">Total</td>
	<td><?php echo $cartShowTotal; ?> </td>
</tr>
<tr>
<td colspan="4" style="text-align:center;">
<input type="submit" value="Update Cart">
</td>
</tr>
</table>

<div style="text-align:center; padding-top:10px;">
	<a rel="external" href="http://zencartmobile.ezispace.com/ipn_main_handler.php?type=ec">
		    <img src="mobile/images/btn_checkout_278x43.png" />
    </a>
</div>

</form>

<?php include 'footer.php'; ?>
