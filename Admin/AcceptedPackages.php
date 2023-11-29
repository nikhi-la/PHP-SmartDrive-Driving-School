<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted Packages</title>


</head>

<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
if(isset($_GET["rid"]))
{
$sel="select * from tbl_packagebooking p inner join tbl_student s on p.student_id=s.student_id where p.packagebooking_id='".$_GET["rid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();
	
	
$updateQry="update tbl_packagebooking set packagebooking_status=2 where packagebooking_id='".$_GET["rid"]."'";
$con->query($updateQry);
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($data1["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Rejected";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your smartdrive package  has been rejected.Thank You.";
  if($mail->send())
  {
    echo "Sended";
  }
  else
  {
    echo "Failed";
  }


?>
<script>
window.location="AcceptedPackages.php";
</script>
<?php	
}
if(isset($_GET["crid"]))
{
$sel="select * from tbl_customizepackage c inner join tbl_student s on c.student_id=s.student_id where c.customization_id='".$_GET["crid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();
	
$updateQry1="update tbl_customizepackage set booking_status=2 where customization_id='".$_GET["crid"]."'";
$con->query($updateQry1);
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($data1["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Rejected";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your smartdrive package  has been rejected.Thank You.";
  if($mail->send())
  {
    echo "Sended";
  }
  else
  {
    echo "Failed";
  }
?>
<script>
window.location="AcceptedPackages.php";
</script>
<?php	
}
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h1>Accepted Packages List</h1>
  <p>&nbsp;</p>
  <table width="1091" height="50" border="1" cellpadding="10">
    <tr>
     <th>Sl.No</th>
      <th>Student</th>
      <th>Package Name</th>
      <th>Package Details</th>
      <th>Package Amount (in INR)</th>
      <th>Package type Name</th>
      <th>Vehicle Name</th>
      <th>Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_package p inner join tbl_packagebooking d inner join tbl_vehicletype v inner join tbl_packagetype e  inner join tbl_student s on p.package_id=d.package_id and p.vehicletype_id=v.vehicletype_id and p.packagetype_id=e.packagetype_id and d.student_id=s.student_id  where packagebooking_status=1";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td>&nbsp;<?php echo $data["packagebooking_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_name"]);?></td>
      <td>&nbsp; <?php echo ucfirst($data["package_details"]);?></td>
      <td>&nbsp;<?php echo $data["package_amount"];?> INR</td>
      <td>&nbsp;<?php echo ucfirst($data["packagetype_name"]);?></td>
      <td>&nbsp;<?php echo ucfirst($data["vehicletype_name"]);?></td>
      <td><?php if($data["packagepayment_status"]==1)
	  			{
	  				echo "Paid";
				}
				else
				{
					?><a href="AcceptedPackages.php?rid=<?php echo $data["packagebooking_id"] ?>">Reject</a>
                    <?php 
				}?>
    </tr>
    <?php
	}
	?>
  </table>
  
  
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <h1>Accepted Custom Packages List</h1>
   <p>&nbsp;</p>
  <table width="1091" height="50" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>Student Name</th>
      <th>Vehicle Type</th>
      <th>Vehicle Name</th>
      <th>Vehicle Number</th>
      <th>Vehicle Image</th>
      <th>Course Duration</th>
      <th>Amount(in INR)</th>
      <th width="163">Action</th>
    </tr>
    <?php
    $selQry2="select * from tbl_customizepackage c inner join tbl_vehicletype v inner join tbl_student s on c.vehicle_type=v.vehicletype_id and c.student_id=s.student_id where booking_status=1";
$row1=$con->query($selQry2);
$i=0;
while($data1=$row1->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["customization_id"]  ?></td>
     <td>&nbsp;<?php echo ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])  ?></td>
      <td>&nbsp;<?php echo ucfirst($data1["vehicletype_name"])  ?></td>
      <td>&nbsp;<?php echo ucfirst($data1["vehicle_name"])  ?></td>
      <td>&nbsp; <?php echo $data1["vehicle_number"]?></td>
      <td><a href="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"download target="_blank"  download>
      <img src="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"width="100" height="100"/></td>
      <td>&nbsp;<?php echo $data1["course_duration"]?> Days</td>
      <td>&nbsp;<?php echo $data1["course_amount"]?> INR</td>
      <td><?php if($data1["payment_status"]==1)
	  			{
	  				echo "Paid";
				}
				else
				{
					?>
      			   <a href="AcceptedPackages.php?crid=<?php echo $data1["customization_id"] ?>">Reject</a>
                 <?php 
				}?>
                </td>
    </tr>
    <?php
}
	?>
</table>
</form>
</div>
</center>
</body>
</html>