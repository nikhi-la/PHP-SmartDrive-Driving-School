<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salary Report</title>
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

<h1>Salary</h1>
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
    <table width="836" height="50"  border="1" align="center" cellpadding="10">
    <tr>
      <td width="41">Sl.no</td>
      <td width="153">Name</td>
      <td width="115">Contact</td>
      <td width="138">Email</td>
      <td width="107">Salary Fromdate</td>
      <td width="107">Salary Todate</td>      
      <td width="107">Salary</td>     
    </tr>
    <?php
	$sel1="select * from  tbl_salary s inner join tbl_employee e on  s.emp_id=e.emp_id where s.paid_status=1 and s.emp_id='".$_POST["txtemployee"]."'";
	
	
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel1 = $sel1 ." and (salary_fromdate between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."') and (salary_todate between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."')";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel1 = $sel1 ." and salary_fromdate between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel1 = $sel1 ." and salary_todate <= '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]=="" && $_POST["txtto"]=="")
	{
	$sel1="select * from  tbl_salary s inner join tbl_employee e on  s.emp_id=e.emp_id where s.paid_status=1 and s.emp_id='".$_POST["txtemployee"]."'";
	}
	
	//echo $sel;
	
	$row1=$con->query($sel1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data1["salary_id"]?></td>
    <td><?php echo ucfirst($data1["emp_name"])." ".ucfirst($data1["emp_middle"])." ".ucfirst($data1["emp_last"]);?></td>
     <td><?php echo $data1["emp_contact"];?></td>
         <td><?php echo $data1["emp_email"];?></td>
         <td><?php echo $data1["salary_fromdate"];?> </td>
         <td><?php echo $data1["salary_todate"];?></td>
         <td><?php echo $data1["salary_amount"];?> INR</td>
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
