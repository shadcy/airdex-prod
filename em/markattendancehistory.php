<?php
session_start();
error_reporting(0);
include('scripts/config.php');

// Redirect to login page if user is not logged in
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
    exit();
} else {
    $eid = $_SESSION['emplogin'];

    // Update employee record if 'update' form is submitted
    if (isset($_POST['update'])) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $mobileno = $_POST['mobileno'];

        // Prepare SQL query to update employee details
        $sql = "UPDATE tblemployees 
                SET FirstName=:fname, LastName=:lname, Gender=:gender, Dob=:dob, Department=:department, 
                    Address=:address, City=:city, Country=:country, Phonenumber=:mobileno 
                WHERE EmailId=:eid";
        $query = $dbh->prepare($sql);

        // Bind parameters
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

        // Execute query
        $query->execute();

        // Set success message
        $msg = "Employee record updated Successfully";
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
        <div class="alert alert-gray-800" role="alert">
            <ul>
                <li>Estimated Salary&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;: <span class="badge bg-secondary">Salary</span></li>
                <li>Attendance Marked &nbsp;: <span class="badge bg-success">Marked</span></li>
            </ul>
        </div>
        <div class="row">
            <!-- Row starts here -->

            <?php
            // Define the array with months and corresponding number of days for the year 2024
            $months = [
                "January" => 31,
                "February" => 29, // 2024 is a leap year
                "March" => 31,
                "April" => 30,
                "May" => 31,
                "June" => 30,
                "July" => 31,
                "August" => 31,
                "September" => 30,
                "October" => 31,
                "November" => 30,
                "December" => 31
            ];

            // Function to print the calendar for each month in a table
            function printCalendar($month, $days, $startDay, $currentMonth) {
                echo "<h2><u>$month</u></h2>";
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr>";

                // Print day headers
                $daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                foreach ($daysOfWeek as $day) {
                    echo "<th style='padding: 5px; text-align: center; background-color: #f0f0f0;'>$day</th>";
                }
                echo "</tr><tr>";

                // Print empty cells for days of the week before the start of the month
                for ($i = 0; $i < $startDay; $i++) {
                    echo "<td>&nbsp;</td>";
                }

                // Print the days
                for ($i = 1; $i <= $days; $i++) {
                    // Determine if the current month is before or after the displayed month
                    $currentTimestamp = strtotime($currentMonth);
                    $displayedTimestamp = strtotime($month);

                    // Check if the date should be marked
                    if ($i == 7 && $displayedTimestamp < $currentTimestamp) {
                        echo "<td class='bg-secondary' style='padding: 5px; text-align: center; border-radius:10px;'><b>$i</b></td>";
                    } else {
                        echo "<td style='padding: 5px; text-align: center;'>" . str_pad($i, 2, " ", STR_PAD_LEFT) . "</td>";
                    }

                    // Break the row after Saturday
                    if (($i + $startDay) % 7 == 0) {
                        echo "</tr><tr>";
                    }
                }

                // Fill in the remaining cells for the last week if needed
                $remainingDays = (7 - (($days + $startDay) % 7)) % 7;
                if ($remainingDays > 0) {
                    for ($i = 0; $i < $remainingDays; $i++) {
                        echo "<td>&nbsp;</td>";
                    }
                }

                echo "</tr>";
                echo "</table><br /><br />"; // Separate each month's calendar with a blank line
            }

            // Assume January 1, 2024 is a Monday (startDay = 1)
            $startDay = 1;

            // Get current month and year
            $currentMonth = date('F'); // Full month name, e.g., "June"

            // Iterate through each month and print the calendar
            foreach ($months as $month => $days) {
                printCalendar($month, $days, $startDay, $currentMonth);
                // Calculate the start day for the next month
                $startDay = ($startDay + $days) % 7;
            }
            ?>

            <!-- Row ends here -->
        </div>
        <div class="row">
            <!-- Additional rows or components can be added here -->

        </div>
        <?php include_once('components/page_components/settings.php'); ?>
        <?php include_once('components/page_components/footer.php'); ?>
    </main>
    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php
} // End of else block for session check
?>