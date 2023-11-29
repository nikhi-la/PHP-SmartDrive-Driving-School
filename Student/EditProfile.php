<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile</title>
<style>
.required {
  color: red;
}
.p-viewer {
	z-index: 9999;
	position: absolute;
	left: 560px;
	margin-top: -60px;
}

#message {
  display:none;
  color: #000;
  position: relative;
  padding: 10px 10px;
  margin-top: 0px;
}

#message p {
  padding: 0px 35px;
  font-size: 12px;
}
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
.t {
    background: #DDD;
	padding: 0px;
	 margin: 50px 400px;
	 border-radius: 5px;
}
g{
	font-size: 14px;
	color:#666666;
}

a{
	text-decoration: none;
}
.t1 {
    background: #DDD;
	padding: 0px;
	 margin: 50px 146px;
}
p{
	
	font-family: Arial, Helvetica, sans-serif;	
}
body{
font-family: Arial, Helvetica, sans-serif ;
	
}
#form1 table th {
	font-weight: bold;
	text-align: left;
}
input[type=submit],[type=Reset]{
  background-color: #A3A3A3;
  border: 1px solid #3B3B3B;
  padding: 5px 12px;
  color: black;
  cursor: pointer;
  border-radius: 3px;
}
input[type=text],[type=password] {
  width: 50%;
  height: 30px;
  padding: 12px 20px;
  margin: 6px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit],[type=Reset]:hover {
  background-color: #999;
}

</style>

</head>

