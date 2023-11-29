<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Slot</title>
<style>
a{
	text-decoration: none;
}
</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));


$selQry="select * from tbl_batch   where emp_id='".$_SESSION["uid"]."' and  batch_date between '".$min."' and '".$max."' ";
$row=$con->query($selQry);
?>
<form id="form1" name="form1" method="post" action="">

  <table width="1474" height="94" border="0" cellpadding="5">
    <tr>
    <?php
	while($data1=$row->fetch_assoc())
	{
	?>
      <td width="493"><p>
        <input type="submit" name="btndate1" id="btndate1" value="<?php echo $data1["batch_date"]?>" onmouseover="getSlotDetails(this)"/>
      </p>
      <p><?php echo $data1["batch_starttime"]?> - <?php echo $data1["batch_endtime"]?></p></td>
       
    <?php
    $selQry1="select * from tbl_studentslot s inner join tbl_batch b  on s.batch_id=b.batch_id  where b.emp_id='".$_SESSION["uid"]."' and studentslot_date='" .$data1["batch_date"] . "'";
			//echo $selQry1;
            
            $row1=$con->query($selQry1);
$i=0;
while($data=$row1->fetch_assoc())
{
 $i++;

        ?>



            


                <td width="722"><button <?php if($data["slotbook_status"]==1) {?> disabled <?php }?>><p align="center"  >
                        Slot                 <?php echo $data["studentslot_number"]?>
                    <p align="center"  ><?php echo $data["studentslot_starttime"]  ?>-<?php echo $data["studentslot_endtime"]  ?>
                    </button>
         </td>
        		 <?php 
             
		   
}?><td width="221"><a href="BookedSlotDetails.php?batchid=<?php echo $data1["batch_id"]?>">Booked Details</a></td></tr><?php
}?>

           
         </tr>
         
         </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
</center>
<?php
include("Foot.php");
?>
</body>
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
</html>