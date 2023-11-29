<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Salary </title>
<style>
.required {
  color: red;
}
</style>
</head>

<body>
<?php
include("SessionValidator.php");
include('../Assets/Connection/Connection.php');
include("Head.php");
if(isset($_GET["empid"]))
$_SESSION["empid"]=$_GET["empid"];
if(isset($_POST["btnsave"]))
{
	$from=$_POST["txtfrom"];
	$to=$_POST["txtto"];
	$min=date('Y-m-d', strtotime('-94 days'));
	$max=date('Y-m-d');

if($from>$max || $from<$min || $from=="")
{
	?>
    <script>
    alert("Invalid From Date");
	window.location="Salary.php";
	</script>
    <?php
}
else if($to>$max || $to<$min || $to=="")
{
	?>
    <script>
    alert("Invalid To Date");
	window.location="Salary.php";
	</script>
    <?php
}
else
{
 $SelQry1="select * from tbl_salary where emp_id='".$_SESSION["empid"]."' and salary_fromdate <= '".$_POST["txtfrom"]."' and salary_todate >= '".$_POST["txtfrom"]."' and salary_fromdate <= '".$_POST["txtto"]."' and salary_todate >= '".$_POST["txtto"]."'";
	$row=$con->query($SelQry1);
	if(mysqli_num_rows($row)>0)
	{ 
			?>
			<script>
    		alert("Salary Already Given");
			window.location="ViewSalary.php";
			</script>
   			 <?php
		die();

	}
	$attendancecount=0;
	$SelQry="select * from tbl_empattendance ea  where emp_id='".$_SESSION["empid"]."' and empattendance_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."' and empattendance_status=1";
	$row=$con->query($SelQry);

	while($data1=$row->fetch_assoc())
	{
		$attendancecount++;
	}

	$salaryamount= 500*$attendancecount;

$sel="select * from tbl_regid where id=1";
$row1=$con->query($sel);
$datae=$row1->fetch_assoc();

$reg=$datae["slreg_id"];
$slid=$datae["slid_number"];
$slid++;
$length=strlen($slid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$salid=$reg.$zero.$slid;
$upQry="update tbl_regid set slid_number='".$slid."' where id=1";
$con->query($upQry);

    $ins="insert into tbl_salary(salary_id,emp_id,salary_fromdate,salary_todate,salary_amount)values('".$salid."','".$_SESSION["empid"]."','".$_POST["txtfrom"]."','".$_POST["txtto"]."','".$salaryamount."')";
	if($con->query($ins))
	{
	?>
	<script>
    alert("Salary Updated");
	window.location="ViewSalary.php";
	</script>
    <?php
	}
	else
	{
	?>
	<script>
    alert("Salary failed");
	window.location="Salary.php";
	</script>
    <?php
	}
}
}
?>
<br /><br /><br /><br /><br />
<div id="tab" align="center">
<center>
  <h1>Salary</h1></center>

<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="510" border="1" align="center" cellpadding="10">


    <tr>
      <td width="84">From Date<span class="required">  *</span></td>
      <td width="328"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" min=<?php echo date('Y-m-d', strtotime('-94 days'));?> max=<?php echo date('Y-m-d');?> required="required"/><span id="fromdateError"></span></td>
    </tr>
    <tr>
      <td>To Date<span class="required">  *</span></td>
      <td><label for="txtto"></label>
      <input type="date" name="txtto" id="txtto" min=<?php echo date('Y-m-d', strtotime('-94 days'));?> max=<?php echo date('Y-m-d');?>  required="required"/><span id="todateError"></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnsave" value="Save" />
        <input type="reset" name="btnc" value="Cancel" /></td>
    </tr>
  </table>
</form>
</div>
</body>
<br /><br /><br /><br /><br /><br /><br /><br /><br />
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });

//--------------------------------Date From Validation------------------------------------------------------ 

    var mydate1 = document.getElementById('txtfrom');
    mydate1.addEventListener('input', function() {
            var value = new Date(mydate1.value),
                min = new Date(mydate1.min),
                max = new Date(mydate1.max);
	    if( !mydate1.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("fromdateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select Date</span>";
       }
	   else{

            if (value < min )
			 {
				document.getElementById("fromdateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
             }
			 else if(value > max)
			 {
				document.getElementById("fromdateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
			 }
			 else
			  {
						document.getElementById("fromdateError").innerHTML = "";

              }
	   }
    });
	
//--------------------------------Date To Validation------------------------------------------------------ 

    var mydate = document.getElementById('txtto');
    mydate.addEventListener('input', function() {
            var value = new Date(mydate.value),
                min = new Date(mydate.min),
                max = new Date(mydate.max);
	    if( !mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("todateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select Date</span>";
       }
	   else{

            if (value < min )
			 {
				document.getElementById("todateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
             }
			 else if(value > max)
			 {
				document.getElementById("todateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
			 }
			 else
			  {
						document.getElementById("todateError").innerHTML = "";

              }
	   }
    });
	
</script>