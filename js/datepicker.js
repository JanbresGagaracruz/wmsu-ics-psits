$('.input-daterange input').each(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy'});
    $(this).datepicker('clearDates');
}); 