<?php

    session_name($APP_CONF['site_name']);
    session_start();


	class Init
	{

        private $_numUserID;
        private $_strUserName;
        private $_strUserEmai;
        private $_strPageName;
        private $_numPageID;

        private $_rowUser;
        private $_rowGroup;


        public function __construct() {
            $this->_numUserID = NULL;
            $this->_strUserName = NULL;
            $this->_strUserEmai = NULL;
            $this->_strPageName = NULL;
            $this->_numPageID = NULL;

            $this->_rowUser = ($_SESSION['user'] ? $_SESSION['user'] : NULL);
            $this->_rowGroup = array();

            $this->init();
		}

        /**
         * 
         * @global type $rowUrl
         * @global type $objDb
         */
        private function init() {
            global $APP_CONF, $rowUrl, $objDb;

            if($rowUrl[0] == 'Webservice') {
//            Amennyiben ajax hívás volt
                $strClassName = "{$rowUrl[0]}_{$rowUrl[1]}";
                if(class_exists("{$rowUrl[0]}_{$rowUrl[1]}")) {
                    $rowWebserviceObject[] = new $strClassName;
                }
            } else {
//                TODO      menu es page tabla, jogosultsag kezeles, amennyiben lesz tobb page is
                if(!$this->_rowUser) {
                    $this->_strPageName = 'Sign';
                } else if(is_file("{$APP_CONF['lib']}Page/" . trim(ucfirst($rowUrl[0])) . ".php")) {
//                    TODO      tovabbi oldalak betoltese eseten. Itt most nem lesz.
                    $this->_strPageName = trim(ucfirst($rowUrl[0]));
                } else {
                    $this->_strPageName = '404';
                }
            }
            $this->loadPage($this->addWebservice());
        }


        /**
         * Betöltjük az oldal teljes tartalmát [head|header|content|footer]
         * @global type $APP_CONF
         * @global type $rowUrl
         * @param type $rowWebserviceObject
         */
        private function loadPage($rowWebserviceObject = NULL) {
            global $APP_CONF, $rowUrl;

            if($this->_strPageName) {
                $strPage = $this->_strPageName; //TODO global for included files
                require_once "{$APP_CONF['sys']}Content/Head.php";
                if($this->_rowUser && $this->_strPageName != '404') {
                    require_once "{$APP_CONF['sys']}Content/Header.php";
                }
                $strClass = "Page_{$this->_strPageName}";
                new $strClass();

                if($rowWebserviceObject) {
                    foreach ($rowWebserviceObject AS $objWebservice) {
                        if(method_exists($objWebservice, 'getFunction')) {
                            print $objWebservice->getFunction();
                        }
                    }
                }

                require_once "{$APP_CONF['sys']}Content/Footer.php";
            }
		}

        /**
         * v0.9
         * file név és elérés alapján betöltjük a css/js-eket
         * TODO automatizálni, hogy ne legyen egyesével beégetve a head/footer-ben
         * TODO ajax híváskor is be kell tölteni a megfelelőt, hogy ne első betöltéskor legyen bent minden. Csak ami kell
         * @global type $APP_CONF
         * @param type $strFileName
         * @param type $strPath
         */
        public static function getScript($strFileName, $strPath = NULL) {
            global $APP_CONF;
            if($strFileName) {
                $strExtension = pathinfo($strFileName)['extension'];
                if($strPath) {
                    $strFilePath = "{$APP_CONF['path']}{$strPath}{$strFileName}";
                } else {
                    $strFilePath = ($strExtension == 'js' ? "{$APP_CONF['js']}{$strFileName}" : "{$APP_CONF['css']}{$strFileName}");
                }
                if(is_file($strFilePath)) {
                    $strFileTime = "?v=" . filemtime($strFilePath);
                    if($strExtension == 'css') {
                        print "
                            <link href=\"" . ($strPath ? "{$APP_CONF['base_url']}{$strPath}" : "{$APP_CONF['base_url']}assets/page/css/") . "{$strFileName}{$strFileTime}\" rel=\"stylesheet\">";
                    } else if($strExtension == 'js') {
                        print "
                            <script src=\"" . ($strPath ? "{$APP_CONF['base_url']}{$strPath}" : "{$APP_CONF['base_url']}assets/page/js/") . "{$strFileName}{$strFileTime}\"></script>";
                    }
                }
            }
        }

        final private function addWebservice() {
            $rowClassName = array(
                $this->_strPageName => "Webservice_{$this->_strPageName}",
                "web" => "Webservice_About"
            );

            foreach($rowClassName AS $strParam => $strClassName) {
                if(class_exists($strClassName)) {
                    $rowWebserviceObject[] = new $strClassName(ucfirst($strParam));
                }
            }

            return $rowWebserviceObject;
        }

        public function getRowAdminUser() {
            return $this->_rowUser;
        }

        public function getStrUserLastName() {
            return $this->_rowUser['last_name'];
        }
        public function getStrUserEmail() {
            return $this->_rowUser['email'];
        }
        public function getStrUserGroupID() {
            return $this->_rowUser['group_id'];
        }

	}

?>