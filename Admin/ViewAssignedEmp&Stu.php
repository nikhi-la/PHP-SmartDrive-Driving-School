<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View assigned Employee and Student</title>
</head>

<body>
  <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
?>
<br><br><br><br>
<div id="tab" align="center">
  <form id="form1" name="form1" method="post" action="EmployeeList.php">
  <h1>Assigned List</h1>
  <p>&nbsp;</p>

  <table width="549" height="50" border="1" cellpadding="10">
    <tr>
      <th width="91">&nbsp;Sl.No</th>
      <th width="196">&nbsp;Employee Name</th>
      <th width="196">&nbsp;Student Name</th>
      <th width="196">&nbsp;Action</th>
    </tr>
    <?php

    $selQry="select * from tbl_assignstudent a inner join tbl_student s inner join tbl_employee e on a.student_id=s.student_id and a.emp_id=e.emp_id ";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
?>
    <tr>
      <td>&nbsp;<?php echo $data["assign_id"]  ?></td>
      <td>&nbsp;<?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"]);?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"]);?></td>
      <td><a href="ViewAssignedEmp&Stu.php?did=<?php echo $data["assign_id"];?>">Delete</a></td>
    </tr>
    <?php
}
?>
  </table>
</form>
</div>
</body>
</html>
<?php
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_assignstudent where assign_id='".$_GET["did"]."'";
	$con->query($delQry);
			?>
			<script>
			window.location="ViewAssignedEmp&Stu.php";
			</script>
			<?php
}