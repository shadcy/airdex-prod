<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login page if admin is not logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit();
}

// Validate and sanitize inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $reply_message = $_POST['reply_message'];

    // Validate input (basic example)
    if (empty($sender_id) || empty($receiver_id) || empty($reply_message)) {
        // Handle validation error (redirect back with error message or display error)
        header('location:chatwithem.php?error=1');
        exit();
    }

    // Insert reply message into database
    $sql = "INSERT INTO chat_messages (message, sender_id, receiver_id, sent_at) 
            VALUES (:message, :sender_id, :receiver_id, NOW())";

    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':message', $reply_message, PDO::PARAM_STR);
        $stmt->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $stmt->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->rowCount() > 0) {
            // Redirect back to chatwithem.php with success message
            header('location:chatwithem.php?success=1');
            exit();
        } else {
            // Handle error: Insertion failed
            header('location:chatwithem.php?error=2');
            exit();
        }
    } catch (PDOException $e) {
        // Handle database error (redirect back with error message or display error)
        header('location:chatwithem.php?error=3&msg=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header('location:chatwithem.php');
    exit();
}
?>