<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of toolbar
 *
 * @author david
 */
class ToolBar {
    
    
    private static $Active = true;
    
    private static $Title = null;
    
    private static $Buttons = array();
    
    //IsActive will indicate if the ToolBar has been activate, otherwise it will be ignored
    public static function IsActive()
    {
        return self::$Active;
    }
    
    public static function title( $title )
    {
        self::$Title = $title;
    }
    
    public static function getTitle()
    {
        return self::$Title;
    }
    
    public static function AddNew( $task_name , $button_text  )
    {
        
        $button = new ToolBarButtonObject();
        $button->Text = $button_text;
        $button->Task = $task_name;
        $button->Image = "icon-32-new";
        
        self::$Buttons[] = $button;
        self::$Active = true;
        
    }
    
    public static function Apply( $task_name , $button_text  )
    {
        
        $button = new ToolBarButtonObject();
        $button->Text = $button_text;
        $button->Task = $task_name;
        $button->Image = "icon-32-apply";
        
        self::$Buttons[] = $button;
        self::$Active = true;
    }
    
    public static function Save( $task_name , $button_text  )
    {
        
        $button = new ToolBarButtonObject();
        $button->Text = $button_text;
        $button->Task = $task_name;
        $button->Image = "icon-32-save";
        
        self::$Buttons[] = $button;
        self::$Active = true;
    }
    
    public static function Close( $task_name , $button_text  )
    {
        
        $button = new ToolBarButtonObject();
        $button->Text = $button_text;
        $button->Task = $task_name;
        $button->Image = "icon-32-close";
        
        self::$Buttons[] = $button;
        self::$Active = true;
    }
    
    public static function Delete( $task_name , $button_text  )
    {
        
        $button = new ToolBarButtonObject();
        $button->Text = $button_text;
        $button->Task = $task_name;
        $button->Image = "icon-32-delete";
        
        self::$Buttons[] = $button;
        self::$Active = true;
    }
    
    public static function render()
    {
        $buttons = "";
        if( count( self::$Buttons ) > 0 )
        {
            
            $buttons .= '<ul class="toolbar_wrapper">';
            foreach( self::$Buttons as $key => $button )
            {
                $buttons .= '<li onclick="javascript: SubmitButton(\''.$button->Task.'\');" class="toolbar_button">
                                    <div class="toolbar_img '.$button->Image.'"></div>
                                    <div class="toolbar_text">'.$button->Text.'</div>
                             </li>';
            }
            $buttons .= '</ul>';
            
        }
        
        
        return $buttons;
    }
    
}


class ToolBarButtonObject
{
    public $Text = null;
    public $Image = null;
    public $Task = null;
}



?>
