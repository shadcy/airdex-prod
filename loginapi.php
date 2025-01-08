<?php
header('Content-Type: application/json');

session_start();
error_reporting(0);
include('./includes/config.php');

$response = array();

if(isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $status = $result->Status;
            $_SESSION['eid'] = $result->id;
        }

        if($status == 0) {
            $response['status'] = 'error';
            $response['message'] = 'Your account is Inactive. Please contact admin';
        } else {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $_SESSION['emplogin'] = $_POST['username'];
            $_SESSION['user_id'] = $_SESSION['eid'];
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid Details';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid Request';
}

echo json_encode($response);
?>
