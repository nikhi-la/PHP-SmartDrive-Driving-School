<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vehicle</title>
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
	$vehicletypeid=$_POST["txtvehicletype"];
	$vehiclenumber=$_POST["txtnumber"];
	$vehiclenumber=test_input($vehiclenumber);


	$vehiclename=$_POST["txtname"];
	$vehiclename=test_input($vehiclename);


	$photo=$_FILES["txtphoto"]["name"];
	$temp=$_FILES["txtphoto"]["tmp_name"];
	$allowedI =  array('jpeg','png' ,'jpg');
	$filenameI = $_FILES['txtphoto']['name'];
	$extI = pathinfo($filenameI, PATHINFO_EXTENSION);
if ($vehicletypeid=="")
	{
	?>
	<script>
    alert("Select Vehicle Type");
	window.location="Vehicle.php";
	</script>
    <?php
	}
else if (!preg_match("/^[a-zA-Z0-9' ]*$/",$vehiclenumber))
	{
	?>
    <script>
    alert("Vehicle Number : Special Charaters are not allowed");
	window.location="Vehicle.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z0-9' ]*$/",$vehiclename))
	{
	?>
    <script>
    alert("Vehicle Name : Special Charaters are not allowed");
	window.location="Vehicle.php";
	</script>
    <?php
    }
else if(!in_array($extI,$allowedI) ) 
{
  ?>
    <script>
    alert("Invalid image type");
	window.location="Vehicle.php";
	</script>
    <?php	
}

else
{		
	move_uploaded_file($temp,"../Assets/Files/vehiclephoto/".$photo);	
$hid=$_POST["txtid"];
if($hid!="")
{
	$updateQry="update tbl_vehicle set vehicletype_id='".$vehicletypeid."', vehicle_name='".$vehiclename."',vehicle_number='".$vehiclenumber."' ,vehicle_image='".$photo."' where vehicle_id='".$hid."'";
	$con->query($updateQry);
	?>
    <script>
	window.location="Vehicle.php";
	</script>
    <?php	
}
else
{
	
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["vreg_id"];
		$veid=$datae["vid_number"];
		$veid++;
		$length=strlen($veid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$vehicid=$reg.$zero.$veid;
		$upQry="update tbl_regid set vid_number='".$veid."' where id=1";
		$con->query($upQry);


$insQry="insert into tbl_vehicle(vehicle_id,vehicletype_id,vehicle_number,vehicle_image,vehicle_name)values('".$vehicid."','".$vehicletypeid."','".$vehiclenumber."','".$photo."','".$vehiclename."')";
if($con->query($insQry))
{
		?>

        <script>
		alert("Data Inserted");
		window.location="Vehicle.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Failed");
		window.location="Vehicle.php";
		</script>
        <?php
				
	}
	}
}
}

if(isset($_GET["did"]))
{
	$delQry="delete from tbl_vehicle where vehicle_id='".$_GET["did"]."'";
	$con->query($delQry);
	header("Location:Vehicle.php");
}
$eid="";
$ename="";
$enumber="";
$etypename="";
if(isset($_GET["eid"]))
{
	$selQry="select *  from tbl_vehicle v inner join tbl_vehicletype vt on v.vehicletype_id=vt.vehicletype_id where vehicle_id='".$_GET["eid"]."'";
	$row1=$con->query($selQry);
	$data1=$row1->fetch_assoc();
	$etypename=$data1["vehicletype_name"];
	$eid=$data1["vehicle_id"];
	$ename=$data1["vehicle_name"];
	$enumber=$data1["vehicle_number"];
	
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
  <h1> Vehicle</h1>
  <p>&nbsp;</p>
  <table width="570" height="260" border="1" cellpadding="10">
    <tr>
      <td>VehicleType<span class="required">  *</span></td>
      <td>
        <select name="txtvehicletype" id="txtvehicletype" onchange="validateVehicletype(this)" required>
          <option selected="selected" value="">---select---</option>
          <?php
		  $selQry="select * from tbl_vehicletype";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>      
          <option value=<?php echo $data["vehicletype_id"]?>><?php echo $data["vehicletype_name"]?></option>
          <?php
		  }
		  ?>
          
      </select> <span id="vehicletypeerr"></span></td>
    </tr>
    <tr>
      <td>Name<span class="required">  *</span></td>
      <td><label for="txtname"></label>
       <input type="hidden" name="txtid" id="txtid" value="<?php echo $eid?>" />
      <input type="text" name="txtname" id="txtname" value="<?php echo $ename?>"  onkeyup="validateVname(this)" required="required" autocomplete="off" /><span id="vname"></span></td>
    </tr>
    <tr>
      <td>Number<span class="required">  *</span></td>
      <td><label for="txtnumber"></label>
      <input type="text" name="txtnumber" id="txtnumber" value="<?php echo $enumber?>" onkeyup="validateVnumber(this)" required="required" autocomplete="off"/><span id="vnumber"></span></td>
    </tr>
    <tr>
      <td>Photo<span class="required">  *</span></td>
      <td><label for="txtphoto"></label>
      <input type="file" name="txtphoto" id="txtphoto" required="required"  onchange="OnPhotoValidation()" autocomplete="off"/>
    <span id="photocss"></span></td></tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Save" />
        <input type="Reset" name="txtcancel" id="txtcancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