<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
$photo="";
$proof="";
if(isset($_POST["btnupdate"]))
{
	
$name=$_POST["txtname"];
$name=test_input($name);
$name=strtolower($name);

$middle=$_POST["txtmiddle"];
$middle=test_input($middle);
$middle=strtolower($middle);

$last=$_POST["txtlast"];
$last=test_input($last);


$dob=$_POST["txtdob"];
$min=date('Y-m-d', strtotime('-21915 days'));
$max=date('Y-m-d', strtotime('-6575 days'));

$gender=$_POST["txtgender"];
$district=$_POST["txtdistrict"];

$place=$_POST["txtplace"];
$place=test_input($place);
$place=strtolower($place);

$landmark=$_POST["txtlandmark"];
$landmark=test_input($landmark);
$landmark=strtolower($landmark);

$housename=$_POST["txthousename"];
$housename=test_input($housename);
$housename=strtolower($housename);

$pincode=$_POST["txtpincode"];
$pincode=test_input($pincode);

$email=$_POST["txtemail"];
$email=test_input($email);

$contact=$_POST["txtcontact"];
$contact=test_input($contact);


if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
	{
	?>
    <script>
    alert("Name : Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$middle))
	{
	?>
    <script>
    alert("Middle Name : Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$last))
	{
	?>
    <script>
    alert("Last Name : Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
    }
else if($dob>$max || $dob<$min || $dob=="")
{
	?>
    <script>
    alert("Invalid DOB");
	window.location="NewStudent.php";
	</script>
    <?php
}
else if ($gender=="")
	{
	?>
	<script>
    alert("Select Gender");
	window.location="NewStudent.php";
	</script>
    <?php
	}
else if ($district=="")
	{
	?>
	<script>
    alert("Select District");
	window.location="NewStudent.php";
	</script>
    <?php
	}
if (!preg_match("/^[a-zA-Z-' ]*$/",$place))
	{
	?>
    <script>
    alert("Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
    }

else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$landmark))
	{
	?>
    <script>
    alert("Landmark : Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
}
else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$housename))
	{
	?>
    <script>
    alert("Housename : Only letters and white space allowed");
	window.location="NewStudent.php";
	</script>
    <?php
    }
else if (!preg_match("/^[0-9]{6}$/",$pincode)) 
	{
	?>
    <script>
    alert("Pincode must be in the form ###### and only contains digits");
	window.location="NewStudent.php";
	</script>
    <?php
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	?>
    <script>
    alert("Invalid email format");
	window.location="NewStudent.php";
	</script>
    <?php
    }	
else if (!preg_match("/^[0-9]{10}$/",$contact)) 
	{
	?>
    <script>
    alert("Phone Number must contain 10 digits");
	window.location="NewStudent.php";
	</script>
    <?php
}

else 
{

$photo=$_FILES["photo"]["name"];
$temp=$_FILES["photo"]["tmp_name"];	
$proof=$_FILES["proof"]["name"];
$temp1=$_FILES["proof"]["tmp_name"];	

$allowedI =  array('jpeg','png' ,'jpg');
$filenameI = $_FILES['photo']['name'];
$extI = pathinfo($filenameI, PATHINFO_EXTENSION);

$allowedF =  array('pdf','doc','docx','odt','pdf','tex','txt','rtf','wps','wks','wpd');
$filenameF = $_FILES['proof']['name'];
$extF = pathinfo($filenameF, PATHINFO_EXTENSION);

if(!in_array($extI,$allowedI) ) 
{
  ?>
    <script>
    alert("Invalid image type");
	window.location="NewStudent.php";
	</script>
    <?php	
}
else if(!in_array($extF,$allowedF) ) 
{
  ?>
    <script>
    alert("Invalid File type");
	window.location="NewStudent.php";
	</script>
    <?php	
}

else
{
move_uploaded_file($temp,"../Assets/Files/studentPhoto/".$photo);
move_uploaded_file($temp1,"../Assets/Files/studentProof/".$proof);

$updateQry="update tbl_student set student_name='".$name."', student_middle='".$middle."', student_last='".$last."',student_dob='".$dob."',student_gender='".$gender."',district_id='".$district."',student_place='".$place."',student_landmark='".$landmark."',student_housename='".$housename."',student_pincode='".$pincode."',student_email='".$email."',student_contact='".$contact."',student_photo='".$photo."',student_proof='".$proof."',student_vstatus=0 where student_id='".$_SESSION["uid"]."'";	
if($con->query($updateQry))
{
 $sel="select * from tbl_student where student_id='".$_SESSION["uid"]."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($_POST["txtemail"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Account Verification";
    $mail->Body = "Hello"." ".ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])." ".".Your smartdrive account has been temporarily disabled as you edited your profile.You will be informed once your account has been activated after verification.With regards SmartDrive Team.";
  if($mail->send())
  {
    echo "Sended";
  }
  else
  {
    echo "Failed";
  }
		
?>
	<script>
	alert("Profile Updated");
	location.href="../Guest/Login.php";
	</script>
<?php
				
	}
}
}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	$sel="select * from tbl_student s inner join tbl_district d  on s.district_id=d.district_id where student_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);
	$data1=$row->fetch_assoc();
	
?>
<br><br><br><br><br>
<div id="tab" align="center" >
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
  <h2>Edit Profile</h2>
  <table width="847" height="668" border="0" cellpadding="10">
  <tr>
    <td width="185">Name<span class="required">  *</span></td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtname4"></label>
      <input type="text" name="txtname" id="txtname4" value="<?php echo ucfirst($data1["student_name"])?>" required="required" autocomplete="off" onkeyup="validateName(this)"/>
      <span id="name"></span></div></td>
    </tr>
  <tr>
    <td width="179">Middle Name</td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtmiddle"></label>
      <input type="text" name="txtmiddle" id="txtmiddle"  value="<?php echo ucfirst($data1["student_middle"])?>"  autocomplete="off" onkeyup="validateMiddleName(this)"/>
      <span id="middle"></span></div></td>
    </tr>
  <tr>
    <td width="179">Last Name<span class="required">  *</span></td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtlast"></label>
      <input type="text" name="txtlast" id="txtlast"  value="<?php echo ucfirst($data1["student_last"])?>" required="required" autocomplete="off" onkeyup="validateLastName(this)"/>
      <span id="last"></span></div></td>
    </tr>
  <tr>
    <td>DOB<span class="required">  *</span></td>
    <td colspan="2"><label for="txtdob"></label>
      <input type="date" name="txtdob" id="txtdob" value="<?php echo $data1["student_dob"]?>"  max=<?php echo date('Y-m-d', strtotime('-6574 days'));?>  min=<?php echo date('Y-m-d', strtotime('-27393 days'));?>  required="required" autocomplete="off"/>
      <span id="mydateError"></span></td>
    </tr>
  <tr>
    <td>Gender<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Male" <?php if (($data1["student_gender"]=="male")|| ($data1["student_gender"]=="Male")) echo "checked";?>  autocomplete="off" required="required"/>
      &nbsp;Male&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Female"  <?php if (($data1["student_gender"]=="female")|| ($data1["student_gender"]=="Female")) echo "checked";?> autocomplete="off" required="required"/>
      &nbsp;Female&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Others"  <?php if (($data1["student_gender"]=="others")|| ($data1["student_gender"]=="Others")) echo "checked";?> autocomplete="off" required="required"/>
     &nbsp; Otherss&nbsp;&nbsp;&nbsp;  <span id="gendererr"></span></div></td>
    </tr>
  <tr>
    <td>District<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtdistrict"></label>
      <select name="txtdistrict" id="txtdistrict"  onchange="validateDistrict(this)" required>
        <option selected="selected" value="">---select---</option>
        <?php
		  $selQry="select * from tbl_district";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		   ?>
        <option value=<?php echo $data["district_id"]?>><?php echo ucfirst($data["district_name"])?></option>
        <?php
		  }
		  ?>
        </select>
        <span id="districterr"></span></div>
     </td>
    </tr>
  <tr>
  <tr>
    <td>City<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtplace"></label>
      <input type="text" name="txtplace" id="txtplace" value="<?php echo ucfirst($data1["student_place"])?>" onkeyup="validateCity(this)"  required="required" autocomplete="off"/>
      <span id="city"></span></div></td>
    </tr>
  <tr>
    <td>Landmark<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtlandmark"></label>
      <input type="text" name="txtlandmark" id="txtlandmark" value="<?php echo ucfirst($data1["student_landmark"])?>" onkeyup="validateLandmark(this)"  required="required" autocomplete="off"/>
      <span id="landmark"></span></div></td>
    </tr>
  <tr>
    <td>House Name<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txthousename"></label>
      <input type="text" name="txthousename" id="txthousename" value="<?php echo ucfirst($data1["student_housename"])?>" onkeyup="validateHousename(this)" required="required" autocomplete="off"/>
      <span id="housename"></span></div></td>
  </tr>
  <tr>
    <td>Postal/Zip Code<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtpincode"></label>
      <input type="text" name="txtpincode" id="txtpincode" onkeyup="validatePincode(this)" value="<?php echo $data1["student_pincode"]?>" required="required" autocomplete="off"/>
      <span id="pincode"></span></div></td>
    </tr>
  <tr>
    <td>Email<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail"   onkeyup="validateEmail(this)" value="<?php echo $data1["student_email"]?>" required="required" autocomplete="off"/>
      <span id="email"></span></div></td>
  </tr>
  <tr>
    <td>Contact<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" onkeyup="validateContact(this)" value="<?php echo $data1["student_contact"]?>" required="required" autocomplete="off"/>
      <span id="contact"></span></div></td>
  </tr>
  <tr>
    <td>Photo<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="photo"></label>
      <input type="file" name="photo" id="photo" onchange="OnPhotoValidation()" required="required" autocomplete="off"/><g>.jpg,.jpeg,.png(limit upto 2mb)</g> <span id="photocss"></span></div></td>
  </tr>
  <tr>
    <td>Proof<span class="required">  *</span></td>
    <td width="616"colspan="2"><div class="input-group">
      <label for="proof"></label>
      <input type="file" name="proof" id="proof"  onchange="fileValidation()" required="required" autocomplete="off"/><g>Aadhar/Passport/PAN Card(doc,docx,pdf,txt)</g>
    <span id="proofcss"></span></div>
  </tr>
   <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnupdate" id="btnupdate" value="Update" />
        <input type="Reset" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
</form>

</div>
</body>
<?php 
include("Foot.php");
?>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
</script>
<script src="Validation.js"></script>
