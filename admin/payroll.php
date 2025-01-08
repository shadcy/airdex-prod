<?php
// Start session and include necessary files
session_start();
error_reporting(0);
include('includes/config.php'); // Adjust path as per your file structure

// Check if user is logged in
if(strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit(); // Stop further execution
}

// Initialize variables
$msg = '';
$error = '';

// Handle form submission for updating salary
if(isset($_POST['update'])) {
    try {
        // Validate inputs (you should add more validation as per your requirements)
        $empid = $_POST['empid'];
        $new_salary = $_POST['new_salary'];

        // Update query
        $sql = "UPDATE tblemployees SET salary = :new_salary WHERE EmpId = :empid";
        $query = $dbh->prepare($sql);

        // Bind parameters
        $query->bindParam(':new_salary', $new_salary, PDO::PARAM_INT);
        $query->bindParam(':empid', $empid, PDO::PARAM_INT);

        // Execute query
        $query->execute();

        // Check if update was successful
        if($query->rowCount() > 0) {
            $msg = "Salary updated successfully.";
        } else {
            $error = "Failed to update salary.";
        }
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Handle form submission for deleting salary
if(isset($_POST['delete'])) {
    try {
        // Validate inputs (you should add more validation as per your requirements)
        $empid = $_POST['empid'];

        // Delete (set to NULL) query
        $sql = "UPDATE tblemployees SET salary = NULL WHERE EmpId = :empid";
        $query = $dbh->prepare($sql);

        // Bind parameter
        $query->bindParam(':empid', $empid, PDO::PARAM_INT);

        // Execute query
        $query->execute();

        // Check if deletion was successful
        if($query->rowCount() > 0) {
            $msg = "Salary deleted successfully.";
        } else {
            $error = "Failed to delete salary.";
        }
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Fetch all employees for displaying salary update/delete form
$sql_select_employees = "SELECT * FROM tblemployees ORDER BY salary ASC";
$query_select_employees = $dbh->prepare($sql_select_employees);
$query_select_employees->execute();
$employees = $query_select_employees->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('scripts/head_scripts.php'); ?>

</head>

<body>



    <?php include('includes/nav.php'); ?>

    <main class="content">

        <footer class="bg-white rounded shadow p-3 mb-4 mt-4">

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update Employee Salary</title>
                <!-- Include any necessary CSS or JavaScript files -->
            </head>

            <body>
                <div class="container">
                    <h2>Payroll Manager <span class="badge bg-primary">Payroll</span></h2>
                    <?php if($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <div class=""><?php echo htmlentities($error); ?></div>
                    </div>
                    <?php elseif($msg): ?>
                    <div class="alert alert-success" role="alert">
                        <div class="succWrap"><?php echo htmlentities($msg); ?></div>
                    </div>

                    <?php endif; ?>

                    <!-- Display form for updating/deleting salary -->
                    <!-- Display form for updating/deleting salary -->
                    <form method="post" action="">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Current Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="empid"
                                                    id="emp_<?php echo $employee['EmpId']; ?>"
                                                    value="<?php echo $employee['EmpId']; ?>">
                                                <label class="form-check-label"
                                                    for="emp_<?php echo $employee['EmpId']; ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo $employee['FirstName'] . ' ' . $employee['LastName']; ?></td>
                                        <td><?php echo isset($employee['salary']) ? $employee['salary'] : 'No Salary Set'; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="input-field col s12">
                            <input class="form-control" type="number" name="new_salary" placeholder="New Salary">
                        </div>
                        <br>
                        <div class="input-field col s12">
                            <button type="submit" name="update" class="waves-effect waves-light btn btn-primary">Update
                                Salary</button>
                            <button type="submit" name="delete" class="waves-effect waves-light btn btn-danger">Delete
                                Salary</button>
                        </div>
                    </form>


                </div>

                <!-- Include JavaScript libraries -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('select').formSelect();
                });
                </script>
            </body>

            </html>




        </footer>


        <?php include('includes/footer.php'); ?>

    </main>

    <?php include('scripts/body_scripts.php'); ?>
</body>

</html>