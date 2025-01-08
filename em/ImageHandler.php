<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['emplogin'];
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$address=$_POST['address']; 
$city=$_POST['city']; 
$country=$_POST['country']; 
$mobileno=$_POST['mobileno']; 
$sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmailId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$msg="Employee record updated Successfully";
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

        </div>
        <div class="row">
            <!-- Row starts here -->



            <!-- Row ends here -->
        </div>
        <div class="row">
            <!-- Row starts here -->


            <?php
session_start();

// Define the correct password
$correct_password = "Shukai@1310";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        // Get the entered password from the form
        $entered_password = $_POST['password'];

        // Verify the entered password
        if ($entered_password === $correct_password) {
            // Password is correct, set a session variable
            $_SESSION['authenticated'] = true;
        } else {
            // Password is incorrect, set an error message
            $error_message = "Incorrect password. Please try again.";
        }
    } elseif (isset($_POST['logout'])) {
        // Handle logout by unsetting the specific session variable
        unset($_SESSION['authenticated']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Check if the user is authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Display the success page with a logout button
    echo "<h1>  Image Handler with <span style='color:blue;'>@n/pipeline<span></h1>";
    echo "<span></span>";
    echo "<p>You have successfully entered the correct password.</p>";
    echo '<form method="post" action="">
            <button type="submit" name="logout">Logout</button>
          </form><br><br> <hr>';
          echo include_once('imgForm.php');;
} else {
    // Display the password form
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    echo ' <div style="position: relative; display: inline-block;">
    <img src="https://images.unsplash.com/photo-1627843240167-b1f9d28f732e?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width: 100%; height:full;">
    <form method="post" action="" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px;">
      <label for="password" style="display: block; margin-bottom: 10px;">Enter Password:</label>
      <input type="password" id="password" name="password" required style="display: block; margin-bottom: 10px; width: 100%; padding: 10px; box-sizing: border-box;">
      <button type="submit" style="display: block; width: 100%; padding: 10px; background-color: #000; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
    </form>
  </div> ';
}
?>


            <!-- Row ends here -->
        </div>
        <?php include_once('components/page_components/settings.php'); ?>


        <?php include_once('components/page_components/footer.php'); ?>
    </main>




    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php } ?>