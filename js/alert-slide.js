//alert danger message
$(document).ready(function () {
    window.setTimeout(function() {
    $(".alert-danger").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
    }, 4000);
});
//alert success message
$(document).ready(function () {
    window.setTimeout(function() {
    $(".alert-success").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
    }, 4000);
});
