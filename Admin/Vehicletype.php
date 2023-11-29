<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>vehicle Type</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.required {
  color: red;
}
</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsave"]))
{
$vehicletype=$_POST["txtvehicletype"];
$vehicletype=test_input($vehicletype);

$hid=$_POST["txtid"];
if($hid!="")
{
	$updateQry="update tbl_vehicletype set vehicletype_name='".$vehicletype."' where vehicletype_id='".$hid."'";
	$con->query($updateQry);
	?>
	<script>
	window.location="vehicletype.php";
	</script>
	<?php	

}
else
{
	
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["vtreg_id"];
		$vetid=$datae["vtid_number"];
		$vetid++;
		$length=strlen($vetid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$vehictypeid=$reg.$zero.$vetid;
		$upQry="update tbl_regid set vtid_number='".$vetid."' where id=1";
		$con->query($upQry);
	
	
$insQry="insert into tbl_vehicletype(vehicletype_id,vehicletype_name)values('".$vehictypeid."','".$vehicletype."')";
if($con->query($insQry))
{
?>
<script>
alert("Data Inserted");
window.location="vehicletype.php";
</script>

<?php	

}
else
{
?>
<script>
alert("Failed");
window.location="vehicletype.php";
</script>	
<?php	
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_vehicletype where vehicletype_id='".$_GET["did"]."'";
	$con->query($delQry);
	?>
	<script>
	window.location="vehicletype.php";
	</script>
	<?php	

}
$eid="";
$ename="";
if(isset($_GET["eid"]))
{
	$selQry="select *  from tbl_vehicletype where vehicletype_id='".$_GET["eid"]."'";
	$row1=$con->query($selQry);
	$data1=$row1->fetch_assoc();
	$eid=$data1["vehicletype_id"];
	$ename=$data1["vehicletype_name"];
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div id="tab" align="center">
  <br>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h1>Vehicle Type</h1>
  <p>&nbsp;</p>
  <table width="432" height="178" border="1" cellpadding="10">
    <tr>
      <td width="139">Vehicletype Name<span class="required">  *</span></td>
      <td width="201"><label for="txtvehicletype"></label>
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
      <input type="text" name="txtvehicletype" id="txtvehicletype" value="<?php echo ucfirst($ename)?>" required="required" autocomplete="off"/></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Save" />
        <input type="Reset" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <br><br>
  <table width="432" height="50" border="1" cellpadding="10">
    <tr>
      <th height="45">Sl.No.</th>
      <th>Vehicle Type</th>
      <th>Action</th>
    </tr>
     <?php
    $selQry="select * from tbl_vehicletype";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
      <tr>
      <td>&nbsp;<?php echo $data["vehicletype_id"]?></td>
      <td>&nbsp;<?php echo $data["vehicletype_name"];?></td>
      <td>&nbsp;<a href="vehicletype.php?did=<?php echo $data["vehicletype_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Vehicletype.php?eid=<?php echo $data["vehicletype_id"] ?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</div>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
</script>