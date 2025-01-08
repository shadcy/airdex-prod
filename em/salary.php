<?php
session_start();
error_reporting(0);
include('scripts/config.php');

if(strlen($_SESSION['emplogin']) == 0) {   
    header('location:index.php');
    exit();
} else {
    $eid = $_SESSION['emplogin'];

    if(isset($_POST['update'])) {
        // Handle update logic here if needed
        // Note: Ensure proper validation and sanitization of form inputs before updating database
    }

    // Fetch employee details including salary
    $sql = "SELECT FirstName, LastName, Salary FROM tblemployees WHERE EmailId = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
        // Handle case where employee details are not found
        echo "Employee details not found.";
        exit();
    }

    $firstName = htmlentities($result['FirstName']);
    $lastName = htmlentities($result['LastName']);
    $salary = htmlentities($result['Salary']);

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
            <h1>Hey, <?php echo $firstName; ?> <?php echo $lastName; ?>, your current salary is <?php echo $salary; ?>/-
            </h1>
            <h2>Next Salary Estimated date: <span style="color:blue;">7th of Every Month</span></h2>
        </div>

        <div class="row">
            <div class="alert alert-primary" role="alert">
                <?php echo $firstName; ?>, you can track your salary <a style="color:blue;"
                    href="markattendancehistory.php">here</a>.
            </div>
        </div>

        <?php include_once('components/page_components/footer.php'); ?>
    </main>

    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php 
}
?>