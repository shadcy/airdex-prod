<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
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
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="alert alert-primary mb-4">
                        Total Leaves: $[count] &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                        &nbsp; &nbsp; Leaves Remaining: $[count]
                    </div>

                    <?php if ($msg) { ?>
                    <div class="alert alert-success">
                        <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
                    </div>
                    <?php } ?>

                    <div class="table-responsive">
                        <table id="example" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th width="120">Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th width="120">Posting Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $eid = $_SESSION['eid'];
                                $sql = "SELECT tblleaves.id as lid, LeaveType, ToDate, FromDate, Description, PostingDate, AdminRemarkDate, AdminRemark, Status FROM tblleaves WHERE empid=:eid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { 
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->LeaveType); ?></td>
                                    <td><?php echo htmlentities($result->FromDate); ?></td>
                                    <td><?php echo htmlentities($result->ToDate); ?></td>
                                    <td><?php echo htmlentities($result->PostingDate); ?></td>
                                    <td>
                                        <?php 
                                        $stats = $result->Status;
                                        if ($stats == 1) { ?>
                                        <span class="text-success">Approved</span>
                                        <?php } elseif ($stats == 2) { ?>
                                        <span class="text-danger">Not Approved</span>
                                        <?php } elseif ($stats == 0) { ?>
                                        <span class="text-primary">Waiting for approval</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid); ?>"
                                            class="btn btn-primary btn-sm">View Details</a>
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

            <?php include_once('components/page_components/settings.php'); ?>

        </div>
        <?php include_once('components/page_components/footer.php'); ?>
    </main>

    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php 
} 
?>