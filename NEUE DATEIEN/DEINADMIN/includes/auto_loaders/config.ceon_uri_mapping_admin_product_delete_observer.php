<?php
/**
 * Autoloader array for Ceon URI Mapping ADMIN functionality. Makes sure that Ceon URI Mapping is instantiated at the
 * right point of the Zen Cart initsystem.
 *
 * @package     ceon_uri_mapping
 * @author      Conor Kerr <zen-cart.uri-mapping@ceon.net>
 * @author      Ceon Support
 * @copyright   Copyright 2008-2019 Ceon
 * @copyright   Copyright 2003-2007 Zen Cart Development Team
 * @copyright   Portions Copyright 2003 osCommerce
 * @link        https://ceon.net
 * @license     http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version     2019
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

//added to use an observer with includes/functions/general.php for processing product removal
 $autoLoadConfig[0][] = array(
  'autoType' => 'class',
  'loadFile' => 'observers/class.CeonURIMappingDeleteProductsObserver.php',
  'classPath'=>DIR_WS_CLASSES
  );
 $autoLoadConfig[198][] = array(
  'autoType' => 'classInstantiate',
  'className' => 'ceonAdminRemoveProducts',
  'objectName' => 'ceonAdminRemoveProductsObserve'
  );
