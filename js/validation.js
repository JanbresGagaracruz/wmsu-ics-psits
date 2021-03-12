$(document).ready(function(){
        $("#email").blur(function(){
        var email = $("#email").val();
        if(email == "")
        {
            $('#availability').html("");
            $("#register").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/request.php",
            method: "POST",
            data:
            {
                email_add:email
            },
            datatype: "text",
            success:function(html){
                $('#availability').html(html);
            }
        });   
        }                           
    });

    $("#student_id").blur(function(){
        var student_id = $("#student_id").val();
        if(student_id == "")
        {
            $('#student_validation').html("");
            $("#register").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/request.php",
            method: "POST",
            data:
            {
                student_id:student_id
            },
            datatype: "text",
            success:function(html){
                $('#student_validation').html(html);
            }
        });   
        }                           
    });
});


$(document).ready(function() {
    $("#reg").validate({
      rules: {
        student_id : {
          minlength: 11
        },
        password : {
            minlength: 8
          }
      },
      messages : {
        student_id: {
          minlength: "Student id should be at least 11 characters"
        },
        email: {
            email: "The email format should be in: abc@domain.com"
        },
        password: {
            email: "Password should be at least 8 characters."
        }
      }
    });
});