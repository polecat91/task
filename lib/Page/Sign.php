<?php

    class Page_Sign
	{
		
        public function __construct() {
            $this->contentDisplay();
		}
        
        
        public function contentDisplay() {
            global $APP_CONF;
            
            //own setup
            //own setup END
            
            //CONST setup
            $strTemplate = $APP_CONF['sys'] . str_replace('_', '/', __CLASS__) . '.php';
            require_once $strTemplate;
        }
        
	}	
?>