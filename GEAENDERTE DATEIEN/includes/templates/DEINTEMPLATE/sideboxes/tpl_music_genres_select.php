<?php
/**
 * Side Box Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_music_genres_select.php for CEON Uri Mapping 2022-02-18 20:07:16Z webchills $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content .= zen_draw_form('music_genres_form', zen_href_link(FILENAME_DEFAULT, '', $request_type, false), 'get');
  $content .= zen_draw_hidden_field('main_page', FILENAME_DEFAULT) . zen_hide_session_id() . zen_draw_hidden_field('typefilter', 'music_genre');
  $content .= zen_draw_label(PLEASE_SELECT, 'select-music_genre_id', 'class="sr-only"');
// BEGIN CEON URI MAPPING 1 of 2
  // Build the JavaScript necessary to have the music genre selection directly redirect to the page for the music
  // genre. This will result in the static URI for the music genre being used if one is associated with the music
  // genre page, or simply the default dynamic URI being used
  $content .= '<script type="text/javascript">' . "\n<!--\n";
  $content .= "music_genre_sidebox_uri_mappings = new Array;\n\n";
  
  foreach ($music_genres_array as $music_genre_sidebox_info) {
    if (strlen($music_genre_sidebox_info['id']) > 0) {
      $content .= "music_genre_sidebox_uri_mappings[" . $music_genre_sidebox_info['id'] . "] = '" .
        addslashes(str_replace('&amp;', '&',
        zen_href_link(FILENAME_DEFAULT, 'typefilter=music_genre&music_genre_id=' .
        $music_genre_sidebox_info['id'], $request_type))) . "';\n";
    }
  }
  
  $content .= "function ceon_uri_mappingMusicGenreSideboxRedirect(el)\n{\n\t";
  $content .= "if (el.options[el.selectedIndex].value != '') {\n\t\t";
  $content .= "window.location = music_genre_sidebox_uri_mappings[" . "el.options[el.selectedIndex].value];\n\t";
  $content .= "}\n";
  $content .= "}\n";
  $content .= "//-->\n</script>\n";
  
  $content .= zen_draw_pull_down_menu('music_genre_id', $music_genres_array,
    (isset($_GET['music_genre_id']) ? $_GET['music_genre_id'] : ''),
    'onchange="javascript:ceon_uri_mappingMusicGenreSideboxRedirect(this);" size="' . MAX_MUSIC_GENRES_LIST .
    '" style="width: 90%; margin: auto;"') . zen_hide_session_id();
/*
// END CEON URI MAPPING 1 of 2
  $content .= zen_draw_pull_down_menu('music_genre_id', $music_genres_array, (isset($_GET['music_genre_id']) ? $_GET['music_genre_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_MUSIC_GENRES_LIST . '" style="width: 90%; margin: auto;"');
// BEGIN CEON URI MAPPING 2 of 2
*/
// END CEON URI MAPPING 2 of 2
  $content .= '</form>';
  $content .= '</div>';

