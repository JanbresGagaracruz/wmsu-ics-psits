<?php 
    ob_start();
    require("../include/cashier.php");
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != 1){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
    } 
    ob_end_flush();
    $yearId = $_POST['add_year'];
    $courseId = $_POST['add_course'];
    $semesterId = $_POST['add_semester'];
    $result = $connect->query("SELECT id, total_fees, fee_names FROM manage_fees WHERE year_lvl = '$yearId' AND course = '$courseId' AND semester = '$semesterId'") or die($connect->error());
    while($row = $result->fetch_assoc()):
?>

<?php endwhile; ?>
<script src="../js/datable.js"></script>
<script>
    $(function() {
        $(".check_amount").click(function(event) {
            var total = 0;
            var name="";
            $("tbody input[type=checkbox]:checked").each(function() {
                total += parseInt($(this).closest('tr').find('td[name=amount]').text().trim());
                name += ($(this).closest('tr').find('td[name=selected_fees]').text() + "  ");
            });
            $('#u_payment').val(total);
            $('#u_fees').val(name);
            $('#u_payment').focus();
        });
    });
</script> 