<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Custom Package Report</title>
<style>
.required {
  color: red;
}
</style>
</head>

<?php
include("../Assets/Connection/Connection.php");
include("SessionValidator.php");
include("Head.php");
?>  
<body>      

  <div id="tab" align="center">
</p>
<form id="form1" name="form1" method="post" action="">
<p>&nbsp;</p>
<h1>Custom Package Report</h1>
<p>&nbsp;</p>
  <table width="876" height="121"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="95">From Date<span class="required">  *</span></td>
      <td width="281"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>"/></td>
      <td width="89">To Date<span class="required">  *</span></td>
      <td width="289"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>"/></td>
    </tr>
      <tr>
      <td colspan="4"><div align="center">Vehicle Type
        <label for="txtvehicletype"></label>
      <select name="txtvehicletype" id="txtvehicletype"   required>
        <option selected="selected" value="">---select---</option>
        <?php
		  $selQry="select * from tbl_vehicletype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>
        <option value=<?php echo $data["vehicletype_id"]?>><?php echo $data["vehicletype_name"];?></option>
        <?php
		  }
		  ?>
        </select>        </div></td>
      </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="btnsave" id="btnsave" value="View Report" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <?php
  if(isset($_POST["btnsave"]))
  {
  ?>
  </p>
  <div id="pri">
    <table width="715"  border="1" align="center" cellpadding="10">
    <tr>
      <td width="41">Sl.no</td>
      <td width="46">Name</td>
      <td width="60">Contact</td>
      <td width="97">Email</td>
      <td>Vehicle Type</td>
      <td>Package Duration</td>
      <td>Package Amount</td>
     
     
    </tr>
    <?php
	$sel="select * from  tbl_customizepackage c inner join tbl_student s inner join tbl_vehicletype v on c.student_id=s.student_id and c.vehicle_type=v.vehicletype_id where c.payment_status=1";
	
	
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel = $sel ."  and v.vehicletype_id='".$_POST["txtvehicletype"]."' and packagebooking_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel = $sel ." and v.vehicletype_id='".$_POST["txtvehicletype"]."' and packagebooking_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel = $sel ." and v.vehicletype_id='".$_POST["txtvehicletype"]."' and packagebooking_date < '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]=="" && $_POST["txtto"]=="")
	{
		$sel="select * from  tbl_customizepackage c inner join tbl_student s inner join tbl_vehicletype v on c.student_id=s.student_id and c.vehicle_type=v.vehicletype_id where c.payment_status=1  and v.vehicletype_id='".$_POST["txtvehicletype"]."'";

	

	}

	
	//echo $sel;
	
	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["customization_id"]?></td>
    <td><?php echo ucfirst($data["student_name"]);?></td>
     <td><?php echo $data["student_contact"];?></td>
         <td><?php echo $data["student_email"];?></td>
         <td><?php echo ucfirst($data["vehicletype_name"]);?></td>
         <td><?php echo $data["course_duration"];?> Days</td>
         <td><?php echo $data["course_amount"];?> INR</td>
   
      </tr>
          <?php
	}
		  ?>
  </table>
</div>
   <center>
     <p>&nbsp;     </p>
     <p>&nbsp;</p>
     <p>
       <input type="button" onclick="printDiv('pri')" id="invoice-print"  class="btn btn-success" value="Print" />
     </p>
   </center>
  <?php
  }
  ?>
 
</form>
</body>
</div>
</html>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
