<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Change Password</title>
<style>
.required {
  color: red;
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
.t {
    background: #DDD;
	padding: 0px;
	 margin: 50px 400px;
	 border-radius: 5px;
}
g{
	font-size: 14px;
	color:#666666;
}

a{
	text-decoration: none;
}
.t1 {
    background: #DDD;
	padding: 0px;
	 margin: 50px 146px;
}
p{
	
	font-family: Arial, Helvetica, sans-serif;	
}
body{
font-family: Arial, Helvetica, sans-serif ;
	
}
#form1 table th {
	font-weight: bold;
	text-align: left;
}
input[type=submit]{
  background-color: #A3A3A3;
  border: 1px solid #3B3B3B;
  padding: 5px 12px;
  color: black;
  cursor: pointer;
  border-radius: 3px;
}
input[type=text],[type=password] {
  width: 75%;
  height: 30px;
  padding: 12px 20px;
  margin: 6px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit]:hover {
  background-color: #999;
}

</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsave"]))
{
	$sel="select * from tbl_employee where emp_password='".$_POST["txtcurrent"]."' and emp_id='".$_SESSION["uid"]."'";
		$row=$con->query($sel);
		if($data=$row->fetch_assoc())
		{
			  $uppercase = preg_match('@[A-Z]@', $_POST["txtnew"]);
			  $lowercase = preg_match('@[a-z]@', $_POST["txtnew"]);
			  $number    = preg_match('@[0-9]@', $_POST["txtnew"]);

		   if(!$uppercase || !$lowercase || !$number || strlen($_POST["txtnew"]) < 8 || $_POST["txtnew"]=="") 
  			{
				?>
			    <script>
			    alert("Invalid New Password");
				window.location="ChangePassword.php";
				</script>
		       <?php  
		   }
		   else if($_POST["txtnew"]!=$_POST["txtconfirm"]) 
		  {
			?>
		    <script>
		    alert("Password Doesn't Match");
			window.location="ChangePassword.php";
			</script>
		    <?php  
		  }
		else
		{
		   
			if($_POST["txtnew"]==$_POST["txtconfirm"])
			{
				$updateQry="update tbl_employee set emp_password='".$_POST["txtnew"]."' where emp_id='".$_SESSION["uid"]."'";
				if($con->query($updateQry))
				{
				?>
                <script>
				alert("Profile Updated");
				location.href="ChangePassword.php";
				</script>
       			 <?php
				}
				}
				else
				{
				?>
        		<script>
				alert("Password Mismatch");
				location.href="ChangePassword.php";
				</script>
        		<?php
				}
				}
		}
		else
		{
			?>
        <script>
		alert("Current Password Is Wrong");
		location.href="ChangePassword.php";
		</script>
        <?php
		}
	}
	?>
 <br><br><br>
 <div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
<h3>Change Your Account Password</h3>
<p>&nbsp;</p>
  <table width="506" height="207" border="1" cellpadding="10">
    <tr>
      <td width="163">Current Password<span class="required">  *</span></td>
      <td width="291"><label for="txtcurrent"></label>
      <input type="password" name="txtcurrent" id="txtcurrent" required="required" autocomplete="off"/></td>
    </tr>
    <tr>
      <td>New Password<span class="required">  *</span></td>
      <td><label for="txtnew"></label>
      <input type="password" name="txtnew" id="txtnew" required="required" autocomplete="off"/>
       <i class="fa fa-eye "id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
     <div id="message">
  	 <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  	 <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  	 <p id="number" class="invalid">A <b>number</b></p>
  	 <p id="length" class="invalid">Minimum <b>8 characters</b></p>
	 </div>
    </td>
    </tr>
    <tr>
      <td>Confirm Password<span class="required">  *</span></td>
      <td><div class="input-group">
      <label for="txtconfirm"></label>
      <input type="password" name="txtconfirm" id="txtconfirm" onkeyup="validateConfirmPassword()" required="required" autocomplete="off"/>      <span id="scpassword"></span></div>
    </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Change" />
        <input type="submit" name="txtcancel" id="txtcancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
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

//Show Password
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#txtnew');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

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