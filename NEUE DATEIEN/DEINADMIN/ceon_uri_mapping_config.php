<?php
//steve css select disabled
//webchills use admin_html_head and own css
/**
 * Ceon URI Mapping Configuration Utility HTML Output Page.
 *
 * Builds the main Zen Cart output HTML then instantiates and outputs the Config Utility's output.
 * 
 * @package     ceon_uri_mapping
 * @author      Conor Kerr <zen-cart.uri-mapping@ceon.net>
 * @copyright   Copyright 2008-2019 Ceon
 * @copyright   Copyright 2003-2019 Zen Cart Development Team
 * @copyright   Portions Copyright 2003 osCommerce
 * @link        http://ceon.net/software/business/zen-cart/uri-mapping
 * @license     http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version     $Id: ceon_uri_mapping_config.php 2024-04-07 14:30:10Z webchills $
 */

require('includes/application_top.php');

$languages = zen_get_languages();
$num_languages = count($languages);

/**
 * Load in the Ceon URI Mapping Config Utility class
 */
require_once(DIR_WS_CLASSES . 'class.CeonURIMappingConfigUtility.php');

$config_utility = new CeonURIMappingConfigUtility();

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
</head>
<body>
<a name="top" id="top"></a>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="ceon-uri-mapping-wrapper">
<?php echo zen_draw_form('ceon-uri-mapping', FILENAME_CEON_URI_MAPPING_CONFIG, zen_get_all_get_params(), 'post',
	'onsubmit="" id="ceon-uri-mapping"', true);
echo zen_hide_session_id(); ?>
	<h1 class="pageHeading CeonAdminPageHeading"><?php echo HEADING_TITLE; ?></h1>

<?php

echo $config_utility->getOutput();

?>
</form>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>