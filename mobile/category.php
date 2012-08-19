<?php include 'header.php'; ?>

<div>
	<?php   for ($i=0;$i<sizeof($breadcrumb->_trail);$i++) { ?>
	<?php 
	$str = end(explode('_', $breadcrumb->_trail[$i]['link']));	
	$catid = preg_replace('[\D]', '', $str);
	?>
	<a href="<?php 
		if($i==0) {
			echo './">';
		} else {
			echo 'category' . $catid . '_1.htm?cPath='. $catid . '">';
		};
		echo htmlspecialchars($breadcrumb->_trail[$i]['title']); ?></a> >
	<?php } ?>
</div>

<?php
$subcategories = zen_get_categories('', $current_category_id);

?>

<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
	<?php   for ($i=0;$i<sizeof($subcategories);$i++) { ?>
		<li data-theme="c" class=""><a data-transition="slide" href="category<?php echo $subcategories[$i]['id'] ?>_1.htm?cPath=<?php echo $current_category_id ?>_<?php echo $subcategories[$i]['id'] ?>"><?php echo $subcategories[$i]['text']; ?></a></li>
	<?php } ?>
</ul>


<?php

$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_PRODUCTS_LISTING, 'p.products_id', 'page');
$listing = $db->Execute($listing_split->sql_query);

if (!$listing->EOF) {
?>
<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<li data-role="list-divider">Products</li>

	<?php
	while(!$listing->EOF)
	{
	?>
		
	<li style="text-align:center; padding:5px;" class="ui-body-c">
	
<div class="hproduct brief" style="text-align:center;">

<table width="100%">
<tr>
	<td colspan="2" align="left">
		<a rel="external" href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><?php echo htmlspecialchars($listing->fields['products_name']); ?></a>
	</td>
</tr>
<tr>
<td width="0" style="vertical-align: top;">
	<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="<?php echo htmlspecialchars(mobile_image(DIR_WS_IMAGES.$listing->fields['products_image'])); ?>" width="100"/></a>
</td>
<td align="left">

		<form method="post" action="cart/index.php?action=add_product" class="productform">
                        <input type="hidden" name="securityToken" value="<?php echo @$_SESSION['securityToken'];?>" />
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
				<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>" class="ui-link" style="color: #2489CE !important; text-shadow: none;"><?PHP echo MORE_INFO_TEXT; ?></a>
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
} else if(!$subcategories) {

echo '<p>There are no products in this category</p>';

};
?>

</ul>

<?php include 'returntodesktop.php' ?>


<?php include 'footer.php'; ?>

