<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uploaded Documents</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	$sel="select * from tbl_license l where student_id='".$_SESSION["uid"]."' ";
	$row=$con->query($sel);
	if(mysqli_num_rows($row)>0)
	{
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">

<h1>License Documents</h1>
  <p>&nbsp;</p>
  <table width="968" height="140" border="1" cellpadding="10">
    <tr>
      <th width="52">Sl.No</th>
      <th width="56">Photo</th>
      <th width="92">Signature</th>
      <th width="109">Permanent Address Proof</th>
      <th width="113">Self Declaration</th>
      <th width="60">Age Proof</th>
      <th width="89">Present Address Proof</th>
      <th width="104">Eye Test Certificate</th>
      <th width="73">Action</th>
    </tr>
  <?php
	$i=0;
	while($data=$row->fetch_assoc())
	{
	$i++;

  ?>
    <tr>
      <td><?php echo $data["license_id"]   ?></td>
      <td><input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />

      <center><a href="../Assets/Files/LicenseDetails/<?php echo $data["license_photo"];?>" download>
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
       <td><a href="EditLicenseDocuments.php?eid=<?php echo $data["license_id"] ?>">Edit</a></td>
    </tr>
<?php
}
?>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
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
?>
</body>
</html>
<?php
include("Foot.php");
?>
