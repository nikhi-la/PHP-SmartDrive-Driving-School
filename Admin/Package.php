<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package</title>
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
	$packagetypeid=$_POST["txtpackagetype"];

	$details=$_POST["txtdetails"];
	
	$packagename=$_POST["txtpackagename"];
	$packagename=test_input($packagename);
	$packagename=strtolower($packagename);

	
	$amount=$_POST["txtamount"];
	$amount=test_input($amount);

	$vehicleid=$_POST["txtvehicle"];
	
if ($packagetypeid=="")
	{
	?>
	<script>
    alert("Select Package Type");
	window.location="Package.php";
	</script>
    <?php
	}
	
else if($details=="")
	{
	?>
	<script>
    alert("Enter Details");
	window.location="Package.php";
	</script>
    <?php
	}
else if($packagename=="")
	{
	?>
	<script>
    alert("Enter Package Name");
	window.location="Package.php";
	</script>
    <?php
	}
else if (!is_numeric($amount)) 
	{
	?>
    <script>
    alert("Invalid Amount");
	window.location="Package.php";
	</script>
    <?php
}
else if ($vehicleid=="")
	{
	?>
	<script>
    alert("Select Package Type");
	window.location="Package.php";
	</script>
    <?php
	}
else
{
$hid=$_POST["txtid"];
if($hid!="")
{
	$updateQry="update tbl_package set packagetype_id='".$packagetypeid."', package_name='".$packagename."',package_details='".$details."' ,package_amount='".$amount."',vehicletype_id='".$vehicleid."' where package_id='".$hid."'";
	$con->query($updateQry);

		?>
        <script>
		window.location="Package.php";
		</script>
        <?php
}
else
{
	
$sel="select * from tbl_regid where id=1";
$row1=$con->query($sel);
$datae=$row1->fetch_assoc();

$reg=$datae["preg_id"];
$pacid=$datae["pid_number"];
$pacid++;
$length=strlen($pacid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$packid=$reg.$zero.$pacid;
$upQry="update tbl_regid set pid_number='".$pacid."' where id=1";
$con->query($upQry);


$insQry="insert into tbl_package(package_id,packagetype_id,package_name,package_details,package_amount,vehicletype_id)values('".$packid."','".$packagetypeid."','".$packagename."','".$details."','".$amount."','".$vehicleid."')";
if($con->query($insQry))
{
		?>

        <script>
		alert("Data Inserted");
		window.location="Package.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Failed");
		window.location="Package.php";
		</script>
        <?php
				
	}
  }
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_package where package_id='".$_GET["did"]."'";
	$con->query($delQry);
		?>
        <script>
		window.location="Package.php";
		</script>
        <?php
}
$eid="";
$epackagetype="";
$epackagename="";
$epackagedetails="";
$epackageamount="";
$evehicletype="";
if(isset($_GET["eid"]))
{
	$selQry="select *  from tbl_package p inner join tbl_packagetype pt inner join tbl_vehicletype v on p.packagetype_id=pt.packagetype_id and p.vehicletype_id=v.vehicletype_id where package_id='".$_GET["eid"]."'";
	$row1=$con->query($selQry);
	$data1=$row1->fetch_assoc();
	$eid=$data1["package_id"];
	$epackagetype=$data1["packagetype_name"];
	$epackagename=$data1["package_name"];
	$epackagedetails=$data1["package_details"];
	$epackageamount=$data1["package_amount"];
	$evehicletype=$data1["vehicletype_name"];
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<br><br>
<div id="tab" align="center">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h1>New Package </h1>
  <p>&nbsp;</p>
  <table width="570" height="260" border="1" cellpadding="10">
    <tr>
      <td width="130">PackageType<span class="required">  *</span></td>
      <td width="388">
        <select name="txtpackagetype" id="txtpackagetype"  onchange="validatePackagetype(this)" required>
          <option selected="selected" value="" >---select---</option>
          <?php
		  $selQry="select * from tbl_packagetype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>      
          <option value=<?php echo $data["packagetype_id"]?>><?php echo ucfirst($data["packagetype_name"]);?></option>
          <?php
		  }
		  ?>
          
      </select> <span id="packagetypeerr"></span></td>
    </tr>
   <tr>
      <td>Vehicle Type<span class="required">  *</span></td>
      <td>
        <select name="txtvehicle" id="txtvehicle" value="<?php echo ucfirst($evehicletype);?>" onchange="validateVehicletype(this)" required>
          <option selected="selected" value="" >---select---</option>
          <?php
		  $selQry="select * from tbl_vehicletype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>      
          <option value=<?php echo $data["vehicletype_id"]?>><?php echo ucfirst($data["vehicletype_name"])?></option>
          <?php
		  }
		  ?>
          
      </select> <span id="vehicletypeerr"></span></td>
    </tr>

    <tr>
      <td>PackageName<span class="required">  *</span></td>
      <td><label for="txtpackagename"></label>
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
      <input type="text" name="txtpackagename" id="txtpackagename" value="<?php echo ucfirst($epackagename);?>" required="required" autocomplete="off"/></td>
    </tr>
    <tr>
      <td>Details<span class="required">  *</span></td>
      <td><label for="txtdetails"></label>
      <textarea name="txtdetails" id="txtdetails" cols="45" rows="5"  required="required" autocomplete="off" ><?php echo $epackagedetails;?></textarea></td>
    </tr>
    <tr>
      <td>Amount<span class="required">  *</span></td>
      <td><label for="txtamount"></label>
      <input type="text" name="txtamount" id="txtamount" value="<?php echo $epackageamount?>"  onkeyup="validateAmount(this)" required="required" autocomplete="off"/><span id="amount"></span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Save" />
        <input type="Reset" name="txtcancel" id="txtcancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 </form>

