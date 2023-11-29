<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Licence Status</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	$sel="select * from tbl_licensetest lt  inner join tbl_license l inner join tbl_student s  on lt.license_id=l.license_id and l.student_id=s.student_id where s.student_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);
	$data=$row->fetch_assoc();
if(mysqli_num_rows($row)>0)
{
	if($data["license_status"]==2)
	{
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <table width="646" height="114" border="1" cellpadding="10">
    <tr>
      <th width="58">Sl.No</th>
      <th width="190">Application Number</th>
      <th width="143">learners Date</th>
      <th width="155">Test Date</th>
    </tr>
    <tr>
      <td><?php echo $data["licensetest_id"];?></td>
      <td><?php echo $data["application_no"];?></td>
      <td><?php if($data["learners_date"]=="0000-00-00") echo "-----";
	  				else 
				echo $data["learners_date"];?></td>
      <td><?php if($data["test_date"]=="0000-00-00") echo "-----";
	  			else
				echo $data["test_date"];?></td>
    </tr>
  </table>
</form>
<?php
	}
	else
	{
	?>
    <script>
	alert("No Data Found");
	window.location="LicenseStatus.php";
	</script>
    <?php

	}
}
else
{
	$sel1="select * from tbl_license l  inner join tbl_student s  on l.student_id=s.student_id where l.student_id='".$_SESSION["uid"]."'";
	$row1=$con->query($sel1);
	if(mysqli_num_rows($row1)>0)
	{
	$data1=$row1->fetch_assoc();
	if($data1["license_status"]==1)
	{
	?>
    <script>
	alert("Slot Dates are not scheduled");
	window.location="LicenseStatus.php";
	</script>
    <?php

	}
	else
	{
	?>
    <script>
	alert("No Data Found");
	window.location="LicenseStatus.php";
	</script>
    <?php

	}
	
	}
	else
	{
	?>
    <script>
	alert("No Data Found");
	window.location="LicenseStatus.php";
	</script>
    <?php
	}
		
}
?>
</body>
</html>