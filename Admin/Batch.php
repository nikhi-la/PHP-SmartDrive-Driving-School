<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Batch</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
span
{
	color: red;
	text: 12px;
	font-size: 14px;
	
}
</style>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
include("SessionValidator.php");
include("Head.php");

if(isset($_POST["btnsave"]))
{
	$empid=$_POST["txtempname"];
	$date=$_POST["txtdate"];
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));
	$start=$_POST["txtstart"];
	$startfloat = (float)$start;	
	$startmin="08:00";
	$startmax="17:00";
	
	$end=$_POST["txtend"];
	$endfloat = (float)$end;
	$endmin="09:00";
	$endmax="18:00";
	$diff=$endfloat-$startfloat;
	
	if ($empid=="")
	{
	?>
	<script>
    alert("Select Employee Name");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if($date < $min || $date > $max || $date == "")
	{
	?>
    <script>
    alert("Invalid Date");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if( $start < $startmin || $start > $startmax || $start== "" )
	{
	?>
    <script>
    alert("Enter Valid Start Time");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if( $end < $endmin || $end > $endmax || $end== ""  )
	{
	?>
    <script>
    alert("Enter Valid End Time");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if(  $end < $start )
	{
	?>
    <script>
    alert("End Time should greater than start time");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if(  $end == $start )
	{
	?>
    <script>
    alert("End Time should not equal to start time");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if(  $diff < 1 )
	{
	?>
    <script>
    alert("Minimum Hour Difference 1 Hr");
	window.location="Batch.php";
	</script>
    <?php
	}
	else if(  $diff > 10 )
	{
	?>
    <script>
    alert("Maximum Hour Difference 10 Hr");
	window.location="Batch.php";
	</script>
    <?php
	}

	else
	{
	$hid=$_POST["txtid"];
	if($hid!="")
	{
	$updateQry="update tbl_batch set emp_id='".$empid."',batch_date='".$date."',batch_starttime='".$start."',batch_endtime='".$end."' where batch_id='".$hid."'";
	$con->query($updateQry);
	header("Location:Batch.php");
	}
	else
	{	

	$selQry2="select * from tbl_batch where emp_id= '".$empid."' and batch_date='".$date."'";
	$row2=$con->query($selQry2);
	if($data2=$row2->fetch_assoc())
	{
	?>
	<script>
	alert("Batch Already Set  For The Employee On This Day");
	window.location="Batch.php";
	</script>
	<?php	
	}
	else
	{
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["breg_id"];
		$baid=$datae["bid_number"];
		$baid++;
		$length=strlen($baid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$batchhid=$reg.$zero.$baid;
		$upQry="update tbl_regid set bid_number='".$baid."' where id=1";
		$con->query($upQry);


		
	$insQry="insert into tbl_batch(batch_id,emp_id,batch_date,batch_starttime,batch_endtime)values('".$batchhid."','".$empid."','".$date."','".$start."','".$end."')";
	if($con->query($insQry))
	{
	?>
    <script>
	alert("Data inserted");
	window.location="Batch.php";
    </script>
    <?php
	}
	else
	{
	?>
    <script>
	alert("Failed");
	window.location="Batch.php";
    </script>
    <?php
	}
	}
	}
	}
}

if(isset($_GET["did"]))
{
	$delQry="delete from tbl_batch where batch_id='".$_GET["did"]."'";
	$con->query($delQry);
	?>
    <script>
	window.location="Batch.php";
    </script>
    <?php
}
$eid="";
$ename="";
$edate="";
$estime="";
$eetime="";

if(isset($_GET["eid"]))
{
	$selQry="select * from tbl_batch where batch_id='".$_GET["eid"]."' ";
	$row2=$con->query($selQry);
	$data2=$row2->fetch_assoc();
	$eid=$data2["batch_id"];
	$ename=$data2["emp_id"];
	$edate=$data2["batch_date"];
	$estime=$data2["batch_starttime"];
	$eetime=$data2["batch_endtime"];

}

?>

<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post">
	<h1>Batch</h1>
<table width="565" height="280" border="1" cellpadding="10">
    <tr>
      <td width="131">Employee Name<span class="required">  *</span></td>
      <td width="382"><label for="txtempname"  ></label>
       <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
       <select name="txtempname" id="txtempname"  onchange="getSearch();validateName(this)" required>
       <option value="" >---SELECT---</option>
        <?php
    $selQry="select * from tbl_employee ";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <option  value="<?php echo $data["emp_id"] ?>"><?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"]);?></option>
          <?php
		  }
		  ?>
      </select><span id="name"></span></td>
    <tr>
      <td>Batch Date<span class="required">  *</span></td>
      <td><label for="txtdate"></label>
      <input type="date" name="txtdate" id="txtdate" value="<?php echo $edate;?>" min=<?php  echo date('Y-m-d'); ?> max= <?php echo date('Y-m-d', strtotime('+6 days'));?> required="required" autocomplete="off" />
      &nbsp;<span id="mindateError"></span><span id="min"></span><span id="and"></span><span id="max"></span></td>
    </tr>
    <tr>
      <td>Start Time<span class="required">  *</span></td>
      <td><label for="txtstart"></label>
      <input type="time" name="txtstart" id="txtstart" value="<?php echo $estime;?>" min="08:00" max="17:00" required="required" autocomplete="off" />
      <span id="starttimeError"></span><span id="tmin"></span><span id="tand"></span><span id="tmax"></span></td>
    </tr>
    <tr>
      <td>End Time<span class="required">  *</span></td>
      <td><label for="txtend"></label>
      <input type="time" name="txtend" id="txtend" value="<?php echo $eetime;?>"  onchange="HourDiff();" min="09:00" max="18:00" required="required" autocomplete="off" />
      <span id="endtimeError"></span><span id="emin"></span><span id="eand"></span><span id="emax"></span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Submit" />
        <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" />
      </div></td>
      
    </tr>
  </table>
     <br><br>
   <div id="t1">
  <table width="839" height="50" border="1" cellpadding="10">
    <tr>
      <th width="69" >Sl.No</th>
      <th width="88">Employee Name</th>
      <th width="103">Date</th>
      <th width="77">Start Time</th>
      <th width="87">End Time</th>
      <th width="109">Action</th>
      <th width="134">Slot</th>
    </tr>
    <?php
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+10 days'));

	$selQry1="select * from tbl_batch b inner join tbl_employee e on b.emp_id=e.emp_id and b.batch_date between '".$min."' and '".$max."' order by e.emp_id,b.batch_date ";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["batch_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data1["emp_name"]);?> <?php echo ucfirst($data1["emp_middle"]);?> <?php echo ucfirst($data1["emp_last"]);?></td>
      <td>&nbsp;<?php echo $data1["batch_date"] ?></td>
       <td>&nbsp;<?php echo $data1["batch_starttime"] ?></td>
        <td>&nbsp;<?php echo $data1["batch_endtime"] ?></td>
       <td>&nbsp;<a href="Batch.php?did=<?php echo $data1["batch_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Batch.php?eid=<?php echo $data1["batch_id"]?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
       <td>&nbsp;<a href="Slot.php?bid=<?php echo $data1["batch_id"]?>">Add Slot</a></td>
 
    </tr>
    <?php
	}
	?>
  </table>
 </form>

</div>
</center>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });


 
//--------------------------------Employee Validation------------------------------------------------------ 
function validateName(elem)
{
    var name=elem.value;
    if( name=="")
       {
		document.getElementById("name").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select Employee Name</span>";
       }
	else
		{
		document.getElementById("name").innerHTML = "";
       }
 }
 
 
//--------------------------------Date Validation------------------------------------------------------ 

//Current Date

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = dd + '-' + mm + '-' + yyyy;


var today6 = new Date();

var number=6;
var result = today6.setDate(today6.getDate() + number );
var dd6 = String(today6.getDate()).padStart(2, '0');
var mm6 = String(today6.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy6 = today6.getFullYear();
result= dd6 + '-' + mm6 + '-' + yyyy6;

    var batchdate = document.getElementById('txtdate');
	    batchdate.addEventListener('input', function() {
            var value = new Date(batchdate.value),
                min = new Date(batchdate.min),
                max = new Date(batchdate.max);
	    if( !batchdate.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("mindateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
        document.getElementById("and").innerHTML = "";
 		document.getElementById("min").innerHTML = "";
		document.getElementById("max").innerHTML ="";
	   }
	   else{

            if (value < min || value > max)
			 {
				document.getElementById("mindateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>select date between </span>";
				document.getElementById("and").innerHTML = " & ";
				document.getElementById("min").innerHTML = today;
				document.getElementById("max").innerHTML = result;
				

             }
			else
			  {
				document.getElementById("mindateError").innerHTML = "";
				document.getElementById("and").innerHTML = "";
 				document.getElementById("min").innerHTML = "";
				document.getElementById("max").innerHTML ="";


              }
	   }
    });

//--------------------------------StartTime Validation------------------------------------------------------ 
	
	
    var starttime = document.getElementById('txtstart');
	    starttime.addEventListener('input', function() {
            var value = starttime.value;
                min = starttime.min;
                max = starttime.max;
	    if( !starttime.value.match(/\d+:\d+/))
       {
		document.getElementById("starttimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Time</span>";
		document.getElementById("tand").innerHTML = "";
		document.getElementById("tmin").innerHTML = "";
		document.getElementById("tmax").innerHTML ="";

       }
	   else{

            if (value < min || value > max)
			 {
				document.getElementById("starttimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>select time between </span>";
				document.getElementById("tand").innerHTML = " & ";
				document.getElementById("tmin").innerHTML = min;
				document.getElementById("tmax").innerHTML = max;
				

             }
			else
			  {
				document.getElementById("starttimeError").innerHTML = "";
				document.getElementById("tand").innerHTML = "";
 				document.getElementById("tmin").innerHTML = "";
				document.getElementById("tmax").innerHTML ="";


              }
	   }
    });

//--------------------------------EndTime Validation------------------------------------------------------ 
	
	
    var endtime = document.getElementById('txtend');
	var starttime = document.getElementById('txtstart');	

	    endtime.addEventListener('input', function() {
            var value = endtime.value;
                min = endtime.min;
                max = endtime.max;
				var value1 = starttime.value;
	    if( !endtime.value.match(/\d+:\d+/))
       {
		document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Time</span>";
		document.getElementById("eand").innerHTML = "";
		document.getElementById("emin").innerHTML = "";
		document.getElementById("emax").innerHTML ="";

       }
	   else{

            if (value < min || value > max)
			 {
				document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>select time between ";
				document.getElementById("eand").innerHTML = " & ";
				document.getElementById("emin").innerHTML = min;
				document.getElementById("emax").innerHTML = max;
				

             }
			 else if (value < value1)
			 {
				document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Choose end time greater than ";
				document.getElementById("eand").innerHTML = value1;
				document.getElementById("emin").innerHTML = "";
				document.getElementById("emax").innerHTML = "";
				
				

             }
			 
			 else if (value == value1)
			 {
				document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>End time should not equal to start time ";
				document.getElementById("eand").innerHTML = "";
				document.getElementById("emin").innerHTML = "";
				document.getElementById("emax").innerHTML = "";
				

             }
			else 
			  {
				document.getElementById("endtimeError").innerHTML = "";
				document.getElementById("eand").innerHTML = "";
 				document.getElementById("emin").innerHTML = "";
				document.getElementById("emax").innerHTML ="";


              }	
	   }
	   
    });
 </script>
 <script src="../Assets/Jquery/jQuery.js"></script>
 <script>
function getSearch()
{
  var d=document.getElementById("txtempname").value;  
  //alert(did);
	$.ajax({
	url: "../Assets/AjaxPages/AjaxBatchSearch.php?d="+d,
	 
	  success: function(html){
		$("#t1").html(html);
               // alert(html);
		
	  }
	});
}

</script>
<script>
//-----------minimum and maximum hour validation--------

$('#txtend').on('change',function() 
{

   var start = document.getElementById('txtstart').value;
   var end =  document.getElementById('txtend').value;
   s = start.split(':');
   e = end.split(':');
   min = e[0]-s[0];
   hour_carry = 0;
   if(min < 0){
       min += 60;
       hour_carry += 1;
   }
   if(min < 1){
          document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Minimum Time difference 1 Hr";    
		  document.getElementById("eand").innerHTML = "";
  		  document.getElementById("emin").innerHTML = "";
	      document.getElementById("emax").innerHTML ="";

   }
   if(min > 10){
          document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Maximum Time difference 10 Hr";    
		  document.getElementById("eand").innerHTML = "";
  		  document.getElementById("emin").innerHTML = "";
	      document.getElementById("emax").innerHTML ="";

   }
   
   });
</script>
