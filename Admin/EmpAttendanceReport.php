  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Attendance Report</title>
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
<h1>Employee Attendance Report</h1>
<p>&nbsp;</p>
  <table width="862" height="120"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="96">From Date<span class="required">  *</span></td>
      <td width="284"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>"/></td>
      <td width="90">To Date<span class="required">  *</span></td>
      <td width="292"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" min="2000-01-01" max="<?php  echo date('Y-m-d'); ?>"/></td>
    </tr>
      <tr>
      <td colspan="4"><div align="center">Employee
        <label for="txtemployee"></label>
      <select name="txtemployee" id="txtemployee"   required>
        <option selected="selected" value="">---select---</option>
        <?php
		  $selQry="select * from tbl_employee";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>
        <option value=<?php echo $data["emp_id"]?>><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"]);?></option>
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
    <table width="774" height="94"  border="1" align="center" cellpadding="10">
    <tr>
      <td height="44" >Sl.no</td>
      <td >Name</td>
      <td >Contact</td>
      <td >Email</td>
      <td>Date</td>
      <td>Status</td>
     
     
    </tr>
    <?php
	$sel="select * from  tbl_empattendance ea inner join tbl_employee e on ea.emp_id=e.emp_id where ea.emp_id='".$_POST["txtemployee"]."'";
	
	
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel = $sel ." and empattendance_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel = $sel ." and empattendance_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel = $sel ." and empattendance_date < '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]=="" && $_POST["txtto"]=="")
	{
	$sel="select * from  tbl_empattendance ea inner join tbl_employee e on ea.emp_id=e.emp_id where ea.emp_id='".$_POST["txtemployee"]."'";
	}
	
	//echo $sel;
	
	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["empattendance_id"]?></td>
    <td><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"]);?></td>
     <td><?php echo $data["emp_contact"];?></td>
         <td><?php echo $data["emp_email"];?></td>
         <td><?php echo $data["empattendance_date"];?></td>
         <td><?php if($data["empattendance_status"]==1)
		 			echo "Present";
					else
		 			echo "Absent";
					?></td>
   
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
