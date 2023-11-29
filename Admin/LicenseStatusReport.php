<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>License Status Report</title>
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
<h1>License Status Report</h1>
<p>&nbsp;</p>
  <table width="886" height="121"  border="1" align="center"  cellpadding="10">
    <tr>
      <td width="126">From Date<span class="required">  *</span></td>
      <td width="277"><label for="txtfrom"></label>
      <input type="date" name="txtfrom" id="txtfrom" min="2000-01-01" max=<?php echo date('Y-m-d', strtotime('+242 days'));?> /></td>
      <td width="112">To Date<span class="required">  *</span></td>
      <td width="271"><label for="txtto"></label>
      <input type="date" name="txtto" id="txtto" min="2000-01-01" max=<?php echo date('Y-m-d', strtotime('+242 days'));?>/></td>
      </tr>
      <tr>
      <td colspan="4"><div align="center">License Status
        <label for="txtstatus"></label>
           <select name="txtstatus" id="txtstatus" required>
            <option value ="-1">--Select--</option>
            <option value=1>Not Applied</option>
            <option value=2>Applied</option>
            <option value=3>Received</option>
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
    <table width="774" height="94"  border="1" align="center" cellpadding="10">
    <tr>
      <td height="44" >Sl.no</td>
      <td >Student Name</td>
      <td >License Status</td>
      <td >Date</td>

    </tr>
    <?php
	$sel="select * from  tbl_license l inner join tbl_student s on  l.student_id=s.student_id ";
	if($_POST["txtfrom"]!="" && $_POST["txtto"]!="")
	{
		$sel = $sel ." where license_status='".$_POST["txtstatus"]."' and cur_date between '".$_POST["txtfrom"]."' and '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]!="" && $_POST["txtto"]=="")
	{
		$sel = $sel ." where  license_status='".$_POST["txtstatus"]."' and cur_date between '".$_POST["txtfrom"]."' and curdate()";
	}
	if($_POST["txtto"]!="" && $_POST["txtfrom"]=="")
	{
		$sel = $sel ." where license_status='".$_POST["txtstatus"]."' and cur_date < '".$_POST["txtto"]."'";
	}
	if($_POST["txtfrom"]=="" && $_POST["txtto"]=="")
	{
		$sel="select * from  tbl_license l inner join tbl_student s on  l.student_id=s.student_id where license_status='".$_POST["txtstatus"]."'";

	}

	$row=$con->query($sel);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["license_id"]?></td>
    <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></td>
	<td><?php if($data["license_status"]==0 || $data["license_status"]==1 )
				echo "Not Applied";
			 else if($data["license_status"]==2)
				echo " Applied";
			else
				echo " Received";
			 ?></td>
     <td><?php echo $data["cur_date"];?></td>
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
