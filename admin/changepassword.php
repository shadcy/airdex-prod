<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
    $sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
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
    <?php include('scripts/head_scripts.php'); ?>

</head>

<body>



    <?php include('includes/nav.php'); ?>

    <main class="content">
        <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Change Password</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <!-- <div class="card">
                            <div class="card-content"> -->

                        <div class="row">
                            <form class="col s12" name="chngpwd" method="post">
                                <?php if($error){?><div class="errorWrap">
                                    <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                <?php }?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" autocomplete="off"
                                            name="password" required>
                                        <label for="password">Current Password</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="newpassword" class="validate"
                                            autocomplete="off" required>
                                        <label for="password">New Password</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="confirmpassword" class="validate"
                                            autocomplete="off" required>
                                        <label for="password">Confirm Password</label>
                                    </div>
                                    <br><br>

                                    <div class="input-field col s12">
                                        <button style="background-color:black; color:white; padding:10px; "
                                            type="submit" name="change"
                                            class="waves-effect waves-light btn indigo m-b-xs"
                                            onclick="return valid();">Change</button>

                                    </div>




                                </div>

                            </form>
                        </div>
                    </div>
                </div>



                </div>

                </div>
            </main>
        </footer>
        <?php include('includes/footer.php'); ?>

    </main>

    <?php include('scripts/body_scripts.php'); ?>
</body>

</html><?php } ?>