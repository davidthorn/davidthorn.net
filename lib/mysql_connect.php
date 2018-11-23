<?php

require_once DATABASE_DIR  . 'mysql.php';


MySQL::connect("localhost", "david", "TFD_@221278");



if( MySQL::IsConnected() )
{
    MySQL::select_db("db_davidthorn");
   
    //MySQL::update($row, 'users', 'id');
    
}
else
{
    echo "not connected";
}


?>
