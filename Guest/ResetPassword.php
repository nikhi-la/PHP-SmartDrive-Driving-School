<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset Password</title>
<style>
.required {
  color: red;
}
span
{
	color: red;
	text: 12px;
	font-size: 14px;
	
}
.p-viewer {
	z-index: 9999;
	position: absolute;
	left: 560px;
	margin-top: -60px;
}

#message {
  display:none;
  color: #000;
  position: relative;
  padding: 10px 10px;
  margin-top: 0px;
}

#message p {
  padding: 0px 35px;
  font-size: 12px;
}
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}

</style>
</head>

<body>
<p>
  <?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST["btnreset"]))
{
$password=$_POST["txtnew"];
$password=test_input($password);
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);

$confirmpassword=$_POST["txtconfirm"];
$confirmpassword=test_input($confirmpassword);

 if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || $password=="") 
  {
	?>
    <script>
    alert("Invalid Password");
	window.location="ResetPassword.php";
	</script>
    <?php  
  }	

else if($password!=$confirmpassword) 
  {
	?>
    <script>
    alert("Password Doesn't Match");
	window.location="ResetPassword.php";
	</script>
    <?php  
  }

else
{
 if($_POST["txtnew"]==$_POST["txtconfirm"])
	{
   	  
	  $selStudent="select * from tbl_student where student_email='".$_SESSION["femail"]."'";
	  $row1=$con->query($selStudent);
	  $selEmployee="select * from tbl_employee where emp_email='".$_SESSION["femail"]."'";
	  $row2=$con->query($selEmployee);
      $selAdmin="select * from tbl_admin where admin_email='".$_SESSION["femail"]."'";
	  $row3=$con->query($selAdmin);

	  if($data1=$row1->fetch_assoc())
	  {
		  $updateQry="update tbl_student set student_password='".$_POST["txtnew"]."' where student_email='".$_SESSION["femail"]."'";
		  $con->query($updateQry);
		?>
        <script>
		alert("Password Updated");
		window.location="Login.php";
		</script>
        <?php
		}
	else if($data2=$row2->fetch_assoc())
	 {
		  $updateQry="update tbl_employee set emp_password='".$_POST["txtnew"]."' where emp_email='".$_SESSION["femail"]."'";
		  $con->query($updateQry);
		?>
        <script>
		alert("Password Updated");
		window.location="Login.php";
		</script>
        <?php
	}
	else if($data3=$row3->fetch_assoc())
	{
		  $updateQry="update tbl_admin set admin_password='".$_POST["txtnew"]."' where admin_email='".$_SESSION["femail"]."'";
		  $con->query($updateQry);
		?>
        <script>
		alert("Password Updated");
		window.location="Login.php";
		</script>
        <?php
	}
		else
	{ 
		?>
        <script>
		alert("Failed");
		window.location="ResetPassword.php";
		</script>
        <?php
	}
	 	
	}
	else
	{ 
		?>
        <script>
		alert("Password Mismatch");
		window.location="ResetPassword.php";
		</script>
        <?php
				
	}
	 		
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
</p>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <table width="407" border="1" cellpadding="10">
   <h2> Reset Password</h2>
   <br><br>
    <tr>
      <td><p>New Password<span class="required">  *</span></p>
      <p>
        <label for="txtnew"></label>
        <input type="password" name="txtnew" id="txtnew" size="35"required/>
      <i class="fa fa-eye "id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></p>
      <span id="err"></span></div>
     <div id="message">
  	 <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  	 <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  	 <p id="number" class="invalid">A <b>number</b></p>
  	 <p id="length" class="invalid">Minimum <b>8 characters</b></p>
	 </div>

</td>
    </tr>
    <tr>
      <td><p>Confirm Password<span class="required">  *</span></p>
      <p>
        <label for="txtconfirm"></label>
        <input type="password" name="txtconfirm" id="txtconfirm" onchange="validateConfirmPassword() " size="35" required />
              <span id="scpassword"></span>

      </p></td>
    </tr>
    <tr>
      <td><div align="center">
        <input type="submit" name="btnreset" id="btnreset" value="Reset" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
</body>
<?php 
include("Foot.php");
?>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });

//--------------------------------Password Validation------------------------------------------------------ 

//password validation
var myInput = document.getElementById("txtnew");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

//--------------------------------Show Password Eye Icon------------------------------------------------------ 

const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#txtnew');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


//--------------------------------Confirm Password Validation------------------------------------------------------ 

function validateConfirmPassword() 
{
	var cpassword=document.getElementById("txtconfirm").value;
	var password=document.getElementById("txtnew").value;
	if(cpassword==password)
	{
		document.getElementById("scpassword").innerHTML = "";
		return true;
		}
    else
		document.getElementById("scpassword").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Password doesn't match</span>";
		elem.focus();
		return false;
}
</script>

