<?php
//    set environment
    $strJson = file_get_contents("./env.json");
    if($strJson) {
        $ENV = json_decode($strJson, true);
        if(!$ENV) {
            die("Invalid json!");
        }
        if(!$ENV['env']) {
            die("Set ENV type first!");
            /**
             * local    -   workspace
             * dev      -   dev-test server
             * prod     -   productio server
             */
        }
    } else {
        die("env.json is not found or empty!");
    }


?>