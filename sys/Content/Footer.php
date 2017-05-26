                </div>
        <!-- /page content -->
        
        <div
            class="modal fade bs-example-modal-lg confirm-modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
            style="z-index: 11264;"
        >
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Confirm</h4>
                        </div>
                        <div class="modal-body confirm-conten text-center"></div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary accept-confirm">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if($_SESSION['admin_user']) {
        ?>
        <!-- footer content -->
        <footer>
            test
        </footer>
        <!-- /footer content -->
        <?php
        }
        ?>
            </div>
        </div>
    </body>
<!--</main>-->
    
    <?=Init::getScript("jquery.min.js", "assets/vendors/jquery/dist/")?>
    <?=Init::getScript("bootstrap.min.js", "assets/vendors/bootstrap/dist/js/")?>
    <?=Init::getScript("nprogress.js", "assets/vendors/nprogress/")?>
    <?=Init::getScript("bootstrap-progressbar.min.js", "assets/vendors/bootstrap-progressbar/")?>
    

<!-- Datatables -->
    <?=Init::getScript("jquery.dataTables.min.js", "assets/vendors/datatables.net/js/")?>
    <?=Init::getScript("dataTables.bootstrap.min.js", "assets/vendors/datatables.net-bs/js/")?>
    <?=Init::getScript("dataTables.buttons.min.js", "assets/vendors/datatables.net-buttons/js/")?>
    <?=Init::getScript("buttons.bootstrap.min.js", "assets/vendors/datatables.net-buttons-bs/js/")?>
    
    <!-- PNotify -->
    <?=Init::getScript("pnotify.js", "assets/vendors/pnotify/dist/")?>
    <?=Init::getScript("pnotify.buttons.js", "assets/vendors/pnotify/dist/")?>
    <?=Init::getScript("pnotify.nonblock.js", "assets/vendors/pnotify/dist/")?>
    
    <!--confirm-->
    <?=Init::getScript("bootbox.js", "assets/vendors/bootbox/")?>
    
    <?=Init::getScript("scope.js")?>
    <?=Init::getScript("custom.js")?>
    <?=Init::getScript("{$strPage}.js")?>
    
</html>