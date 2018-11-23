<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysql
 *
 * @author david
 */#


require_once TABLES_DIR  . 'tableinfo.php';

class MySQL {
    
    private static $Tables = array();
    
    
    private static $Host = null;
    private static $Username = null;
    private static $Password = null;
    private static $Database = null;
    
    private static $Connection = null;
    private static $_isConnected = false;
    
    
    private static $Databases = null;
    
    private static $query = null;
    
    private static $NumRows = null;
    
    public static function connect( $host , $username , $password , $database = null )
    {
        
        self::$Host = $host;
        self::$Username = $username;
        self::$Password = $password;
        
        if( $database != null )
        {
            self::select_db($database);
        }
        
        
        if( self::$Host && self::$Username && self::$Password )
        {
            $con = mysql_connect( self::$Host , self::$Username , self::$Password ) or die( "There was an error connectiing to the database" );
            
            if( $con )
            {
                self::$Connection =& $con;
                self::$_isConnected = true;
                
                
                
            }
        }
    }
    
    public static function IsConnected()
    {
        return self::$_isConnected;
    }
    
    
    public static function list_dbs()
    {
        
        if( !self::$_isConnected )
        {
            throw new Exception("You must be connected to the mysql server to make a query");
        }
        
        $sql = "show databases";
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            $dbs = array();
            while( $row = mysql_fetch_array( $query ) )
            {
                $dbs[] = $row[0];
            }
            
            self::$Databases = $dbs;
        }
        
        return self::$Databases;
        
    }
    
    public static function select_db( $database )
    {
        if( self::$Database == null )
        {
            
            if( !isset( $_SESSION['Config'] ) )
            {
                
                self::list_dbs();
                    
                if( in_array( $database , self::$Databases ) )
                {
                    
                    $_SESSION['Config']['db_connected'] = 1;
                    $_SESSION['Config']['db_name'] = md5( $database );
                    self::$Database = $database;
                    mysql_select_db( self::$Database );
                }
                else
                {
                    throw new Exception( "The Database provided is not valid" );
                }
            }
            else
            {
                
                if( $_SESSION['Config']['db_name'] != md5( $database ) )
                {
                    self::list_dbs();
                    
                    if( in_array( self::$Database , self::$Databases ) )
                    {
                        mysql_select_db( self::$Database );
                    }
                    else
                    {
                        throw new Exception( "The Database provided is not valid" );
                    }
                }
                else
                {
                    self::$Database = $database;
                    mysql_select_db( self::$Database );
                }
            }
            
        }
    }
    
    public static function query( $sql )
    {

        
       
        
        if( self::IsConnected() )
        {
            $query = mysql_query( $sql );
            
            
            if( $query )
            {
                self::$query = $query;
                if( preg_match( "{insert}" , $sql ) )
                {
                    
                }
                else
                {
                    self::$NumRows = mysql_num_rows( $query );
                }
                
                
                return self::$query;
            }
            else
            {
                echo "Not Query: " . $sql . "<br>";
            }
        }

    }
    
    public static function getDbName()
    {
        return self::$Database;
    }
    
    protected static function storeTable( $db_name , $table_names_array )
    {
        
        if( !array_key_exists( $db_name , self::$Tables ) )
        {
            self::$Tables[ $db_name ] =& $table_names_array;
        }
        
    }
    
    
    public static function insert( &$obj , $table_name )
    {
        
       $table_info = new TableInfo( $table_name , self::getDbName() );
        
        $sql_data = $table_info->getQueryData();
        
        
        $pri = $table_info->getPrimaryKeyName();
        
        foreach( $obj as $key => $value )
        {
            $exp = "{@" . strtoupper( $key ) . "}"; 
            if( preg_match( $exp , $sql_data->insert_sql ) ) 
            {

                if( property_exists( $obj , $key ) )
                {
                    $value = $obj->$key;
                }

                $sql_data->insert_sql = str_replace("@" . strtoupper( $key ) , $value , $sql_data->insert_sql );
            }

        }
        
        
        $query = self::query( $sql_data->insert_sql );
        
        if( $query )
        {
            $obj->id = mysql_insert_id();
           
            return mysql_insert_id(  );
        }
        else
        {
            return false;
        }
        
    }
    
    
    public static function update( &$obj , $table_name , $primary_key )
    {
        $table_info = new TableInfo( $table_name , self::getDbName() );
        
        $sql_data = $table_info->getQueryData();
        
        
        
        $pri = $table_info->getPrimaryKeyName();
        
        if( property_exists( $obj , $pri ) )
        {
            
            $query = self::query( str_replace( "@" . strtoupper( $pri ) , $obj->$pri ,  $sql_data->select_sql ) );
            
            if( $query )
            {
                
                if( self::$NumRows == 1 )
                {
                    
                    $row = mysql_fetch_object( $query );
                    
                    foreach( $row as $key => $value )
                    {
                        $exp = "{@" . strtoupper( $key ) . "}"; 
                        if( preg_match( $exp , $sql_data->update_sql ) ) 
                        {
                            
                            if( property_exists( $obj , $key ) )
                            {
                                $value = $obj->$key;
                            }
                            
                            if( $key == "params" )
                            {
                                if( $value instanceof ParamsObject )
                                {
                                    $value = $value->encode();
                                }
                                
                            }
                            
                            $sql_data->update_sql = str_replace("@" . strtoupper( $key ) , $value , $sql_data->update_sql );
                        }
                        
                    }
                     
                    
                    echo $sql_data->update_sql . "<br><br>";
                    $update = mysql_query( $sql_data->update_sql );
                    
                    if( $update )
                    {
                        return true;
                    }
                    
                }
            }
            
            
        }
        
        return false;
        
        
    }
    
    
    public static function delete( $id , $table_name , $pri )
    {
        
        
        $query = self::query("delete from " . $table_name . " where $pri=" . $id);
        
        if( $query )
        {
            
            return true;
            
        }
        
        return false;
        
        
    }
    
    
    public static function getRow( $class_name = 'stdClass' )
    {
       
        if( $class_name != 'stdClass' )
        {
            if( !class_exists( $class_name ) )
            {
                throw new Exception("The class provided does not exists, please load the class prior to calling getRows");
            }
        }
        
        if( self::$query )
        {
           
           if( self::getNumRows() == 1 )
           {
                
               
               
               $row = mysql_fetch_object( self::$query );
               
               return new $class_name( $row );
           }
            
            
        }
        
        return null;
        
    }
    
    public static function getRows( $class_name = 'stdClass' )
    {
       
        if( $class_name != 'stdClass' )
        {
            if( !class_exists( $class_name ) )
            {
                throw new Exception("The class provided does not exists, please load the class prior to calling getRows");
            }
        }
        
        if( self::$query )
        {
           
           if( self::getNumRows() > 0 )
           {
                
               $rows = array();
               
               while( $row = mysql_fetch_object( self::$query ) )
               {
                   
                   $rows[ $row->id ] = new $class_name( $row );
               }
               
               return $rows;
           }
            
            
        }
        
        return null;
        
    }
    
    public static function getNumRows()
    {
        
        if( self::$query )
        {
            
            return mysql_num_rows( self::$query );
        }
        
        return -1;
    }
    
    public static function close()
    {
        
        mysql_close( self::$Connection );
        
    }
    
    
    
    
}

?>
