<?php


// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Content type header
header('Content-Type: application/json');

// Start the session
session_start();

// Include the database configuration file
include('./includes/config.php');

// Initialize the response array
$response = array();

// Check if the username and password are set in the POST request
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get the username and password from the POST request
    $uname = $_POST['username'];
    $password = md5($_POST['password']);

    // Prepare the SQL query to check the user's credentials
    $sql = "SELECT EmailId, Password, Status, id FROM tblemployees WHERE EmailId = :uname AND Password = :password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    // Fetch the result
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Check if a result was returned
    if ($result) {
        // Check the status of the user account
        $status = $result['Status'];
        if ($status == 0) {
            $response['error'] = true;
            $response['message'] = "Your account is Inactive. Please contact admin";
        } else {
            // Set session variables
            $_SESSION['eid'] = $result['id'];
            $_SESSION['emplogin'] = $uname;

            // Set success response
            $response['error'] = false;
            $response['message'] = "Login successful and data found in database";
            $response['user_id'] = $result['id'];
        }
    } else {
        // Invalid username or password
        $response['error'] = true;
        $response['message'] = "Invalid username or password";
    }
} else {
    // Username and password are required
    $response['error'] = 0;
    $response['message'] = "Username and password are not required";
}

// Encode the response array to JSON and output it
echo json_encode($response);

?>