<form action="" method="post" name="form1" id="form1">
  <table width="968" height="121" border="1" cellpadding="10">
    <tr>
      <th width="64">Sl.No</th>
      <th width="141">PackageType</th>
      <th width="123">PackageName</th>
      <th width="140">Details</th>
      <th width="92">Amount</th>
      <th width="120">Vehicle Type</th>
       <th width="116">Action</th>
    </tr>
      <?php
    $selQry="select * from tbl_package p inner join tbl_packagetype t inner join tbl_vehicletype v on p.packagetype_id=t.packagetype_id and p.vehicletype_id=v.vehicletype_id order by package_id";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td>&nbsp;<?php echo $data["package_id"]?></td>
      <td>&nbsp;<?php echo $data["packagetype_name"];?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_name"]);?></td>
      <td>&nbsp;<?php echo ucfirst($data["package_details"]);?></td>
      <td>&nbsp;<?php echo $data["package_amount"]?> INR</td>
      <td>&nbsp;<?php echo $data["vehicletype_name"];?></td>
      <td>&nbsp;<a href="Package.php?did=<?php echo $data["package_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Package.php?eid=<?php echo $data["package_id"] ?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
    </tr>
     <?php
	}
	?>
  </table>

 </form>
 </div>
</center>
   <p>&nbsp;</p>
  <p>&nbsp;</p>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });

//--------------------------------PackageType Validation------------------------------------------------------ 
function validatePackagetype(elem)
{
    var packagetype=elem.value;
    if( packagetype=="")
       {
		document.getElementById("packagetypeerr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select Packagetype</span>";
       }
	else
		{
		document.getElementById("packagetypeerr").innerHTML = "";
       }
 }


//--------------------------------Amount Validation------------------------------------------------------ 

function validateAmount(elem)
{
	var nameexp = /^[0-9 ]+$/;
	 if(elem.value.match(nameexp))
       {
		document.getElementById("amount").innerHTML = "";
   }
    else

		document.getElementById("amount").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Only Digits Are Allowed</span>";
		elem.focus();
		return false;
}

//--------------------------------VehicleType Validation------------------------------------------------------ 
function validateVehicletype(elem)
{
    var vehicletype=elem.value;
    if( vehicletype=="")
       {
		document.getElementById("vehicletypeerr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select Vehicletype</span>";
       }
	else
		{
		document.getElementById("vehicletypeerr").innerHTML = "";
       }
 }


</script>