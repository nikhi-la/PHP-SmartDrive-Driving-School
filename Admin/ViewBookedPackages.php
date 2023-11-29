<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booked Packages</title>

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

if(isset($_GET["aid"]))
{
$sel="select * from tbl_packagebooking p inner join tbl_student s on p.student_id=s.student_id where p.packagebooking_id='".$_GET["aid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

$updateQry="update tbl_packagebooking set packagebooking_status=1 where packagebooking_id='".$_GET["aid"]."'";
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
  
    $mail->Subject = "Verified";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your smartdrive package  has been verified.Complete your payment to book the package.";
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
window.location="ViewBookedPackages.php";
</script>
<?php
}
if(isset($_GET["caid"]))
{
$sel="select * from tbl_customizepackage c inner join tbl_student s on c.student_id=s.student_id where c.customization_id='".$_GET["caid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();
	

$updateQryc="update tbl_customizepackage set booking_status=1 where customization_id='".$_GET["caid"]."'";
$con->query($updateQryc);	

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
  
    $mail->Subject = "Verified";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your smartdrive package  has been verified.Complete your payment to book the package.";
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
window.location="ViewBookedPackages.php";
</script>
<?php
}

if(isset($_GET["rid"]))
{
$sel="select * from tbl_packagebooking p inner join tbl_student s on p.student_id=s.student_id where p.packagebooking_id='".$_GET["rid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();
	
	
$updateQry1="update tbl_packagebooking set packagebooking_status=2 where packagebooking_id='".$_GET["rid"]."'";
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
window.location="ViewBookedPackages.php";
</script>
<?php
}
if(isset($_GET["crid"]))
{
$sel="select * from tbl_customizepackage c inner join tbl_student s on c.student_id=s.student_id where c.customization_id='".$_GET["crid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

$updateQryc1="update tbl_customizepackage set booking_status=2 where customization_id='".$_GET["crid"]."'";
$con->query($updateQryc1);

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
window.location="ViewBookedPackages.php";
</script>
<?php
}

?>

<br><br><br>
<div id="tab" align="center">
<h1>Booked Packages</h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">

  <table width="1091" height="50" border="1" cellpadding="10">
    <tr>
      <th width="45" height="68">Sl.No</th>
      <th width="92">Student</th>
      <th width="98">Package Name</th>
      <th width="112">Package Details</th>
      <th width="90">Package Amount (in INR)</th>
      <th width="111">Package type Name</th>
      <th width="78">Vehicle Name</th>
      <th width="163">Action</th>
      <th width="82">Payment</th>
    </tr>
    <?php
    $selQry="select * from tbl_package p inner join tbl_packagebooking d inner join tbl_vehicletype v inner join tbl_packagetype e  inner join tbl_student s on p.package_id=d.package_id and p.vehicletype_id=v.vehicletype_id and p.packagetype_id=e.packagetype_id and d.student_id=s.student_id order by packagebooking_date ASC";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
?>
	  <tr>
      <td>&nbsp;<?php echo $data["packagebooking_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_name"])  ?></td>
      <td>&nbsp; <?php echo ucfirst($data["package_details"])?></td>
      <td>&nbsp;<?php echo $data["package_amount"]?> INR</td>
      <td>&nbsp;<?php echo ucfirst($data["packagetype_name"])?></td>
      <td>&nbsp;<?php echo ucfirst($data["vehicletype_name"])?></td>
      <td>&nbsp;<?php if($data["packagebooking_status"]==0)
	  					{
	   					 ?><a href="ViewBookedPackages.php?aid=<?php echo $data["packagebooking_id"] ?>">Accept</a>/<a href="ViewBookedPackages.php?rid=<?php echo $data["packagebooking_id"] ?>">Reject</a>
                         <?php
                         }
						  else  if($data["packagebooking_status"]==1)
						  {
							  echo "Accepted";
						  }
						  else
						  {
							  echo "Rejected";  
						  }
					  ?>
     </td>
     <td>&nbsp;<?php if($data["packagebooking_status"]==1)
	 					{
	 					if($data["packagepayment_status"]==0)
	  					{
	   					 echo "Payment Pending";
                         
                         }
						  else  if($data["packagepayment_status"]==1)
						  {
							  echo "Paid";
						  }
						}
						  else
						  {
							  echo "------";  
						  }
					  ?>
     </td>
    </tr>
<?php
}
?>
</table>
<br><br>
<h1>Booked Custom Packages</h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">

  <table width="1091" height="50" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>Student Name</th>
      <th>Vehicle Type</th>
      <th>Vehicle Name</th>
      <th>Vehicle Number</th>
      <th>Vehicle Image</th>
      <th>Course Duration</th>
      <th>Amount (in INR)</th>
      <th width="163">Action</th>
      <th width="82">Payment</th>

    </tr>
    <?php
    $selQry2="select * from tbl_customizepackage c inner join tbl_vehicletype v inner join tbl_student s on c.vehicle_type=v.vehicletype_id and c.student_id=s.student_id ";
$row1=$con->query($selQry2);
$i=0;
while($data1=$row1->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["customization_id"]  ?></td>
     <td>&nbsp;<?php echo ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])?></td>
      <td>&nbsp;<?php echo ucfirst($data1["vehicletype_name"])  ?></td>
      <td>&nbsp;<?php echo ucfirst($data1["vehicle_name"])  ?></td>
      <td>&nbsp; <?php echo $data1["vehicle_number"]?></td>
      <td><a href="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"download target="_blank"  download>
      <img src="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"width="100" height="100"/></td>
      <td>&nbsp;<?php echo $data1["course_duration"]?> Days</td>
      <td>&nbsp;<?php echo $data1["course_amount"]?> INR</td>
      <td>&nbsp;<?php if($data1["booking_status"]==0)
	  					{
	   					 ?><a href="ViewBookedPackages.php?caid=<?php echo $data1["customization_id"] ?>">Accept</a>/<a href="ViewBookedPackages.php?crid=<?php echo $data1["customization_id"] ?>">Reject</a>
                         <?php
                         }
						  else  if($data1["booking_status"]==1)
						  {
							  echo "Accepted";
						  }
						  else
						  {
							  echo "Rejected";  
						  }
					  ?>
     </td>
     <td>&nbsp;<?php if($data1["booking_status"]==1)
	 					{
	 					if($data1["payment_status"]==0)
	  					{
	   					 echo "Payment Pending";
                         
                         }
						  else  if($data1["payment_status"]==1)
						  {
							  echo "Paid";
						  }
						}
						  else
						  {
							  echo "------";  
						  }
					  ?>
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