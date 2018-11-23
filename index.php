<?php 
//die();
if( !isset( $_COOKIE['admin'] ) )
{
    //die( "You do not have permission to view this page" );
}

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/loader.php";


ContentLoader::setGetVariables();




Logger::debug('Setting POST task test');


$active = ModelPages::getActive();


ContentLoader::initialise($active);


if( !ContentLoader::check_ajax() )
{
    $template =&  ContentLoader::render(); 
    echo $template."hi";
}









?>
