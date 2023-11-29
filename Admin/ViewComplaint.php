<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Complaint</title>
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
  <h1>View Complaint</h1>
  <p>&nbsp;</p>
  <table width="728" height="55"  border="1" cellpadding="10">
    <tr>
     <th width="84">Sl No</th>
      <th width="120">Student Name</th>
      <th width="204">Complaint</th>
      <th width="100">Date</th>
        <th width="96">Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_complaint c inner join tbl_student s on c.student_id=s.student_id";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $data["complaint_id"] ;?></td>
      <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td><?php echo $data["complaint_content"]?></td>
      <td><?php echo $data["complaint_date"]?></td>
      <td><?php if($data["complaint_status"]==1)
	  			{
	  			echo "Replied";
				}
				else
				{
				?>
                <a href="ComplaintReply.php?cid=<?php echo $data["complaint_id"] ?>">Reply</a> 
      			<?php
				}
				?></td>

    </tr>
   <?php
    }
	?>
  </table>
  <p>&nbsp;</p>
  <p><br>
  </p>
  <p>&nbsp;</p>
  <table width="728" height="55" border="1" cellpadding="10">
    <tr>
     <th width="84">Sl No</th>
      <th width="120">Employee Name</th>
      <th width="204">Complaint</th>
      <th width="100">Date</th>
      <th width="96">Action</th>
    </tr>
    <?php
    $selQry1="select * from tbl_complaint c inner join tbl_employee s on c.emp_id=s.emp_id";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $i ;?></td>
      <td><?php echo ucfirst($data1["emp_name"])." ".ucfirst($data1["emp_middle"])." ".ucfirst($data1["emp_last"])?></td>
      <td><?php echo $data1["complaint_content"]?></td>
      <td><?php echo $data1["complaint_date"]?></td>
      <td><?php if($data1["complaint_status"]==1)
	  			{
	  			echo "Replied";
				}
				else
				{
				?>
      			<a href="ComplaintReply.php?cid=<?php echo $data1["complaint_id"]?>">Reply</a>
      			<?php
				}
				?></td>
    </tr>
   <?php
    }
	?>
  </table>
</form>
</div>
</body>
</html>