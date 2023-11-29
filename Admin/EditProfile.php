<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile</title>
<style>
.required {
  color: red;
}
</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnupdate"]))
{
$updateQry="update tbl_admin set admin_name='".$_POST["txtname"]."',admin_email='".$_POST["txtemail"]."',admin_contact='".$_POST["txtcontact"]."' where admin_id='".$_SESSION["uid"]."'";	
if($con->query($updateQry))
{
?>
	<script>
	alert("Profile Updated");
	location.href="EditProfile.php";
	</script>
<?php
}
}
	$sel="select * from tbl_admin where admin_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);
	$data=$row->fetch_assoc();
	
?>
	<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h1>&nbsp;</h1>
  <h1>Edit Profile</h1>
  <p>&nbsp;</p>
  <table width="452" height="238" border="1" cellpadding="10">
    <tr>
      <td width="113">Name<span class="required">  *</span></td>
      <td width="287" ><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" value="<?php echo ucfirst($data["admin_name"])?>" onkeyup="validateName(this)" required="required" autocomplete="off"/><span id="name"></span></td>
    </tr>
    <tr>
      <td>Email<span class="required">  *</span></td>
      <td><label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail" onkeyup="validateEmail(this)" value="<?php echo $data["admin_email"]?>" required="required" autocomplete="off"/> <span id="email"></span></td>
    </tr>
    <tr>
      <td>Contact<span class="required">  *</span></td>
      <td><label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" onkeyup="validateContact(this)" value="<?php echo $data["admin_contact"]?>" required="required" autocomplete="off"/><span id="contact"></span></td>
    </tr>
    
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnupdate" id="btnupdate" value="Update" />
        <input type="Reset" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
 </form>
 </div>
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