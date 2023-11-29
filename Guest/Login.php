<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Login</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../Assets/Template/Login/css/style.css">

</head>

<body >
<?php
include("../Assets/Connection/Connection.php");

session_start();
if(isset($_POST["btnsave"]))
{  
$studentemail="";
$studentpass="";
$empemail="";
$emppass="";
$adminemail="";
$adminpass="";
 
 	$selStudent="select * from tbl_student where student_email='".$_POST["txt_email"]."' and student_password='".$_POST["txt_pass"]."' and student_vstatus=1" ;
	$row1=$con->query($selStudent);
	$data1=$row1->fetch_assoc();
	if(mysqli_num_rows($row1)>0)
	{
	$studentemail=$data1["student_email"];
	$studentpass=$data1["student_password"];
	}
	
	$selEmployee="select * from tbl_employee where emp_email='".$_POST["txt_email"]."' and emp_password='".$_POST["txt_pass"]."'";
	$row2=$con->query($selEmployee);
	$data2=$row2->fetch_assoc();
	if(mysqli_num_rows($row2)>0)
	{
	$empemail=$data2["emp_email"];
	$emppass=$data2["emp_password"];
	}
	$selAdmin="select * from tbl_admin where admin_email='".$_POST["txt_email"]."' and admin_password='".$_POST["txt_pass"]."'";
	$row3=$con->query($selAdmin);
	$data3=$row3->fetch_assoc();
	if(mysqli_num_rows($row3)>0)
	{
	$adminemail=$data3["admin_email"];
	$adminpass=$data3["admin_password"];
	}

	if(($studentemail==$_POST["txt_email"])&&($studentpass==$_POST["txt_pass"]))
	{
		$_SESSION["uid"]=$data1["student_id"];
		$_SESSION["username"]=$data1["student_name"];
			$_SESSION["email"]=$data1["student_email"];
		header("Location:../Student/Homepage.php");
  	}
	else if($empemail==$_POST["txt_email"]&&$emppass==$_POST["txt_pass"])
	{
	
		$_SESSION["uid"]=$data2["emp_id"];
		$_SESSION["username"]=$data2["emp_name"];
		header("Location:../Employee/Homepage.php");
		
	}
	else if($adminemail==$_POST["txt_email"]&&$adminpass==$_POST["txt_pass"])
	{
	
		$_SESSION["uid"]=$data3["admin_id"];
		$_SESSION["username"]=$data3["admin_name"];
		header("Location:../Admin/Homepage.php");
		
	}
	
	else
	{
		?>

		<script>
		alert("Invalid User");
		window.location="Login.php";
		</script>
        <?php
	}
}

?>
<section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
                    <center>
						<img src="Sd.png" width="250" height="250"/></center>
						<div class="login-wrap p-3 p-md-5">
			      		<div class="form-group mt-0">
			      			<form action="#" class="signin-form" method="post">
			      			<input type="email" class="form-control" name="txt_email" required autocomplete="off">
			      			<label class="form-control-placeholder" for="username">Email</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" class="form-control" name="txt_pass" required autocomplete="off">
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="btnsave" onclick="sendEmail()"  class="form-control btn btn-primary rounded submit px-3">Log In</button>
		            </div>
	          </form>
		          <p class="text-center"> <a  href="RecoveryPassword.php">Forgot Password</a></p>
		          <p class="text-center">Don't have an account? <a  href="NewStudent.php">Sign Up</a></p>
		          <p class="text-center"> <a  href="../index.php">Back To Home</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
	<script src="../Assets/Template/Login/js/jquery.min.js"></script>
  <script src="../Assets/Template/Login/js/popper.js"></script>
  <script src="../Assets/Template/Login/js/bootstrap.min.js"></script>
  <script src="../Assets/Template/Login/js/main.js"></script>
</body>
</html>

<script>
//Show Password
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#txt_pass');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

</script>
