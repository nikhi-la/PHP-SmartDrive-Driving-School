<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customize Your Own Packages</title>
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
	
	if($_POST["txtvehicletype"]=="VT2022110001")
	{
	 $amount=$_POST["txtduration"]*100;
	}
   if($_POST["txtvehicletype"]=="VT2022110002")
	{
	 $amount=$_POST["txtduration"]*110;
	}
	if($_POST["txtvehicletype"]=="VT2022110003")
	{
	 $amount=$_POST["txtduration"]*250;
	}
	if($_POST["txtvehicletype"]=="VT2022110004")
	{
	 $amount=$_POST["txtduration"]*350;
	}

	$vehicletypeid=$_POST["txtvehicletype"];
	$vehiclename=$_POST["txtvehiclename"];
	$vehiclename=test_input($vehiclename);
	$vehiclename=strtolower($vehiclename);


	$vehiclenumber=$_POST["txtvehiclenumber"];
	$vehiclenumber=test_input($vehiclenumber);

	$courseduration=$_POST["txtduration"];
	$courseduration=test_input($courseduration);

	$photo=$_FILES["txtimage"]["name"];
	$temp=$_FILES["txtimage"]["tmp_name"];
	$allowedI =  array('jpeg','png' ,'jpg');
	$filenameI = $_FILES['txtimage']['name'];
	$extI = pathinfo($filenameI, PATHINFO_EXTENSION);
if ($vehicletypeid=="")
	{
	?>
	<script>
    alert("Select Vehicle Type");
	window.location="CustomizePackage.php";
	</script>
    <?php
	}

else if (!preg_match("/^[a-zA-Z0-9' ]*$/",$vehiclename))
	{
	?>
    <script>
    alert("Vehicle Name : Special Charaters are not allowed");
	window.location="CustomizePackage.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z0-9' ]*$/",$vehiclenumber))
	{
	?>
    <script>
    alert("Vehicle Number : Special Charaters are not allowed");
	window.location="CustomizePackage.php";
	</script>
    <?php
    }
else if (!preg_match("/^[0-9 ]+$/",$courseduration)) 
	{
	?>
    <script>
    alert("Invalid Course Duration");
	window.location="CustomizePackage.php";
	</script>
    <?php
	}

else if(!in_array($extI,$allowedI) ) 
{
  ?>
    <script>
    alert("Invalid image type");
	window.location="CustomizePackage.php";
	</script>
    <?php	
}

else
{
	move_uploaded_file($temp,"../Assets/Files/vehiclephoto/".$photo);

		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["custreg_id"];
		$custid=$datae["custid_number"];
		$custid++;
		$length=strlen($custid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$customid=$reg.$zero.$custid;
		$upQry="update tbl_regid set custid_number='".$custid."' where id=1";
		$con->query($upQry);
	

$insQry="insert into tbl_customizepackage(customization_id,vehicle_type,vehicle_name,vehicle_number,vehicle_image,course_duration,course_amount,student_id)values('".$customid."','".$_POST["txtvehicletype"]."','".$_POST["txtvehiclename"]."','".$_POST["txtvehiclenumber"]."','".$photo."','".$_POST["txtduration"]."','".$amount."','".$_SESSION["uid"]."')";
if($con->query($insQry))
{
?>
<script>
alert("Data Inserted");
window.location="ViewBookedPackages.php";
</script>

<?php	

}
else
{
?>
<script>
alert("Failed");
window.location="CustomizePackage.php";
</script>	
<?php	
}
}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<br><br><br> 
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <h3>Customize Your Package</h3>
  <p>&nbsp;</p>
  <table width="542" height="300" border="1" cellpadding="10">
    <tr>
      <td width="156">Vehicle Type<span class="required">  *</span></td>
      <td width="334"><label for="txtvehicletype"></label>
        <select name="txtvehicletype" id="txtvehicletype" onchange="validateVehicletype(this)" required>
          <option selected="selected" value="">---select---</option>
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
      <tr>
      <td>Vehicle Name<span class="required">  *</span></td>
      <td><label for="txtvehiclename"></label>
      <input type="text" name="txtvehiclename" id="txtvehiclename"  onkeyup="validateVname(this)" autocomplete="off" required="required" />
      <span id="vname"></span></td>
    </tr>

    <tr>
      <td>Vehicle Number<span class="required">  *</span></td>
      <td><label for="txtvehiclenumber"></label>
      <input type="text" name="txtvehiclenumber" id="txtvehiclenumber"  onkeyup="validateVnumber(this)" autocomplete="off" required="required" />
        <span id="vnumber"></span></td>
    </tr>
    <tr>
      <td>Vehicle Image<span class="required">  *</span></td>
      <td><label for="txtimage"></label>
      <input type="file" name="txtimage" id="txtimage" onchange="OnPhotoValidation()" required="required" />
      <span id="photocss"></span></td>
    </tr>
    <tr>
      <td>Course Duration<span class="required">  *</span></td>
      <td><label for="txtduration"></label>
      <input type="text" name="txtduration" id="txtduration" onkeyup="validateDuration(this)" placeholder="number of days"  autocomplete="off" required="required"  />
      Day <span id="duration"></span>
</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Customize" />
      </div></td>
    </tr>
  </table>
</form>
</div>
</body>
<?php
include("Foot.php") 
?>
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

    var image = document.getElementById("txtimage");
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

//--------------------------------Course Duration Validation------------------------------------------------------ 

function validateDuration(elem)
{
	var nameexp = /^[0-9 ]+$/;
	 if(elem.value.match(nameexp))
       {
		document.getElementById("duration").innerHTML = "";
   }
    else

		document.getElementById("duration").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Only Digits Are Allowed</span>";
		elem.focus();
		return false;
}


</script>
