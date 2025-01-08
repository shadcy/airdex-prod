<?php
session_start();
error_reporting();
include('scripts/config.php');

// Redirect to login page if not logged in
if(strlen($_SESSION['emplogin']) == 0) {   
    header('location:index.php');
    exit();
} else {
    $eid = $_SESSION['emplogin'];

    // Update employee profile information
    if(isset($_POST['update'])) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];   
        $gender = $_POST['gender']; 
        $dob = $_POST['dob']; 
        $department = $_POST['department']; 
        $address = $_POST['address']; 
        $city = $_POST['city']; 
        $country = $_POST['country']; 
        $mobileno = $_POST['mobileno']; 

        $sql = "UPDATE tblemployees SET FirstName=:fname, LastName=:lname, Gender=:gender, Dob=:dob, Department=:department, Address=:address, City=:city, Country=:country, Phonenumber=:mobileno WHERE EmailId=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Employee record updated successfully";
    }

    // Fetch employee details for display
    $sql_fetch_employee = "SELECT * FROM tblemployees WHERE EmailId = :eid";
    $query_fetch_employee = $dbh->prepare($sql_fetch_employee);
    $query_fetch_employee->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query_fetch_employee->execute();
    $employee_details = $query_fetch_employee->fetch(PDO::FETCH_ASSOC);

    // Fetch admin details for chat (assuming there's only one admin)
    $sql_fetch_admin = "SELECT * FROM admin LIMIT 1";
    $query_fetch_admin = $dbh->query($sql_fetch_admin);
    $admin_details = $query_fetch_admin->fetch(PDO::FETCH_ASSOC);

    // Fetch chat messages
    $sql_fetch_messages = "SELECT * FROM chat_messages ORDER BY sent_at ASC";
    $query_fetch_messages = $dbh->query($sql_fetch_messages);
    $messages = $query_fetch_messages->fetchAll(PDO::FETCH_ASSOC);

    // Handle sending a new message
    if(isset($_POST['send_message'])) {
        $message = $_POST['message'];
        $sender_id = $employee_details['id'];
        $receiver_id = $admin_details['id'];
        $sent_at = date('Y-m-d H:i:s');

        $sql_insert_message = "INSERT INTO chat_messages (message, sender_id, receiver_id, sent_at) VALUES (:message, :sender_id, :receiver_id, :sent_at)";
        $query_insert_message = $dbh->prepare($sql_insert_message);
        $query_insert_message->bindParam(':message', $message, PDO::PARAM_STR);
        $query_insert_message->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $query_insert_message->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        $query_insert_message->bindParam(':sent_at', $sent_at, PDO::PARAM_STR);
        $query_insert_message->execute();
        header('Refresh:0'); // Refresh page to show new message
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('scripts/head_scripts.php'); ?>
    <!-- Include Bootstrap CSS -->
    <style>
    .chat-container {
        max-width: 80%;
        margin: auto;
    }

    .message-list {
        list-style-type: none;
        padding: 0;
        overflow-y: auto;
        /* Enable vertical scrolling */
        max-height: 300px;
        /* Set a maximum height for the message list */
    }

    .message-item {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
    }

    .message-item.sent {
        background-color: #d4edda;
    }

    .message-item.received {
        background-color: #f8f9fa;
    }
    </style>

</head>

<body>
    <?php include_once('components/nav.php'); ?>

    <main class="content ">
        <?php include_once('components/nav_menu.php'); ?>

        <div class="container chat-container card p-4 mt-4">
            <h2>Chat with <span style="color:blue;">@akshay</span></h2>

            <!-- Display update message if any -->
            <?php if(isset($msg)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>

            <!-- Chat Messages -->
            <ul class="message-list">
                <?php foreach($messages as $msg): ?>
                <li
                    class="message-item <?php echo ($msg['sender_id'] == $employee_details['id']) ? 'sent' : 'received'; ?>">
                    <strong><?php echo ($msg['sender_id'] == $employee_details['id']) ? 'You' : 'Admin'; ?>:</strong>
                    <?php echo $msg['message']; ?>
                    <small class="text-muted"> - <?php echo date('M d, Y H:i:s', strtotime($msg['sent_at'])); ?></small>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Chat Input Form -->
            <form method="post" class="mt-3">
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="3" placeholder="Type your message..."
                        required></textarea>
                </div>
                <button type="submit" name="send_message" class="btn btn-primary mt-4">Send</button>
            </form>
        </div>

        <?php include_once('components/page_components/footer.php'); ?>
    </main>

    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php } ?>