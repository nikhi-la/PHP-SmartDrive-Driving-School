
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
 
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
   <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

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
                <a href="Homepage.php" class="nav-item nav-link "> <p></p>Home</a>
            <div class="nav-item dropdown"> <p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">License</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="LicenseStatus.php" class="dropdown-item">License Status</a>
                        <a href="ViewLicenseStatus.php"class="dropdown-item">Test Details</a>
                        <a href="LicenseDocuments.php"class="dropdown-item">View Uploaded Details</a>
                    </div>
                </div>
                <a href="https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do" class="nav-item nav-link"><p></p>RTO</a>

                <div class="nav-item dropdown">  <p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Packages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="SearchPackage.php" class="dropdown-item">Packages</a>
                        <a href="CustomizePackage.php"class="dropdown-item">Customize Package</a>
                        <a href="ViewBookedPackages.php" class="dropdown-item">Booked Packages</a>
                    </div>
                </div>
              			
              <div class="nav-item dropdown"> <p></p>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Slot</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="ViewAssignedEmployee.php" class="dropdown-item">Trainer & Slot</a>
                        <a href="viewBookedSlot.php" class="dropdown-item">Booked Slot</a>
                        <a href="ViewBookedTrialSlot.php" class="dropdown-item">Booked Trial Slot</a>
                    </div>
            </div>
                <a href="ViewAttendance.php" class="nav-item nav-link"><p></p>Attendance</a>
             
			
              <div class="nav-item dropdown">
                   <p></p>
                    <p><a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Support</a>
                    </p>
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


    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../Assets/Template/Student/img\image-1.jpg" alt="Image" >
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-2 text-light mb-5 animated slideInDown">SAFE RIDE ON YOUR LIFE</h1>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../Assets/Template/Student/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-2 text-light mb-5 animated slideInDown">Safe Driving Is Our Top Priority</h1>
                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-car text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Easy Driving Learn </h5>
					<span>We make driving easy and safer for you</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Trained Instructor</h5>
					<span>Well trained instructors are there for you</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-file-alt text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Get licence</h5>
					<span>Get Your license in your first try</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->



    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="../Assets/Template/Student/img/about-1.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="../Assets/Template/Student/img/about-2.jpg" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">About Us</h6>
                        <h1 class="display-6 mb-4">We Help Students To Pass Test & Get A License On The First Try</h1>
                        <p>Safe driving on today’s roads requires a higher level of confidence and competence than ever before. Our meticulously designed courses help transform beginners into skilled and confident drivers.</p>
                        <div class="row g-2 mb-4 pb-2">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Flexible Timings
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Standard Vehicles
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Safety Driving 
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Experienced Trainers
                            </div>
                        </div>
                        <div class="row g-4">
                           <div class="col-sm-6">
                                <a class="d-inline-flex align-items-center btn btn-outline-primary border-2 p-2" href="tel:+0123456789">
                                    <span class="flex-shrink-0 btn-square bg-primary">
                                        <i class="fa fa-phone-alt text-white"></i>
                                    </span>
                                    <span class="px-3">+91 9745620479</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Courses Start -->
    <div class="container-xxl courses my-6 py-6 pb-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Trending Courses</h6>
                <h1 class="display-6 mb-4">Our Courses Upskill You With Driving Training</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">...</div>
                            <h5 class="mb-3">Light Motor Driving Course</h5>
                            <p>Courses offered for both two wheeler and four wheeler</p>
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Beginner</li>
					   <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Advanced</li>
                            </ol> 
					<ol class="breadcrumb justify-content-center mb-0">
				   <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>15 Days</li>
				   <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>30 Days</li>

                            </ol>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="../Assets/Template/Student/img/4wheeler.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">...</div>
                            <h5 class="mb-3">Heavy Equipments Training</h5>
                            <p>Courses offered for both two wheeler and four wheeler</p>
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Beginner</li>
					   <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Advanced</li>
                            </ol> 
					<ol class="breadcrumb justify-content-center mb-0">
				   <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>15 Days</li>
				   <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>30 Days</li>

                            </ol>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="../Assets/Template/Student/img/bus.jpg" alt="">

                        </div>
                    </div>
                </div>
                
                                
                <div class="col-lg-8 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-primary text-center p-5">
                        <h3 class="mb-4">Response</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
						<a class="btn btn-dark w-100 py-3" href="Complaint.php">Complaint</a>
                                    </div>
                                </div>
					<div class="col-sm-6">
                                   <div class="form-floating">
						<a class="btn btn-dark w-100 py-3" href="Feedback.php">Feedback</a>
                                    </div>
                               </div>
				</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->


 
  <!-- Footer Start -->
    <div class="container-fluid bg-dark  text-light footer my-6 mb-0 py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container" >
            <div class="row g-5" >
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Get In Touch</h4>
                    <h5 class="text-white mb-4"><img src="../Assets/Template/Student/img/Sd.png" width="20" height="20" me-3> SMART DRIVE</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Perumbavoor, Ernakulam, Kerala</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 9745620479</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>smartdrive46@gmail.com</p>
                </div>
                               
                <div class="col-lg-3 col-md-6">
                 <h6 class="text-white mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light me-1" href="https://twitter.com/i/flow/login"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-outline-light me-0" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="Homepage.php">smartdrive</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Template/Student/lib/wow/wow.min.js"></script>
    <script src="../Assets/Template/Student/lib/easing/easing.min.js"></script>
    <script src="../Assets/Template/Student/lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets/Template/Student/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets/Template/Student/js/main.js"></script>
</body>

</html>