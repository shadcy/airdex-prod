<?php
if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $error_message = ""; // Variable to store error message

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $error_message .= "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $error_message .= "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) { // Size limit can be adjusted
        $error_message .= "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error_message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>document.addEventListener('DOMContentLoaded', function () {
                var toastHTML = '<span>$error_message</span><button class=\"btn-flat toast-action\">Close</button>';
                M.toast({html: toastHTML});
            });
        </script>";
        echo "Sorry, there was an error uploading your file."; // Move this inside the else block
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

            // Save the file path and name to the database
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            $imagePath = $target_file;

            include('scripts/config.php');

            $sql = "INSERT INTO tblimages (ImageName, ImagePath) VALUES ('$imageName', '$imagePath')";

            if ($dbh->query($sql) === TRUE) {
                echo "Image metadata saved successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $dbh->errorInfo()[2]; // Use errorInfo() to get error message
            }
            $dbh = null; // Close the database connection
            
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function () {
                var toastHTML = '<span>Sorry, there was an error uploading your file.</span><button class=\"btn-flat toast-action\">Close</button>';
                M.toast({html: toastHTML});
            });
        </script>";
        }
    }
}
?>