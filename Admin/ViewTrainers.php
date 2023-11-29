<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Trainers</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_GET["sid"]))
{
	$_SESSION["sid"]=$_GET["sid"];
}

if(isset($_GET["tid"]))
{
	
	$empid=$_GET["tid"];
    $selQry="select * from tbl_assignstudent where student_id='".$_SESSION["sid"]."'";
	$rows=$con->query($selQry);
	if($datas=$rows->fetch_assoc())
	{
		?>
    <script>
	alert("Already Assigned");
	window.location="AssignStudent.php";
    </script>
    <?php
	}
	else
	{
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["asreg_id"];
		$asid=$datae["asid_number"];
		$asid++;
		$length=strlen($asid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$assignid=$reg.$zero.$asid;
		$upQry="update tbl_regid set asid_number='".$asid."' where id=1";
		$con->query($upQry);
		
	$insQry="insert into tbl_assignstudent(assign_id,student_id,emp_id)values('".$assignid."','".$_SESSION["sid"]."','".$empid."')";
	if($con->query($insQry))
	{
	?>
    <script>
	alert("Data inserted");
	window.location="AssignStudent.php";
    </script>
    <?php
	}
	else
	{
	?>
    <script>
	alert("Failed");
	window.location="AssignStudent.php";
    </script>
    <?php
	}
	}
}
?>
<br><br><br>
<div id="tab" align="center">
<h1>Assign Trainer</h1>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
   <table  border="1" cellpadding="10">
    <tr>
      <th width="50">Sl.No</th>
      <th width="106">Name</th>
      <th width="85">Contact</th>
      <th width="85">Email</th>
      <th width="114">Photo</th>
      <th width="85">Action</th>
      </tr>
    <?php
    $selQry="select * from tbl_employee";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td height="188"><?php echo $data["emp_id"]?></td>
      <td><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"])?></td>
	  <td><?php echo $data["emp_contact"];?></td>
      <td><?php echo $data["emp_email"];?></td>
      <td><img src="../Assets/Files/employeePhoto/<?php echo $data["emp_photo"];?>"width="100" height="100"/></td>
      <td>&nbsp;<a href="ViewTrainers.php?tid=<?php echo $data["emp_id"] ?>">Assign</a></td>
      </tr>
    <?php
	}
	?>
  </table>
</form>
</div>
</body>
</html>