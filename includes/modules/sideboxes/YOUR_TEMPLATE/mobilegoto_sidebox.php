<?php
/**
 * mobilegoto sidebox - resets the cookie that prevented the mobile user from seeing the mobile site, as defined in this file
 *
 * @package templateSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mobilegoto_sidebox.php ???? 2012-08-14 00:36:39Z drbyte $
 */

	unset ($information);

	?>
	<script type="text/javascript">
	
	function WriteShowDesktopCookie()
	{
		var now = new Date();
		now.setFullYear( now.getFullYear() - 1);
		document.cookie="showdesktop=;" + " expires=" + now.toUTCString() + ";"; 
		window.location = './';
	}
	
	</script>
<?PHP

	if (isset($_COOKIE["showdesktop"]) == true)
	{
//		echo 'showdesktop is set to ' . $_COOKIE["showdesktop"] . "<-";
		$cook_val = $_COOKIE["showdesktop"];
		if ($cook_val == 1) {
//			echo 'cook_val = 1';
			$information[] = '<a href="" onclick="WriteShowDesktopCookie();"/>Return to Mobile Site</a>';
			$show_mobilegoto_sidebox = true;
		} elseif ($cook_val == 0) {
//			echo 'cook_val = 0';
			$information[] = '<a href="" onclick="WriteShowDesktopCookie();"/>Return to Mobile Site</a>';
			$show_mobilegoto_sidebox = true;
		} else {
//			echo 'cook_val = something else';
			$show_mobilegoto_sidebox = false;
		}
	} else {
		$show_mobilegoto_sidebox = false;
	}

	if ($show_mobilegoto_sidebox == true) { //This is to determine if the cookie has been set
		require($template->get_template_dir('tpl_mobilegoto_sidebox.php',DIR_WS_TEMPLATE,$current_page_base,'sideboxes'). '/tpl_mobilegoto_sidebox.php');
		$title = BOX_HEADING_MOBILEGOTO_SIDEBOX;
//		$left_corner = false;
//		$right_corner = false;
//		$right_arrow = false;
		require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE,$current_page_base,'common') . '/' . $column_box_default);
	}

 ?>