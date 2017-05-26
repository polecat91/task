<?php


	class Web_User
	{

		private $_numUserID;
		private $_strUserName;
		private $_strUserEmai;
        private $_strPageName;

        public function __construct($numUserID = NULL) {
            $this->_numUserID = $numUserID;
            $this->_strUserName = NULL;
            $this->_strUserEmai = NULL;
            $this->_strPageName = NULL;

		}


		private function set($rowUser) {
            $this->_numUserID = $rowUser['id'];
            $this->_strUserName = $rowUser['username'];
            $this->_strUserEmail = $rowUser['email'];
		}


        public function signUp($rowData) {
            global $objDb;
            if($rowData['password'] != $rowData['re_password']) {
                return array("isError" => TRUE, "message" => 'A két jelszó nem térhet el.');
            }
            if($rowData['username'] && $rowData['email']) {
                $numIsEmail = $objDb->getOne("
                    SELECT
                        1
                    FROM
                        user
                    WHERE
                        email = '{$rowData['email']}'
                ");
                if(!DB::isError($numIsEmail) && $numIsEmail) {
                    return array("isError" => TRUE, "message" => 'Az email cím már foglalt.');
                }
                $numIsUser = $objDb->getOne("
                    SELECT
                        1
                    FROM
                        user
                    WHERE
                        username = '{$rowData['username']}'
                ");
                if(!DB::isError($numIsUser) && $numIsUser) {
                    return array("isError" => TRUE, "message" => 'A felhasználónév már foglalt.');
                }

                $objAddUser = $objDb->query("
                    INSERT INTO
                        user
                    SET
                         username = '{$rowData['username']}'
                        ,email = '{$rowData['email']}'
                        ,password = '{$this->setPasswd($rowData['password'])}'
                        ,create_user = '{$rowData['username']}'
                ");
                if(!DB::isError($objAddUser)) {
                    $numLadtID = $objDb->getOne('SELECT LAST_INSERT_ID()');
                    $rowUser = array(
                         'user_id' => $numLadtID
                        ,'user_status' => 1
                        ,'username' => $rowData['username']
                        ,'email' => $rowData['email']
                    );
                    
                    $this->set($rowUser);
                    $_SESSION['user'] = $rowUser;
                    return array("isError" => FALSE, "message" => 'Sikeres regisztráció.');
                }
            }
            
            return array("isError" => TRUE, "message" => 'Sikertelen regisztráció.');
        }

        public function login($strEmail, $strPassword) {
            global $objDb;
            
            if(!$strEmail || !$strPassword) {
                return false;
            }

            $rowUser = $objDb->getRow("
                SELECT
                     id AS user_id
                    ,status AS user_status
                    ,username
                    ,email
                FROM
                    user
                WHERE
                    email = '{$strEmail}'
                    AND password = '{$this->setPasswd($strPassword)}'
                    AND status IS TRUE
            ");

            if(!DB::isError($rowUser) && $rowUser) {
//                accept to login and set default UserData
                $this->set($rowUser);
                $_SESSION['user'] = $rowUser;
                $_SESSION['isCompact'] = FALSE;
                
                return TRUE;
            }
//            failed login -- invalid email and/or password
            return FALSE;

		}

		public function logout() {
            if(session_destroy()) {
                return TRUE;
            }

            return FALSE;
		}


        /**
         * Legeneraljuk az md5-olt jelszot
         * @param type $strDefaultPassword
         * @return type
         */
        private function setPasswd($strDefaultPassword) {
            return md5("p4C41P0Rk01tB4r4cK1EkV4Rr41{$strDefaultPassword}");
        }

	}	
?>