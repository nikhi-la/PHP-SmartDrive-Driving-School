<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance</title>

</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
$sel="select * from tbl_packagebooking where student_id='".$_SESSION["uid"]."' and packagepayment_status=1";
$row=$con->query($sel);
if($data=$row->fetch_assoc())
{
?>
 <br><br><br><br><br>
<form id="form1" name="form1" method="post" action="">
	<div id="tab" align="center">
		<h3>Your Attendance</h3>
         <div id="c">
 <table width="452" border="1" cellpadding="10">
    <tr>
      <th>Sl.No</th>
      <th>Attendance Date</th>
      <th>Attendance Status</th>
    </tr>
     <?php
	 $min= date('Y-m-d', strtotime('-6 days'));
	$max= date('Y-m-d');


	$selQry1="select * from tbl_studentattendance where student_id='".$_SESSION["uid"]."' and attendance_date between '".$min."' and '".$max."' order by attendance_date";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["attendance_id"]?></td>
      <td>&nbsp;<?php echo $data1["attendance_date"] ?></td>
      <td>&nbsp;<?php if($data1["attendance_status"]==1)
	  						echo "Present";
	  					else
							echo "Absent";?></td>
    </tr>
    <?php
	}?>
    
    <tr>
    <td colspan="3"><div align="right"><a href="PreviousAttendance.php">Previous Attendance</a></div></td>
    </tr>
  </table></div>
      
</form>

</center>
<?php
include("Foot.php");
?>
</body>
</html>
 <script src="../Assets/Jquery/jQuery.js"></script>
 <script>
function getFullAttendance()
{
     var d=document.getElementById("btn").value;  

  //alert("did");
  $.ajax({
	url: "../Assets/AjaxPages/AjaxFullAttendance.php?d="+d,
	 
	  success: function(html){
		$("#c").html(html);
           // alert("html");
		
	  }
	});
	
}
</script>
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