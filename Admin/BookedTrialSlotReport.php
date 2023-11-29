<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booked Slot Report</title>
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
<h1>Booked Slot Report</h1>
<p>&nbsp;</p>
  <table width="871" height="122"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="100">From Date<span class="required">  *</span></td>
      <td width="284"><label for="txt_f"></label>
      <input type="date" name="txtfrom" id="txtfrom" min="2000-01-01" max= <?php echo date('Y-m-d', strtotime('+6 days'));?>/></td>
      <td width="91">To Date<span class="required">  *</span></td>
      <td width="296"><label for="txt_t"></label>
      <input type="date" name="txtto" id="txtto" min="2000-01-01" max= <?php echo date('Y-m-d', strtotime('+6 days'));?>/></td>
    </tr>
      <tr>
      <td colspan="4"><div align="center">Student
        <label for="txtstudent"></label>
      <select name="txtstudent" id="txtstudent"   required>
        <option selected="selected" value="">---select---</option>
        <?php
		  $selQry="select * from tbl_student";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>
        <option value=<?php echo $data["student_id"]?>><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></option>
        <?php
		  }
		  ?>
        </select>        </div></td>
      </tr>
    <tr>
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
      <td >Student Name</td>
      <td >Employee Name</td>
      <td >Vehicle Type</td>
      <td>Slot Date</td>
      <td >Slot Number</td>
      <td >Start Time</td>
      <td>End Time</td>
      <td >Amount (in INR)</td>
     
    </tr>
    <?php
	$studentid=$_POST["txtstudent"];
	$max=date('Y-m-d', strtotime('+6 days'));
	$sel1="select * from  tbl_trial t inner join tbl_studentslot ss inner join tbl_employee e inner join tbl_student s inner join tbl_vehicletype vt on t.studentslot_id=ss.studentslot_id and t.emp_id=e.emp_id and t.student_id=s.student_id and t.vehicletype_id=vt.vehicletype_id where  t.student_id='".$studentid."'";
	

	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel1 = $sel1 ."  and ss.studentslot_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."' order by booking_date";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel1 = $sel1 ."  and ss.studentslot_date between '".$_POST["txtfrom"]."' and '".$max."' order by booking_date";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel1 = $se1l ." and ss.studentslot_date <= '".$_POST["txtto"]."' order by booking_date";
	}

	$row=$con->query($sel1);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["trial_id"]?></td>
    <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></td>
     <td><?php echo ucfirst($data["emp_name"])." ".ucfirst($data["emp_middle"])." ".ucfirst($data["emp_last"]);?></td>
     <td><?php echo $data["vehicletype_name"];?></td>
         <td><?php echo $data["studentslot_date"];?></td>
     <td><?php echo $data["studentslot_number"];?></td>
         <td><?php echo $data["studentslot_starttime"];?></td>
         <td><?php echo $data["studentslot_endtime"];?></td>
         <td><?php echo $data["trial_amount"];?> INR</td>      </tr>
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
