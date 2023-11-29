<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Slot</title>
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
if(isset($_GET["bid"]))
{
	$_SESSION["bid"]=$_GET["bid"];
}

if(isset($_POST["btnsave"]))
{
	
    $selQry1="select * from tbl_batch where batch_id='".$_SESSION["bid"]."'";
	$row1=$con->query($selQry1);
	$data1=$row1->fetch_assoc();

	$slotnumber=$_POST["txtslotnumber"];
	
	$slotdate=$_POST["txtslotdate"];
	$datemin=$data1["batch_date"];
	$datemax=$data1["batch_date"];
	
	$start=$_POST["txtstart"];
	$startfloat = (int)$start;	
	$start=substr($start,0,5);
	$startmin=$data1["batch_starttime"];
	$startmin=substr($startmin,0,5);
	$startmax=$data1["batch_endtime"];
	$startmax=substr($startmax,0,5);
	
	$end=$_POST["txtend"];
	$endfloat = (int)$end;
	$end=substr($end,0,5);
	$endmin=$data1["batch_starttime"];
	$endmin=substr($endmin,0,5);
	$endmax=$data1["batch_endtime"];
	$endmax=substr($endmax,0,5);
	
	$diff=$endfloat-$startfloat;
	if(!is_numeric($slotnumber))
	{
	?>
    <script>
	alert("Slot Number Should be an Integer");
	window.location="Slot.php";
    </script>
    <?php
	}
	else if($slotnumber=="")
	{
	?>
    <script>
	alert("Enter Slot Number");
	window.location="Slot.php";
    </script>
    <?php
	}
	else if($slotnumber<0 || $slotnumber>10)
	{
	?>
    <script>
	alert("Choose Slot 1-Slot 10");
	window.location="Slot.php";
    </script>
    <?php
	}
	else if($slotdate < $datemin || $slotdate > $datemax || $slotdate == "")
	{
	?>
    <script>
    alert("Invalid Date");
	window.location="Slot.php";
	</script>
    <?php
	}
	else if( $start < $startmin || $start > $startmax || $start== "" )
	{
	?>
    <script>
    alert("Enter Valid Start Time");
	window.location="Slot.php";
	</script>
    <?php
	}
	else if( $end < $endmin || $end > $endmax || $end== ""  )
	{
	?>
    <script>
    alert("Enter Valid End Time");
	window.location="Slot.php";
	</script>
    <?php
	}
	else if(  $end < $start )
	{
	?>
    <script>
    alert("End Time should greater than start time");
	window.location="Slot.php";
	</script>
    <?php
	}
	else if(  $end == $start )
	{
	?>
    <script>
    alert("End Time should not equal to start time");
	window.location="Slot.php";
	</script>
    <?php
	}
	else if(  $diff < 1)
	{
	?>
    <script>
    alert("Time Difference must be 1 Hr");
	window.location="Slot.php";
	</script>
    <?php
	}

else
{	
	$hid=$_POST["txtid"];
	if($hid!="")
	{
	$updateQry="update tbl_studentslot set studentslot_number='".$slotnumber."',studentslot_starttime='".$start."',studentslot_endtime='".$end."',batch_id='".$_SESSION["bid"]."',studentslot_date='".$slotdate."', curr_date=curdate() where studentslot_id='".$hid."'";
	$con->query($updateQry);
	?>
    <script>
	window.location="Slot.php";
    </script>
    <?php
	}
	else
	{

	$selQry2="select * from tbl_studentslot where batch_id= '".$_SESSION["bid"]."' and studentslot_number='".$slotnumber."'";
	$row2=$con->query($selQry2);
	if($data2=$row2->fetch_assoc())
	{
	?>
	<script>
	alert("Slot Already Exist");
	window.location="Slot.php";
	</script>
	<?php	
	}

	else
	{

$sel="select * from tbl_regid where id=1";
$row1=$con->query($sel);
$datae=$row1->fetch_assoc();

$reg=$datae["ssreg_id"];
$ssid=$datae["ssid_number"];
$ssid++;
$length=strlen($ssid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$stuslotid=$reg.$zero.$ssid;
$upQry="update tbl_regid set ssid_number='".$ssid."' where id=1";
$con->query($upQry);


	$insQry="insert into tbl_studentslot(studentslot_id,studentslot_number,studentslot_starttime,studentslot_endtime,batch_id,studentslot_date,curr_date)values('".$stuslotid."','".$slotnumber."','".$start."','".$end."','".$_SESSION["bid"]."','".$slotdate."',curdate())";

	if($con->query($insQry))
	{
	?>
    <script>
	alert("Data inserted");
	window.location="Slot.php";
    </script>
    <?php
	}
	else
	{
	?>
    <script>
	alert("Failed");
	window.location="Slot.php";
    </script>
    <?php
	}
	}
	}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_studentslot where studentslot_id='".$_GET["did"]."'";
	$con->query($delQry);
	?>
    <script>
	window.location="Slot.php";
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
	$selQry="select * from tbl_studentslot where studentslot_id='".$_GET["eid"]."' ";
	$row2=$con->query($selQry);
	$data2=$row2->fetch_assoc();
	$eid=$data2["studentslot_id"];
	$ename=$data2["studentslot_number"];
	$edate=$data2["studentslot_date"];
	$estime=$data2["studentslot_starttime"];
	$eetime=$data2["studentslot_endtime"];

}



    $selQry="select * from tbl_batch where batch_id='".$_SESSION["bid"]."'";
	$row=$con->query($selQry);
	$data=$row->fetch_assoc();
	$date=$data["batch_date"];
	$min=$data["batch_starttime"];
	$max=$data["batch_endtime"];
	

?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post">
	<h1>Slot</h1>
  <table width="527" height="279" border="1" cellpadding="10">
    <tr>
      <td width="119">Slot Number<span class="required">  *</span></td>
      <td width="291"><label for="txtslotnumber"></label>
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>"  />
      <input type="text" name="txtslotnumber" id="txtslotnumber" placeholder="slot 1-slot 10"  value="<?php echo ucfirst($ename)?>" onkeyup="validateSlot(this)" autocomplete="off" required="required" />
      <span id="sloterr"></span></td>
    </tr>
    <tr>
      <td width="119">Date<span class="required">  *</span></td>
      <td width="291"><label for="txtslotdate"></label>
      <input type="date" name="txtslotdate" id="txtslotdate" value="<?php echo $date?>" min="<?php echo $date?>" max="<?php echo $date?>" autocomplete="off" required="required"  />
      <span id="mindateError"></span><span id="min"></span></td>
    </tr>
    <tr>
      <td>Start Time<span class="required">  *</span></td>
      <td><label for="txtstart"></label>
      <input type="time" name="txtstart" id="txtstart"  min="<?php echo $min?>" max="<?php echo $max?>" value="<?php echo $estime?>" autocomplete="off" required="required" />
      <span id="starttimeError"></span><span id="tmin"></span><span id="tand"></span><span id="tmax"></span></td>
    </tr>
    <tr>
      <td>End Time<span class="required">  *</span></td>
      <td><label for="txtend"></label>
      <input type="time" name="txtend" id="txtend" min="<?php echo $min?>" max="<?php echo $max?>" value="<?php echo $eetime?>" autocomplete="off" required="required" />
      <span id="endtimeError"></span><span id="emin"></span><span id="eand"></span><span id="emax"></span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Submit" />
        <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </form>
  <form id="form1" name="form1" method="post">
  <table width="719" height="121" border="1" cellpadding="10">
    <tr>
      <th width="71" height="70">Sl.No</th>
      <th width="98">Slot Number</th>
      <th width="72">Start Time</th>
      <th width="88">End Time</th>
      <th width="135">Action</th>
  
    </tr>
    <?php
	$selQry1="select * from tbl_studentslot  where batch_id='".$_SESSION["bid"]."' order by studentslot_starttime ";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["studentslot_id"]?></td>
      <td>&nbsp;<?php echo $data1["studentslot_number"] ?></td>
       <td>&nbsp;<?php echo $data1["studentslot_starttime"] ?></td>
        <td>&nbsp;<?php echo $data1["studentslot_endtime"] ?></td>
       <td>&nbsp;<a href="Slot.php?did=<?php echo $data1["studentslot_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Slot.php?eid=<?php echo $data1["studentslot_id"]?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
 
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

//--------------------------------Slot Number Validation------------------------------------------------------ 

function validateSlot(elem)
{
	var nameexp = /^[0-9 ]+$/;
	 if(elem.value.match(nameexp))
       {
		document.getElementById("sloterr").innerHTML = "";
		if(elem.value>10 || elem.value<1)
		{
					document.getElementById("sloterr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid slot Number</span>";

		}
		   }
    else

		document.getElementById("sloterr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Only Digits Are Allowed</span>";
		
		return false;
}



//--------------------------------Date Validation------------------------------------------------------ 
    var slotdate = document.getElementById('txtslotdate');
	    slotdate.addEventListener('input', function() {
            var value = new Date(slotdate.value),
                min = new Date(slotdate.min);
var minimum = new Date(min);
var dd = String(minimum.getDate()).padStart(2, '0');
var mm = String(minimum.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = minimum.getFullYear();
minimum = dd + '-' + mm + '-' + yyyy;

var dd1 = String(value.getDate()).padStart(2, '0');
var mm1 = String(value.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy1 = value.getFullYear();
value = dd1 + '-' + mm1 + '-' + yyyy1;

	    if( !slotdate.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("mindateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
        document.getElementById("min").innerHTML = ""
	   }
	   else{

            if (value != minimum )
			 {
				document.getElementById("mindateError").innerHTML = "select ";
				document.getElementById("min").innerHTML = minimum;
				

             }
			else 
			  {
				document.getElementById("mindateError").innerHTML = "";
 				document.getElementById("min").innerHTML = "";

              }
	   }
    });



//--------------------------------StartTime Validation------------------------------------------------------ 
	
	
	
    var starttime = document.getElementById('txtstart');
	    starttime.addEventListener('input', function() {
            var value = starttime.value;
                min = starttime.min;
                max = starttime.max;
const resultMin = min.slice(0, min.lastIndexOf(":"));
const resultMax = max.slice(0, max.lastIndexOf(":"));
				
	    if( !starttime.value.match(/\d+:\d+/))
       {
		document.getElementById("starttimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Time</span>";
		document.getElementById("tand").innerHTML = "";
		document.getElementById("tmin").innerHTML = "";
		document.getElementById("tmax").innerHTML ="";

       }
	   else{

            if (value < resultMin || value > resultMax)
			 {
				document.getElementById("starttimeError").innerHTML ="<span >Select time between </span>";
				document.getElementById("tand").innerHTML = " & ";
				document.getElementById("tmin").innerHTML = resultMin;
				document.getElementById("tmax").innerHTML = resultMax;
				

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
const resultMin = min.slice(0, min.lastIndexOf(":"));
const resultMax = max.slice(0, max.lastIndexOf(":"));

	    if( !endtime.value.match(/\d+:\d+/))
       {
		document.getElementById("endtimeError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Time</span>";
		document.getElementById("eand").innerHTML = "";
		document.getElementById("emin").innerHTML = "";
		document.getElementById("emax").innerHTML ="";
	   }
	   else{

            if (value < resultMin || value > resultMax)
			 {
				document.getElementById("endtimeError").innerHTML = "select time between ";
				document.getElementById("eand").innerHTML = " & ";
				document.getElementById("emin").innerHTML = resultMin;
				document.getElementById("emax").innerHTML = resultMax;
				

             }
			 else if (value < value1)
			 {
				document.getElementById("endtimeError").innerHTML = "Choose end time greater than ";
				document.getElementById("eand").innerHTML = value1;
				document.getElementById("emin").innerHTML = "";
				document.getElementById("emax").innerHTML = "";
				

             }
			 else if (value == value1)
			 {
				document.getElementById("endtimeError").innerHTML = "End time should not equal to start time ";
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
   if(min != 1){
          document.getElementById("endtimeError").innerHTML = "Time difference must be 1 hr ";    
		  document.getElementById("eand").innerHTML = "";
  		  document.getElementById("emin").innerHTML = "";
	      document.getElementById("emax").innerHTML ="";

   }
   });
</script>
