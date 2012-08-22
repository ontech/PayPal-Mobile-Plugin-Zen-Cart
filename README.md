PayPal Mobile Plugin Installation Instructions
==============================================
<sup> Powered by [ezimerchant](http://ezimerchant.com/)</sup>

1. Click the 'ZIP' button at the top of this page to download the plugin.

2. If you haven't already setup PayPal Express Checkout inside your Zen Cart installation, please follow these instructions, if you have already done so, please skip to step 3:
    + a. Login into your PayPal account
    + b. Under the 'My Account' tab, click 'Profile'
    + c. Under the 'Selling Online' section, click the 'Update' button next the API Access line.
    + d. Under Option 2 on the next screen, click 'View API Signature'
    + e. You will use these details on the page to fill out the API credentials in Zen Cart.
    + f. Login to Zen Cart
    + g. Go to Modules -> Payment and click on PayPal Express checkout.
    + h. Use the details from step 2e. and copy and paste the details accross.
    + i. Hit Save.

3. Unpack the contents of the plugin into your public directory except for the includes folder. mobile.php will be in the base of your public directory, while the 'mobile' folder will be subfolder within that.

4. Make a backup of your current .htaccess file inside your public hosting directory - if you have one.

5. Merge mobile.htaccess file with your existing .htaccess file (if you already have one). This contains the mobile user agent detection.
   Note: If you do not have an existing .htaccess file, then rename the mobile.htaccess to .htaccess

6. Check the site is still functional on your desktop computer.

7. Check the site on your phone and test the transaction flow.

ZenCart Modifications to support Return to Mobile Site after going back to Desktop.
--------------------------------
1. The steps above inserted three files into your includes directory to display a sidebox that would display when a mobile user has come back to the desktop.  This allows the user to then return to the mobile site.  These files must be moved so that they are under your own template instead of the YOUR_TEMPLATE path designated.

2. Unpack the ZIP file includes folder into a local directory.

3. Search through the folder for YOUR_TEMPLATE and rename the folder to the name of the current template on your ZenCart.

4. Copy the includes folder to your ZenCart location.

5. Login as your administrator and relocate the sidebox as desired.

Revert Installation Instructions
--------------------------------

1. Remove the changes to the .htacess file that you have made. Or use the backed up .htaccess to overwrite the changes. This should restore previous functionality in itself.

### Optional Steps


2. Remove the mobile.php file in the root of your public hosting directory.

3. Remove the mobile subdirectory uploaded previously.