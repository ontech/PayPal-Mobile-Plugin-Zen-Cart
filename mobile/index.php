<?php include 'header.php'; ?>

<?php
$listing_sql = "select pd.products_name, p.products_image, p.products_id, p.products_type, p.master_categories_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status from ".DB_PREFIX."products_description pd, ".DB_PREFIX."products p left join ".DB_PREFIX."manufacturers m on p.manufacturers_id = m.manufacturers_id, ".DB_PREFIX."products_to_categories p2c left join ".DB_PREFIX."specials s on p2c.products_id = s.products_id where p.products_status = 1 and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '1'";
$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_PRODUCTS_LISTING, 'p.products_id', 'page');
$listing = $db->Execute($listing_split->sql_query);
$productcheck = $listing->fields['products_id'];
if ($productcheck) {

?>
<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<li data-role="list-divider">Featured Products</li>

	<?php
	while(!$listing->EOF)
	{
	?>
		
	<li style="text-align:center; padding:5px;">
	
<div class="hproduct brief" style="text-align:center;">

<table width="100%">
<tr>
	<td colspan="2" align="left">
		<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><?php echo htmlspecialchars($listing->fields['products_name']); ?></a>
	</td>
</tr>
<tr>
<td width="0" style="vertical-align: top;">
	<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="./images/<?php echo htmlspecialchars($listing->fields['products_image']); ?>" width="100"/></a>
</td>
<td align="left">
		<form method="post" action="cart/index.php?action=add_product" class="productform">
			<input type="hidden" name="products_id" value="<?php echo $listing->fields['products_id']; ?>"/>
			<input type="hidden" name="cart_quantity" value="1" maxlength="6" size="4">

			<table align="center" style="margin-left:auto; margin-right:auto;" width="100"><tr><td style="border:none; vertical-align:middle">					
					<span class="price">
						<?php echo zen_get_products_display_price($listing->fields['products_id']) ?>
					</span>
				
			</td></tr><tr><td style="border:none; vertical-align:middle;">
			<?php
			if (zen_has_product_attributes($listing->fields['products_id'])) { 
				echo ' ';
			} else {
			?>
				<input type="submit" class="buy" data-theme="e" value="Add to Cart" /><br/>
			<?php
			}
			?>
				<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id'];?>" class="ui-link" style="color: #2489CE !important; text-shadow: none;">More info...</a>
			</td></tr></table>
		</form>
</td>
</tr>
</table>		
</div>
	
	</li>
	
	<?php

		$listing->MoveNext();
	}
} else {

echo '<h1>Welcome</h1>';

};
?>

</ul>

<?php include 'footer.php'; ?>
