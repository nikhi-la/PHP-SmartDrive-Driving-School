<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Trial Booked Slot</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

if(isset($_GET["did"]))
{
	$selQry="select * from tbl_trial where trial_id='".$_GET["did"]."'";
	$row=$con->query($selQry);
	$datad=$row->fetch_assoc();
	
	
	$updateQry="update tbl_studentslot set slotbook_status=0 where studentslot_id='".$datad["studentslot_id"]."'";
	$con->query($updateQry);
	
	
	$delQry="delete from tbl_trial where trial_id='".$_GET["did"]."'";
	$con->query($delQry);
	
	?>
    <script>
    window.location="viewBookedTrialSlot.php";
	</script>
    <?php
}
?>
<br><br><br><br>
<form id="form1" name="form1" method="post" action="">
<div id="tab" align="center">
<h1>Booked Trial Slot</h1>

  <table width="754" height="158" border="1" cellpadding="10">
    <tr>
    <th width="45">Sl.No</th>
    <th width="67">Slot Number</th>
    <th width="108">Date</th>
    <th width="78">Start Time</th>
    <th width="49">End Time</th>
    <th width="70">Action</th>
          
    </tr>
    <?php
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));

 	$selQry="select * from tbl_trial t  inner join tbl_studentslot s  on  t.studentslot_id=s.studentslot_id  where t.student_id='".$_SESSION["uid"]."' and t.booking_date between '".$min."' and '".$max."' ";
$row=$con->query($selQry);
if(mysqli_num_rows($row)>0)
{
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["trial_id"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_number"]  ?></td>
      <td>&nbsp;<?php echo $data["booking_date"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_starttime"]?></td>
      <td>&nbsp;<?php echo $data["studentslot_endtime"]?></td>
       <td>&nbsp;<?php if($data["payment_status"]==1)
	   					echo "Paid";
						else
						{?><a href="viewBookedTrialSlot.php?did=<?php echo $data["trial_id"]?>">Delete</a>
                        <?php } ?></td>
       <td width="66">&nbsp;<a href="TrialReceipt.php?trid=<?php echo $data["trial_id"]?>">Receipt</a></td>

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
</center>
<?php
}
else
{
	?>
<script>
alert("No Booked Trial Slot");
window.location="Homepage.php";
</script>
<?php
}
include("Foot.php"); 
?>
</body>
</html>
