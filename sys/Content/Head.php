<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <link rel="icon" href="<?=$APP_CONF['base_url']?>assets/page/images/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?=$APP_CONF['base_url']?>assets/page/images/favicon.ico" type="image/x-icon"/>

    <title><?php print $strPage; ?></title>

    <?=Init::getScript("bootstrap.min.css", "assets/vendors/bootstrap/dist/css/")?>
    <?=Init::getScript("font-awesome.min.css", "assets/vendors/font-awesome/css/")?>
    <?=Init::getScript("nprogress.css", "assets/vendors/nprogress/")?>
    <?=Init::getScript("green.css", "assets/vendors/iCheck/skins/flat/")?>
    <?=Init::getScript("bootstrap-progressbar-3.3.4.min.css", "assets/vendors/bootstrap-progressbar/css/")?>
    <?=Init::getScript("jqvmap.min.css", "assets/vendors/jqvmap/dist/")?>
    <?=Init::getScript("daterangepicker.css", "assets/vendors/bootstrap-daterangepicker/")?>
    
    <!-- Datatables -->
    <?=Init::getScript("dataTables.bootstrap.min.css", "assets/vendors/datatables.net-bs/css/")?>
    <?=Init::getScript("buttons.bootstrap.min.css", "assets/vendors/datatables.net-buttons-bs/css/")?>
    <?=Init::getScript("fixedHeader.bootstrap.min.css", "assets/vendors/datatables.net-fixedheader-bs/css/")?>
    <?=Init::getScript("responsive.bootstrap.min.css", "assets/vendors/datatables.net-responsive-bs/css/")?>
    <?=Init::getScript("scroller.bootstrap.min.css", "assets/vendors/datatables.net-scroller-bs/css/")?>
    
    <!-- PNotify -->
    <?=Init::getScript("pnotify.css", "assets/vendors/pnotify/dist/")?>
    <?=Init::getScript("pnotify.buttons.css", "assets/vendors/pnotify/dist/")?>
    <?=Init::getScript("pnotify.nonblock.css", "assets/vendors/pnotify/dist/")?>
    
    <!-- Custom Theme Style -->
    <?=Init::getScript("main.css")?>
    
    
    <script type="text/javascript">
        var base_url = '<?=$ADM['base_url']?>';
        var rowUrl = JSON.parse('<?php print json_encode($rowUrl); ?>');
        var isTestServer = <?php print ($ENV['env'] != 'prod' ? "true;" : "false;"); ?>
    </script>
  </head>