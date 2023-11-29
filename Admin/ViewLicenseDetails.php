<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View License Details</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	$sel="select * from tbl_license l inner join tbl_student s  on l.student_id=s.student_id where license_status=1 ";
	$row=$con->query($sel);
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <h1>License Details</h1>
  <p>&nbsp;</p>
  <table width="1128" height="50" border="1" cellpadding="10">
    <tr>
      <th width="45">Sl.No</th>
      <th width="102">Student Name</th>
      <th width="58">Photo</th>
      <th width="81">Signature</th>
      <th width="97">Permanent Address Proof</th>
      <th width="98">Self Declaration</th>
      <th width="57">Age Proof</th>
      <th width="83">Present Address Proof</th>
      <th width="92">Eye Test Certificate</th>
      <th width="171">License Status</th>
    </tr>
  <?php
	$i=0;
	while($data=$row->fetch_assoc())
	{
	$i++;

  ?>
    <tr>
      <td><?php echo $data["license_id"]  ?></td>
      <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_photo"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_signature"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_permanentap"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_self"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_ageproof"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_presentap"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
      <td><center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_eyetest"];?>" download>
      	<i class="fa fa-download " style="font-size:24px;cursor: pointer;color:black;"></i></center></td>
       <td><p><a href="LicenselearnersDetails.php?learnersid=<?php echo $data["license_id"] ?>">Provide learners Details</a>
         </p>
         <p><a href="LicenseTestDetails.php?testid=<?php echo $data["license_id"] ?>">Provide Test Details</a></p>
            </td>
    </tr>
<?php
}
?>
</table>
</form>
</div>
</body>
</html>