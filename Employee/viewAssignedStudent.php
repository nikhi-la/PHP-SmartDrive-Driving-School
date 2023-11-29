<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Assigned Student</title>

</head>

<body>
  <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

?>
<br><br><br><br>
<div id="tab" align="center">
<h3>Student List</h3>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="414" height="98" border="1" cellpadding="10">
    <tr>
      <th width="91">&nbsp;Sl.No</th>
      <th width="196">&nbsp;Student Name</th>
        <th width="196">&nbsp;Photo</th>
          </tr>
    <?php
    $selQry="select * from tbl_assignstudent a inner join tbl_student s inner join tbl_employee e on a.student_id=s.student_id and a.emp_id=e.emp_id where e.emp_id='".$_SESSION["uid"]."'";
$row=$con->query($selQry);
$i=0;
while($data=$row->fetch_assoc())
{
	$i++;
?>

    <tr>
      <td>&nbsp;<?php echo $data["assign_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"])?></td>
      <td><img src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"];?>"width="100" height="100"/></td>
      </tr>
<?php
}
?>
	
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
</body>
<?php 
include("Foot.php");
?>
</html>