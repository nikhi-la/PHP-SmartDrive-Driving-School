<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Customized Package</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_customizepackage where customization_id='".$_GET["did"]."'";
	$con->query($delQry);
	?>
    <script>
    window.location="ViewCustomization.php";
	</script>
    <?php
}

?>
<br><br><br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <table width="836" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>Vehicle Type</th>
      <th>Vehicle Name</th>
      <th>Vehicle Number</th>
      <th>Vehicle Image</th>
      <th>Course Duration</th>
      <th>Amount</th>
      <th>Status</th>      
      <th>Payment</th>
      <th>Receipt</th>
      <th>Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_customizepackage c inner join tbl_vehicletype v on c.vehicle_type=v.vehicletype_id";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td><?php echo $data["customization_id"]  ?></td>
      <td><?php echo ucfirst($data["vehicletype_name"])  ?></td>
      <td><?php echo ucfirst($data["vehicle_name"])  ?></td>
      <td> <?php echo $data["vehicle_number"]?></td>
      <td><a href="../Assets/Files/vehiclephoto/<?php echo $data["vehicle_image"];?>" download>
      <img src="../Assets/Files/vehiclephoto/<?php echo $data["vehicle_image"];?>"width="100" height="100"/></td>
      <td><?php echo $data["course_duration"]?> Days</td>
      <td><?php echo $data["course_amount"]?>INR</td>
            <td><?php if($data["booking_status"]==1)
	   					 echo "Accepted";
						  else if ($data["booking_status"]==2)
						    echo "Rejected";
							else
							echo "Pending";
	 						?></td>
      <td><?php if($data["booking_status"]==1)
	  					{
	   					 if($data["payment_status"]==1)
	   					 echo "Paid";
						  else 
						  {?>
						    <a href="CPayment.php?cid=<?php echo $data["customization_id"]?>">Pay</a>
                            <?php
						  }
						}
					  if ($data["booking_status"]==2)
						    echo "------";
					 if ($data["booking_status"]==0)
						    echo "Delay in Payment";
						  ?>

</td>
    <td><?php if($data["booking_status"]==1)
	  					{
	   					 if($data["payment_status"]==1)
	   					 {
							 ?>
						    <a href="CPaymentReceipt.php?cpid=<?php echo $data["customization_id"]?>">Receipt</a>
                            <?php
						 }
						}
					else
					{
						echo "----";
					}
						   ?>
	</td>

    <td><?php if($data["payment_status"]==0)
		{
			?>
        <a href="ViewCustomization.php?did=<?php echo $data["customization_id"]?>">Delete</a>/<a href="CustomizationEdit.php?eid=<?php echo $data["customization_id"]?>">Edit</a>
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
 </body>
<?php
include("Foot.php"); 
?>
</html>