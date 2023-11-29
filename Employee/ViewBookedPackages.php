<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booked Packages</title>

</head>

<body>
<p>
  <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
?>
<br><br>
 <div id="tab" align="center">
<h1>Booked Packages</h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">

  <table width="1079" height="119" border="1" cellpadding="10">
    <tr>
    <th width="48">Sl.No</th>
      <th width="127">Student</th>
      <th width="116">Package Name</th>
      <th width="139">Package Details</th>
      <th width="150">Package Amount (in INR)</th>
      <th width="189">Package type Name</th>
      <th width="138">Vehicle Name</th>
    </tr>
    <?php
$selQry2="select * from tbl_student s inner join  tbl_assignstudent a inner join tbl_employee e  on s.student_id=a.student_id and a.emp_id=e.emp_id where e.emp_id='".$_SESSION["uid"]."'";
$row2=$con->query($selQry2);
$data2=$row2->fetch_assoc();

    $selQry="select * from tbl_package p inner join tbl_packagebooking d inner join tbl_vehicletype v inner join tbl_packagetype e  inner join tbl_student s on p.package_id=d.package_id and p.vehicletype_id=v.vehicletype_id and p.packagetype_id=e.packagetype_id and d.student_id=s.student_id where d.packagepayment_status=1 and s.student_id='".$data2["student_id"]."' order by packagebooking_id DESC";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["packagebooking_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"]) ?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_name"]) ?></td>
      <td>&nbsp; <?php echo $data["package_details"]?></td>
      <td>&nbsp;<?php echo $data["package_amount"]?> INR</td>
      <td>&nbsp;<?php echo ucfirst($data["packagetype_name"])?></td>
      <td>&nbsp;<?php echo ucfirst($data["vehicletype_name"])?></td>
    </tr>
    <?php
}
	?>
  </table>
</form>

<form id="form1" name="form1" method="post" action="">
<h1>&nbsp;</h1>
<h1>Custom Booked Packages</h1>
<p>&nbsp;</p>
  <table width="1023" height="98" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</td>
      <th>Student Name</th>
      <th>Vehicle Type</th>
      <th>Vehicle Name</th>
      <th>Vehicle Number</th>
      <th>Vehicle Image</th>
      <th>Course Duration</th>
      <th>Amount (in INR)</th>
    </tr>
    <?php
    $selQry1="select * from tbl_customizepackage c inner join tbl_vehicletype v inner join tbl_student s on c.vehicle_type=v.vehicletype_id and c.student_id=s.student_id where c.payment_status=1 and s.student_id='".$data2["student_id"]."' order by customization_id DESC" ;
$row1=$con->query($selQry1);
$i=0;
while($data1=$row1->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["customization_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data1["student_name"]);?> <?php echo ucfirst($data1["student_middle"]);?> <?php echo ucfirst($data1["student_last"]) ?></td>
      <td>&nbsp;<?php echo $data1["vehicletype_name"]  ?></td>
      <td>&nbsp;<?php echo $data1["vehicle_name"]  ?></td>
      <td>&nbsp; <?php echo $data1["vehicle_number"]?></td>
      <td><a href="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>" download>
      &nbsp;<img src="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"width="100" height="100"/></td>
      <td>&nbsp;<?php echo $data1["course_duration"]?> Days</td>
      <td>&nbsp;<?php echo $data1["course_amount"]?> INR</td>
      </tr>
    <?php
}
	?>
  </table>
  </form>
</div>
</center>
<?php
include("Foot.php");
?>
</body>
</html>