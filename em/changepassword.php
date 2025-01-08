<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['emplogin'];
    $sql ="SELECT Password FROM tblemployees WHERE EmailId=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblemployees set Password=:newpassword where EmailId=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";    
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



            <div class="row">
                <form class="col s12" name="chngpwd" method="post">
                    <?php if($error){?><div class="errorWrap">
                        <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                    </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                    <?php }?>
                    <div class="row">
                        <div>
                            <label for="password">Current Password</label>
                            <input class="form-control" id="password" type="password" autocomplete="off" name="password"
                                required>

                        </div>

                        <div class="">
                            <label for="password">New Password</label>
                            <input class="form-control" id="password" type="password" name="newpassword"
                                class="validate" autocomplete="off" required>

                        </div>

                        <div class="">
                            <label for="password">Confirm Password</label>
                            <input class="form-control" id="password" type="password" name="confirmpassword"
                                class="validate" autocomplete="off" required>

                        </div>


                        <div class="mt-4">
                            <button style="background:black; color:white;" type="submit" name="change"
                                class="waves-effect waves-light btn indigo m-b-xs"
                                onclick="return valid();">Change</button>
                        </div>




                    </div>

                </form>
            </div>

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