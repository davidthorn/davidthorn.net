
$( document ).ready( function(){

    $( ".holder" ).each( function(){
    
      
          var id = this.id;
          $( '#' + id ).click( function() {
            alert( "this color is " + id );
          });
          
    
    } );


} );
