<?php

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
    
    class Manage
    {
        /**
         * Create AND(OR) modify log json by parent Class dir name [date].json file
         * Every day create a new json file
         * Log type is json
         * @param type $strMsg
         * @param type $strType: [NULL || 0 == error], [1 == notice]
         * @author Csáki Viktor
         */
        public static function Log($strMsg, $strType = NULL) {
            global $APP_CONF;
            
            if(!$strMsg) {
                return false;
            }
            
            $strLogDir = $APP_CONF['log'] . debug_backtrace()[1]['class'] . "/";
            $strFileName =  date("ymd") . ".json";
            $tblLog = array();
            $strDate = date("Y-m-d H:i:s");
            
            if(is_file($strLogDir.$strFileName)) {
                $strLogJson = file_get_contents($strLogDir.$strFileName);
                $tblLog = json_decode($strLogJson, true);
            }
            
            $tblLog[] = array(
                 "date" => $strDate
                ,"type" => $strType
                ,"message" => $strMsg
            );
            $strLog = json_encode($tblLog);
            
            if (!is_dir($strLogDir)) {
                mkdir($strLogDir, 0664);
            }
            file_put_contents($strLogDir.$strFileName, $strLog);
            
        }
        
        public static function flush($numPercent = 0) {
//            sleep(1);
//            print json_encode(array('flush' => $numPercent));
//            ob_flush();
//            flush();
        }
    }

?>