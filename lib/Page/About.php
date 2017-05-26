<?php

    class Page_About extends Web_About
	{
		
        public function __construct() {
            parent::__construct();
            $this->contentDisplay();
		}
        
        public function contentDisplay() {
            global $APP_CONF, $ADM;
            
            //own setup
            $tblTask = parent::getTask();
            //own setup END
            
            //CONST setup
            $strTemplate = $APP_CONF['sys'] . str_replace('_', '/', __CLASS__) . '.php';
            require_once $strTemplate;
        }
        
	}	
?>