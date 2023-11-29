<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Type</title>
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
include("Head.php");
include("../Assets/Connection/Connection.php");
if(isset($_POST["btnsave"]))
{
$packagetype=$_POST["txtpackagetype"];
$packagetype=test_input($packagetype);


$hid=$_POST["txtid"];
if($hid!="")
{
	$updateQry="update tbl_packagetype set packagetype_name='".$packagetype."' where packagetype_id='".$hid."'";
	$con->query($updateQry);
	?>
	<script>
	window.location="Packagetype.php";
	</script>
	<?php	
}
else
{
$sel="select * from tbl_regid where id=1";
$row1=$con->query($sel);
$datae=$row1->fetch_assoc();

$reg=$datae["ptreg_id"];
$ptid=$datae["ptid_number"];
$ptid++;
$length=strlen($ptid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$ptypeid=$reg.$zero.$ptid;
$upQry="update tbl_regid set ptid_number='".$ptid."' where id=1";
$con->query($upQry);


$insQry="insert into tbl_packagetype(packagetype_id,packagetype_name)values('".$ptypeid."','".$packagetype."')";
if($con->query($insQry))
{
?>
<script>
alert("Data Inserted");
window.location="Packagetype.php";
</script>

<?php	

}
else
{
?>
<script>
alert("Failed");
window.location="Packagetype.php";
</script>	
<?php	
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_packagetype where packagetype_id='".$_GET["did"]."'";
	$con->query($delQry);
	?>
	<script>
	window.location="Packagetype.php";
	</script>
	<?php	
}
$eid="";
$ename="";
if(isset($_GET["eid"]))
{
	$selQry="select *  from tbl_packagetype where packagetype_id='".$_GET["eid"]."'";
	$row1=$con->query($selQry);
	$data1=$row1->fetch_assoc();
	$eid=$data1["packagetype_id"];
	$ename=$data1["packagetype_name"];
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
<form action="Packagetype.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h1>Package Type</h1>
  <p>&nbsp;</p>
  <table width="432" height="178" border="1" cellpadding="10">
    <tr>
      <td width="147">Packagetype Name<span class="required">  *</span></td>
      <td width="192"><label for="txtpackagetype"></label>
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
      <input type="text" name="txtpackagetype" id="txtpackagetype" value="<?php echo $ename;?>"  required="required" autocomplete="off"/></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Save" />
        <input type="Reset" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  
 <br><br>
  <table width="554" height="50" border="1" cellpadding="10">
    <tr>
      <th width="96" height="45">Sl.No.</th>
      <th width="256">Package Type</th>
      <th width="126">Action</th>
    </tr>
     <?php
    $selQry="select * from tbl_packagetype";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
      <tr>
      <td>&nbsp;<?php echo $data["packagetype_id"]?></td>
      <td>&nbsp;<?php echo $data["packagetype_name"]?></td>
      <td>&nbsp;<a href="Packagetype.php?did=<?php echo $data["packagetype_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Packagetype.php?eid=<?php echo $data["packagetype_id"] ?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
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