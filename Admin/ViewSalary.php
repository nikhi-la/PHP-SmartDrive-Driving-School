<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Salary</title>
</head>

<body>
<?php
include("SessionValidator.php");
include('../Assets/Connection/Connection.php');
include("Head.php");

?>

<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>

<h1>Salary</h1>

  <p>&nbsp;</p>
  <table width="724" height="50" border="1" cellpadding="10">
    <tr>
      <th width="45">Sl.No</th>
      <th width="88">Employee Name</th>
      <th width="180">Salary Period</th>
      <th width="66">Salary Amount</th>
      <th width="55">Action</th>
      <th width="53">Status</th>
      <th width="65">Receipt</th>
    </tr>
    <?php
	$selQry="select * from tbl_salary s inner join tbl_employee e on e.emp_id=s.emp_id order by salary_id DESC";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["salary_id"]?></td>
      <td><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"])?></td>
      <td><?php echo $data["salary_fromdate"]?>   -   <?php echo $data["salary_todate"]?></td>
      <td><?php echo $data["salary_amount"]?> Rs.</td>
      <td><?php if($data["paid_status"]==1)
	  				{
						echo "-----";
					}
					else
					{?>
                    <a href="ViewSalary.php?did=<?php echo $data["salary_id"];?>">Delete</a>
                     <?php }?></td>
      <td><?php if($data["paid_status"]==1)
	  				{
						echo "Paid";
					}
					else
					{?>
	  				<a href="PaymentSalary.php?sid=<?php echo $data["salary_id"];?>">Pay</a>
                    <?php }?></td>
      <td><?php if($data["paid_status"]==1)
	  				{?>
	  				<a href="PaymentSalaryReceipt.php?salaryid=<?php echo $data["salary_id"];?>">Receipt</a>
					<?php 
					}
					else
					{
						echo "-----";
					}?></td>

    </tr>
    <?php
	}?>
  </table>
</form>
</div>
</body>
</html>
<?php
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_salary where salary_id='".$_GET["did"]."'";
	$con->query($delQry);
			?>
			<script>
			window.location="ViewSalary.php";
			</script>
			<?php
}
 
?>
