<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from  tbldepartments  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Department record deleted";

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





        <div class="card card-body border-0 shadow table-wrapper table-responsive">




            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="border-gray-200">Sr no</th>
                        <th class="border-gray-200">Dept Name</th>
                        <th class="border-gray-200">Dept Short Name</th>
                        <th class="border-gray-200">Dept Code</th>
                        <th class="border-gray-200">Creation Date</th>
                        <th class="border-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item -->


                    <?php $sql = "SELECT * from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>


                    <tr>
                        <td>
                            <a href="#" class="fw-bold">
                                <?php echo htmlentities($cnt);?></b>
                            </a>
                        </td>
                        <td>
                            <?php echo htmlentities($result->DepartmentName);?>
                        </td>
                        <td><span class="fw-normal"><?php echo htmlentities($result->DepartmentShortName);?></span></td>
                        <td><span class="fw-normal"><?php echo htmlentities($result->DepartmentCode);?></span></td>
                        <td><span class="fw-bold"><?php echo htmlentities($result->CreationDate);?></span></td>
                        <td><span class="fw-bold text-warning"><a
                                    href="editdepartment.php?deptid=<?php echo htmlentities($result->id);?>"><i
                                        class="material-icons">mode_edit</i></a><a
                                    href="managedepartments.php?del=<?php echo htmlentities($result->id);?>"
                                    onclick="return confirm('Do you want to delete');"> <i
                                        class="material-icons">delete_forever</i></a></span></td>

                    </tr>
                    <!-- Item -->
                    <?php $cnt++;} }?>
                </tbody>
            </table>
            <div
                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <nav aria-label="Page navigation example">
                    <ul class="pagination mb-0">
                        <li class="page-item">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">5</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">Showing <b>1</b> out of <b>1</b> entries</div>
            </div>
        </div>








        <?php include('includes/footer.php'); ?>

    </main>

    <?php include('scripts/body_scripts.php'); ?>
</body>

</html><?php } ?>