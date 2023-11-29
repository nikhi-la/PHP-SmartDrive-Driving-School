<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Batch </title>

</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
?>
<br><br><br> 
<div id="tab" align="center">
	<h2>Batch</h2>
	<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
<table  border="1" cellpadding="10">
    <tr>
      <th >Sl.No</th>
      <th >Batch Date</th>
      <th >Batch Start Time</th>
      <th >Batch End Time</th>
    </tr>
    <?php
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));

	$selQry1="select * from tbl_batch where emp_id='".$_SESSION["uid"]."'and batch_date between '".$min."' and '".$max."'";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["batch_id"]?></td>
      <td>&nbsp;<?php echo $data1["batch_date"] ?></td>
       <td>&nbsp;<?php echo $data1["batch_starttime"] ?></td>
        <td>&nbsp;<?php echo $data1["batch_endtime"] ?></td>
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