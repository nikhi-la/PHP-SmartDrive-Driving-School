<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verify OTP</title>
</head>

<body>
<?php
session_start();
include("Head.php");
if(isset($_POST["btnsubmit"]))
{
	if($_SESSION["token"]==$_POST["txtotp"])
	{
		?>
		<script>
		window.location="ResetPassword.php";
		</script>
		<?php
		
	}
	else
	{
		?>
		<script>
		alert("Invalid OTP");
		window.location="OTP.php";
		</script>
		<?php
		
	}
}
?>
<br><br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
    <h2> OTP</h2>
    <p>&nbsp;</p>

  <table width="200" border="1" cellpadding="10">
    <tr>
      <td><p>Enter OTP</p>
        <p>
          <label for="txtotp"></label>
          <input type="text" name="txtotp" id="txtotp" placeholder="6 digit code" required="required" autocomplete="off" />
        </p></td>
    </tr>
    <tr>
      <td><div align="center">
        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
<?php
include("Foot.php");
?>
</body>
</html>