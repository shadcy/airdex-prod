<?php
session_start();
error_reporting(0);
include('scripts/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{




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
        <div class="row">
            <!-- Row starts here -->


            <div class="col s12 m12 l12">
                <div class="table-responsive" style="background-color:white; border-radius:9px;">
                    <div class="table table-centered table-nowrap mb-0 rounded p-4">
                        <span class="card-title">Leave Details</span>
                        <?php if($msg) {?>
                        <div class="succWrap">
                            <strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?>
                        </div>
                        <?php }?>
                        <table id="example" class="table table-centered table-nowrap mb-0 rounded ">
                            <tbody>
                                <?php 
                    $lid=intval($_GET['leaveid']);
                    $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':lid',$lid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0) {
                        foreach($results as $result) {         
                    ?>
                                <tr>
                                    <td style="font-size:16px;"> <b>Employe Name :</b></td>
                                    <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?></td>
                                    <td style="font-size:16px;"><b>Emp Id :</b></td>
                                    <td><?php echo htmlentities($result->EmpId);?></td>
                                    <td style="font-size:16px;"><b>Gender :</b></td>
                                    <td><?php echo htmlentities($result->Gender);?></td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>Emp Email id :</b></td>
                                    <td><?php echo htmlentities($result->EmailId);?></td>
                                    <td style="font-size:16px;"><b>Emp Contact No. :</b></td>
                                    <td><?php echo htmlentities($result->Phonenumber);?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>Leave Type :</b></td>
                                    <td><?php echo htmlentities($result->LeaveType);?></td>
                                    <td style="font-size:16px;"><b>Leave Date . :</b></td>
                                    <td>From <?php echo htmlentities($result->FromDate);?> to
                                        <?php echo htmlentities($result->ToDate);?></td>
                                    <td style="font-size:16px;"><b>Posting Date</b></td>
                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>Employe Leave Description : </b></td>
                                    <td colspan="5"><?php echo htmlentities($result->Description);?></td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>leave Status :</b></td>
                                    <td colspan="5"><?php 
                        $stats=$result->Status;
                        if($stats==1){?>
                                        <span style="color: green">Approved</span>
                                        <?php } 
                        if($stats==2)  { ?>
                                        <span style="color: red">Not Approved</span>
                                        <?php } 
                        if($stats==0)  { ?>
                                        <span style="color: blue">waiting for approval</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>Admin Remark: </b></td>
                                    <td colspan="5"><?php
                        if($result->AdminRemark==""){
                          echo "waiting for Approval";  
                        }
                        else{
                            echo htmlentities($result->AdminRemark);
                        }
                        ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;"><b>Admin Action taken date : </b></td>
                                    <td colspan="5"><?php
                        if($result->AdminRemarkDate==""){
                          echo "NA";  
                        }
                        else{
                            echo htmlentities($result->AdminRemarkDate);
                        }
                        ?></td>
                                </tr>
                                <?php $cnt++;} }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Row ends here -->
        </div>
        <div class="row">
            <!-- Row starts here -->


            <!-- Row ends here -->
        </div>
        <?php include_once('components/page_components/settings.php'); ?>


        <?php include_once('components/page_components/footer.php'); ?>
    </main>




    <?php include_once('scripts/body_scripts.php'); ?>
</body>

</html>

<?php } ?>