
$( document ).ready( function(){
    
    
    getViews();
    getTmpls();
    
} );

var views;

function getViews()
{
  $( '#page_type' ).change( function(){

        $.post( "/ajax/" , 
        {
            task : "getViews",
            page_type : $('#page_type').val()
        } , function(data){ 

            views = jQuery.parseJSON( data );
            $('#views_holder').html("");
            var x = 0;
            for( var i in views['views']  )
            {
                if( x == 0 )
                {
                   setTmpls( i );
                   
                }
                var f = i.charAt(0).toUpperCase();
                var view_name = f + i.substr(1);
                $('#views_holder').append( "<option value='"+i+"'>" + view_name + "</option>\n" );
            }

        } );

    });
}


function setTmpls( view_name )
{
    
    $('#tmpl_holder').html("");
    
    
    for( var g in views['views'][view_name] )
     {
         $('#tmpl_holder').append( "<option value='"+views['views'][view_name][g].toLowerCase()+"'>" + views['views'][view_name][g] + "</option>\n");
     }
    
}

function getTmpls()
{
  $( '#views_holder' ).change( function(){

        var view_name = $('#views_holder').val();
        
        setTmpls( view_name );

    });
}

