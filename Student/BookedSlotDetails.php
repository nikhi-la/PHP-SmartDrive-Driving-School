<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Booked Slot</title>
<style>
a{
	text-decoration: none;
}
</style>
</head>

<body>
<p>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_GET["batchhid"]))
{
	$_SESSION["batchhid"]=$_GET["batchhid"];
}

if(isset($_GET["did"]))
{
	$selQry="select * from tbl_slotbooking where slotbooking_id='".$_GET["did"]."'";
	$row=$con->query($selQry);
	$datad=$row->fetch_assoc();
	
	
	$updateQry="update tbl_studentslot set slotbook_status=0 where studentslot_id='".$datad["studentslot_id"]."'";
	$con->query($updateQry);
	
	
	$delQry="delete from tbl_slotbooking where slotbooking_id='".$_GET["did"]."'";
	$con->query($delQry);
 	?>
	<script>
	window.location="BookedSlotDetails.php";
	</script>
    <?php

}
?>
<center>
<form id="form1" name="form1" method="post" action="">

  <p>&nbsp;</p>
 <h1>Booked Slot</h1>
  <table width="744" height="95" border="1" cellpadding="10">
    <tr>
    <th>Sl.No</th>
    <th>Slot Number</th>
    <th>Date</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Action</th>      
    </tr>
    <?php
    $selQry="select * from tbl_slotbooking s  inner join tbl_studentslot ss inner join tbl_batch b on  s.studentslot_id=ss.studentslot_id and ss.batch_id=b.batch_id where s.student_id='".$_SESSION["uid"]."' and ss.batch_id='".$_SESSION["batchhid"]."'";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["slotbooking_id"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_number"]  ?></td>
      <td>&nbsp;<?php echo $data["booking_date"]  ?></td>
      <td>&nbsp; <?php echo $data["studentslot_starttime"]?></td>
      <td>&nbsp;<?php echo $data["studentslot_endtime"]?></td>
       <td>&nbsp;<a href="BookedSlotDetails.php?did=<?php echo $data["slotbooking_id"]?>">Remove</a></td>
    </tr>
    <?php
}
	?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</center>

</div>

<?php
include("Foot.php");
?>

</body>
</html>