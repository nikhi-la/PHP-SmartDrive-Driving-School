<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SmartDrive</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Guest/Sd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Assets/Template/Student/lib/animate/animate.min.css" rel="stylesheet">
    <link href="Assets/Template/Student/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="Assets/Template/Student/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Assets/Template/Student/css/style.css" rel="stylesheet">
    
   <style>
   marquee
   {
	   color:#000066;
	   font-size: 24px;
	   
 
   }
   
   </style>
</head>


<body onLoad="phpfunction()">
<?php
include("Assets/Connection/Connection.php");
if(isset($_POST["btnsubmit"]))
{
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["enreg_id"];
		$enid=$datae["enid_number"];
		$enid++;
		$length=strlen($enid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$enqid=$reg.$zero.$enid;
		$upQry="update tbl_regid set enid_number='".$enid."' where id=1";
		$con->query($upQry);	

$insQry="insert into tbl_enquiry(enquiry_id,user_name,user_email,user_enquiry,enquiry_date)values('".$enqid."','".$_POST["gname"]."','".$_POST["gmail"]."','".$_POST["message"]."',curdate())";
if($con->query($insQry))
{	?>

        <script>
		alert("Enquiry Submitted");
	    window.location="index.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Failed");
	window.location="index.php";
		</script>
        <?php
				
	}
	
}
?>

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
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h4 class="m-0"><img src="Assets/Template/Main/img/Sd.png" width="80" height="80">SMART DRIVE</h4>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link ">Home</a>
                <a href="Guest/NewStudent.php" class="nav-item nav-link">Student Registration</a>
            </div>
            <a href="Guest/Login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="Assets/Template/Main/img/image-1.jpg" alt="Image" >
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
                    <img class="w-100" src="Assets/Template/Main/img/carousel-1.jpg" alt="Image">
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
                        <img class="position-absolute w-100 h-100" src="Assets/Template/Main/img/about-1.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="Assets/Template/Main/img/about-2.jpg" alt="" style="width: 200px; height: 200px;">
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
                            <img class="img-fluid" src="Assets/Template/Main/img/4wheeler.jpg" alt="">
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
                            <img class="img-fluid" src="Assets/Template/Main/img/bus.jpg" alt="">

                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
                   <marquee behavior="scroll" direction="right">Office Time 10.00 AM - 5.00 PM</marquee>                            

                    <div class="bg-primary text-center p-5">
                        <h1 class="mb-4">Enquiry</h1>
                        <form action="" method="post">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" autocomplete="off" id="gname" name="gname" placeholder="Gurdian Name">
                                        <label for="gname">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0" autocomplete="off" id="gmail" name="gmail" placeholder="Gurdian Email">
                                        <label for="gmail">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0" placeholder="Leave a message here" name="message" id="message" style="height: 100px"></textarea>
                                        <label for="message">Enquiry About</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit" name="btnsubmit" id="btnsubmit">Submit</button>
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
                    <h5 class="text-white mb-4"><img src="Assets/Template/Main/img/Sd.png" width="20" height="20" me-3> SMART DRIVE</h5>
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
                    &copy; <a href="">smartdrive</a>, All Right Reserved.
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
    <script src="Assets/Template/Main/lib/wow/wow.min.js"></script>
    <script src="Assets/Template/Main/lib/easing/easing.min.js"></script>
    <script src="Assets/Template/Main/lib/waypoints/waypoints.min.js"></script>
    <script src="Assets/Template/Main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="Assets/Template/Main/js/main.js"></script>
</body>

