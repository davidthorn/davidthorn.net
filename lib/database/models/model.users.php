<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author david
 */

require_once TABLES_DIR . 'table.users.php';

class ModelUsers extends Model {
   
    
    public static function login( $username , $password )
    {
        
        $username = addslashes($username);
        
        $sql = "select * from users where username='$username'";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            if( mysql_num_rows( $query ) == 1 )
            {
                
                $row = mysql_fetch_object($query);
                
                $user = new TableUsersObject( $row );
                
                if( $user->get('password') == md5( $password ) )
                {
                    date_default_timezone_set("Europe/Berlin");
                    $session_id = session_id();
                    $date = date("Y-n-d H:i:s");
                    $id = $user->get('id');
                    $ipaddr = getenv('REMOTE_ADDR');
                    
                    $update = mysql_query( "update users set last_logged_in='$date' , session_id='$session_id', ipaddr='$ipaddr' where id=$id" );
                    
                    if( $update )
                    {
                        $user->session = $session_id;
                        $user->last_logged_in = $date;
                        
                        setcookie('admin', $session_id, time() + 3600 * 7, "/", ".davidthorn.net", 0); 
                        
                        header('location: /profile');
                    }
                    
                }
                
                
            }
            
        }
        
    }
    
}

?>
