<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('scripts/head_scripts.php'); ?>
</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


    <main>

        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                    <a href="https://nxtdev.shop" class="d-flex align-items-center justify-content-center">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Back to homepage
                    </a>
                </p>
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Airdex +</h1>
                            </div>

                            <form class="col s12 mt-4" name="signin" method="post">



                                <!-- Email Input -->
                                <div class="input-field col s12">
                                    <label for="username">Your Email</label>
                                    <br>
                                    <input id="username" type="text" name="username" class="validate" autocomplete="off"
                                        required style="width:100%; height:44px;">
                                </div>
                                <br>

                                <!-- Password Input -->
                                <div class="input-field col s12">
                                    <label for="password">Your Password</label>
                                    <br>
                                    <input id="password" type="password" class="validate" name="password"
                                        autocomplete="off" required style="width:100%; height:44px;">
                                </div>
                                <br><br>

                                <!-- Sign In Button -->
                                <div class="d-grid">
                                    <button type="submit" name="signin" value="Sign in" class="btn btn-gray-800">
                                        Administrator Login +
                                    </button>
                                </div>

                            </form>






                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('scripts/body_scripts.php'); ?>
</body>

</html>