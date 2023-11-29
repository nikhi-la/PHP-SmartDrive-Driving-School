12<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Slot</title>
</head>

<body>
  <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_GET["eid"]))
{
	$_SESSION["eid"]=$_GET["eid"];
}

	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));


$selQry="select * from tbl_batch   where emp_id='".$_SESSION["eid"]."' and  batch_date between '".$min."' and '".$max."'";
$row=$con->query($selQry);
?>
<form id="form1" name="form1" method="post" action="">

  <table width="1459" height="94" border="0" cellpadding="5">
    <tr>
    <?php
	while($data1=$row->fetch_assoc())
	{
	?>
      <td width="500"><p>
        <input type="submit" name="btndate1" id="btndate1" value="<?php echo $data1["batch_date"]?>" onmouseover="getSlotDetails(this)"/>
      </p>
      <p><?php echo $data1["batch_starttime"]?> - <?php echo $data1["batch_endtime"]?></p></td>
       
    <?php
    $selQry1="select * from tbl_studentslot s inner join tbl_batch b  on s.batch_id=b.batch_id  where b.emp_id='".$_SESSION["eid"]."' and studentslot_date='" .$data1["batch_date"] . "' order by studentslot_starttime";
			//echo $selQry1;
            
            $row1=$con->query($selQry1);
$i=0;
while($data=$row1->fetch_assoc())
{
 $i++;

        ?>



            


                <td width="650"><button <?php if($data["slotbook_status"]==1) {?> disabled <?php }?> name="btnslotbook" value="<?php echo $data["studentslot_id"]?>"><p align="center"  >
                        Slot                 <?php echo $data["studentslot_number"]?>
                    <p align="center"  ><?php echo $data["studentslot_starttime"]  ?>-<?php echo $data["studentslot_endtime"]  ?>
                    </button>
         </td>
        		 <?php 
             
		   
}?><td width="600"><a href="BookedSlotDetails.php?batchhid=<?php echo $data1["batch_id"]?>">Booked Details</a></td></tr><?php
}?>

           
         </tr></table>
</form>
</div>
 


</body>
<?php
include("Foot.php");
?>
<script src="../Assets/Jquery/jQuery.js"></script>
<script>
function getSlotDetails(slot)
{
  var d=slot.value;  
  //alert(did);
	$.ajax({
	url: "../Assets/AjaxPages/AjaxSlotSearch.php?d="+d,
	 
	  success: function(html){
		$("#slot").html(html);
               // alert(html);
		
	  }
	});
}

</script>
</script>
</html>
<?php

if(isset($_POST["btnslotbook"]))
{
	$studentslotid=$_POST["btnslotbook"];
	
	$selQry1="select * from tbl_studentslot where studentslot_id='".$studentslotid."'";
	$row1=$con->query($selQry1);
	$data1=$row1->fetch_assoc();
	$batchid=$data1["batch_id"];  


	$selQry2="select * from tbl_slotbooking s inner join tbl_studentslot ss on s.studentslot_id=ss.studentslot_id where ss.batch_id='".$batchid."' and s.student_id='".$_SESSION["uid"]."'";
	$row2=$con->query($selQry2);
	if($data2=$row2->fetch_assoc())
	{
	?>
<script>
alert("Already Booked For This Day");
window.location="viewSlot.php";
</script>
<?php	
}
else
{
 	$bookeddate=$data1["studentslot_date"];  
$updateQry="update tbl_studentslot set slotbook_status=1 where studentslot_id= '".$studentslotid."'";
	$con->query($updateQry);
	
$sel="select * from tbl_regid where id=1";
$row5=$con->query($sel);
$datae=$row5->fetch_assoc();

$reg=$datae["sbreg_id"];
$sbid=$datae["sbid_number"];
$sbid++;
$length=strlen($sbid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$sbookingid=$reg.$zero.$sbid;
$upQry="update tbl_regid set sbid_number='".$sbid."' where id=1";
$con->query($upQry);

	$insQry="insert into tbl_slotbooking(slotbooking_id,student_id,booked_date,booking_date,studentslot_id)values('".$sbookingid."','".$_SESSION["uid"]."',curdate(),'".$bookeddate."','".$studentslotid."')";
	
	if($con->query($insQry))
	
	
{
?>
<script>
alert("Slot Booked");
window.location="viewSlot.php";
</script>
<?php	
}
}
}
