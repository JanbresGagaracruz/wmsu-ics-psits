(function ($) {
    "use strict";
    var mainApp = {

        metisMenu: function () {
            $('#main-menu').metisMenu();
        },
        loadMenu: function () {
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        },
    };
    $(document).ready(function () {
        mainApp.metisMenu();
        mainApp.loadMenu();
    });
}(jQuery));