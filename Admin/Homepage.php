<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SmartDrive</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../Assets/Template/Admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="Sd.png" />
  </head>
  <body>
    
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a href="Homepage.php"><img src="Sd.png" width="55" height="55"  /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-xl-block">
            <form class="d-flex align-items-center h-100" action="#">
              
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
           
            
            
               
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../Assets/Template/Admin/assets/images/faces/admin.jpg" alt="image">
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Admin</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <div class="p-3 text-center bg-primary">
                  <img class="img-avatar img-avatar48 img-avatar-thumb" src="../Assets/Template/Admin/assets/images/faces/admin.jpg" alt="">
                </div>
                <div class="p-2">
                  <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="MyProfile.php">
                    <span>Profile</span>
                    <span class="p-0">
                      
                      <i class="mdi mdi-account-outline "></i>
                    </span>
                  </a>
                 
                  <div role="separator" class="dropdown-divider"></div>
                  <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
              
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="../Guest/Login.php">
                    <span>Log Out</span>
                    <i class="mdi mdi-logout ml-1"></i>
                  </a>
                </div>
              </div>
            </li>
           
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
              <a class="nav-link" href="Homepage.php">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-map menu-icon"></i></span>
                <span class="menu-title">Location</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="District.php">District</a></li>
                  
                </ul>
              </div>
            </li>
            
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="icon-bg"><i class="mdi mdi-table  menu-icon"></i></span>
                <span class="menu-title">Type</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="Packagetype.php"> Package Type</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Vehicletype.php"> Vehicle Type</a></li>
                  
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#class" aria-expanded="false" aria-controls="class">
                <span class="icon-bg"><i class="mdi mdi-application menu-icon"></i></span>
                <span class="menu-title">Registration</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="class">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="NewEmployee.php">Employee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Package.php">Package</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Vehicle.php">Vehicle</a></li>
                 
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#basic" aria-expanded="false" aria-controls="basic">
                <span class="icon-bg"><i class="mdi mdi-checkbox-marked-circle-outline menu-icon"></i></span>
                <span class="menu-title">Verification</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="NewStudentlist.php">New Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewBookedPackages.php">Booked Package</a></li>
                  </ul>
              </div>
                </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ver" aria-expanded="false" aria-controls="ver">
                <span class="icon-bg"><i class="mdi mdi-checkbox-multiple-marked-circle-outline menu-icon"></i></span>
                <span class="menu-title">Verified</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ver">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="AcceptedStudent.php">Accepted Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="RejectedStudent.php">Rejected Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="AcceptedPackages.php">Accepted Package</a></li>
                  <li class="nav-item"> <a class="nav-link" href="RejectedPackages.php">Rejected Package</a></li>
                  </ul>
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#license" aria-expanded="false" aria-controls="license">
                <span class="icon-bg"><i class="mdi mdi-map menu-icon"></i></span>
                <span class="menu-title">License</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="license">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do">RTO</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewLicenseDetails.php">License Details</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewLicenseDates.php">License Dates</a></li>
                  </ul>
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#resign" aria-expanded="false" aria-controls="resign">
                <span class="icon-bg"><i class="mdi mdi-map menu-icon"></i></span>
                <span class="menu-title">Resign</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="resign">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="ViewEmployee.php">Employee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewDeparturedEmp.php">View Resigned Employee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewStudent.php">Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewDeparturedStudent.php">View Resigned Student</a></li>
                  </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#oth" aria-expanded="false" aria-controls="oth">
                <span class="icon-bg"><i class="mdi mdi-more menu-icon"></i></span>
                <span class="menu-title">Other Data</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="oth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="AssignStudent.php">Assign Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Batch.php">Batch & Slot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="AttendanceN.php">Attendance</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="EmployeeSalary.php">Salary</a></li>                 
                  </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#view" aria-expanded="false" aria-controls="view">
                <span class="icon-bg"><i class="mdi mdi-view-agenda menu-icon"></i></span>
                <span class="menu-title">View</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="view">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="EmployeeList.php">Employees</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewASsignedEmp&Stu.php">Assigned Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewBookedSlot.php">Booked Slot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewLicenseDates.php">License Dates</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewSalary.php">View Salary</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewComplaint.php">Complaint View</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewFeedback.php">Feedback View</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ViewEnquiry.php">Enquiry View</a></li>
                  </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#rep" aria-expanded="false" aria-controls="rep">
                <span class="icon-bg"><i class="mdi mdi-view-agenda menu-icon"></i></span>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="rep">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="StudentSearchReport.php"> Student Search</a></li>
                  <li class="nav-item"> <a class="nav-link" href="EmpSearchReport.php"> Employee Search</a></li>

                  <li class="nav-item"> <a class="nav-link" href="LicenseLearnersReport.php">License Leaners</a></li>
                  <li class="nav-item"> <a class="nav-link" href="LicenseTestReport.php">License Test</a></li>
                  <li class="nav-item"> <a class="nav-link" href="LicenseStatusReport.php">License Status</a></li>
                  <li class="nav-item"> <a class="nav-link" href="Transaction.php">Packages</a></li>
                  <li class="nav-item"> <a class="nav-link" href="PackageBookedReport.php">BookedNotPayed Package </a></li>
                  <li class="nav-item"> <a class="nav-link" href="ResignedStudentReport.php">Resigned Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ResignedEmployeeReport.php">Resigned Employee</a></li>

                  <li class="nav-item"> <a class="nav-link" href="EmpAttendanceReport.php">Employee Attendance </a></li>
                  <li class="nav-item"> <a class="nav-link" href="StudentAttendanceReport.php">Student Attendance </a></li>
                  <li class="nav-item"> <a class="nav-link" href="BookedSlotReport.php">Booked Slot </a></li>
                  <li class="nav-item"> <a class="nav-link" href="BookedTrialSlotReport.php">Booked Trial Slot </a></li>
                  <li class="nav-item"> <a class="nav-link" href="SalaryReport.php">Salary Report </a></li>

                  </ul>
              </div>
            </li>
           
            <li class="nav-item sidebar-user-actions">
              <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      <div class="sidebar-profile-img">
                        <img src="../Assets/Template/Admin/assets/images/faces/admin.jpg" alt="image">
                      </div>
                      <div class="sidebar-profile-text">
                        <p class="mb-1">Admin</p>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#set" aria-expanded="false" aria-controls="set">
                <span class="icon-bg"><i class="mdi mdi-account-outline"></i></span>
                <span class="menu-title">Profile</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="set">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="MyProfile.php">Profile</a></li>
                  <li class="nav-item"> <a class="nav-link" href="EditProfile.php">Edit Profile</a></li>
                  <li class="nav-item"> <a class="nav-link" href="ChangePassword.php">Change Password</a></li>
                  
                  </ul>
              </div>
            </li>
            
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="../Guest/Login.php" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Log Out</span></a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="d-xl-flex justify-content-between align-items-start">
              <h1 align="center" class="text-dark font-weight-bold mb-2 "> Dashboard </h1> 
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-2 text-dark font-weight-bold">Attendance</h2>
                            <a href="AttendanceN.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/attendance.jpg" width="220" height="250" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Package</h2>
                            <a href="Package.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/packages.jpg" width="220" height="250" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Customer Records</h2>
                            <a href="AcceptedStudent.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/CustomerRecord.jpg" width="200" height="220" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Salary </h2>
                            <p>&nbsp;</p>
                         <a href="ViewSalary.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/salary.jpg" width="200" height="220" alt="image"></a>                          

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-2 text-dark font-weight-bold">Time Slot</h2>
                            <a href="Batch.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/timeslot.jpg" width="220" height="250" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Vehicle</h2>
                            <a href="Vehicle.php"> <img src="../Assets/Template/Admin/assets/images/dashboard/vehicle.jpg" width="220" height="250" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">License RTO</h2>
                            <a href="https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do"> <img src="../Assets/Template/Admin/assets/images/dashboard/licenceRTO.jpg" width="200" height="220" alt="image"></a>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Invoice</h2>
                         <img src="../Assets/Template/Admin/assets/images/dashboard/invoice.jpg" width="200" height="220" alt="image"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                   </div>
                  </div> 
    <!-- plugins:js -->
    <script src="../Assets/Template/Admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../Assets/Template/Admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../Assets/Template/Admin/assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../Assets/Template/Admin/assets/js/off-canvas.js"></script>
    <script src="../Assets/Template/Admin/assets/js/hoverable-collapse.js"></script>
    <script src="../Assets/Template/Admin/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../Assets/Template/Admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>