<?php

    //functions

    /**
     * set date to time ago
     * @param type $strDateTime
     * @return type
     */
    function time_elapsed_string($strDateTime) {
        $objNow = new DateTime;
        $objAgo = new DateTime($strDateTime);
        $objDiffTime = $objNow->diff($objAgo);

        $objDiffTime->w = floor($objDiffTime->d / 7);
        $objDiffTime->d -= $objDiffTime->w * 7;

        $rowString = array(
             'y' => 'éve'
            ,'m' => 'hónapja'
            ,'w' => 'hete'
            ,'d' => 'napja'
            ,'h' => 'órája'
            ,'i' => 'perce'
            ,'s' => 'másodperce'
        );
        foreach ($rowString as $strKey => &$strTimeValue) {
            if ($objDiffTime->$strKey) {
                $strTimeValue = $objDiffTime->$strKey . ' ' . $strTimeValue;
            } else {
                unset($rowString[$strKey]);
            }
        }
        $rowString = array_values(array_filter($rowString));
        return $rowString ? "{$rowString[0]}, {$rowString[1]}"  : 'pont most';
    }
    
    /**
     * Autoloader
     * @global type $APP_CONF
     * @param type $strClassName
     */
    function myAutoloader($strClassName) {
        global $APP_CONF;

        $strFileName = 'lib/' . str_replace("_", "/", $strClassName) . '.php';

        include_once $strFileName;
    }

    /**
     * Create underscore string to camelCase
     * @param type $input
     * @param type $separator
     * @return type
     */
    function camelize($input, $separator = '_') {
        return str_replace($separator, '', ucwords($input, $separator));
    }
    
    function dbNull($str) {
        return ($str == NULL ? "'NULL'" : "'{$str}'");
    }
    
    function is_multi($tbl) {
        $obj = array_filter($tbl,'is_array');
        if(count($obj)>0) return true;
        return false;
    }
    
    /**
     * fast check JSON
     * @param type $strString
     * @return type
     */
    function isJson($strString) {
        json_decode($strString);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    //functions END

//    Classes

    class Pre
    {
        public static function data($tbl, $isDebug = FALSE) {
            if($tbl) {
                print '<pre>';
                if($isDebug) {
                    var_dump($tbl);
                } else {
                    print_r($tbl);
                }
                print '</pre>';
            }
        }
    }
    
?>