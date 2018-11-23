
<?php



require_once "defines.php";

require_once LOG_ROOT . "logger.php";

Logger::setDebugFile('debug01.log');

require_once "mysql_connect.php";




require_once LIB_ROOT  . 'application' . DS  . 'application.php';

require_once LIB_ROOT  . 'mvc' . DS  . 'contentloader.php';
require_once LIB_ROOT  . 'mvc' . DS  . 'controller.php';
require_once LIB_ROOT  . 'mvc' . DS  . 'view.php';
require_once LIB_ROOT  . 'mvc' . DS  . 'model.php';
require_once "modules.php";

require_once LIB_ROOT . 'site' . DS . 'site.php';


require_once MODELS_DIR . "model.pages.php";





?>
