<?php

    /**
     * EscapeSimple
     * @param type $item
     * @author Csáki Viktor
     */
//    function escapeData(&$item) {
//        $item = mysql_real_escape_string($item);
//    }
    
//    function 

    /**
     * Create underscore string to camelCase
     * @param type $input
     * @param type $separator
     * @return type
     * @author Csáki Viktor
     */
    function camelize($input, $separator = '_') {
        return str_replace($separator, '', ucwords($input, $separator));
    }
    
    function dbNull($str) {
        return ($str == NULL ? "'NULL'" : "'{$str}'");
    }

?>