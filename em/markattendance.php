<?php
session_start();
error_reporting(E_ALL);
include('scripts/config.php');

// Redirect to login page if session is not set
if (empty($_SESSION['emplogin'])) {
    header('location:index.php');
    exit();
}

// Initialize variables
$eid = $_SESSION['eid'];
$msg = '';

// Function to get user's current location
function getUserLocation() {
    if (isset($_GET['lat']) && isset($_GET['lon'])) {
        $latitude = $_GET['lat'];
        $longitude = $_GET['lon'];
        return array($latitude, $longitude);
    } else {
        // If coordinates are not available, prompt the browser to get the user's location
        echo "<script>
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    alert('Geolocation is not supported by this browser.');
                }

                function showPosition(position) {
                    window.location.href = '?lat=' + position.coords.latitude + '&lon=' + position.coords.longitude;
                }
              </script>";
        return false;
    }
}

// Function to check if current time is between 8am and 11am in IST
function isWithinTimeRange() {
    date_default_timezone_set('Asia/Kolkata');
    $currentHour = date('H');
    return ($currentHour >= 8 && $currentHour < 12) || ($currentHour >= 14 && $currentHour < 20);
}



function isWithinReqTime() {
    date_default_timezone_set('Asia/Kolkata');
    $currentHour = date('H');
    return ($currentHour >= 4 && $currentHour < 14); // Updated to 11 AM to match the requirement
}


// Function to check if user is within a certain radius using Haversine formula
function isWithinRadius($userLat, $userLon) {
    // Replace with your workplace coordinates
    $workplaceLat = 21.179474;
    $workplaceLon = 79.6390965;
    
    // Radius in meters
    $radius = 100; // Adjust as needed
    
    // Radius of the Earth in meters
    $earthRadius = 6371000;
    
    // Convert degrees to radians
    $userLatRad = deg2rad($userLat);
    $userLonRad = deg2rad($userLon);
    $workplaceLatRad = deg2rad($workplaceLat);
    $workplaceLonRad = deg2rad($workplaceLon);
    
    // Haversine formula
    $deltaLat = $userLatRad - $workplaceLatRad;
    $deltaLon = $userLonRad - $workplaceLonRad;
    
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
         cos($workplaceLatRad) * cos($userLatRad) *
         sin($deltaLon / 2) * sin($deltaLon / 2);
         
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    // Distance between the two points
    $distance = $earthRadius * $c;
    
    // Check if within the specified radius
    return ($distance <= $radius);
}

// Function to determine the button text based on the current time
function getButtonText() {
    date_default_timezone_set('Asia/Kolkata');
    $currentHour = date('H');
    return ($currentHour < 14) ? "Clock In" : "Clock Out"; // Updated to 2 PM for clarity
}

// Handle form submission to mark attendance
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if current time is between 8am and 11am in IST
    if (!isWithinTimeRange()) {
        $msg = "You cannot mark attendance at this time. Attendance can only be recorded during the following hours:
        - Clock In: 8 AM to 12 PM IST
        - Clock Out: 2 PM to 8 PM IST";
        
    } else {
        // Get user's current location
        $userLocation = getUserLocation();
        
        if ($userLocation) {
            list($latitude, $longitude) = $userLocation;
            
            // Check if user is within the radius
            if (isWithinRadius($latitude, $longitude)) {
                // Insert attendance record into the database
                $currentDateTime = date('Y-m-d H:i:s');
                $status = getButtonText();

                $sql = "INSERT INTO attendance (empid, attendance_date, check_in, check_out) VALUES (?, ?, ?, ?)";
                $stmt = $dbh->prepare($sql);

                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($dbh->error));
                }

                $stmt->bindParam(1, $eid, PDO::PARAM_INT);
                $stmt->bindParam(2, $currentDateTime, PDO::PARAM_STR); // Use current datetime as attendance_date
            

                // Adjusted database insertion logic
                if (isWithinReqTime()) {
                    $stmt->bindValue(3, $currentDateTime, PDO::PARAM_STR); // Use current datetime as check_in time
                    $stmt->bindValue(4, NULL, PDO::PARAM_NULL); // Set check_out to NULL initially
                } else {
                    $stmt->bindValue(3, NULL, PDO::PARAM_NULL); // Use NULL for check_in
                    $stmt->bindValue(4, $currentDateTime, PDO::PARAM_STR); // Use current datetime as check_out time
                }
                
                try {
                    if ($stmt->execute()) {
                        $msg = "Attendance marked successfully.";
                    } else {
                        $msg = "Failed to mark attendance. Please try again.";
                    }
                } catch (PDOException $e) {
                    $msg = "PDO Error: " . $e->getMessage();
                }

                $stmt->closeCursor(); // Close cursor after execution
            } else {
                $msg = "You are not within the required radius to mark attendance.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('scripts/head_scripts.php'); ?>
</head>

<body>

    <?php include_once('components/nav.php'); ?>

    <main class="content p-4">

        <div class="card p-4 ">
            <h2 class="mt-4 mb-4">Mark Attendance</h2>

            <?php if (!empty($msg)) : ?>
            <div class="alert alert-info"><?php echo $msg; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <button
                    style="width: 100%; margin-top: 20px; background-color:black; border-radius:6px; padding:4px; color:white; max-width:100%;"
                    type="submit">Mark Attendance / <?php echo getButtonText(); ?></button>
            </form>

            <hr>

            <!-- Example of using getUserLocation() function -->
            <h4>Current Location:</h4>
            <div>
                <?php $userLocation = getUserLocation();
                if ($userLocation) {
                    list($latitude, $longitude) = $userLocation;
                    echo "<p><strong>Latitude:</strong> $latitude</p>";
                    echo "<p><strong>Longitude:</strong> $longitude</p>";
                } ?>
            </div>

            <hr>

            <!-- Display current date and time -->
            <div class="alert alert-primary">
                <?php
                // Set the default timezone to Asia/Kolkata
                date_default_timezone_set('Asia/Kolkata');

                // Format the current date and time
                $currentDateTime = date('Y-m-d H:i:s');

                // Display the current date and time
                echo "<p><strong>Current Date and Time (IST):</strong> " . $currentDateTime . "</p>";
                ?>

                <p>
                    <span style="color:blue;">Check In&nbsp;&nbsp;&nbsp;&nbsp;</span>: From 8 AM to 11:59 AM.<br>
                    <span style="color:blue;">Check Out&nbsp;</span>: From 2 PM (14:00 IST) to 7:59 PM (19:00 IST).
                </p>
            </div>
        </div>

        <?php include_once('scripts/body_scripts.php'); ?>
    </main>

</body>

</html>