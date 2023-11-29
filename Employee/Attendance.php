<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Attendance</title>
<style>
.butonp
{
	background-color:#999; /* Green */
  border: none;
  color: black;
  padding: 5px 10px;
  text-align: center;
  border-radius:6px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.butona
{
	background-color: #333; /* Green */
  border: none;
  color: white;
  padding: 5px 10px;
  text-align: center;
  border-radius:6px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

</head>

<body>
<?php
$addattendance="";
include("SessionValidator.php");
include("../ASSETS/Connection/connection.php");
include("Head.php");

	if(isset($_POST["checkbox1"]))
	{
	$addattendance=$_POST["checkbox1"];
	$attendancep=1;
	$s=implode(",",$addattendance);	
	for($i=0;$i<sizeof($addattendance);$i++)
	{
		$sel="select * from tbl_studentattendance where student_id='".$addattendance[$i]."' and attendance_date=curdate()";
		$row=$con->query($sel);
		if($addattendancedata=$row->fetch_assoc())
		{
			$update="update tbl_studentattendance set attendance_status= '".$attendancep."' where student_id='".$addattendance[$i]."' and attendance_date=curdate()";
			$con->query($update);
		}
		else
		{

		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["sareg_id"];
		$said=$datae["said_number"];
		$said++;
		$length=strlen($said);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$sattendid=$reg.$zero.$said;
		$upQry="update tbl_regid set said_number='".$said."' where id=1";
		$con->query($upQry);

		$ins="insert into tbl_studentattendance(attendance_id,student_id,attendance_date,attendance_status)values('".$sattendid."','".$addattendance[$i]."',curdate(),'".$attendancep."')";
		$con->query($ins);
		{
		?>
		<script>
		alert("Attendance Submitted");
		location.href="Attendance.php";
		</script>
		<?php
		}
	}
	}
	}
	if(isset($_POST["checkbox2"]))
	{
	$addattendancep=$_POST["checkbox2"];
	$attendancea=0;
	$s=implode(",",$addattendancep);	
	for($i=0;$i<sizeof($addattendancep);$i++)
	{
		$sel="select * from tbl_studentattendance where student_id='".$addattendancep[$i]."' and attendance_date=curdate()";
		$row=$con->query($sel);
		if($addattendancedata=$row->fetch_assoc())
		{
			$update="update tbl_studentattendance set attendance_status= '".$attendancea."' where student_id='".$addattendancep[$i]."' and attendance_date=curdate()";
			$con->query($update);
		}
		else
		{
			
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["sareg_id"];
		$said=$datae["said_number"];
		$said++;
		$length=strlen($said);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$sattendid=$reg.$zero.$said;
		$upQry="update tbl_regid set said_number='".$said."' where id=1";
		$con->query($upQry);
		
		$ins="insert into tbl_studentattendance(student_id,attendance_date,attendance_status)values('".$addattendancep[$i]."',curdate(),'".$attendancea."')";
		$con->query($ins);
		{
		?>
		<script>
		alert("Attendance Submitted");
		location.href="Attendance.php";
		</script>
		<?php
		}
	}
	}
}
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
	<h1>Today's Attendance</h1>
	<p>&nbsp;</p>
  <table width="562" height="241" border="1" cellpadding="6" cellspacing="6">
    <tr>
      <th width="33" rowspan="2">Sl No</th>
      <th width="153" rowspan="2">Employee Name</th>
      <th colspan="2">Attendance</th>
       <th width="120" rowspan="2">Status</th>
      </tr> 
    <tr><th width="81" height="23">Present</th><th width="67">Absent</th></tr>
	<?php
	$selQry1="select * from tbl_student s inner join tbl_assignstudent a inner join tbl_employee e on a.student_id=s.student_id and a.emp_id=e.emp_id where a.emp_id='".$_SESSION["uid"]."'";
	$row1=$con->query($selQry1);
	$i=0;
	while($data=$row1->fetch_assoc())
	{
		$i++;
		$selQry="select * from tbl_studentattendance where student_id='".$data["student_id"]."' and attendance_date=curdate()";
	$row2=$con->query($selQry);
		?>

	
    <tr>
      <td>&nbsp;<?php echo $data["student_id"]; ?></td>
    <td>&nbsp;<?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"]);?></td>
    <td><label for="checkbox"></label>
      <button class="butonp" name="checkbox1[]" id="checkbox"  value="<?php echo $data["student_id"] ?>"   >P</button>
       <td><button class="butona" name="checkbox2[]" id="checkbox"  value="<?php echo $data["student_id"] ?>"   >A</button></td>
       
       <td><?php 	if($data1=$row2->fetch_assoc())
	   {
	    if($data1["attendance_status"]==1)
	   				echo "Present";
				 else if($data1["attendance_status"]==0)
				 	echo "Absent";

	   }
				 else
				 	echo "Mark Attendance";?></td>
     <?php 
	}
	?>
    </tr>
      <tr><td colspan="5"><div align="right"><a href="PreviousAttendance.php">previous attendance </a></div></td></tr>
    
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 
</form>
</div>
</body>

</html>

<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">

$(document).ready(function() {
    $('#selectall').click(function() {
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
    })
});
</script>