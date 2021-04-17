$(document).ready(function(){  
    $('.get_data').click(function(){  
         var id = $(this).attr("id");  
         $.ajax({  
              url:"../include/create_withdraw.php",  
              method:"post",  
              data:{id:id},  
              success:function(data){  
                   $('#withdraw_detail').html(data);  
                   $('#withdraw_modal_details').modal("show");  
              }  
         });  
    });  
}); 