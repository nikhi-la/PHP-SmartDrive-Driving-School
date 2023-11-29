<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Report</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
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
<h1>Package Report</h1>
<p>&nbsp;</p>
  <table width="854" height="122"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="94">From Date<span class="required">  *</span></td>
      <td width="282"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>" /></td>
      <td width="89">To Date<span class="required">  *</span></td>
      <td width="289"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>"/></td>
    </tr>
      <tr>
      <td colspan="4"><div align="center">Package Type
        <label for="txtpackagetype"></label>
      <select name="txtpackagetype" id="txtpackagetype"   required>
        <option selected="selected" value="">---select---</option>
        <?php
		  $selQry="select * from tbl_packagetype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>
        <option value=<?php echo $data["packagetype_id"]?>><?php echo $data["packagetype_name"];?></option>
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
    <table width="1047" height="121"  border="1" align="center" cellpadding="10">
    <tr>
      <td height="44" >Sl.no</td>
      <td >Name</td>
      <td >Contact</td>
      <td >Email</td>
      <td>Package Name</td>
      <td>Package Type</td>
      <td>Package Details</td>
      <td>Package Amount</td>
     
     
    </tr>
    <?php
	$sel="select * from  tbl_package p inner join tbl_packagebooking pb inner join tbl_packagetype pt inner join tbl_student s on p.package_id=pb.package_id and pb.student_id=s.student_id and pt.packagetype_id=p.packagetype_id where pb.packagepayment_status=1";
	
	
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel = $sel ." and pt.packagetype_id='".$_POST["txtpackagetype"]."' and packagebooking_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel = $sel ." and pt.packagetype_id='".$_POST["txtpackagetype"]."' and packagebooking_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel = $sel ." and pt.packagetype_id='".$_POST["txtpackagetype"]."' and packagebooking_date < '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]=="" && $_POST["txtto"]=="")
	{
	$sel="select * from  tbl_package p inner join tbl_packagebooking pb inner join tbl_packagetype pt inner join tbl_student s on p.package_id=pb.package_id and pb.student_id=s.student_id and pt.packagetype_id=p.packagetype_id where pb.packagepayment_status=1  and pt.packagetype_id='".$_POST["txtpackagetype"]."'";
	

	}

	
	//echo $sel;
	
	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["packagebooking_id"]?></td>
    <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></td>
     <td><?php echo $data["student_contact"];?></td>
         <td><?php echo $data["student_email"];?></td>
         <td><?php echo ucfirst($data["package_name"]);?></td>
         <td><?php echo ucfirst($data["packagetype_name"]);?></td>     
         <td><?php echo ucfirst($data["package_details"]);?></td>
         <td><?php echo $data["package_amount"];?> INR</td>
   
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
