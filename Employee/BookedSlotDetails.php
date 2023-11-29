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
if(isset($_GET["batchid"]))
{
	$_SESSION["batchid"]=$_GET["batchid"];
}
?>
<center>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="707" height="98" border="1" cellpadding="10">
    <tr>
    <th>Sl.No</th>
    <th>Slot Number</th>
    <th>Student</th>
    <th>Date</th>
    <th>Start Time</th>
    <th>End Time</th>
      
    </tr>
    <?php
    $selQry="select * from tbl_slotbooking s inner join tbl_student st inner join tbl_studentslot ss inner join tbl_batch b on s.student_id=st.student_id and s.studentslot_id=ss.studentslot_id and ss.batch_id=b.batch_id where b.emp_id='".$_SESSION["uid"]."' and ss.batch_id='".$_SESSION["batchid"]."' order by studentslot_number";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["slotbooking_id"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_number"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"])?></td>
      <td>&nbsp;<?php echo $data["booking_date"]  ?></td>
      <td>&nbsp; <?php echo $data["studentslot_starttime"]?></td>
      <td>&nbsp;<?php echo $data["studentslot_endtime"]?></td>
    </tr>
    <?php
}
    $selQry="select * from tbl_trial t inner join tbl_student st inner join tbl_studentslot ss inner join tbl_batch b on t.student_id=st.student_id and t.studentslot_id=ss.studentslot_id and ss.batch_id=b.batch_id where b.emp_id='".$_SESSION["uid"]."' and ss.batch_id='".$_SESSION["batchid"]."' order by studentslot_number";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["trial_id"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_number"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"])?></td>
      <td>&nbsp;<?php echo $data["booking_date"]  ?></td>
      <td>&nbsp; <?php echo $data["studentslot_starttime"]?></td>
      <td>&nbsp;<?php echo $data["studentslot_endtime"]?></td>
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
<?php
include("Foot.php"); 
?>

</body>
</html>