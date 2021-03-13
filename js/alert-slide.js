//alert danger for login
$(document).ready(function () {
    window.setTimeout(function() {
    $(".alert-danger").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
    }, 1000);
});
//alert success for registration
$(document).ready(function () {
    window.setTimeout(function() {
    $(".alert-success").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
    }, 4000);
});