<br>
  <table width="784" height="222" border="1" cellpadding="10">
    <tr>
      <th>Sl.No.</th>
       <th>Vehicle Type</th>
      <th>Vehicle Name</th>
       <th>Vehicle Number</th>
        <th>Vehicle Image</th>
      <th>Action</th>
    </tr>
     <?php
    $selQry="select * from tbl_vehicle v inner join tbl_vehicletype vt on v.vehicletype_id=vt.vehicletype_id";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
      <tr>
      <td height="145">&nbsp;<?php echo $data["vehicle_id"]?></td>
      <td>&nbsp;<?php echo $data["vehicletype_name"];?></td>
      <td>&nbsp;<?php echo $data["vehicle_name"];?></td>
      <td>&nbsp;<?php echo $data["vehicle_number"]?></td>
<td width="114">&nbsp;<img src="../Assets/Files/vehiclephoto/<?php echo $data["vehicle_image"];?>"width="100" height="100"/></td>
      <td>&nbsp;<a href="Vehicle.php?did=<?php echo $data["vehicle_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a> / <a href="Vehicle.php?eid=<?php echo $data["vehicle_id"] ?>"><i class="fa fa-edit" style="font-size:24px"></i></a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</div>
</center>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });

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

//--------------------------------Vehicle Number Validation------------------------------------------------------ 

function validateVnumber(elem)
{
var nameexp=/^([A-Za-z0-9 ]*)$/;
	if(elem.value.match(nameexp))
	{
		document.getElementById("vnumber").innerHTML = "";
		return true;
	}
	else
	{
		
		document.getElementById("vnumber").innerHTML = "<span  style='color: red;text: 12px;font-size: 14px;'>Special characters are not allowed</span>";
		elem.focus();
		return false;
	}  
}

//--------------------------------Photo Validation------------------------------------------------------ 

function OnPhotoValidation() {

    var image = document.getElementById("txtphoto");
	 var imagePath = image.value;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	if(imagePath=="")
	{
			document.getElementById("photocss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Insert Photo</span>";
	}
	else{
    if (typeof (image.files) != "undefined") {
        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 
        if(size > 2) {
            alert('Please select image size less than 2 MB');
        }
		if (!allowedExtensions.exec(imagePath)) {
                alert('Invalid file type');
                image.value = '';
            }
		
    } else {
        alert("This browser does not support HTML5.");
    }
	}
}

//--------------------------------Vehicle Name Validation------------------------------------------------------ 

function validateVname(elem)
{
var nameexp=/^([A-Za-z0-9 ]*)$/;
	if(elem.value.match(nameexp))
	{
		document.getElementById("vname").innerHTML = "";
		return true;
	}
	else
	{
		
		document.getElementById("vname").innerHTML = "<span  style='color: red;text: 12px;font-size: 14px;'>Special characters are not allowed</span>";
		elem.focus();
		return false;
	}  
}



</script>