$(document).ready( function(){
    
    
    $('.status_ok').each( function(){
        
        var box = this;
        
        $( box ).click( function(){
            
            $('#source_element').val( this.id );
            $('#task').val( "update_status" );
            
            SubmitButton( 'update_status' );
        
        } );
        
    } );
    
    $('.status_off').each( function(){
        
        var box = this;
        
        $( box ).click( function(){
            
            $('#source_element').val( this.id );
            $('#task').val( "update_status" );
            
            SubmitButton( 'update_status' );
        
        } );
        
    } );
    
} );




