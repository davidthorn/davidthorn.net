<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logger
 *
 * @author david
 */
class Logger {
    
    
    private static $Logs = array();
    
    private static $Errors = array();
    
    private static $FileName = null;
    
    public static function setDebugFile( $filename )
    {
            self::$FileName = $filename;
    }
    
    public static function debug( $msg , $file_name = false )
    {
        
        if( self::$FileName == null && $file_name )
        {
            self::$FileName = $file_name;
        }
        
        
        self::$Logs[] = "Msg: " . $msg . " | " . self::$FileName . "\r\n";
        
    }
    
    public static function error( $msg , $filename = false )
    {
        if( self::$FileName == null && $file_name )
        {
            self::$FileName = $file_name;
        }
        else
        {
           echo "NO FILENAME HAS BEEN GIVEN FOR THE DEBUG FILE<BR>";
        }
        self::$Errors[] = "Error: " . $msg . " | " . self::$FileName . "\r\n";
        
    }
    
    public static function write(  )
    {
        
        $fp = fopen( LOG_ROOT . 'debug'. DS . self::$FileName , "w" );
        
        foreach( self::$Logs as $value )
        {
            fwrite( $fp , $value );
        }
        
        fclose($fp);
         
        
        $fp = fopen( LOG_ROOT . 'error'. DS . self::$FileName , "w" );
        
        foreach( self::$Errors as $value )
        {
            fwrite( $fp , $value );
        }
        
        fclose($fp);
        
    }
    
}

?>
