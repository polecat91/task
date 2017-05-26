<?php

    class Webservice_Sign extends Webservice
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
            
            if($strName) {
                $this->setFunction();
            } else if($_POST['do']) {
                $this->_strDo = $rowUrl[2];
                $this->init();
            }
        }
        
        /**
         * Init and create ajax function
         * @global type $APP_CONF
         */
        private function setFunction() {
            global $APP_CONF;
            
            $rowFinction['Login'] = '
                 cache:  false
                ,type:   "POST"
                ,async:  true
            ';
            
            $rowFinction['SignUp'] = '
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
                case 'Login':
                    $this->loginUser();
                    break;
                case 'SignUp':
                    $this->signUp();
                    break;
            }
        }

        private function loginUser() {
            $_SESSION['objUser'] = new Web_User();
            print json_encode($_SESSION['objUser']->login($this->_rowDo['email'], $this->_rowDo['password']));
        }
        
        private function signUp() {
            $_SESSION['objUser'] = new Web_User();
            print json_encode($_SESSION['objUser']->signUp($this->_rowDo));
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