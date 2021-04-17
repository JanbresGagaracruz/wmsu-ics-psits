$(document).ready(function(){  
    $('.view_data').click(function(){  
         var id = $(this).attr("id");  
         $.ajax({  
              url:"../include/view_user.php",  
              method:"post",  
              data:{id:id},  
              success:function(data){  
                   $('#student_detail').html(data);  
                   $('#user_detail').modal("show");  
              }  
         });  
    });  
});
 