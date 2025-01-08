<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login page if admin is not logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit();
}

// Fetch all chat messages
$sql = "SELECT cm.*, e.FirstName, e.LastName 
        FROM chat_messages cm
        INNER JOIN tblemployees e ON cm.sender_id = e.id
        ORDER BY cm.sent_at DESC";
try {
    $stmt = $dbh->query($sql);
    if (!$stmt) {
        throw new PDOException("Failed to fetch chat messages");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('scripts/head_scripts.php'); ?>
</head>

<body>
    <?php include('includes/nav.php'); ?>

    <main class="content">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mt-4 mb-4">Chat Messages</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Message</th>
                                            <th>Sent At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($stmt->rowCount() > 0) {
                                            foreach ($stmt as $row) {
                                                $sender_id = $row['sender_id'];
                                                $sender_name = $row['FirstName'] . ' ' . $row['LastName'];
                                                $message = $row['message'];
                                                $sent_at = $row['sent_at'];
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($sender_name); ?></td>
                                            <td><?php echo htmlspecialchars($message); ?></td>
                                            <td><?php echo htmlspecialchars($sent_at); ?></td>
                                            <td>
                                                <form action="reply.php" method="post">
                                                    <input type="hidden" name="sender_id"
                                                        value="<?php echo htmlspecialchars($_SESSION['admin_id']); ?>">
                                                    <input type="hidden" name="receiver_id"
                                                        value="<?php echo htmlspecialchars($sender_id); ?>">
                                                    <textarea name="reply_message" rows="4" cols="50"
                                                        placeholder="Reply to <?php echo htmlspecialchars($sender_name); ?>"></textarea><br><br>
                                                    <input type="submit" value="Submit Reply">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No messages found</td></tr>";
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

        <?php include('includes/footer.php'); ?>
    </main>

    <?php include('scripts/body_scripts.php'); ?>
</body>

</html>