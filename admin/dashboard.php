<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('scripts/head_scripts.php'); ?>

</head>

<body>



    <?php include('includes/nav.php'); ?>

    <main class="content">

        <main class="mn-inner">
            <div class="table-settings mb-4" style="padding:10px;">
                <div class="row align-items-center justify-content-between">
                    <div class="col col-md-6 col-lg-3 col-xl-4">
                        <div class="input-group me-2 me-lg-3 fmxw-400">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Search Employee">
                        </div>
                    </div>
                    <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                        <div class="dropdown">
                            <button
                                class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1 bg-white border p-2"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    style="fill: rgba(12, 11, 11, 1);transform: ;msFilter:;">
                                    <circle cx="18" cy="6" r="3"></circle>
                                    <path
                                        d="M13 6c0-.712.153-1.387.422-2H6c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7.422A4.962 4.962 0 0 1 18 11a5 5 0 0 1-5-5z">
                                    </path>
                                </svg> <span class="">Notifications</span>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" style="width:300px;">

                                <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                                    <li class="notifications-dropdown-container">
                                        <ul>

                                            <?php 
                $isread = 0;
                $sql = "SELECT tblleaves.id as lid, tblemployees.FirstName, tblemployees.LastName, tblemployees.EmpId, tblleaves.PostingDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.IsRead=:isread";
                $query = $dbh->prepare($sql);
                $query->bindParam(':isread', $isread, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                ?>
                                            <li>
                                                <a
                                                    href="leave-details.php?leaveid=<?php echo htmlentities($result->lid); ?>">
                                                    <div class="notification">
                                                        <div class="notification-icon circle cyan">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    style="fill: rgba(12, 11, 11, 1);transform: ;msFilter:;">
                                                                    <path
                                                                        d="M16.813 4.419A.997.997 0 0 0 16 4H3a1 1 0 0 0-.813 1.581L6.771 12l-4.585 6.419A1 1 0 0 0 3 20h13a.997.997 0 0 0 .813-.419l5-7a.997.997 0 0 0 0-1.162l-5-7z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="notification-text">
                                                            <p><b><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?><br />(<?php echo htmlentities($result->EmpId); ?>)</b>
                                                                applied for leave</p>
                                                            <span>at
                                                                <?php echo htmlentities($result->PostingDate); ?></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php 
                    }
                }
                ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4 bg-white p-4 mt-3 border"
                    style="border-radius:10px;">
                    <div class="d-block mb-4 mb-md-0">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">shukaitrust.co.in</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <h2 class="h4">Hey, Akshay</h2>
                        <p class="mb-0">Organization : Shukai Centre for Special Needs</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="addemployee.php" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            New Employee
                        </a>
                        <div class="btn-group ms-2 ms-lg-3">
                            <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
                        </div>
                    </div>
                </div>

            </div>











            <table class="card table-responsive">
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">Registered Employees</h2>
                                <h3 class="fs-1 fw-extrabold mb-1"> <?php
$sql = "SELECT id from tblemployees";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$empcount=$query->rowCount();
?> <span class="counter"><?php echo htmlentities($empcount);?></span></span>
                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
                &nbsp;
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">Listed Departments</h2>
                                <h3 class="fs-1 fw-extrabold mb-1"> <?php
$sql = "SELECT id from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$dptcount=$query->rowCount();
?>
                                    <span class="stats-counter"><span
                                            class="counter"><?php echo htmlentities($dptcount);?></span></span>
                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">Listed Leave Types</h2>
                                <h3 class="fs-1 fw-extrabold mb-1"> <?php
$sql = "SELECT id from  tblleavetype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query->rowCount();
?>
                                    <span class="stats-counter"><span
                                            class="counter"><?php echo htmlentities($leavtypcount);?></span></span>
                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
            </table>

            <table class="card table-responsive mb-4">
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">Total Leaves</h2>
                                <h3 class="fs-1 fw-extrabold mb-1"> <?php
$sql = "SELECT id from  tblleaves";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalleaves=$query->rowCount();
?>
                                    <span class="stats-counter"><span
                                            class="counter"><?php echo htmlentities($totalleaves);?></span></span>
                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
                &nbsp;
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">Approved Leaves</h2>
                                <h3 class="fs-1 fw-extrabold mb-1">
                                    <?php
