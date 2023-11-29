<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View feedback</title>
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
  <h1>&nbsp;</h1>
  <h1>View Feedback</h1>
  <p>&nbsp;</p>
  <table  border="1" cellpadding="10">
    <tr>
     <th width="68">Sl No</th>
      <th width="151">Student Name</th>
      <th width="116">Feedback</th>
      <th width="81">Date</th>
    </tr>
    <?php
    $selQry="select * from tbl_feedback f inner join tbl_student s on f.student_id=s.student_id";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $data["feedback_id"];?></td>
      <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td><?php echo $data["feedback_content"]?></td>
      <td><?php echo $data["feedback_date"]?></td>
    </tr>
   <?php
    }
	?>
  </table>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table  border="1" cellpadding="10">
    <tr>
     <th width="63">Sl No</th>
      <th width="168">Employee Name</th>
      <th width="108">Feedback</td>
      <th width="76">Date</th>
      </tr>
    <?php
    $selQry="select * from tbl_feedback f inner join tbl_employee e on f.emp_id=e.emp_id";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $data["feedback_id"];?></td>
      <td><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"])?></td>
      <td><?php echo $data["feedback_content"]?></td>
      <td><?php echo $data["feedback_date"]?></td>
    </tr>
   <?php
    }
	?>
  </table>
</form>
</div>
</body>
</html>