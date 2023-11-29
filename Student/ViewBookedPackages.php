<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Booked Packages</title>

</head>

<body>
 <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_GET["cdid"]))
{
	$delQry="delete from tbl_customizepackage where customization_id='".$_GET["cdid"]."'";
	$con->query($delQry);
	?>
    <script>
    window.location="ViewBookedPackages.php";
	</script>
    <?php
}
if(isset($_GET["did"]))
{
	$delQry1="delete from tbl_packagebooking where packagebooking_id='".$_GET["did"]."'";
	$con->query($delQry1);
	?>
    <script>
    window.location="ViewBookedPackages.php";
	</script>
    <?php
}

?>

<center>
<div class="t">
<h1>Booked Packages</h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="604" height="98" border="1" cellpadding="10">
    <tr>
    <th>Sl.No</th>
      <th>Package Name</th>
      <th>Package Details</th>
      <th>Package Amount(in INR)</th>
      <th>Package type Name</th>
      <th>Vehicle Name</th>
       <th>Status</th>
       <th>Payment</th>
       <th>Receipt</th>
      <th>Action</th>

    </tr>
    <?php
    $selQry="select * from tbl_package p inner join tbl_packagebooking d inner join tbl_vehicletype v inner join tbl_packagetype e  inner join tbl_student s on p.package_id=d.package_id and p.vehicletype_id=v.vehicletype_id and p.packagetype_id=e.packagetype_id and d.student_id=s.student_id  where d.student_id='".$_SESSION["uid"]."'";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
?>
    <tr>
    <td>&nbsp;<?php echo $data["packagebooking_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_name"])?></td>
      <td>&nbsp; <?php echo $data["package_details"]?></td>
      <td>&nbsp;<?php echo $data["package_amount"]?>INR</td>
      <td>&nbsp;<?php echo ucfirst($data["packagetype_name"])?></td>
      <td>&nbsp;<?php echo ucfirst($data["vehicletype_name"])?></td>
       <td>&nbsp;<?php if($data["packagebooking_status"]==1)
	   					 echo "Accepted";
						  else if ($data["packagebooking_status"]==2)
						    echo "Rejected";
							else
							echo "Pending";
	 						?></td>
      <td>&nbsp;<?php if($data["packagebooking_status"]==1)
	  					{
	   					 if($data["packagepayment_status"]==1)
	   					 echo "Paid";
						  else 
						  {?>
						    <a href="Payment.php?bid=<?php echo $data["packagebooking_id"]?>">Pay</a>
                            <?php
						  }
						}
					  if ($data["packagebooking_status"]==2)
						    echo "------";
					 if ($data["packagebooking_status"]==0)
						    echo "Delay in Payment";
						  ?>

</td>
    <td><?php if($data["packagebooking_status"]==1)
	  					{
	   					 if($data["packagepayment_status"]==1)
	   					 {
							 ?>
						    <a href="PaymentReceipt.php?pid=<?php echo $data["packagebooking_id"]?>">Receipt</a>
                            <?php
						 }
						
					else
					{
						echo "----";
					}
						}
					else
					{
						echo "-----";
					}
					
						   ?>
	</td>
        <td>
                <?php if($data["packagepayment_status"]==0)
		{
			?>
            <a href="ViewBookedPackages.php?did=<?php echo $data["packagebooking_id"]?>" >Delete</a>
               <?php
        }
		 else
		 echo "-----";?></td>

    </tr>
     <?php
}
	?>
  </table>
</form>
 </div>
 <div class="t1">
   <h1>&nbsp;</h1>
   <h1>Customized Packages</h1>
   <p>&nbsp;</p>
   <form id="form1" name="form1" method="post" action="">
     <table width="1074" height="98" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>Vehicle Type</th>
      <th>Vehicle Name</th>
      <th>Vehicle Number</th>
      <th>Vehicle Image</th>
      <th>Course Duration</th>
      <th>Amount(in INR)</th>
      <th>Status</th>      
      <th>Payment</th>
      <th>Receipt</th>
      <th>Action</th>
      <th></th>
    </tr>
    <?php
    $selQry1="select * from tbl_customizepackage c inner join tbl_vehicletype v on c.vehicle_type=v.vehicletype_id where c.student_id='".$_SESSION["uid"]."'";
$row1=$con->query($selQry1);
$i=0;
while($data1=$row1->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td height="144"><?php echo $data1["customization_id"]  ?></td>
      <td><?php echo ucfirst($data1["vehicletype_name"])  ?></td>
      <td><?php echo ucfirst($data1["vehicle_name"])  ?></td>
      <td> <?php echo $data1["vehicle_number"]?></td>
      <td><a href="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>" download>
      <img src="../Assets/Files/vehiclephoto/<?php echo $data1["vehicle_image"];?>"width="100" height="100"/></td>
      <td><?php echo $data1["course_duration"]?> Days</td>
      <td><?php echo $data1["course_amount"]?>INR</td>
            <td><?php if($data1["booking_status"]==1)
	   					 echo "Accepted";
						  else if ($data1["booking_status"]==2)
						    echo "Rejected";
							else
							echo "Pending";
	 						?></td>
      <td><?php if($data1["booking_status"]==1)
	  					{
	   					 if($data1["payment_status"]==1)
	   					 echo "Paid";
						  else 
						  {?>
						    <a href="CPayment.php?cid=<?php echo $data1["customization_id"]?>">Pay</a>
                            <?php
						  }
						}
					  if ($data1["booking_status"]==2)
						    echo "-----";
					 if ($data1["booking_status"]==0)
						    echo "Delay in Payment";
						  ?>

</td>
    <td><?php if($data1["booking_status"]==1)
	  					{
	   					 if($data1["payment_status"]==1)
	   					 {
							 ?>
						    <a href="CPaymentReceipt.php?cpid=<?php echo $data1["customization_id"]?>">Receipt</a>
                            <?php
						 }
						
					else
					{
						echo "-----";
					}
						
						}
						else
					{
						echo "-----";
					}
						   ?>
	</td>
     

        <td>
        <?php if($data1["payment_status"]==0)
		{
			?><a href="ViewBookedPackages.php?cdid=<?php echo $data1["customization_id"]?>">Delete</a> / <a href="CustomizationEdit.php?ceid=<?php echo $data1["customization_id"]?>">Edit</a>
            <?php
        }
		 else
		 echo "-----";?></td>
      
    </tr>
    <?php
}
	?>
  </table>
</form>
</div>
</center>
    <?php

$cid="";
if(isset($_GET["cid"]))
{
	$cid=$_GET["cid"];
	$_SESSION["cid"]=$_GET["cid"];
	$updateQry="update  tbl_customizepackage set booking_status=1 where customization_id='".$cid."' and student_id='".$_SESSION["uid"]."'";
	if($con->query($updateQry))
{
?>
<script>
alert("Package Booking starts");
window.location="CPayment.php";
</script>
<?php	
}
else
{
?>
<script>
alert("Package Booking Failed");
window.location("ViewBookedPackages.php");
</script>
<?php	
}
}
  ?>
  
</body>
<?php
include("Foot.php");
?>
</html>