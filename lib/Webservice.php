<?php

    class Webservice
    {
        
        private $_objFile;              //uploaded file
        private $_strFilePath;          //save location
        private $_strFileName;          //save name
        private $_rowFileExtension;     //licensed
        private $_numFileSize;          //max file size

        protected function createFunction($strFunction, $strSetup, $strName) {
            global $APP_CONF, $ADM;
            
            if($strFunction && $strSetup) {
                $strJS = '
                    <script type="text/javascript">
                        function AJAX_' . $strFunction . '(strData, objCallBack) {
                            NProgress.start();
                            $.ajax({
                                url: "' . ($ADM ? $ADM['base_url'] : $APP_CONF['base_url'] ) . 'Webservice/' . $strName . '/' . $strFunction . '",
                                data: "do="+strData,
                                ' . $strSetup . ',
                                success: function (objResponse) {
                                    objCallBack(objResponse);
                                    NProgress.done();
                                }
                            });
                        }
                    </script>
                ';
                return $strJS;
            }
            
            return FALSE;
        }
        
//        BEGIN FILEUPLOAD
        final protected function initUpload($rowInit) {
            $this->_objFile = $rowInit['FILE'];
            $this->_strFilePath = $rowInit['PATH'];
            $this->_strFileName = $rowInit['NAME'];
            $this->_rowFileExtension = $rowInit['EXT'];
            $this->_numFileSize = ($rowInit['SIZE'] ? $rowInit['SIZE'] : 1000000);
        }

        final protected function uploadFile() {
            
        }
        
    }

?>