<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.required {
  color: red;
}
</style>

</head>

<body>
<?php
ob_start();
include("Head.php");
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

if(isset($_POST["btnsave"]))
{
$district=$_POST["txtdistrict"];
$district=test_input($district);
$district=strtolower($district);

if (!preg_match("/^[a-zA-Z-' ]*$/",$district))
	{
	?>
    <script>
    alert("Only letters and white space allowed");
	window.location="District.php";
	</script>
    <?php
    }
else
{

$hid=$_POST["txtid"];
if($hid!="")
{
	$updateQry="update tbl_district set district_name='".$district."' where district_id='".$hid."'";
	$con->query($updateQry);
			?>
			<script>
			window.location="District.php";
			</script>
			<?php
}
else
{
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["dreg_id"];
		$distid=$datae["did_number"];
		$distid++;
		$length=strlen($distid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$districtttid=$reg.$zero.$distid;
		$upQry="update tbl_regid set did_number='".$distid."' where id=1";
		$con->query($upQry);

	$insQry="insert into tbl_district(district_id,district_name)values('".$districtttid."','".$district."')";	
	if($con->query($insQry))
		{
			?>
			<script>
			alert("Data Inserted");
			window.location="District.php";
			</script>

			<?php	
		}
	else
		{
			?>
			<script>
			alert("Failed");
			window.location="District.php";
			</script>
			<?php
		}
	}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_district where district_id='".$_GET["did"]."'";
	$con->query($delQry);
			?>
			<script>
			window.location="District.php";
			</script>
			<?php
}
$eid="";
$ename="";
if(isset($_GET["eid"]))
{
	$selQry="select *  from tbl_district where district_id='".$_GET["eid"]."'";
	$row1=$con->query($selQry);
	$data1=$row1->fetch_assoc();
	$eid=$data1["district_id"];
	$ename=$data1["district_name"];
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
	<div id="tab" align="center"> 
  <form id="form1" name="form1" method="post" action="District.php">
  	<h1>District</h1>
  	<p>&nbsp;</p>
  <table width="432" height="186" border="1" cellpadding="10">
  <tr></tr>
  <tr>
    <td width="101">District<span class="required">  *</span></td>
    <td width="214"><label for="txtdistrict" ></label>
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
      <input type="text" name="txtdistrict" id="txtdistrict" onkeyup="validateDistrict(this)" value="<?php echo ucfirst($ename);?>" required="required" autocomplete="off"/> <span id="districterr"></span></td>
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
      <th height="45">Sl.No</th>
      <th>District</th>
      <th>Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_district";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
	<tr>
      <td height="44">&nbsp;<?php echo $data["district_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data["district_name"])?></td>
      <td>&nbsp;<a href="District.php?did=<?php echo $data["district_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="District.php?eid=<?php echo $data["district_id"] ?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
    </tr>
    <?php
	}
	?>
  </table>
<p>&nbsp;</p>
<p>&nbsp;</p>
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

function validateDistrict(elem)
{
var nameexp=/^[A-Za-z ]+$/
	if(elem.value.match(nameexp))
	{
		document.getElementById("districterr").innerHTML = "";
		return true;
	}
	else
	{
		
		document.getElementById("districterr").innerHTML = "<span  style='color: red;text: 12px;font-size: 14px;'>Alphabets Are Allowed</span>";
		elem.focus();
		return false;
	}  
}

</script>