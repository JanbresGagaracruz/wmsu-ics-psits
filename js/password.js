$(document).ready(function() {
    $("#pass a").on('click', function(event) {
        event.preventDefault();
        if($('#pass input').attr("type") == "text"){
            $('#pass input').attr('type', 'password');
            $('#pass i').addClass( "fa-eye-slash" );
            $('#pass i').removeClass( "fa-eye" );
        }else if($('#pass input').attr("type") == "password"){
            $('#pass input').attr('type', 'text');
            $('#pass i').removeClass( "fa-eye-slash" );
            $('#pass i').addClass( "fa-eye" );
        }
    });
});