<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('scripts/head_scripts.php'); ?>
</head>

<body>




    <?php include_once('components/nav.php'); ?>

    <main class="content">
        <div style="width:100%;" class="toast bg-primary mb-3 mt-4" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <svg class="icon icon-xs text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                    </path>
                    <path
                        d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                    </path>
                </svg>
                <strong class="me-auto">Shukai Trust</strong>
                <small>0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white">
                Please mail to <a style="color:orange;"> shukaitrust@gmail.com<a />
            </div>
        </div>
        <?php include_once('components/nav_menu.php'); ?>
        <div class="py-4">
            <?php include_once('components/page_components/newtaskbutton.php'); ?>
        </div>
        <div class="row">

            <!-- // Productivity chart for employees -->
            <div class="col-12 mb-4">
                <?php 
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
                <div class="card">
                    <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                        <!-- <div class="d-block mb-3 mb-sm-0">
                            <div class="fs-5 fw-normal mb-2">Current Salary</div>
                            <h2 class="fs-3 fw-extrabold">10,000/-</h2>
                            <div class="small mt-2">
                                <span class="fw-normal me-2">% Hike from last year </span>
                                <span class="fas fa-angle-up text-success"></span>
                                <span class="text-success fw-bold">900%</span>
                            </div>
                        </div>
                        <div class="d-flex ms-auto">
                            <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                            <a href="#" class="btn btn-dark btn-sm me-3">Week</a>
                        </div> -->
                        <h1 style="
                        font-size:300%; color:black; text-transform: capitalize; "> Hello,
                            <span class='color:blue;'>
                                <?php echo htmlentities($result->FirstName);?>
                            </span><br />
                            <!-- <span>Em ID: <?php echo htmlentities($result->EmpId)?></span> -->
                            <?php }} ?>
                        </h1>
                    </div>
                    <div class="card-body p-2">
                        <!-- <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div> -->
                        <span>Airdex Managed by <span style="color:blue;">shukaitrust.co.in</span></span>
                        <img style="width:26px;" src='https://nxtdev.shop/images/ai-star.png' />
                    </div>
                </div>
            </div>




            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow">


                    <!-- Total Leaves  -->
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Leaves</h2>
                                    <h3 class="fw-extrabold mb-1"> <span class="card-title"></span>
                                        <?php $eid=$_SESSION['eid'];
$sql = "SELECT id from  tblleaves where empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($totalleaves);?></span></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Total Leaves</h2>
                                    <h3 class="fw-extrabold mb-2"> <span class="card-title"></span>
                                        <?php $eid=$_SESSION['eid'];
$sql = "SELECT id from  tblleaves where empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($totalleaves);?></span></span>
                                    </h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">
                                    Feb 1 - Apr 1,
                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    India, Shukai Trust
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg><span class="text-success fw-bolder">0%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Approved  Leaves  -->
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="fw-extrabold h5">Approved Leaves</h2>
                                    <h3 class="mb-1"><?php
$sql = "SELECT id from  tblleaves where Status=1 and empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($approvedleaves);?></span></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Approved Leaves</h2>
                                    <h3 class="fw-extrabold mb-2"><?php
$sql = "SELECT id from  tblleaves where Status=1 and empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($approvedleaves);?></span></span>
                                    </h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">
                                    Feb 1 - Apr 1,
                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    India, Shukai Trust
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg><span class="text-danger fw-bolder">0%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- New Leaves application  -->
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="fw-extrabold h5">New Applications</h2>
                                    <h3 class="mb-1"> <?php
$sql = "SELECT id from  tblleaves where Status=0 and empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($approvedleaves);?></span></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">New Applications</h2>
                                    <h3 class="fw-extrabold mb-2"> <?php
$sql = "SELECT id from  tblleaves where Status=0 and empid ='$eid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                        <span class="stats-counter"><span
                                                class="counter"><?php echo htmlentities($approvedleaves);?></span></span>
                                    </h3>
                                </div>
                                <small class="text-gray-500">
                                    Feb 1 - Apr 1
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg><span class="text-success fw-bolder">0%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">





            <!-- Old assets -->




            <section class='w-full'>
                <div class=" py-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4 class="card-title">Leave Applications</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee Name</th>
                                                    <th>Leave Type</th>
                                                    <th>Posting Date</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                        $sql = "SELECT tblleaves.id as lid, tblemployees.FirstName, tblemployees.LastName, tblemployees.EmpId, tblemployees.id, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status FROM tblleaves JOIN tblemployees ON tblleaves.empid=tblemployees.id WHERE tblleaves.empid='$eid' ORDER BY lid DESC LIMIT 6";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {         
                                    ?>
                                                <tr>
                                                    <td><b><?php echo htmlentities($cnt);?></b></td>
                                                    <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>"
                                                            target="_blank">
                                                            <?php echo htmlentities($result->FirstName . " " . $result->LastName);?>
                                                            (<?php echo htmlentities($result->EmpId);?>)
                                                        </a>
                                                    </td>
                                                    <td><?php echo htmlentities($result->LeaveType);?></td>
                                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                                    <td>
                                                        <?php 
                                                $status = $result->Status;
                                                if ($status == 1) {
                                                    echo '<span class="badge text-black-50 badge-success">Approved</span>';
                                                } elseif ($status == 2) {
                                                    echo '<span class="badge text-black-50 badge-danger">Not Approved</span>';
                                                } else {
                                                    echo '<span class="badge text-black-50 badge-danger">Waiting for approval</span>';
                                                }
                                            ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>"
                                                            class="btn btn-tertiary btn-sm">View Details</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                            $cnt++;
                                            }
                                        } 
                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <!-- timepass chizee -->

            <section>

                <div class="alert alert-primary mt-4 " role="alert">
                    <?php echo htmlentities($result->FirstName);?> you can track your salary here <a style="color:blue;"
                        href="markattendancehistory.php"> [ preview ]</a>

                    <!-- Row ends here -->
                    </ div>



                    <div class="alert alert-light mt-4" role="alert">
                        <div class="alert-icon">
                            <span class="fas fa-bell"></span>
                        </div>
                        <h5 class="alert-heading">Feedback : If you are facing any technical issue mail to <a
                                style="color:blue;" href="#"> [ shreyashwanjari5162@gmail.com
                                ]</a></h5>

                        <h5 class="alert-heading">Community Admin : If you are facing any other issue mail to <a
                                id="showToastBtn" style="color:blue;" href="#"> @AkshayGarg
                            </a></h5>

                        <hr>
                        <p class="mb-0">Create a leave application <a style="color:blue;" href="applyforleave.php">
                                Click Here
                            </a></p>
                    </div>
            </section>
            <script>
            // Function to show the toast
            document.getElementById('showToastBtn').addEventListener('click', function() {
                var toastElement = document.querySelector('.toast');
                var toast = new bootstrap.Toast(toastElement);
                toast.show();
            });
            </script>


        </div>
        <?php include_once('components/page_components/settings.php'); ?>


        <?php include_once('components/page_components/footer.php'); ?>
    </main>




    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php } ?>