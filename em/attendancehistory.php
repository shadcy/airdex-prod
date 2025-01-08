<?php
session_start();
error_reporting(E_ALL);
include('scripts/config.php');

// Redirect to login page if session is not set
if (empty($_SESSION['emplogin'])) {
    header('location:index.php');
    exit();
}

$eid = $_SESSION['eid'];
$msg = '';

// Fetch attendance history from database
$sql = "SELECT attendance_date, check_in, check_out FROM attendance WHERE empid = ? ORDER BY attendance_date DESC";
$stmt = $dbh->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($dbh->error));
}

$stmt->bindParam(1, $eid, PDO::PARAM_INT);

try {
    $stmt->execute();
    $attendanceHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = "PDO Error: " . $e->getMessage();
}

$stmt->closeCursor(); // Close cursor after execution
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('scripts/head_scripts.php'); ?>
</head>

<body>

    <?php include_once('components/nav.php'); ?>

    <main class="content">

        <div class="">
            <h2 class="mt-4 mb-4">Attendance History</h2>

            <?php if (!empty($msg)) : ?>
            <div class="alert alert-danger"><?php echo $msg; ?></div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendanceHistory as $attendance) : ?>
                                <tr>
                                    <td><?php echo $attendance['attendance_date']; ?></td>
                                    <td><?php echo $attendance['check_in'] ?: 'N/A'; ?></td>
                                    <td><?php echo $attendance['check_out'] ?: 'N/A'; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <?php include_once('scripts/body_scripts.php'); ?>
    </main>

</body>

</html>