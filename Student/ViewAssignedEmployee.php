<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Assigned Employee</title>

</head>

<body>
  <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
$sel="select * from tbl_packagebooking where student_id='".$_SESSION["uid"]."' and packagepayment_status=1";
$row=$con->query($sel);
$data=$row->fetch_assoc();
if(mysqli_num_rows($row)>0)
{
?>
  <br><br><br><br><br>
 <div id="tab" align="center">
<h1>Trainer</h1>
<form id="form1" name="form1" method="post" action="">

  <table width="566" height="50" border="1" cellpadding="10">
    <tr>
      <th width="56">&nbsp;Sl.No</th>
      <th width="104">&nbsp;Employee Name</th>
      <th width="100">&nbsp;Photo</th>
       <th width="114">&nbsp;Slot</th>
          </tr>
    <?php
    $selQry="select * from tbl_assignstudent a inner join tbl_student s inner join tbl_employee e on a.student_id=s.student_id and a.emp_id=e.emp_id where s.student_id='".$_SESSION["uid"]."'";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
?>

    <tr>
      <td>&nbsp;<?php echo $data["assign_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"]) ?></td>
       <td><img src="../Assets/Files/employeePhoto/<?php echo $data["emp_photo"];?>"width="100" height="100"/></td> 
       <td><a href="viewSlot.php?eid=<?php echo $data["emp_id"]?>">Book Slot</a></td>
      </tr>
<?php
}
?>
  </table>
 
</form>
 </div>
 <br><br><br><br><br>
</body>
<?php
include("Foot.php");
?>
</html>
<?php
}
else
{
?>
<script>
alert("Book Package");
window.location="Homepage.php";
</script>
<?php
}
?>