<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Salary</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

?>
 <br><br><br> 
 <div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
<h3>Salary</h3>
<p>&nbsp;</p>
  <table width="456" height="95" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>From Date</th>
      <th>To Date</th>
      <th>Receipt</th>
    </tr>
    <?php
    $sel="select * from tbl_salary where emp_id='".$_SESSION["uid"]."' and salary_fromdate order by salary_id DESC";
	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
			$i++;
	if($data["paid_status"]==1)
	  	{?>
	
    <tr>
      <td><?php echo $data["salary_id"];?></td>
      <td><?php echo $data["salary_fromdate"];?></td>
      <td><?php echo $data["salary_todate"];?></td>
      <td><a href="PaymentSalaryReceipt.php?salaryid=<?php echo $data["salary_id"];?>">Receipt</a></td>
    </tr>
    <?php
		}
	else
	{
	$i--;
	continue;
	}
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
include("Foot.php");
?>
</body>
</html>