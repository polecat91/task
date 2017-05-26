<?php

    require_once 'lib/Common/DB.php';

    $rowConnectData = array(
        'phptype'  => $ENV['db']['phptype'],
        'username' => $ENV['db']['username'],
        'password' => $ENV['db']['password'],
        'hostspec' => $ENV['db']['hostspec'],
        'database' => $ENV['db']['database']
    );
    
    $rowOptions = array(
        'debug'       => 2,
        'portability' => DB_PORTABILITY_ALL,
    );

    $objDb =& DB::connect($rowConnectData, $rowOptions);
    $objDb->query("SET NAMES 'utf8'");
    
    if (PEAR::isError($objDb)) {
        die($objDb->getMessage());
    }

    function escapeData(&$item) {
        global $objDb;
        if(isJson($item)) {
            return false;
        }
        
        $item = $objDb->escapeSimple($item);
    }
    
    array_walk_recursive($_POST, "escapeData");
    array_walk_recursive($_REQUEST, "escapeData");
    array_walk_recursive($_GET, "escapeData");

?>