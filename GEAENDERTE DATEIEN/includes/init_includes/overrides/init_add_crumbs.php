<?php
/**
 * create the breadcrumb trail
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_add_crumbs.php for Ceon Uri Mapping 2023-11-04 08:24:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$breadcrumb->add(HEADER_TITLE_CATALOG, zen_href_link(FILENAME_DEFAULT));

/**
 * add category names or the manufacturer name to the breadcrumb trail
 */
$robotsNoIndex = $robotsNoIndex ?? false;

// might need isset($_GET['cPath']) later ... right now need $cPath or breaks breadcrumb from sidebox etc.
if (isset($cPath_array, $cPath)) {
    for ($i = 0, $n = count($cPath_array); $i < $n; $i++) {
        $categories_query =
            "SELECT categories_name
               FROM " . TABLE_CATEGORIES_DESCRIPTION . "
              WHERE categories_id = " . (int)$cPath_array[$i] . "
                AND language_id = " . (int)$_SESSION['languages_id'];
        $categories = $db->Execute($categories_query, 1);

        if (!$categories->EOF) {
            $breadcrumb->add($categories->fields['categories_name'], zen_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i + 1)))));
        } elseif (SHOW_CATEGORIES_ALWAYS === '0') {
            // if invalid, set the robots noindex/nofollow for this page
            $robotsNoIndex = true;
            break;
        }
    }
}
/**
 * add get terms (e.g manufacturer, music genre, record company or other user defined selector) to breadcrumb
 */
$sql = "select *
        from " . TABLE_GET_TERMS_TO_FILTER;
$get_terms = $db->execute($sql);
while (!$get_terms->EOF) {
	if (isset($_GET[$get_terms->fields['get_term_name']])) {
		$sql = "select " . $get_terms->fields['get_term_name_field'] . "
		        from " . constant($get_terms->fields['get_term_table']) . "
		        where " . $get_terms->fields['get_term_name'] . " =  " . (int)$_GET[$get_terms->fields['get_term_name']];
		$get_term_breadcrumb = $db->execute($sql);
    if ($get_term_breadcrumb->RecordCount() > 0) {
// BEGIN CEON URI MAPPING 1 of 2
	  // Set the required parameters so that an attempt can be made to map the link to any static URI for the
	  // filtered page
	  $typefilter_parameters = '';
	  
	  if ($get_terms->fields['get_term_name'] != 'manufacturers_id') {
		$typefilter_parameters = 'typefilter=' . str_replace('_id', '', $get_terms->fields['get_term_name']) . '&';
	  }
	  
	  $typefilter_parameters .=
		$get_terms->fields['get_term_name'] . '=' . $_GET[$get_terms->fields['get_term_name']];
	  
      $breadcrumb->add($get_term_breadcrumb->fields[$get_terms->fields['get_term_name_field']],
		zen_href_link(FILENAME_DEFAULT, $typefilter_parameters));
	  /*
// END CEON URI MAPPING 1 of 2
      $breadcrumb->add($get_term_breadcrumb->fields[$get_terms->fields['get_term_name_field']], zen_href_link(FILENAME_DEFAULT, $get_terms->fields['get_term_name'] . "=" . $_GET[$get_terms->fields['get_term_name']]));
// BEGIN CEON URI MAPPING 2 of 2
	  */
// END CEON URI MAPPING 2 of 2
    }
	}
	$get_terms->MoveNext();
}
/**
 * add the products name to the breadcrumb trail
 */
if (isset($_GET['products_id'])) {
    $productname_query =
        "SELECT products_name
           FROM " . TABLE_PRODUCTS_DESCRIPTION . "
          WHERE products_id = " . (int)$_GET['products_id'] . "
            AND language_id = " . (int)$_SESSION['languages_id'];
    $productname = $db->Execute($productname_query, 1);

    if (!$productname->EOF) {
    $breadcrumb->add($productname->fields['products_name'], zen_href_link(zen_get_info_page($_GET['products_id']), 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
  }
}
