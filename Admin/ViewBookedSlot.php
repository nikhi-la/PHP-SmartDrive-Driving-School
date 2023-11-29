<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Booked Slot</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
?>
<br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h1>Booked Slot</h1>

  <table width="827" height="118" border="1" cellpadding="10">
    <tr>
      <th width="54">Sl.No</th>
      <th width="110">Student Name</th>
      <th width="141">Employee Name</th>   
      <th width="102">Date</th>
      <th width="67">Slot Number</th>
      <th width="92">Start Time</th>
      <th width="89">End Time</th>
    </tr>
    <?php
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));

 	$selQry="select * from tbl_slotbooking s  inner join tbl_studentslot ss inner join  tbl_student st inner join tbl_batch b inner join tbl_employee e on  s.studentslot_id=ss.studentslot_id and s.student_id=st.student_id and b.batch_id=ss.batch_id and b.emp_id=e.emp_id where  s.booking_date between '".$min."' and '".$max."'  order by booking_date ,studentslot_number,e.emp_id";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["slotbooking_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td>&nbsp;<?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"])?></td>
      <td>&nbsp;<?php echo $data["booking_date"]  ?></td>
      <td>&nbsp;<?php echo $data["studentslot_number"]  ?></td>
      <td>&nbsp; <?php echo $data["studentslot_starttime"]?></td>
      <td>&nbsp;<?php echo $data["studentslot_endtime"]?></td>
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