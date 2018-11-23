<?php
define('DS' , DIRECTORY_SEPARATOR);
define( 'DOC_ROOT' , $_SERVER['DOCUMENT_ROOT'] . DS );
define('LIB_ROOT' , DOC_ROOT . 'lib' . DS );
define('LOG_ROOT' , LIB_ROOT . 'log' . DS );


define("TEMPLATES_DIR" , DOC_ROOT . 'templates' . DS );
define('DATABASE_DIR' , LIB_ROOT . 'database' . DS );
define('CONTENT_DIR' , DOC_ROOT . 'content' . DS );
define('MODULES_DIR' , DOC_ROOT . 'modules' . DS );
define('TABLES_DIR' , DATABASE_DIR . 'tables' . DS );
define('MODELS_DIR' , DATABASE_DIR . 'models' . DS );
?>
