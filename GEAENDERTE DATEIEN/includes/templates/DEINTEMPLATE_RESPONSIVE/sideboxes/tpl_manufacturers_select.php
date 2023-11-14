<?php
/**
 * Side Box Template
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_manufacturers_select.php for CEON Uri Mapping 2023-11-04 08:03:16Z webchills $
 */
$content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
$content .= zen_draw_form('manufacturers_form', zen_href_link(FILENAME_DEFAULT, '', $request_type, false), 'get', 'class="sidebox-select-form"');
  $content .= zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
  $content .= zen_draw_label(PLEASE_SELECT, 'select-manufacturers_id', 'class="sr-only"');
// BEGIN CEON URI MAPPING 1 of 2
  // Build the JavaScript necessary to have the manufacturer selection directly redirect to the page for the
  // manufacturer. This will result in the static URI for the manufacturer being used if one is associated with the
  // manufacturers page, or simply the default dynamic URI being used
  $content .= '<script type="text/javascript">' . "\n<!--\n";
  $content .= "manufacturers_sidebox_uri_mappings = new Array;\n\n";
  
  foreach ($manufacturer_sidebox_array as $manufacturer_sidebox_info) {
    if (strlen($manufacturer_sidebox_info['id']) > 0) {
      $content .= "manufacturers_sidebox_uri_mappings[" . $manufacturer_sidebox_info['id'] . "] = '" .
        addslashes(str_replace('&amp;', '&',
        zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer_sidebox_info['id'],  $request_type))) .
        "';\n";
    }
  }
  
  $content .= "function ceon_uri_mappingManufacturerSideboxRedirect(el)\n{\n\t";
  $content .= "if (el.options[el.selectedIndex].value != '') {\n\t\t";
  $content .= "window.location = manufacturers_sidebox_uri_mappings[" . "el.options[el.selectedIndex].value];\n\t";
  $content .= "}\n";
  $content .= "}\n";
  $content .= "//-->\n</script>\n";
  
  $content .= zen_draw_pull_down_menu('manufacturers_id', $manufacturer_sidebox_array,
    (isset($_GET['manufacturers_id']) ? $_GET['manufacturers_id'] : ''),
    'onchange="javascript:ceon_uri_mappingManufacturerSideboxRedirect(this);" size="' . MAX_MANUFACTURERS_LIST .
    '" style="width: 90%; margin: auto;"') . zen_hide_session_id();
/*
// END CEON URI MAPPING 1 of 2
  $content .= zen_draw_pull_down_menu('manufacturers_id', $manufacturer_sidebox_array, (isset($_GET['manufacturers_id']) ? $_GET['manufacturers_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" style="width: 90%; margin: auto;"') . zen_hide_session_id();
// BEGIN CEON URI MAPPING 2 of 2
*/
// END CEON URI MAPPING 2 of 2
  $content .= '</form>';
  $content .= '</div>';