</html>
<script>
function phpfunction()
{
	<?php
	$student="S";
	$employee="E";
	$assign="AS";
	$batch="B";
	$complaint="C";
	$custom="CS";
	$district="D";
	$eattendance="EA";
	$enquiry="EQ";
	$feedback="F";
	$license="L";
	$licensetest="LT";
	$package="P";
	$packagebooking="PB";
	$packagetype="PT";
	$salary="SL";
	$slotbook="SB";
	$sattendance="SA";
	$studentslot="SS";
	$trial="T";
	$vehicle="V";
	$vehicletype="VT";

	$date=date('Y-m-d');
	$year = date('Y', strtotime($date));
	$month = date('m', strtotime($date));
	
	$studentid=$student.$year.$month;
	$empid=$employee.$year.$month;
	$assignid=$assign.$year.$month;
	$batchid=$batch.$year.$month;
	$complaintid=$complaint.$year.$month;
	$customid=$custom.$year.$month;	
	$districtid=$district.$year.$month;	
	$eattendanceid=$eattendance.$year.$month;	
	$enquiryid=$enquiry.$year.$month;	
	$feedbackid=$feedback.$year.$month;	
	$licenseid=$license.$year.$month;	
	$licensetestid=$licensetest.$year.$month;	
	$packageid=$package.$year.$month;	
	$packagebookingid=$packagebooking.$year.$month;	
	$packagetypeid=$packagetype.$year.$month;	
	$salaryid=$salary.$year.$month;	
	$slotbookid=$slotbook.$year.$month;	
	$sattendanceid=$sattendance.$year.$month;	
	$studentslotid=$studentslot.$year.$month;	
	$trialid=$trial.$year.$month;	
	$vehicleid=$vehicle.$year.$month;	
	$vehicletypeid=$vehicletype.$year.$month;	


	//Student
	
	$sel="select * from tbl_regid where sreg_id='".$studentid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set sreg_id='".$studentid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set sreg_id='".$studentid."', sid_number=0 where id=1";
	 $con->query($insQry);

	 }
	 
	 //Employee
	 
	 $sel1="select * from tbl_regid where ereg_id='".$empid."' ";
	 $row1=$con->query($sel1);
	 if(mysqli_num_rows($row1)>0)
	 {
	 $upQry1="update tbl_regid set ereg_id='".$empid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry1="update tbl_regid set ereg_id='".$empid."', eid_number=0 where id=1";
	 $con->query($insQry1);

	 }
	 
	  //Assign
	 
	 $sel2="select * from tbl_regid where asreg_id='".$assignid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set asreg_id='".$assignid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set asreg_id='".$assignid."', asid_number=0 where id=1";
	 $con->query($insQry2);

	 }
	
		  //Batch
	 
	 $sel2="select * from tbl_regid where breg_id='".$batchid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set breg_id='".$batchid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set breg_id='".$batchid."', bid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Complaint
	 
	 $sel2="select * from tbl_regid where creg_id='".$complaintid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set creg_id='".$complaintid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set creg_id='".$complaintid."', cid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Customize Package
	 
	 $sel2="select * from tbl_regid where custreg_id='".$customid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set custreg_id='".$customid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set custreg_id='".$customid."', custid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //District
	 
	 $sel2="select * from tbl_regid where dreg_id='".$districtid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set dreg_id='".$districtid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set dreg_id='".$districtid."', did_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Employee Attendance
	 
	 $sel2="select * from tbl_regid where eareg_id='".$eattendanceid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set eareg_id='".$eattendanceid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set eareg_id='".$eattendanceid."', eaid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Enquiry
	 
	 $sel2="select * from tbl_regid where enreg_id='".$enquiryid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set enreg_id='".$enquiryid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set enreg_id='".$enquiryid."', enid_number=0 where id=1";
	 $con->query($insQry2);

	 }
		  //Feedback
	 
	 $sel2="select * from tbl_regid where freg_id='".$feedbackid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set freg_id='".$feedbackid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set freg_id='".$feedbackid."', fid_number=0 where id=1";
	 $con->query($insQry2);

	 }

	//License
	
	$sel="select * from tbl_regid where lreg_id='".$licenseid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set lreg_id='".$licenseid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set lreg_id='".$licenseid."', lid_number=0 where id=1";
	 $con->query($insQry);

	 }
	 
	//License Test
	
	$sel="select * from tbl_regid where ltreg_id='".$licensetestid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set ltreg_id='".$licensetestid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set ltreg_id='".$licensetestid."', ltid_number=0 where id=1";
	 $con->query($insQry);

	 }

	 
	//Package
	
	$sel="select * from tbl_regid where preg_id='".$packageid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set preg_id='".$packageid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set preg_id='".$packageid."', pid_number=0 where id=1";
	 $con->query($insQry);

	 }

	//Package Booking
	
	$sel="select * from tbl_regid where pbreg_id='".$packagebookingid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set pbreg_id='".$packagebookingid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set pbreg_id='".$packagebookingid."', pbid_number=0 where id=1";
	 $con->query($insQry);

	 }
	//Package Type
	
	$sel="select * from tbl_regid where ptreg_id='".$packagetypeid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set ptreg_id='".$packagetypeid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set ptreg_id='".$packagetypeid."', ptid_number=0 where id=1";
	 $con->query($insQry);

	 }

	//Salary
	
	$sel="select * from tbl_regid where slreg_id='".$salaryid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set slreg_id='".$salaryid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set slreg_id='".$salaryid."', slid_number=0 where id=1";
	 $con->query($insQry);

	 }

	//Salary
	
	$sel="select * from tbl_regid where sbreg_id='".$slotbookid."' ";
	 $row=$con->query($sel);
	 if(mysqli_num_rows($row)>0)
	 {
	 $upQry="update tbl_regid set sbreg_id='".$slotbookid."' where id=1";
	 $con->query($upQry);
	 }
	 else
	 {
	 $insQry="update tbl_regid set sbreg_id='".$slotbookid."', sbid_number=0 where id=1";
	 $con->query($insQry);

	 }
		  //Student Attendance
	 
	 $sel2="select * from tbl_regid where sareg_id='".$sattendanceid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set sareg_id='".$sattendanceid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set sareg_id='".$sattendanceid."', said_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Student Slot
	 
	 $sel2="select * from tbl_regid where ssreg_id='".$studentslotid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set ssreg_id='".$studentslotid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set ssreg_id='".$studentslotid."', ssid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Trial
	 
	 $sel2="select * from tbl_regid where treg_id='".$trialid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set treg_id='".$trialid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set treg_id='".$trialid."', tid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Vehicle
	 
	 $sel2="select * from tbl_regid where vreg_id='".$vehicleid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set vreg_id='".$vehicleid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set vreg_id='".$vehicleid."', vid_number=0 where id=1";
	 $con->query($insQry2);

	 }

		  //Vehicle Type
	 
	 $sel2="select * from tbl_regid where vtreg_id='".$vehicletypeid."' ";
	 $row2=$con->query($sel2);
	 if(mysqli_num_rows($row2)>0)
	 {
	 $upQry1="update tbl_regid set vtreg_id='".$vehicletypeid."' where id=1";
	 $con->query($upQry1);
	 }
	 else
	 {
	 $insQry2="update tbl_regid set vtreg_id='".$vehicletypeid."', vtid_number=0 where id=1";
	 $con->query($insQry2);

	 }


	?>
}
</script>
