<?php $active = ModelPages::getActive(); ?>
<!DOCTYPE html>
<html>
    <head>
        <base href="http://www.davidthorn.local"/>
        <title><?php echo Site::getTitle(); ?></title>
        <script type="text/javascript" src="/templates/main/js/jquery.js"></script>
        <?php echo Site::getHead(); ?>
        <link href="/templates/main/css/layout.css" rel="stylesheet"/>
        <script type="text/javascript" src="/templates/main/js/script.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
              <?php require_once "includes/header_content.php"; ?>  
            </div>
            
            <div class="navbar">
                <?php echo Modules::renderModules('main_navbar'); ?>
            </div>
            
            <div class="body_wrapper">
                <div class="left_box">
                    <?php echo Modules::renderModules('leftbox'); ?>
                </div>

                <div class="mainbody">
                    
                    <div class="maincontent">
                        ###__CONTENT__###
                        <script type="text/javascript"><!--
google_ad_client = "ca-pub-8418077094128395";
/* Test Ad */
google_ad_slot = "7939059041";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?
Logger::write();
MySQL::close();
?>

