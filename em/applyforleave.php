<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
 $leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  
$status=0;
$isread=0;
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid) VALUES(:leavetype,:todate,:fromdate,:description,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Leave applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('scripts/head_scripts.php'); ?>
</head>

<body>




    <?php include_once('components/nav.php'); ?>

    <main class="content">
        <?php include_once('components/nav_menu.php'); ?>
        <div class="py-4">
            <?php include_once('components/page_components/newtaskbutton.php'); ?>
        </div>
        <div class="row">
            <!-- Row starts here -->


            <form id="example-form" method="post" name="addemp">
                <div>
                    <h3>Apply for <u>Leave</u></h3>
                    <section>
                        <div class="wizard-content">
                            <div class="row mt-4">
                                <div class="col m12">
                                    <div class="row">
                                        <?php if($error){ ?><div class="errorWrap"><strong>ERROR</strong>:
                                            <?php echo htmlentities($error); ?></div><?php } 
                            else if($msg){ ?><div class="succWrap"><strong>SUCCESS</strong>:
                                            <?php echo htmlentities($msg); ?></div><?php } ?>

                                        <div class="input-field col s12">
                                            <select name="leavetype" autocomplete="off" class="form-control">
                                                <option value="" class="form-control">Select leave type...</option>
                                                <?php 
                                    $sql = "SELECT LeaveType FROM tblleavetype";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount() > 0) {
                                        foreach($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->LeaveType); ?>">
                                                    <?php echo htmlentities($result->LeaveType); ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>

                                        <div class="mt-4">
                                            <label for="fromdate">From Date [dd/mm/yyyy]</label>
                                            <input placeholder="" id="mask1" name="fromdate" class="form-control"
                                                type="text" data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy"
                                                required>
                                        </div>
                                        <div class="">
                                            <label for="todate">To Date </label>
                                            <input placeholder="" id="mask1" name="todate" class="form-control"
                                                type="text" data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy"
                                                required>
                                        </div>
                                        <div class="">
                                            <label for="birthdate">Description</label>
                                            <textarea id="textarea1" name="description" class="form-control"
                                                length="500" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" name="apply" id="apply" style="background:black; color:white;"
                                        class="waves-effect waves-light btn indigo m-b-xs mt-4">Apply</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>



            <!-- Row ends here -->
        </div>
        <div class="row">
            <!-- Row starts here -->


            <!-- Row ends here -->
        </div>
        <?php include_once('components/page_components/settings.php'); ?>


        <?php include_once('components/page_components/footer.php'); ?>
    </main>




    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php } ?>