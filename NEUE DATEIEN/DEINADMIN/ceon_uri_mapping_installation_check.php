<?php
// webchills use admin_html_head and own css
/**
 * Ceon URI Mapping Installation Check.
 *
 * Aids the installation of the module by trying to identify any installation issues and by
 * providing example RewriteRules to use.
 * 
 * @package     ceon_uri_mapping
 * @author      Conor Kerr <zen-cart.uri-mapping@ceon.net>
 * @copyright   Copyright 2008-2019 Ceon
 * @copyright   Copyright 2003-2019 Zen Cart Development Team
 * @copyright   Portions Copyright 2003 osCommerce
 * @link        http://ceon.net/software/business/zen-cart/uri-mapping
 * @license     http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version     $Id: ceon_uri_mapping_installation_check.php 2019-07-04 16:31:10Z webchills $
 */

require('includes/application_top.php');

$languages = zen_get_languages();
$num_languages = count($languages);

/**
 * Load in the Ceon URI Mapping Installation Check class
 */
require_once(DIR_WS_CLASSES . 'class.CeonURIMappingInstallationCheck.php');

$installation_check = new CeonURIMappingInstallationCheck();

$installation_check->performChecks();

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
</head>
	
</head>
<body>
<a name="top" id="top"></a>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="ceon-uri-mapping-wrapper">
	<h1 class="pageHeading CeonAdminPageHeading"><?php echo HEADING_TITLE; ?></h1>

<?php

echo $installation_check->getOutput();

?>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>