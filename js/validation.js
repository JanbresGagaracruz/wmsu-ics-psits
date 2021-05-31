//Check the availability of email
$(document).ready(function () {
  $("#email").blur(function () {
    var email = $("#email").val();
    if (email == "") {
      $("#availability").html("");
      $("#register").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/request.php",
        method: "POST",
        data: {
          email_add: email,
        },
        datatype: "text",
        success: function (html) {
          $("#availability").html(html);
        },
      });
    }
  });
  //Check the availability of student id
  $("#student_id").blur(function () {
    var student_id = $("#student_id").val();
    if (student_id == "") {
      $("#student_validation").html("");
      $("#register").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/request.php",
        method: "POST",
        data: {
          student_id: student_id,
        },
        datatype: "text",
        success: function (html) {
          $("#student_validation").html(html);
        },
      });
    }
  });
  //Check the availability of course id
  $("#course").blur(function () {
    var course_id = $("#course").val();
    if (course_id == "") {
      $("#course_validation").html("");
      $("#create").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_course.php",
        method: "POST",
        data: {
          course_check: course_id,
        },
        datatype: "text",
        success: function (html) {
          $("#course_validation").html(html);
        },
      });
    }
  });

  $("#edit_course").blur(function () {
    var edit_course = $("#edit_course").val();
    if (edit_course == "") {
      $("#edit_course_validation").html("");
      $("#Update").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_course.php",
        method: "POST",
        data: {
          edit_course: edit_course,
        },
        datatype: "text",
        success: function (html) {
          $("#edit_course_validation").html(html);
        },
      });
    }
  });
  //Check the availability of semester id
  $("#semester").blur(function () {
    var semester = $("#semester").val();
    if (semester == "") {
      $("#semester_validation").html("");
      $("#create").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_sem.php",
        method: "POST",
        data: {
          semester: semester,
        },
        datatype: "text",
        success: function (html) {
          $("#semester_validation").html(html);
        },
      });
    }
  });
  $("#edit_semester").blur(function () {
    var edit_semester = $("#edit_semester").val();
    if (edit_semester == "") {
      $("#edit_semester_validation").html("");
      $("#Update").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_sem.php",
        method: "POST",
        data: {
          edit_semester: edit_semester,
        },
        datatype: "text",
        success: function (html) {
          $("#edit_semester_validation").html(html);
        },
      });
    }
  });
  //Check the availability of year level id
  $("#year_lvl").blur(function () {
    var year_lvl = $("#year_lvl").val();
    if (year_lvl == "") {
      $("#yearlvl_validation").html("");
      $("#create").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_yearlvl.php",
        method: "POST",
        data: {
          year_lvl: year_lvl
        },
        datatype: "text",
        success: function (html) {
          $("#yearlvl_validation").html(html);
        },
      });
    }
  });
  $("#edit_year_lvl").blur(function () {
    var edit_year_lvl = $("#edit_year_lvl").val();
    if (edit_year_lvl == "") {
      $("#edit_yearlvl_validation").html("");
      $("#Update").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_yearlvl.php",
        method: "POST",
        data: {
          edit_year_lvl: edit_year_lvl
        },
        datatype: "text",
        success: function (html) {
          $("#edit_yearlvl_validation").html(html);
        },
      });
    }
  });
  //Check the availability of section id
  $("#section").blur(function () {
    var section = $("#section").val();
    if (section == "") {
      $("#section_validation").html("");
      $("#create").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_section.php",
        method: "POST",
        data: {
          section: section,
        },
        datatype: "text",
        success: function (html) {
          $("#section_validation").html(html);
        },
      });
    }
  });
  $("#edit_section").blur(function () {
    var edit_section = $("#edit_section").val();
    if (edit_section == "") {
      $("#edit_section_validation").html("");
      $("#Update").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_section.php",
        method: "POST",
        data: {
          edit_section: edit_section,
        },
        datatype: "text",
        success: function (html) {
          $("#edit_section_validation").html(html);
        },
      });
    }
  });
  //Check the availability of year school year
  $("#current", "#end").blur(function () {
    var current_year = $("#current").val();
    var end_year = $("#end").val();
    if (current_year == "") {
      $("#school_validation").html("");
      $("#save").prop("disabled", false);
    } else {
      $.ajax({
        url: "../include/create_year.php",
        method: "POST",
        data: {
          year_id: year_lvl,
        },
        datatype: "text",
        success: function (html) {
          $("#school_validation").html(html);
        },
      });
    }
  });
});
//Check the availability of file name
$("#name").blur(function () {
  var name = $("#name").val();
  if (name == "") {
    $("#title_validation").html("");
    $("#submit").prop("disabled", false);
  } else {
    $.ajax({
      url: "../include/submit_file.php",
      method: "POST",
      data: {
        name: name,
      },
      datatype: "text",
      success: function (html) {
        $("#title_validation").html(html);
      },
    });
  }
});
//Check the availability of fee name
$("#fee_name").blur(function () {
  var fee_name = $("#fee_name").val();
  if (fee_name == "") {
    $("#fee_validation").html("");
    $("#create_local").prop("disabled", false);
  } else {
    $.ajax({
      url: "../include/create_fees.php",
      method: "POST",
      data: {
        fee_name: fee_name,
      },
      datatype: "text",
      success: function (html) {
        $("#fee_validation").html(html);
      },
    });
  }
});
//Check the availability of edit fee name
$("#edit_fee_name").blur(function () {
  var edit_fee_name = $("#edit_fee_name").val();
  if (edit_fee_name == "") {
    $("#edit_fee_validation").html("");
    $("#Update").prop("disabled", false);
  } else {
    $.ajax({
      url: "../include/create_fees.php",
      method: "POST",
      data: {
        edit_fee_name: edit_fee_name,
      },
      datatype: "text",
      success: function (html) {
        $("#edit_fee_validation").html(html);
      },
    });
  }
});

