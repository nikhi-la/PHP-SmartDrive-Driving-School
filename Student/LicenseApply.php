<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply License</title>
<style>
g{
	font-size: 14px;
	color:#666666;
}

</style>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsubmit"]))
{
$photo=$_FILES["photo"]["name"];
$temp=$_FILES["photo"]["tmp_name"];	

$signature=$_FILES["signature"]["name"];
$temp1=$_FILES["signature"]["tmp_name"];
	
$allowedI =  array('jpeg','jpg');
$filenameI = $_FILES['photo']['name'];
$extI = pathinfo($filenameI, PATHINFO_EXTENSION);

$allowedF = array('jpeg','jpg');
$filenameF = $_FILES['signature']['name'];
$extF = pathinfo($filenameF, PATHINFO_EXTENSION);

if(!in_array($extI,$allowedI) ) 
{
  ?>
    <script>
    alert("Invalid Photo type");
	window.location="LicenseApply.php";
	</script>
    <?php	
}
else if(!in_array($extF,$allowedF) ) 
{
  ?>
    <script>
    alert("Invalid Signature type");
	window.location="LicenseApply.php";
	</script>
    <?php	
}
else
{
$paddressproof=$_FILES["paddressproof"]["name"];
$temp2=$_FILES["paddressproof"]["tmp_name"];
	
$selfdeclaration=$_FILES["selfdeclaration"]["name"];
$temp3=$_FILES["selfdeclaration"]["tmp_name"];
	
$ageproof=$_FILES["ageproof"]["name"];
$temp4=$_FILES["ageproof"]["tmp_name"];
	
$addressproof=$_FILES["addressproof"]["name"];
$temp5=$_FILES["addressproof"]["tmp_name"];
	
$eyecertificate=$_FILES["eyecertificate"]["name"];
$temp6=$_FILES["eyecertificate"]["tmp_name"];	


move_uploaded_file($temp,"../Assets/Files/LicenseDetails/".$photo);
move_uploaded_file($temp1,"../Assets/Files/LicenseDetails/".$signature);
move_uploaded_file($temp2,"../Assets/Files/LicenseDetails/".$paddressproof);
move_uploaded_file($temp3,"../Assets/Files/LicenseDetails/".$selfdeclaration);
move_uploaded_file($temp4,"../Assets/Files/LicenseDetails/".$ageproof);
move_uploaded_file($temp5,"../Assets/Files/LicenseDetails/".$addressproof);
move_uploaded_file($temp6,"../Assets/Files/LicenseDetails/".$eyecertificate);

$insQry="update tbl_license set license_photo='".$photo."',license_signature='".$signature."',license_permanentap='".$paddressproof."',license_self='".$selfdeclaration."',license_ageproof='".$ageproof."',license_presentap='".$addressproof."',license_eyetest='".$eyecertificate."',cur_date=curdate() where student_id='".$_SESSION["uid"]."' and license_status=1";
if($con->query($insQry))
{
	?>
    <script>
	alert("Data Inserted");
	location.href="LicenseApply.php";
	</script>

    <?php
}
else
{
	?>
    <script>
	alert("Data Failed");
	</script>

    <?php
}
}
}
?>
<br><br><br><br>
<div id="tab" align="center" >
<form id="form1" name="form1" method="post" action=""  enctype="multipart/form-data">
<h2>Apply Licence</h2>

  <table width="723" height="645" border="1" cellpadding="10">
    <tr>
      <th width="284">Photo</th>
      <td width="387"><input type="file" name="photo" id="photo" onchange="OnPhotoValidation()"  required="required" autocomplete="off"/><g>.jpg,.jpeg(size between 10kb - 20 kb)</g></div></td>
    </tr>
    <tr>
      <th>Signature</th>
      <td><input type="file" name="signature" id="signature"  onchange="SignatureValidation()" required="required" autocomplete="off"/><g>.jpg,.jpeg(size between 10kb - 20 kb)</g></div></td>
    </tr>
    <tr>
      <th>Permanent Address Proof</th>
      <td><input type="file" name="paddressproof" id="paddressproof"  required="required" autocomplete="off"/> <g>Aadhar/Passport/PAN Card/Driving License</g></td>
    </tr>
    <tr>
      <th>Form1 (Self Declaration)</th>
      <td><input type="file" name="selfdeclaration" id="selfdeclaration"  required="required" autocomplete="off"/><g></g></td>
    </tr>
    <tr>
      <th>Age Proof</th>
      <td><input type="file" name="ageproof" id="ageproof"  required="required" autocomplete="off"/><g>SSLC/Birth Certificate/Passort/Driving License</g></td>
    </tr>
    <tr>
      <th>Present Address Proof(Optional)</th>
      <td><input type="file" name="addressproof" id="addressproof"   autocomplete="off"/><g>Aadhar/Passport/PAN Card/Driving License</g></td>
    </tr>
    <tr>
      <th>Eye Test Certificate</th>
      <td><input type="file" name="eyecertificate" id="eyecertificate"  required="required" autocomplete="off"/><g></g></td>
    </tr>
    <tr>
    <td height="18" colspan="2"><div align="center">
      <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
    </div></td>
    </tr>

  </table>
 </div>
</form>
</body>
</html>
<?php 
include("Foot.php")
?>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });

//--------------------------------Photo Validation------------------------------------------------------ 

function OnPhotoValidation() {

    var image = document.getElementById("photo");
	 var imagePath = image.value;
	var allowedExtensions = /(\.jpg|\.jpeg)$/i;
	if(imagePath=="")
	{
			document.getElementById("photocss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Insert Photo</span>";
	}
	else{
    if (typeof (image.files) != "undefined") {
        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 
        if(size > 2) {
            alert('Please select image size less than 20 kb');
        }
		if (!allowedExtensions.exec(imagePath)) {
                alert('Invalid photo type');
                image.value = '';
            }
		
    } else {
        alert("This browser does not support HTML5.");
    }
	}
}
//--------------------------------Signature Validation------------------------------------------------------ 

function SignatureValidation() {

    var image = document.getElementById("signature");
	 var imagePath = image.value;
	var allowedExtensions = /(\.jpg|\.jpeg)$/i;
	if(imagePath=="")
	{
			document.getElementById("signaturecss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Insert signature</span>";
	}
	else{
    if (typeof (image.files) != "undefined") {
        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 
        if(size > 2) {
            alert('Please select image size less than 20 kb');
        }
		if (!allowedExtensions.exec(imagePath)) {
                alert('Invalid signature type');
                image.value = '';
            }
		
    } else {
        alert("This browser does not support HTML5.");
    }
	}
}


</script>