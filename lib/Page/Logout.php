<?php

    class Page_Logout
	{
		
        public function __construct() {
            global $APP_CONF;
            
            $objUser = new Web_User();
            if($objUser->logout()) {
                header("Location: {$APP_CONF['base_url']}");
            }
            
		}
	}	
?>