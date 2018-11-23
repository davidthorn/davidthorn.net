$(document).ready( function(){
    
    
    $('.up_arrow').each( function(){
        
        var box = this;
        
        $( box ).click( function(){
            
            var info = box.id.split(':');
            
            $('#source_element').val( info[0] );
            $('#target_placement').val( info[1] );
            $('#movement_direction').val( info[2] );
            $('#task').val( info[2] );
            
            SubmitButton( info[2] );
        
        } );
        
    } );
    
    $('.down_arrow').each( function(){
        
        var box = this;
        
        $( box ).click( function(){
            
            var info = box.id.split(':');
            
            $('#source_element').val( info[0] );
            $('#target_placement').val( info[1] );
            $('#movement_direction').val( info[2] );
            $('#task').val( info[2] );
            
            SubmitButton( info[2] );
        
        } );
        
    } );
    
} );




