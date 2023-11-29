<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resigned Employee</title>
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

<h1>Resigned Employee</h1>
<p>&nbsp;</p>
  <table width="870" height="121"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="101">From Date<span class="required">  *</span></td>
      <td width="283"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" /></td>
      <td width="91">To Date<span class="required">  *</span></td>
      <td width="295"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" /></td>
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
    <table width="836" height="50"  border="1" align="center" cellpadding="10">
    <tr>
      <td width="41">Sl.no</td>
      <td width="153">Name</td>
      <td width="115">Contact</td>
      <td width="138">Email</td>
      <td width="107">Date of Resign</td>     
    </tr>
    <?php
    $sel1="select * from tbl_empdeparture ";

	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel1 = $sel1 ." where emp_departuredate between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel1 = $sel1 ." where emp_departuredate between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel1 = $sel1 ."where emp_departuredate <= '".$_POST["txtto"]."'";
	}
	
	//echo $sel;
	
	$row1=$con->query($sel1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data1["emp_id"]?></td>
    <td><?php echo ucfirst($data1["emp_name"])." ".ucfirst($data1["emp_middle"])." ".ucfirst($data1["emp_last"]);?></td>
     <td><?php echo $data1["emp_contact"];?></td>
         <td><?php echo $data1["emp_email"];?></td>
         <td><?php echo $data1["emp_departuredate"];?> </td>
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
