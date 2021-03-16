//Check the availability of email
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
    //Check the availability of student id
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
                semester_id:semester
            },
            datatype: "text",
            success:function(html){
                $('#student_validation').html(html);
            }
        });   
        }                           
    });
    //Check the availability of course id
    $("#course").blur(function(){
        var course_id = $("#course").val();
        if(course_id == "")
        {
            $('#course_validation').html("");
            $("#create").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/create_course.php",
            method: "POST",
            data:
            {
                course_check:course_id
            },
            datatype: "text",
            success:function(html){
                $('#course_validation').html(html);
            }
        });   
        }                           
    });
    //Check the availability of semester id
    $("#semester").blur(function(){
        var semester_id = $("#semester").val();
        if(semester_id == "")
        {
            $('#semester_validation').html("");
            $("#create").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/create_sem.php",
            method: "POST",
            data:
            {
                course_check:course_id
            },
            datatype: "text",
            success:function(html){
                $('#semester_validation').html(html);
            }
        });   
        }                           
    });
    //Check the availability of year level id
    $("#year_lvl").blur(function(){
        var year_id = $("#year_lvl").val();
        if(year_id == "")
        {
            $('#yearlvl_validation').html("");
            $("#create").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/create_yearlvl.php",
            method: "POST",
            data:
            {
                year_id:year_lvl
            },
            datatype: "text",
            success:function(html){
                $('#yearlvl_validation').html(html);
            }
        });   
        }                           
    });
    //Check the availability of year school year
    $("#current","#end").blur(function(){
        var current_year = $("#current").val();
        var end_year = $("#end").val();
        if(current_year == "")
        {
            $('#school_validation').html("");
            $("#save").prop('disabled', false);
        }else{
        $.ajax({
            url:"../include/create_year.php",
            method: "POST",
            data:
            {
                year_id:year_lvl
            },
            datatype: "text",
            success:function(html){
                $('#school_validation').html(html);
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