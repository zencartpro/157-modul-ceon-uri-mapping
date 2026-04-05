<?php
/**
 * @package admin
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version CeonURIMappingJavaScriptLoader.php 2026-04-05 11:33:00 webchills
 */

class zcObserverClassCeonURIMappingJavaScriptLoader extends base
{
    public function __construct() {
        $observeThis = [];

        $observeThis[] = 'NOTIFY_ADMIN_FOOTER_END';

        $this->attach($this, $observeThis);
    }

    /**
     * @param $callingClass
     * @param $notifier
     * @return void
     */
    public function updateNotifyAdminFooterEnd(&$callingClass, $notifier): void
    {
        if (file_exists(DIR_WS_INCLUDES . 'ceon_uri_mapping_javascript.php')) {
          require DIR_WS_INCLUDES . 'ceon_uri_mapping_javascript.php';
        }
    }
}
