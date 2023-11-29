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
include("Head.php");
 
	$sel="select * from tbl_student s inner join tbl_district d on s.district_id=d.district_id  where student_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);	
	$data=$row->fetch_assoc();
	
	?>
<br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h2>My Profile</h2>
  <p>&nbsp;</p>
  <table width="415" height="601" border="1"  cellpadding="10">
    <tr>
      <td height="151" colspan="2"><center><img src="../Assets/Files/studentPhoto/<?php echo ucfirst($data["student_photo"]);?>" width="150" height="150"/></center>
          </td>
    </tr>
    <tr>
      <th width="102">Name</th>
      <td width="261"><?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"]);?></tr>
       <tr>
      <th>DOB</th>
      <td><?php echo $data["student_dob"];?></td>
    </tr>
     <tr>
      <th>Gender</th>
      <td><?php echo ucfirst($data["student_gender"]);?></td>
    </tr>
    <tr>
      <th>Address</th>
      <td><p><?php echo ucfirst($data["student_housename"]);?></p>
		 <p><?php echo ucfirst($data["student_landmark"]);?></p>
		 <p><?php echo ucfirst($data["student_place"]);?></p>
         <p><?php echo ucfirst($data["district_name"]);?></p>
         <p><?php echo $data["student_pincode"];?></p></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?php echo $data["student_email"];?></td>
    </tr>
    <tr>
      <th>Contact</th>
      <td><?php echo $data["student_contact"];?></td>
    </tr>
      </table>
</form>
</div>
</body>
<?php 
include("Foot.php")
?>
</html>