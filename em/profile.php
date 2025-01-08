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
            <?php include_once('components/page_components/newtaskbutton.php'); ?>
        </div>
        <div class="row">
            <!-- Row starts here -->


            <main>
                <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                    <div
                        style="background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; width: 100%; height: 100%;">
                        <div style="border-bottom: 0px solid #e0e0e0; margin-bottom: 20px;">
                            <u>
                                <div style="background-color:white;">
                                    <!-- <?php echo htmlentities($result->FirstName);?>'s profile</div> -->
                                    <div class=" mb-3" role="" aria-live="assertive" aria-atomic=""
                                        style="background-color:white;">
                                        <div class="toast-header">
                                            <svg class="icon icon-xs text-gray-500 me-2" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                                </path>
                                                <path
                                                    d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                                </path>
                                            </svg>
                                            <strong class="me-auto">Powered by Shukai</strong>
                                            <small>Update Documents</small>
                                        </div>

                                    </div>
                                </div>
                            </u>
                            <div>
                                <div>
                                    <div>
                                        <form id="example-form" method="post" name="updatemp" style="">
                                            <div>
                                                <h3 style="margin-bottom: 20px;" class="form">Update Information <span
                                                        class="badge bg-info">Info</span></h3>
                                                <?php if($error){?><div>
                                                    <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                                </div><?php } 
                                else if($msg){?><div><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?>
                                                </div><?php }?>
                                                <section>
                                                    <div>
                                                        <div>
                                                            <div>
                                                                <?php 
                                                $eid=$_SESSION['emplogin'];
                                                $sql = "SELECT * from  tblemployees where EmailId=:eid";
                                                $query = $dbh -> prepare($sql);
                                                $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt=1;
                                                if($query->rowCount() > 0)
                                                {
                                                foreach($results as $result)
                                                { ?>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label for="empcode">Employee Code</label> <br>
                                                                    <input name="empcode" id="empcode"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->EmpId);?>"
                                                                        type="text" autocomplete="off" readonly
                                                                        required>
                                                                    <span id="empid-availability"></span>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label for="firstName">First
                                                                        name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input id="firstName" name="firstName"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->FirstName);?>"
                                                                        type="text" required>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label for="lastName">Last name
                                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input id="lastName" name="lastName"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->LastName);?>"
                                                                        type="text" autocomplete="off" required>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label
                                                                        for="email">Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input name="email" type="email" id="email"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->EmailId);?>"
                                                                        readonly autocomplete="off" required>
                                                                    <span id="emailid-availability"></span>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label for="phone">Mobile number</label>
                                                                    <input id="phone" name="mobileno" type="tel"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->Phonenumber);?>"
                                                                        maxlength="10" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div style="margin-bottom: 15px;">

                                                                    <label
                                                                        for="gender">Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                                                    <select name="gender" autocomplete="off"
                                                                        class="form-control">
                                                                        <option class="form-control"
                                                                            value="<?php echo htmlentities($result->Gender);?>">
                                                                            <?php echo htmlentities($result->Gender);?>
                                                                        </option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>
                                                                <label for="birthdate">Date of Birth</label>
                                                                <div style="margin-bottom: 15px;">
                                                                    <input id="birthdate" name="dob" class="datepicker"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->Dob);?>">
                                                                    <div class="form-control">No Data Available [if DOB
                                                                        showing ignore this message]</div>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label
                                                                        for="department">Department</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <select name="department" autocomplete="off"
                                                                        class="form-control">
                                                                        <option class="form-control"
                                                                            value="<?php echo htmlentities($result->Department);?>">
                                                                            <?php echo htmlentities($result->Department);?>
                                                                        </option>
                                                                        <?php 
                                                        $sql = "SELECT DepartmentName from tbldepartments";
                                                        $query = $dbh -> prepare($sql);
                                                        $query->execute();
                                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt=1;
                                                        if($query->rowCount() > 0)
                                                        {
                                                        foreach($results as $resultt)
                                                        { ?>
                                                                        <option
                                                                            value="<?php echo htmlentities($resultt->DepartmentName);?>">
                                                                            <?php echo htmlentities($resultt->DepartmentName);?>
                                                                        </option>
                                                                        <?php }} ?>
                                                                    </select>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label
                                                                        for="address">Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input id="address" name="address" type="text"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->Address);?>"
                                                                        autocomplete="off" required>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label
                                                                        for="city">City/Town</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input id="city" name="city" type="text"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->City);?>"
                                                                        autocomplete="off" required>
                                                                </div>
                                                                <div style="margin-bottom: 15px;">
                                                                    <label
                                                                        for="country">Country</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input id="country" name="country" type="text"
                                                                        class="form-control"
                                                                        value="<?php echo htmlentities($result->Country);?>"
                                                                        autocomplete="off" required>
                                                                </div>
                                                                <?php }} ?>
                                                                <div>
                                                                    <button type="submit" name="update" id="update"
                                                                        style="background-color: #333; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">UPDATE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>


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