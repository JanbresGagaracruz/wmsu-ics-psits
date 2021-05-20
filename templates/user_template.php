<?php 
    ob_start();
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != 'Student'){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
    } 
    ob_end_flush();
    $yearId = $_POST['year'];
    $courseId = $_POST['course'];
    $semesterId = $_POST['semester'];
?>
    <?php
    if (mysqli_num_rows($connect->query("SELECT total_fees, fee_names FROM manage_fees WHERE year_lvl = '$yearId' AND course = '$courseId' AND semester = '$semesterId';")) == 0) { ?>
        <?php echo "<script>alert('No listed fees for $courseId in $semesterId - semester');</script>";?>
    <?php } else { ?>
        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Total payment</legend>
    <label for="tp">Actual fees</label>
<?php
    $result = $connect->query("SELECT id, total_fees, fee_names FROM manage_fees WHERE year_lvl = '$yearId' AND course = '$courseId' AND semester = '$semesterId'") or die($connect->error());
    while($row = $result->fetch_assoc()):
?>
    <input type="hidden" value="<?php echo $row["id"]; ?>" name="manage_id" id="manage_id" class="form-control">
    <input type="text" value="<?php echo $row["fee_names"]; ?>" name="fn" class="form-control" readonly="readonly">
    <label for="tp" style="margin-top: 1.5rem;">Total Amount to be Paid</label>
    <input type="number" value="<?php echo $row["total_fees"]; ?>" name="tp"  id="tp"class="form-control" readonly="readonly">
    </fieldset>
    <div class="table-sorting  table-responsive" style="margin-top: 1rem;">
        <table class="table table-striped table-bordered table-hover" id="table1">
            <thead>
                <tr class="p-4">
                    <th scope="col">Select</th>
                    <th scope="col">School fees</th>
                    <th scope="col">Amount</th>
                    <th scope="col">type</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $result = $connect->query("SELECT * FROM fees;") or die($connect->error());
                    while($row = $result->fetch_assoc()){ 
                ?>
                <tr>
                    <td>              
                        <div class="form-check custom-checkbox">
                        <input type="checkbox" class="form-check-input check_amount" name="local_fees">
                        <label class="form-check-label" for="check_amount"></label>
                    </div>
                    </td>
                    <td name="selected_fees"><?php echo $row['fee_name']; ?></td>
                    <td name="amount"><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Payment Information</legend>
            <div class="form-group">
                <label for="fs">Fees selected</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required readonly="readonly">
            </div>
            <div class="form-group u_val">
                <label for="tp">Payment fee</label>
                <input type="text" class="form-control" id="amount" name="amount" required readonly="readonly">
            </div>
        </fieldset>
        <input class="form-control" type="submit" name="submit" value="Submit Payment" style="background-color:#FFFF33; color:BLACK;cursor: pointer;"/>

<?php endwhile; ?>

<?php } ?>
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
            $('#amount').val(total);
            $('#item_name').val(name);
            $('#u_payment').focus();
        });
    });
</script> 
