<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Previous Attendance</title>
<style>
.required {
  color: red;
}
.butonp
{
	background-color: #360; /* Green */
  border: none;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  border-radius:6px;
  cursor: pointer;
}
.butona
{
	background-color: #C00; /* Green */
  border: none;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  border-radius:6px;
  cursor: pointer;
}

</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	if(isset($_POST["checkbox1"]))
	{
      $date=$_POST["txtdate"];
	  $min="2000-01-01";
	  $max=date('Y-m-d');
	  if($date>$max || $date<$min || $date=="")
		{
			?>
 		   <script>
		    alert("Invalid Date");
			window.location="PreviousAttendance.php";
			</script>
		    <?php
		}
		else
		{
			$addattendance=$_POST["checkbox1"];
			$attendancep=1;
			$s=implode(",",$addattendance);	
			for($i=0;$i<sizeof($addattendance);$i++)
				{
					$sel="select * from tbl_empattendance where emp_id='".$addattendance[$i]."' and empattendance_date='".$_POST["txtdate"]."'";
					$row=$con->query($sel);
					if($addattendancedata=$row->fetch_assoc())
						{
							$update="update tbl_empattendance set empattendance_status= '".$attendancep."' where emp_id='".$addattendance[$i]."' and empattendance_date='".$_POST["txtdate"]."'";
							$con->query($update);
						}
					else
						{
							$sel="select * from tbl_regid where id=1";
							$row1=$con->query($sel);
							$datae=$row1->fetch_assoc();

							$reg=$datae["eareg_id"];
							$eaid=$datae["eaid_number"];
							$eaid++;
							$length=strlen($eaid);
							if($length==1)
							$zero="000";
							if($length==2)
							$zero="00";
							if($length==3)
							$zero="0";
							if($length==4)
							$zero="";
							$eattendid=$reg.$zero.$eaid;
							$upQry="update tbl_regid set eaid_number='".$eaid."' where id=1";
							$con->query($upQry);
		
							$ins="insert into tbl_empattendance(empattendance_id,emp_id,empattendance_date,empattendance_status)values('".$eattendid."','".$addattendance[$i]."','".$_POST["txtdate"]."','".$attendancep."')";
							if($con->query($ins))
								{
									?>
									<script>
									alert("Attendance Submitted");
									location.href="PreviousAttendance.php";
									</script>
									<?php
								}
							}
					}
			}
		}
	if(isset($_POST["checkbox2"]))
	{

      $date=$_POST["txtdate"];
	  $min="2000-01-01";
	  $max=date('Y-m-d');
	  if($date>$max || $date<$min || $date=="")
		{
			?>
 		   <script>
		    alert("Invalid Date");
			window.location="PreviousAttendance.php";
			</script>
		    <?php
		}
		else
		{
	$addattendancep=$_POST["checkbox2"];
	$attendancea=0;
	$s=implode(",",$addattendancep);	
	for($i=0;$i<sizeof($addattendancep);$i++)
	{
		$sel="select * from tbl_empattendance where emp_id='".$addattendancep[$i]."' and empattendance_date='".$_POST["txtdate"]."'";
		$row=$con->query($sel);
		if($addattendancedatap=$row->fetch_assoc())
		{
			$update="update tbl_empattendance set empattendance_status= '".$attendancea."' where emp_id='".$addattendancep[$i]."' and empattendance_date='".$_POST["txtdate"]."'";
			$con->query($update);
		}
		else
		{
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["eareg_id"];
		$eaid=$datae["eaid_number"];
		$eaid++;
		$length=strlen($eaid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$eattendid=$reg.$zero.$eaid;
		$upQry="update tbl_regid set eaid_number='".$eaid."' where id=1";
		$con->query($upQry);
		
		$ins="insert into tbl_empattendance(empattendance_id,emp_id,empattendance_date,empattendance_status)values('".$eattendid."','".$addattendancep[$i]."','".$_POST["txtdate"]."','".$attendancea."')";
		if($con->query($ins))
		{
		?>
		<script>
		alert("Attendance Submitted");
		location.href="PreviousAttendance.php";
		</script>
		<?php
		}
	}
	
	}
}
}
?>
<br><br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
<center>
  <table width="455"  border="0" cellpadding="10">
    <tr>
      <td width="98" >Select Date<span class="required">  *</span></td>
      <td width="299" ><input type="date" name="txtdate" id="txtdate" min="2000-01-01" max="<?php echo date('Y-m-d'); ?>"  value="<?php echo date('Y-m-d');?>" onchange="getdateSearch()"/><span id="mydateError"></span>
      </td>
      
     </tr>
            <hr>
            </table>
            <hr>
      <div id="txtdiv">
     <h1><?php echo date('Y-m-d');?></h1>
            
  <table width="562" height="241" border="1" cellpadding="6" cellspacing="6">
    <tr>
      <th width="33" rowspan="2">Sl No</th>
      <th width="153" rowspan="2">Employee Name</th>
      <th colspan="2">Attendance</th>
       <th width="120" rowspan="2">Status</th>
      </tr> 
    <tr><th width="81" height="23">Present</th><th width="67">Absent</th></tr>
	<?php
	$selQry1="select * from tbl_employee";
	$row1=$con->query($selQry1);
	$i=0;
	while($data=$row1->fetch_assoc())
	{
		$i++;
	$selQry="select * from tbl_empattendance where emp_id='".$data["emp_id"]."' and empattendance_date=curdate()";
	$row2=$con->query($selQry);
		?>
	
    <tr>
      <td>&nbsp;<?php echo $data["emp_id"]; ?></td>
    <td>&nbsp;<?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"])?></td>
    
    <td><label for="checkbox"></label>
      <button class="butonp" name="checkbox1[]" id="checkbox"  value="<?php echo $data["emp_id"] ?>"  >P</button>
</td>
       <td><button class="butona" name="checkbox2[]" id="checkbox"  value="<?php echo $data["emp_id"] ?>" >A</button></td>
       
       <td><?php 	if($data1=$row2->fetch_assoc())
	   {
	    if($data1["empattendance_status"]==1)
	   				echo "Present";
				 else if($data1["empattendance_status"]==0)
				 	echo "Absent";

	   }
				 else
				 	echo "Mark Attendance";?></td>
     <?php 
	}
	?>
    </tr>
  </table>

        <p>&nbsp;</p>
            </div>
  </center>
</form>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">


function getdateSearch()
{
  var d=document.getElementById("txtdate").value;  
  //alert(did);
	$.ajax({
	url: "../Assets/AjaxPages/AjaxPreviousAttendanceSearch.php?d="+d,
	 
	  success: function(html){
		$("#txtdiv").html(html);
               // alert(html);
		
	  }
	});
}
$(document).ready(function() {
    $('#selectall').click(function() {
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
    })
});

//--------------------------------Date Of Birth Validation------------------------------------------------------ 

    var mydate = document.getElementById('txtdate');
    mydate.addEventListener('input', function() {
            var value = new Date(mydate.value),
                min = new Date(mydate.min),
                max = new Date(mydate.max);
	    if( !mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select DOB</span>";
       }
	   else{

            if (value < min )
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
             }
			 else if(value > max)
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
			 }
			 else
			  {
						document.getElementById("mydateError").innerHTML = "";

              }
	   }
    });
	
</script>