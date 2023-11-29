<?php

	$sel="select * from tbl_student  where student_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);	
	$data=$row->fetch_assoc();
	
	?>
<!DOCTYPE html>
<html lang="en">

<head>
<style>
.image1 {
  border-radius: 50%;
  border: 2px solid #0C2B4B;
}
</style>

    <meta charset="utf-8">
    <title>SmartDrive</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Sd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Template/Student/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../Assets/Template/Student/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Template/Student/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Template/Student/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small> Perumbavoor, Ernakulam, Kerala</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <small class="fa fa-envelope text-primary me-2"></small>
                    <small> smartdrive46@gmail.com</small>
              </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+91 9745620479</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="https://twitter.com/i/flow/login"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-square btn-link rounded-0" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="Homepage.php" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h4 class="m-0"><img src="../Assets/Template/Student/img/Sd.png" width="80" height="80">SMART DRIVE</h4>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="Homepage.php" class="nav-item nav-link "><p></p>Home</a>
                <div class="nav-item dropdown"><p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">License</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="LicenseStatus.php" class="dropdown-item">License Status</a>
                        <a href="ViewLicenseStatus.php"class="dropdown-item">Test Details</a>
                        <a href="LicenseDocuments.php"class="dropdown-item">View Uploaded Details</a>
                    </div>
                </div>
                <a href="https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do" class="nav-item nav-link"><p></p>RTO</a>

                <div class="nav-item dropdown"><p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Packages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="SearchPackage.php" class="dropdown-item">Packages</a>
                        <a href="CustomizePackage.php"class="dropdown-item">Customize Package</a>
                        <a href="ViewBookedPackages.php" class="dropdown-item">Booked Packages</a>

                    </div>
                </div>
              <div class="nav-item dropdown"><p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Slot</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="ViewAssignedEmployee.php" class="dropdown-item">Trainer & Slot</a>
                        <a href="viewBookedSlot.php" class="dropdown-item">Booked Slot</a>
                        <a href="ViewBookedTrialSlot.php" class="dropdown-item">Booked Trial Slot</a>
                    </div>
                </div>
                <a href="ViewAttendance.php" class="nav-item nav-link"><p></p>Attendance</a>
             
			
              <div class="nav-item dropdown"><p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Support</a>
                    <div class="dropdown-menu bg-light m-0">
                         <a href="Complaint.php" class="dropdown-item">Complaint</a>
                        <a href="Feedback.php" class="dropdown-item">Feedback</a>
                     </div>
                </div>
		
             <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img class="image1" src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"];?>" width="55" height="55" />  ACCOUNT</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="MyProfile.php" class="dropdown-item">My Profile</a>
                        <a href="EditProfile.php" class="dropdown-item">Edit Profile</a>
                        <a href="ChangePassword.php" class="dropdown-item">Change Password</a>
                         <a href="../Guest/Login.php" class="dropdown-item">Log Out</a>
                    </div>
                </div>
		</div>
	</div>

    </nav>
    <!-- Navbar End -->
