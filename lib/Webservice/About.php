<?php

    class Webservice_About extends Webservice
    {
        
        private $_strFunction;
        private $_strName;
        private $_rowDo;
        private $_strDo;


        public function __construct($strName) {
            global $rowUrl;

            $this->_strFunction = NULL;
            $this->_strName = $strName;
            $this->_rowDo = NULL;
            $this->_strDo = NULL;
            
            if($_POST['do']) {
                $this->_strDo = $rowUrl[2];
                $this->init();
            } else if($strName) {
                $this->setFunction();
            }
        }
        
        /**
         * Init and create ajax function
         * @global type $APP_CONF
         */
        private function setFunction() {
            global $APP_CONF;
            
            $rowFinction['GetTask'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            $rowFinction['AddTask'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            $rowFinction['RemoveTask'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            $rowFinction['ModifyTask'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            $rowFinction['SetCompact'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            if($rowFinction) {
                foreach($rowFinction AS $strFunction => $strSetup) {
                    $this->_strFunction .= parent::createFunction($strFunction, $strSetup, $this->_strName);
                }
            }
        }

        /**
         * Catch ajax request
         */
        private function init() {
            $this->_rowDo = json_decode($_POST['do'], TRUE);
            array_walk_recursive($this->_rowDo, "escapeData");
            
            switch ($this->_strDo) {
                case 'GetTask':
                    $this->getTask();
                    break;
                case 'AddTask':
                    $this->taskEvent();
                    break;
                case 'RemoveTask':
                    $this->taskEvent();
                    break;
                case 'ModifyTask':
                    $this->taskEvent();
                    break;
                case 'SetCompact':
                    $this->setCompact();
                    break;
            }
        }

        private function taskEvent() {
            $objAbout = new Web_About();
            $strFunction = $this->_strDo;
            print json_encode($objAbout->$strFunction($this->_rowDo));
        }
        
        private function getTask() {
            $objAbout = new Web_About($this->_rowDo['id']);
            print json_encode($objAbout->getTask());
        }
        
        private function setCompact() {
            $objAbout = new Web_About();
            print json_encode($objAbout->setCompact());
        }

        /**
         * return all ajax function
         * @return type
         */
        public function getFunction() {
            return $this->_strFunction;
        }

    }
    
    
?>