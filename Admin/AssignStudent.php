<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assign Student</title>

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
  <h1>Assign Student</h1>
  <p>&nbsp;</p>
  <table width="978" height="50" border="1" cellpadding="10">
    <tr>
      <th width="45">Sl.No</th>
      <th width="167">Student Name</th>
      <th width="109">Contact</th>
      <th width="98">Email</th>
      <th width="145">Image</th>
      <th width="266">Action</th>
    </tr>
     <?php
	$selQry1="select * from tbl_student where student_vstatus=1";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	$sel4="select * from tbl_packagebooking where student_id='".$data1["student_id"]."' and packagepayment_status=1";
	$row4=$con->query($sel4);

	$selQry2="select * from tbl_assignstudent where student_id='".$data1["student_id"]."'";
	$row2=$con->query($selQry2);

	?>
    <tr>
      <td>&nbsp;<?php echo $data1["student_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data1["student_name"]);?> <?php echo ucfirst($data1["student_middle"]);?> <?php echo ucfirst($data1["student_last"]);?></td>
      <td>&nbsp;<?php echo $data1["student_contact"] ?></td>
      <td>&nbsp;<?php echo $data1["student_email"] ?></td>
      <td>&nbsp;<img src="../Assets/Files/studentPhoto/<?php echo $data1["student_photo"];?>"width="100" height="100"/></td>
       <td>&nbsp;<?php if($data4=$row4->fetch_assoc())
	   					{
	   						if($data2=$row2->fetch_assoc())
	   							echo "Assigned";
							else
								{?><a href="ViewTrainers.php?sid=<?php echo $data1["student_id"] ?>">Assign</a>
                					<?php } 
						}
						else
						{
							echo "Package not yet booked";
						}?></td>
    </tr>
     <?php
	}
	?>
  </table>
  </form>
  </div>
</body>
</html>
