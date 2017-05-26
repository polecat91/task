<?php

include_once 'env.php';

$APP_CONF = array();

$APP_CONF['site_name'] = $ENV['base']['site_name'];

$APP_CONF['base_url'] = "{$ENV['base']['base_local']}{$APP_CONF['site_name']}/";

$APP_CONF['path'] = "{$ENV['base']['base_path']}{$APP_CONF['site_name']}/";
$APP_CONF['lib'] = "{$APP_CONF['path']}lib/";
$APP_CONF['sys'] = "{$APP_CONF['path']}sys/";

$APP_CONF['css'] = "{$APP_CONF['path']}assets/page/css/";
$APP_CONF['js'] = "{$APP_CONF['path']}assets/page/js/";
$APP_CONF['images'] = "{$APP_CONF['path']}assets/page/images/";

$APP_CONF['log'] = "{$APP_CONF['sys']}log/";

$APP_CONF['assets'] = "{$APP_CONF['path']}assets/";
$APP_CONF['common'] = "{$APP_CONF['lib']}Common/";

$APP_CONF['default_page'] = 'about';

include_once "{$APP_CONF['common']}Component.php";

ini_set("include_path", $APP_CONF['path']);
define("PEAR", $APP_CONF['common']);
spl_autoload_register('myAutoloader');

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED |E_STRICT));

//set rowUrl
$strUrl = NULL;
$rowUrl = array();
if($_REQUEST) {
    $strUrl = $_REQUEST['s'];
    $rowUrl = array_values(array_filter(explode('/', $strUrl)));
} else {
    $rowUrl[] = $APP_CONF['default_page'];
}



include_once 'db.php';
$objInit = new Init();

?>