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
?>
<br><br><br>
<div id="tab" align="center">
<h1>Attendance</h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
         <div id="c">
 <table width="452" border="1" cellpadding="10">
    <tr>
      <th width="117">Sl.No</th>
      <th width="283">Attendance Date</th>
      <th width="283">Attendance Status</th>
     </tr>
     <?php
	 	 $min= date('Y-m-d', strtotime('-6 days'));
	$max= date('Y-m-d');

	$selQry1="select * from tbl_empattendance where emp_id='".$_SESSION["uid"]."' and empattendance_date between '".$min."' and '".$max."' order by empattendance_date ";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["empattendance_id"]?></td>
      <td>&nbsp;<?php echo $data1["empattendance_date"] ?></td>
      <td>&nbsp;<?php if($data1["empattendance_status"]==1)
	  						echo "Present";
	  					else
							echo "Absent";?></td>
      </tr>
    <?php
	}?>
       <tr>
    <td colspan="3"><div align="right"><a href="ViewPreviousAttendance.php">Previous Attendance</a></div></td>
    </tr>
  </table>
  </div>
     <p>&nbsp;</p>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
</div>
</body>
<?php 
include("Foot.php");
?>
</html>
 <script src="../Assets/Jquery/jQuery.js"></script>
 <script>
function getFullEmpAttendance()
{
     var d=document.getElementById("btn").value;  

  //alert("did");
  $.ajax({
	url: "../Assets/AjaxPages/AjaxFullEmpAttendance.php?d="+d,
	 
	  success: function(html){
		$("#c").html(html);
           // alert("html");
		
	  }
	});
	
}
</script>