//registration restriction input
$(document).ready(function () {
  $("#reg").validate({
    rules: {
      student_id: {
        minlength: 11,
      },
      first_name: {
        minlength: 2,
        maxlength: 20,
      },
      last_name: {
        minlength: 2,
        maxlength: 20,
      },
      middle_name: {
        minlength: 2,
        maxlength: 20,
      },
      password: {
        minlength: 8,
        maxlength: 30,
      },
    },
    messages: {
      student_id: {
        minlength: "Student id should be at least 11 characters.",
      },
      first_name: {
        minlength: "First name should be at least 3 characters.",
        maxlength: "First name maximum character is 20.",
      },
      last_name: {
        minlength: "Last name should be at least 3 characters.",
        maxlength: "Last name maximum character is 20.",
      },
      middle_name: {
        minlength: "Middle name should be at least 3 characters.",
        maxlength: "Middle name maximum character is 20.",
      },
      email: {
        email: "The email format should be in: abc@domain.com.",
      },
      password: {
        minlength: "Password should be at least 8 characters.",
        maxlength: "Password maximum character is 30.",
      },
    },
  });
});

//announcement restriction input
$(document).ready(function () {
  $("#announce_form").validate({
    rules: {
      name: {
        minlength: 5,
        maxlength: 15,
      },
    },
    messages: {
      name: {
        minlength: "File name should be at least 5 characters.",
        maxlength: "File name maximum character is 15.",
      },
    },
  });
});
//course restriction input
$(document).ready(function () {
  $("#course_form").validate({
    rules: {
      course: {
        minlength: 10,
        maxlength: 50,
      },
      edit_course: {
        minlength: 10,
        maxlength: 50,
      },
    },
    messages: {
      course: {
        minlength: "Course name should be at least 10 characters.",
        maxlength: "Course name maximum character is 50.",
      },
    },
  });
});
$(document).ready(function () {
  $("#edit_course_form").validate({
    rules: {
      edit_course: {
        minlength: 10,
        maxlength: 50,
        required: true
      },
    },
    messages: {
      course: {
        minlength: "Course name should be at least 10 characters.",
        maxlength: "Course name maximum character is 50.",
      },
    },
  });
});
//section restriction input
$(document).ready(function () {
  $("#section_form").validate({
    rules: {
      section: {
        maxlength: 1,
        required: true
      },
    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});
$(document).ready(function () {
  $("#edit_section_form").validate({
    rules: {
      edit_section: {
        maxlength: 1,
        required: true
      },
    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});
//semester restriction input
$(document).ready(function () {
  $("#semester_form").validate({
    rules: {
      semester: {
        maxlength: 1,
        number: true,
        required: true,
      },
      edit_semester: {
        maxlength: 1,
        number: true,
        required: true,
      },
    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});

//semester restriction input
$(document).ready(function () {
  $("#year_form").validate({
    rules: {
      year_lvl: {
        maxlength: 1,
        number: true,
        required: true,
      },
    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});
$(document).ready(function () {
  $("#edit_year_form").validate({
    rules: {
      edit_year_lvl: {
        maxlength: 1,
        number: true,
        required: true,
      },
    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});

//local fees restriction input
$(document).ready(function () {
  $("#local_form").validate({
    rules: {
      fee_name: {
        maxlength: 30,
        required: true,
      },
      amount: {
        maxlength: 5,
        number: true,
        required: true,
      },
      edit_fee_name: {
        maxlength: 30,
        required: true,
      },
      edit_amount: {
        maxlength: 5,
        number: true,
        required: true,
      },

    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});
$(document).ready(function () {
  $("#edit_local_form").validate({
    rules: {
      edit_fee_name: {
        maxlength: 30,
        required: true,
      },
      edit_amount: {
        maxlength: 5,
        number: true,
        required: true,
      },

    },
    highlight: function (element) {
      $(element).closest(".form-group input").addClass("text-danger");
    },
    unhighlight: function (element) {
      $(element).closest(".form-group input").removeClass("text-danger");
    },
    errorElement: "small",
    errorClass: "help-block text-danger",
    errorPlacement: function (error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  });
});
