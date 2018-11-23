
$( document ).ready( function(){
    
    var aw_w = $('.adminform_wrapper').width();
    $('.adminTable').css( "width" , (aw_w - 20) + "px" );
    
} );

function SubmitButton( task )
{
    
    document.getElementById('task').value = task;
    document.forms[0].submit();
    return false;
    
}

