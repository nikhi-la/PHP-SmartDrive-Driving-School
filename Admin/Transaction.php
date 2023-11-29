<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transaction Report</title>
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
<h1>Package Transactions</h1>
<p>&nbsp;</p>
  <table width="854" height="121"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="98">From Date<span class="required">  *</span></td>
      <td width="278"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" /></td>
      <td width="89">To Date<span class="required">  *</span></td>
      <td width="289"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" /></td>
    </tr>
         <tr>
      <td colspan="4"><div align="center">Package 
        <label for="txtpackage"></label>
           <select name="txtpackage" id="txtpackage" required >
            <option value ="">--Select--</option>
            <option value=1>Standard Package</option>
            <option value=2>Custom Package</option>
          </select>
        </div></td>
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
    <table width="1011" height="50"  border="1" align="center" cellpadding="10">
    <tr>
      <td width="43">Sl.no</td>
      <td width="127">Name</td>
      <td width="103">Contact</td>
      <td width="110">Email</td>
      <td width="154">Package</td>
      <td width="174">Vehicle Type</td>
      <td width="128">Amount (in INR)</td>     
     
    </tr>
    <?php
if($_POST["txtpackage"]==1)
{
		$sel2="select * from   tbl_packagebooking p inner join tbl_package pa inner join tbl_student s inner join tbl_vehicletype v on  p.student_id=s.student_id and p.package_id=pa.package_id and pa.vehicletype_id=v.vehicletype_id where p.packagepayment_status=1";

	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel2 = $sel2 ." and p.packagebooking_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel2 = $sel2 ." and p.packagebooking_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel2 = $sel2 ." and p.packagebooking_date < '".$_POST["txtto"]."'";
	}
		$row2=$con->query($sel2);

	while($data2=$row2->fetch_assoc())
	{
		
	?>
    <tr>
      <td><?php echo $data2["packagebooking_id"]?></td>
    <td><?php echo ucfirst($data2["student_name"])." ".ucfirst($data2["student_middle"])." ".ucfirst($data2["student_last"]);?></td>
     <td><?php echo $data2["student_contact"];?></td>
         <td><?php echo $data2["student_email"];?></td>
   		<td>Standard Package</td>
         <td><?php echo ucfirst($data2["vehicletype_name"]);?></td>
         <td><?php echo $data2["package_amount"];?> INR</td>

      </tr>
          <?php
	}
		 
}
if($_POST["txtpackage"]==2)
{
		$sel1="select * from  tbl_customizepackage c  inner join tbl_student s inner join tbl_vehicletype v on  c.student_id=s.student_id and v.vehicletype_id=c.vehicle_type where c.payment_status=1";
	
	
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel1 = $sel1 ." and booking_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel1 = $sel1 ." and booking_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel1 = $sel1 ." and booking_date < '".$_POST["txtto"]."'";
	}
	
	//echo $sel;
	
	$row1=$con->query($sel1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		
	?>
    <tr>
      <td><?php echo $data1["customization_id"]?></td>
    <td><?php echo ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"]);?></td>
     <td><?php echo $data1["student_contact"];?></td>
         <td><?php echo $data1["student_email"];?></td>
   		<td>Custom Package</td>
         <td><?php echo ucfirst($data1["vehicletype_name"]);?></td>
         <td><?php echo $data1["course_amount"];?> INR</td>

      </tr>
          <?php
	}
  	
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