$sql = "SELECT id from  tblleaves where Status=1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                    <span class="stats-counter"><span
                                            class="counter"><?php echo htmlentities($approvedleaves);?></span></span>

                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
                <th style="padding:10px;">
                    <div class="col-12 col-xxl-6 mb-4 mb-xxl-0">
                        <div class="card border-0 shadow" style="width:300px">
                            <div class="card-body">
                                <h2 class="fs-5 fw-normal">New Leave Applications</h2>
                                <h3 class="fs-1 fw-extrabold mb-1"> <?php
$sql = "SELECT id from  tblleaves where Status=0";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$approvedleaves=$query->rowCount();
?>
                                    <span class="stats-counter"><span
                                            class="counter"><?php echo htmlentities($approvedleaves);?></span></span>
                                </h3>
                                <div class="d-flex align-items-center"><span class="me-3">Jan 1 - Dec 30</span> <svg
                                        class="icon icon-xxs text-gray-500 me-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                            clip-rule="evenodd"></path>
                                    </svg> <span>India</span></div>
                            </div>
                        </div>
                    </div>
                </th>
            </table>
        </main>
        <main class="mn-inner">









            <div class="card card-body border-0 shadow table-wrapper table-responsive">




                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200">Applications</th>
                            <th class="border-gray-200">Employee Name</th>
                            <th class="border-gray-200">Leave Type</th>
                            <th class="border-gray-200">Posting Date</th>
                            <th class="border-gray-200">Posting Time</th>

                            <th class="border-gray-200">Status</th>
                            <th class="border-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->


                        <?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id order by lid desc limit 6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>


                        <tr>
                            <td>
                                <a href="#" class="fw-bold">
                                    <?php echo htmlentities($cnt);?></b>
                                </a>
                            </td>
                            <td>
                                <span class="fw-normal"><a
                                        href="editemployee.php?empid=<?php echo htmlentities($result->id);?>"
                                        target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></span>
                            </td>
                            <td><span class="fw-normal"><?php echo htmlentities($result->LeaveType);?></span></td>
                            <td><span class="fw-normal"><?php echo htmlentities($result->PostingDate);?></span></td>
                            <td><span class="fw-bold">-</span></td>
                            <td><span class="fw-bold text-warning"><?php $stats=$result->Status;
if($stats==1){
                                             ?>
                                    <span style="color: green">Approved</span>
                                    <?php } if($stats==2)  { ?>
                                    <span style="color: red">Not Approved</span>
                                    <?php } if($stats==0)  { ?>
                                    <span style="color: blue">waiting for approval</span>
                                    <?php } ?></span></td>
                            <td>
                                <a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>"
                                    class="waves-effect waves-light btn blue m-b-xs"><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAe5JREFUSEuNVet5wyAMlIKyh72Ju0m7STtJukm7Sb1HLNRP4mEwYIc/cWy4k07SgaALAUDsqbPix/rnsK8EqMHQ/p4SjPn3Y1cETdyvMTrn3vUos/8FkDXBVHR9KAQEOctsIqIHACwKKiIrM78BQCZJsiv+xWpqMLk7PUBwEfEGiHib9DmQ4GrBRdS2BqOiBJ4cuUbtmWcFcs79IeIkIh/M/L1HjBAIrpII3yei+wNAoiwasX9TKchFuRA+tyd/7Ygq9bFN+xnEyHHx4lcUALxZxCsirgBBLmaejz3XErTZBHCERbwVc9YtKstNZYlFTnLVx68kQphS+gbueY6S7rWI70edPsjAYDKI14J6nmOxqkKnjPqOkGowkgVgiT1usmih70QPsfd+9eyti1T3sjV3sj7BKELrIgRZNKMcedMUrXdV8RPRj05oKQsCTC5OrmVkco39pwRsJpmILOtt2+I3nIic2UKWqxmesdUWkxw2VQTWRWG4Arifd61HflVnVmQQDrg7NS53KPSx1U/vksYqUgYpjuw5ZTFPL5HehdPxovIyqdwxe9dRiuSgB4KyZ1+2vf5Uda6+ag7qIp8a7MiCEWB7pu5LA3hACjUYm3hf/r2jMkHRuZnitdFJ21utk22098GZFfZuo1EXdRL/B/BMUjIz/7O+AAAAAElFTkSuQmCC" /></a>
                            </td>
                        </tr>
                        <!-- Item -->
                        <?php $cnt++;} }?>
                    </tbody>
                </table>
                <div
                    class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="fw-normal small mt-4 mt-lg-0">Showing <b>1</b> out of <b>1</b> entries</div>
                </div>
            </div>










            <?php include('includes/footer.php'); ?>

        </main>

        <?php include('scripts/body_scripts.php'); ?>
</body>

</html><?php } ?>