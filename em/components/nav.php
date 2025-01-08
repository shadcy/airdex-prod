<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../index.html">
        <img class="navbar-brand-dark" src="assets/img/brand/light.svg" alt="Volt logo" /> <img
            class="navbar-brand-light" src="assets/img/brand/dark.svg" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white"
                        alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi,

                        <?php 
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
                        <span class="h5 mb-3"> <?php echo htmlentities($result->FirstName);?><br />
                            <span>Em ID: <?php echo htmlentities($result->EmpId)?></span>
                            <?php }} ?>
                        </span>

                    </h2>
                    <a href="logout.php" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Sign Out
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="/" class="nav-link d-flex align-items-center bg- px-4 py-2 text-black">
                    <span class="sidebar-icon">
                        <img src="assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text text-white" style=''><b>AIR<u>DEX</u></b> <span
                            class="badge bg-secondary">shukai</span></span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider mt-4  border-gray-700"></li>


            <!--  Dashboard Content -->
            <li class="nav-item  ">
                <a href="dashboard.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path
                                d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>



            <!--  Dashboard Content -->
            <li class="nav-item  ">
                <a href="profile.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path
                                d="M6 22h13a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h1zm6-17.001c1.647 0 3 1.351 3 3C15 9.647 13.647 11 12 11S9 9.647 9 7.999c0-1.649 1.353-3 3-3zM6 17.25c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18H6v-.75z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">My profile</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider   border-gray-700"></li>


            <li class="nav-item  ">
                <a href="markattendance.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path
                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm1 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Mark Attendance</span>
                </a>
            </li>


            <li class="nav-item  ">
                <a href="attendancehistory.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                            <path
                                d="M4 7h11v2H4zm0 4h11v2H4zm0 4h7v2H4zm15.299-2.708-4.3 4.291-1.292-1.291-1.414 1.415 2.706 2.704 5.712-5.703z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Attendance History</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider   border-gray-700"></li>


            <li class="nav-item  ">
                <a href="applyforleave.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path
                                d="m21.706 5.292-2.999-2.999A.996.996 0 0 0 18 2H6a.996.996 0 0 0-.707.293L2.294 5.292A.994.994 0 0 0 2 6v13c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a.994.994 0 0 0-.294-.708zM6.414 4h11.172l1 1H5.414l1-1zM14 14v3h-4v-3H7l5-5 5 5h-3z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Apply for Leave</span>
                </a>
            </li>



            <li class="nav-item  ">
                <a href="leavehistory.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path d="M12 8v5h5v-2h-3V8z"></path>
                            <path
                                d="M21.292 8.497a8.957 8.957 0 0 0-1.928-2.862 9.004 9.004 0 0 0-4.55-2.452 9.09 9.09 0 0 0-3.626 0 8.965 8.965 0 0 0-4.552 2.453 9.048 9.048 0 0 0-1.928 2.86A8.963 8.963 0 0 0 4 12l.001.025H2L5 16l3-3.975H6.001L6 12a6.957 6.957 0 0 1 1.195-3.913 7.066 7.066 0 0 1 1.891-1.892 7.034 7.034 0 0 1 2.503-1.054 7.003 7.003 0 0 1 8.269 5.445 7.117 7.117 0 0 1 0 2.824 6.936 6.936 0 0 1-1.054 2.503c-.25.371-.537.72-.854 1.036a7.058 7.058 0 0 1-2.225 1.501 6.98 6.98 0 0 1-1.313.408 7.117 7.117 0 0 1-2.823 0 6.957 6.957 0 0 1-2.501-1.053 7.066 7.066 0 0 1-1.037-.855l-1.414 1.414A8.985 8.985 0 0 0 13 21a9.05 9.05 0 0 0 3.503-.707 9.009 9.009 0 0 0 3.959-3.26A8.968 8.968 0 0 0 22 12a8.928 8.928 0 0 0-.708-3.503z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Leave History</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider   border-gray-700"></li>


            <li class="nav-item  ">
                <a href="salary.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <circle cx="15.5" cy="13.5" r="2.5"></circle>
                            <path
                                d="M12 13.5c0-.815.396-1.532 1-1.988A2.47 2.47 0 0 0 11.5 11a2.5 2.5 0 1 0 0 5 2.47 2.47 0 0 0 1.5-.512 2.486 2.486 0 0 1-1-1.988z">
                            </path>
                            <path
                                d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM4 18V6h16l.002 12H4z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Salary</span>
                </a>
            </li>




            <li class="nav-item  ">
                <a href="markattendancehistory.php" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                            <path
                                d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Salary Calendar</span>
                </a>
            </li>
            <li role="separator" class="dropdown-divider  border-gray-700"></li>

            <li class="nav-item">
                <a href="chatwithadmin.php" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                            <path
                                d="M4 18h2v4.081L11.101 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2z">
                            </path>
                            <path
                                d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Chat /<span style="color:orange;">@akshay</span> </span>
                </a>
            </li>



            <li role="separator" class="dropdown-divider border-gray-700"></li>

            <li class="nav-item">
                <a href="changepassword.php" target="_blank" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 239, 239, 1);transform: ;msFilter:;">
                            <path
                                d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z">
                            </path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Change Password </span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider  mb-3 border-gray-700"></li>

            <li class="nav-item">
                <a href="ImageHandler.php" target="_blank" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(245, 243, 243, 1);transform: ;msFilter:;">
                            <path
                                d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z">
                            </path>
                            <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">ImgH <span
                            style=' font-size:13px; background-color:white; color:black; padding:4px; border-radius:3px;'>shukaitrust.co.in</span></span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider  mb-3 border-gray-700"></li>

            <li class="nav-item">
                <a href="#" target="_blank" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Documentation <span
                            class="badge badge-sm bg-secondary ms-1 text-gray-800">v1.4</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="https://shukaitrust.co.in" target="_blank" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="assets/img/themesberg.svg" height="20" width="28" alt="Themesberg Logo">
                    </span>
                    <span class="sidebar-text">Go to Website</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="https://shukaitrust.co.in"
                    class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
                    <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span>shukaitrust.co.in</span>
                </a>
            </li>
        </ul>
    </div>
</nav>