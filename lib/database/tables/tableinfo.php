<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tableinfo
 *
 * @author david
 */
class TableInfo extends MySQL {
    
    private $Tables = null;
    
    private $Table = null;
    
    private $Database = null;
    
    private $Fields = null;
    
    private $PrimaryKeyName = null;
    
    private $RowData = null;
    
    private $UpdateQuery = null;
    
    public function __construct( $table , $database = false ) {
    
        $this->Table = $table;
        $this->Database = ( $database ) ? $database : self::getDbName();
        
        if( self::IsConnected() )
        {
            
            $this->getTables();
            
            
        }
    }
    
    
    public function getPrimaryKeyName()
    {
        return $this->PrimaryKeyName;
    }
    
    public function getTables()
    {
            
        if( $this->Tables != null )
        {
            return $this->Tables;
        }

         $query = self::query("show tables in " . self::getDbName());

         if( $query )
         {
             $rows = array();

             while( $row = mysql_fetch_array( $query ) )
             {
                 $rows[] = $row[0];
             }

             self::storeTable( $this->Database , $rows);
             $this->Tables = $rows;
             return $rows;
         }
         return null;
    }
    
    
    public function getFields( $table = false )
    {
        

        
        $sql_table = $this->Table;
        
        if( $table )
        {
            $sql_table = $table;
        }
        
        $query = self::query( "show columns in $sql_table" );
        
        if( $query )
        {
            
            $rows = array();
            
            while( $row = mysql_fetch_object( $query ) )
            {
                if( $row->Key == "PRI" )
                {
                    $this->PrimaryKeyName = $row->Field;
                    $row->UpdateText = $this->PrimaryKeyName . "=@".strtoupper( $row->Field )."";
                }
                
                if( preg_match( "{int}" , $row->Type ) )
                {
                    $row->UpdateText = $row->Field . "=@".strtoupper( $row->Field ).""; 
                    $row->InsertText = "@" . strtoupper( $row->Field );
                }
                else if( preg_match( "{varchar|text|date|time}" , $row->Type ) )
                {
                    $row->UpdateText = $row->Field . "='@".strtoupper( $row->Field )."'"; 
                    $row->InsertText = "'@" . strtoupper( $row->Field ) . "'";
                }
                else
                {
                    $row->UpdateText = $row->Field . "='@".strtoupper( $row->Field )."'"; 
                    $row->InsertText = "'@" . strtoupper( $row->Field ) . "'";
                }
                
                $rows[] = $row;
            }
            
            $rows[ 'TableName' ] = $sql_table;
            $this->Fields = $rows;
            return $rows;
        }
    }
    
    
    public function getQueryData()
    {
        
        $primary_key_text = null;
        
        $fields = $this->getFields();
        
        $tbl_name = $fields['TableName'];
        unset( $fields['TableName'] );
        
        $update_sql = "update " . $tbl_name . " set ";
        $insert_sql = "insert into " . $tbl_name . " values( ";
        $select_sql = " select * from " . $tbl_name . " where ";
        
        $x = count( $fields );
        foreach( $fields as $key => $value )
        {
            
            if( is_object( $value ) && $value->Field != $this->PrimaryKeyName )
            {
                
                $update_sql .= $value->UpdateText;
                $insert_sql .= $value->InsertText;
                if( $x > 1 )
                {
                    $update_sql .= ", ";
                    $insert_sql .= ",";
                }
                
                
            }
            else
            {
                if( $value->Key == "PRI" )
                {
                    $insert_sql .= "'',";
                    $primary_key_text = $value->UpdateText;
                    $select_sql .= $value->UpdateText;
                }
            }
            
            $x--;
        }
        
        $delete_sql = "delete from " . $tbl_name . " where " . $primary_key_text;
        $update_sql .= " where " . $primary_key_text;
        $insert_sql .= ")";
        
        //echo $delete_sql . "<br>";
        //echo $insert_sql . "<br>";
        //echo $update_sql . "<br>";
        
        $std = new stdClass();
        $std->delete_sql = $delete_sql;
        $std->update_sql = $update_sql;
        $std->insert_sql = $insert_sql;
        $std->select_sql = $select_sql;
        
        return $std;
        
        
    }
    
}

?>
