<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>

</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include ("Head.php");
 
	$sel="select * from tbl_admin where admin_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);	
	$data=$row->fetch_assoc();
	
	?>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h1>&nbsp;</h1>
  <h1>My Profile</h1>
  <p>&nbsp;</p>
  <table width="378" height="158" border="1" cellpadding="10">
    
    <tr>
      <td width="100">Name</td>
      <td width="171">&nbsp;<?php echo ucfirst($data["admin_name"]);?></tr>
    <tr>
      <td>Email</td>
      <td>&nbsp;<?php echo $data["admin_email"];?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td>&nbsp;<?php echo $data["admin_contact"];?></td>
    </tr>

  </table>
</form>
</div>
</body>
</html>