<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recovery</title>
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
</style>
</head>

<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST["btnotp"]))
{
$email=$_POST["txtemail"];
$email=test_input($email);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	?>
    <script>
    alert("Invalid email");
	window.location="RecoveryPassword.php";
	</script>
    <?php
    }	
else
{	
	
	$_SESSION["femail"]=$_POST["txtemail"];
	$ran=rand(100000,999999);
		$_SESSION["token"]=$ran;
	require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($_POST["txtemail"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Recover Password";
    $mail->Body = "Hello! Your OTP for New Password is"." ".$_SESSION["token"]."";
  if($mail->send())
  {

		?>
		<script>
	 window.location="OTP.php";
		
		</script>
        <?php
	
  }
  else
  {
		?>
		<script>
		    alert("Failed");
		
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
<br><br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <table  border="1" cellpadding="10">
    <h2>Account Recovery</h2>
    <tr>
      <td height="139"><p>&nbsp; </p>
        <p>Enter Email <span class="required">  *</span></p>
        <label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail" placeholder="Email" size="35" onfocusout="validateEmail(this)"  required="required" autocomplete="off" /><span id="email"></span></div></td>

    </tr>
    <tr>
      <td><div align="center">
        <input type="submit" name="btnotp" id="btnotp" value="Send OTP" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<?php 
include("Foot.php")
?>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
</script>
<script src="Validation.js"></script>
