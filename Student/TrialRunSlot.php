<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
?>
<center>
<form id="form1" name="form1" method="post" action="">
  <table  border="0" cellpadding="10">
    <tr>
      <td >Select Employee</td>
      <td ><label for="txtemployee"></label>
        <select name="txtemployee" id="txtemployee"  >
        <option selected="selected" value="">---Select---</option>
         <?php
		  $selQry="select * from tbl_employee";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		  ?>
          <option  value="<?php echo $data["emp_id"] ?>"><?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"])?></option>
          <?php
		  }
		  ?>
      </select>
      </td>
       <td >Select VehicleType</td>
      <td ><label for="txtvehicletype"></label>
        <select name="txtvehicletype" id="txtvehicletype" >
        <option selected="selected" value="">---Select---</option>
         <?php
		  $selQry="select * from tbl_vehicletype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		  ?>
          <option  value="<?php echo $data["vehicletype_id"] ?>"><?php echo ucfirst($data["vehicletype_name"]) ?></option>
          <?php
		  }
		  ?>
      </select>
      </td>
  
     </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="btnsave" id="btnsave" value="Submit" /></td>
    </tr>
            <hr>
    </table>
                      <hr>
    <?php
if(isset($_POST["btnsave"]))
{
	$_SESSION["emp"]=$_POST["txtemployee"];
	$empid=$_POST["txtemployee"];
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));


$selQry1="select * from tbl_batch   where emp_id='".$empid."' and   batch_date between '".$min."' and '".$max."'";
$row1=$con->query($selQry1);
while($data1=$row1->fetch_assoc())
{
?>

  <table width="1459" height="94" border="0" cellpadding="5">
    <tr>
      <td width="500"><p>
        <input type="submit" name="btndate1" id="btndate1" value="<?php echo $data1["batch_date"]?>" />
      </p>
      <p><?php echo $data1["batch_starttime"]?> - <?php echo $data1["batch_endtime"]?></p></td>
       
    <?php
    $selQry2="select * from tbl_studentslot s inner join tbl_batch b  on s.batch_id=b.batch_id  where b.emp_id='".$empid."' and studentslot_date='" .$data1["batch_date"] . "' order by studentslot_starttime";

			//echo $selQry1;
            
            $row2=$con->query($selQry2);
$i=0;
while($data2=$row2->fetch_assoc())
{
 $i++;

        ?>



            


                <td width="650"><button <?php if($data2["slotbook_status"]==1) {?> disabled <?php }?> name="btnslotbook" value="<?php echo $data2["studentslot_id"]?>"><p align="center"  >
                        Slot                 <?php echo $data2["studentslot_number"]?>
                    <p align="center"  ><?php echo $data2["studentslot_starttime"]  ?>-<?php echo $data2["studentslot_endtime"]  ?>
                    </button>
         </td>
        		 <?php 
             
		   
}?><td width="600"><a href="ViewBookedTrialSlot.php">Booked Details</a></td></tr><?php
}?>

           
         </table>
</form>

</center>
</body>
<?php
}
if(isset($_POST["btnslotbook"]))
{
	$_SESSION["studentslotid"]=$_POST["btnslotbook"];
	$_SESSION["trialvehicletypeid"]=$_POST["txtvehicletype"];

	
	$selQry3="select * from tbl_studentslot where studentslot_id='".$_SESSION["studentslotid"]."'";
	$row3=$con->query($selQry3);
	$data3=$row3->fetch_assoc();
	$batchid=$data3["batch_id"];  


	$selQry4="select * from tbl_slotbooking s inner join tbl_studentslot ss on s.studentslot_id=ss.studentslot_id where ss.batch_id='".$batchid."' and s.student_id='".$_SESSION["uid"]."' ";
	$row4=$con->query($selQry4);
	if($data4=$row4->fetch_assoc())
	{
	?>
	<script>
	alert("Already Booked For This Day");
	</script>
	<?php	
	}
	else
	{
	?>
	<script>
	window.location="PaymentTrial.php";
	</script>
	<?php
	}
}
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
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

function getSearch(did)
{

	$.ajax({
	  url:"../Assets/AjaxPages/AjaxTrialSlotSearch.php?did="+did,
	  success: function(html){
		$("#txtdate").html(html);
	  }
	});
}
</script> 
</html>
