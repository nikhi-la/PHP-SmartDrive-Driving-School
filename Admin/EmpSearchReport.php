<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Search</title>
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
<h1>Search Employee</h1>
<p>&nbsp;</p>
  <table width="498" height="121"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="149">Employee Name<span class="required">  *</span></td>
      <td width="297"><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" autocomplete="off" required="required" /></td>
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
    <table width="818" height="90"  border="1" align="center" cellpadding="10">
    <tr>
      <td height="44" >Sl.no</td>
      <td >Name</td>
      <td >Contact</td>
      <td >Email</td>
      <td >Date of Join</td>

    </tr>
    <?php
	$name=$_POST["txtname"];
	$middle=$_POST["txtname"];
	$last=$_POST["txtname"];
	$name=strtolower($name);
	$middle=strtolower($middle);
	$last=strtolower($last);

	$sel="select * from  tbl_employee where emp_name='".$name."' or emp_middle='".$middle."' or emp_last='".$last."'";
	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $data["emp_id"];?></td>
    <td><?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"]);?></td>
     <td><?php echo $data["emp_contact"];?></td>
     <td><?php echo $data["emp_email"];?></td>
     <td><?php echo $data["emp_doj"];?></td>

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
