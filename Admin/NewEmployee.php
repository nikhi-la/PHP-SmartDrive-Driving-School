<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>New Employee</title>
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
input[type=submit]{
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
input[type=submit]:hover {
  background-color: #999;
}

</style>

</head>

<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

$name="";
$gender="";
$contact="";
$email="";
$address="";
$district="";
$photo="";
$proof="";
$doj="";
$dob="";
$housename="";
$landmark="";
$pincode="";
$place="";
$password="";
$confirmpassword="";

if(isset($_POST["btnsave"]))
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

$password=$_POST["password"];
$password=test_input($password);

  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);

$confirmpassword=$_POST["cpassword"];
$confirmpassword=test_input($confirmpassword);

if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
	{
	?>
    <script>
    alert("First Name : Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$middle))
	{
	?>
    <script>
    alert("Middle Name : Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$last))
	{
	?>
    <script>
    alert("Last Name : Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
    }
else if($dob>$max || $dob<$min || $dob=="")
{
	?>
    <script>
    alert("Invalid DOB");
	window.location="NewEmployee.php";
	</script>
    <?php
}
else if ($gender=="")
	{
	?>
	<script>
    alert("Select Gender");
	window.location="NewEmployee.php";
	</script>
    <?php
	}
else if ($district=="")
	{
	?>
	<script>
    alert("Select District");
	window.location="NewEmployee.php";
	</script>
    <?php
	}
else if (!preg_match("/^[a-zA-Z-' ]*$/",$place))
	{
	?>
    <script>
    alert("Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
    }

else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$landmark))
	{
	?>
    <script>
    alert("Landmark : Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
}
else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$housename))
	{
	?>
    <script>
    alert("Housename : Only letters and white space allowed");
	window.location="NewEmployee.php";
	</script>
    <?php
    }
else if (!preg_match("/^[0-9]{6}$/",$pincode)) 
	{
	?>
    <script>
    alert("Pincode must be in the form ###### and only contains digits");
	window.location="NewEmployee.php";
	</script>
    <?php
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	?>
    <script>
    alert("Invalid email format");
	window.location="NewEmployee.php";
	</script>
    <?php
    }	
else if (!preg_match("/^[0-9]{10}$/",$contact)) 
	{
	?>
    <script>
    alert("Phone Number must contain 10 digits");
	window.location="NewEmployee.php";
	</script>
    <?php
}
else if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || $password=="") 
  {
	?>
    <script>
    alert("Invalid Password");
	window.location="NewEmployee.php";
	</script>
    <?php  
  }
else if($password!=$confirmpassword) 
  {
	?>
    <script>
    alert("Password Doesn't Match");
	window.location="NewEmployee.php";
	</script>
    <?php  
  }

else 
{
if($password==$confirmpassword)
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
	window.location="NewEmployee.php";
	</script>
    <?php	
}
else if(!in_array($extF,$allowedF) ) 
{
  ?>
    <script>
    alert("Invalid File type");
	window.location="NewEmployee.php";
	</script>
    <?php	
}

else
{
move_uploaded_file($temp,"../Assets/Files/employeePhoto/".$photo);
move_uploaded_file($temp1,"../Assets/Files/employeeProof/".$proof);

$sel="select * from tbl_regid where id=1";
$row1=$con->query($sel);
$datae=$row1->fetch_assoc();

$reg=$datae["ereg_id"];
$emid=$datae["eid_number"];
$emid++;
$length=strlen($emid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$employeeid=$reg.$zero.$emid;
$upQry="update tbl_regid set eid_number='".$emid."' where id=1";
$con->query($upQry);


$insQry="insert into tbl_employee(emp_id,emp_name,emp_middle,emp_last,emp_dob,emp_gender,district_id,emp_place,emp_landmark,emp_housename,emp_pincode,emp_email,emp_contact,emp_photo,emp_proof,emp_password,emp_doj)values('".$employeeid."','".$name."','".$middle."','".$last."','".$dob."','".$gender."','".$district."','".$place."','".$landmark."','".$housename."','".$pincode."','".$email."','".$contact."','".$photo."','".$proof."','".$password."',curdate())";
if($con->query($insQry))
{
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
  
    $mail->Subject = "Registration Successful";
    $mail->Body = "Hello"." ".ucfirst($_POST["txtname"])." ".ucfirst($_POST["txtmiddle"])." ".ucfirst($_POST["txtlast"])." "."You are registered as an employee in  Smart Drive Driving School.You can now login with password "." ".$_POST["password"]." "." and email "." ".$_POST["txtemail"]." ".".Thank You.";
  if($mail->send())
  {
    echo "";
  }
  else
  {
    echo "";
  }

	?>
       <script>
		alert("Data Inserted");
		window.location="EmployeeList.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Failed");
		window.location="NewEmployee.php";
		</script>
        <?php
				
	}
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

?>
<br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
  <h1>Employee Registration</h1>
  <table width="766" height="668" border="0" cellpadding="10">
  <tr>
    <td width="179">First Name<span class="required">  *</span></td>
    <td width="541" colspan="2"><div class="input-group">
      <label for="txtname"></label>
      <input type="text" name="txtname" id="txtname"  required="required" autocomplete="off" onkeyup="validateFirstName(this)"/>
      <span id="name"></span></div></td>
    </tr>
  <tr>
    <td width="179">Middle Name</td>
    <td width="541" colspan="2"><div class="input-group">
      <label for="txtmiddle"></label>
      <input type="text" name="txtmiddle" id="txtmiddle"   autocomplete="off" onkeyup="validateMiddleName(this)"/>
      <span id="middle"></span></div></td>
    </tr>

  <tr>
    <td width="179">Last Name<span class="required">  *</span></td>
    <td width="541" colspan="2"><div class="input-group">
      <label for="txtlast"></label>
      <input type="text" name="txtlast" id="txtlast"  required="required" autocomplete="off" onkeyup="validateLastName(this)"/>
      <span id="last"></span></div></td>
    </tr>
  <tr>
    <td>DOB<span class="required">  *</span></td>
    <td colspan="2"><label for="txtdob"></label>
      <input type="date" name="txtdob" id="txtdob"  max=<?php echo date('Y-m-d', strtotime('-6574 days'));?>  min=<?php echo date('Y-m-d', strtotime('-27393 days'));?>   required="required" autocomplete="off"/><span id="mydateError"></span>
</td>
    </tr>
  <tr>
    <td>Gender<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <input type="radio" name="txtgender" id="txtgender" required="required" onchange="validateGender(this)"  value="Male"  autocomplete="off"/>
       &nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" required="required" onchange="validateGender(this)"  value="Female" autocomplete="off"/>
      &nbsp; Female&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" required="required" onchange="validateGender(this)"  value="Others" autocomplete="off"/>
      &nbsp;Others  <span id="gendererr"></span></div></td>
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
        <option value=<?php echo $data["district_id"]?>><?php echo ucfirst($data["district_name"]);?></option>
        <?php
		  }
		  ?>
        </select>
        <span id="districterr"></span></div>
     </td>
    </tr>
  <tr>
    <td>City<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtplace"></label>
      <input type="text" name="txtplace" id="txtplace" onkeyup="validateCity(this)"  required="required" autocomplete="off"/>
        <span id="city"></span></div></td>
    </tr>

  <tr>
    <td>Landmark<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtlandmark"></label>
      <input type="text" name="txtlandmark" id="txtlandmark" onkeyup="validateLandmark(this)"  required="required" autocomplete="off"/>
      <span id="landmark"></span></div></td>
    </tr>
  <tr>
    <td>House Name</td>
    <td colspan="2"><div class="input-group">
      <label for="txthousename"></label>
      <input type="text" name="txthousename" id="txthousename" onkeyup="validateHousename(this)" required="required" autocomplete="off"/>
      <span id="housename"></span></div></td>
  </tr>
  <tr>
    <td>Postal/Zip Code<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtpincode"></label>
      <input type="text" name="txtpincode" id="txtpincode" onkeyup="validatePincode(this)" required="required" autocomplete="off"/>
      <span id="pincode"></span></div></td>
    </tr>
  <tr>
    <td>Email<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail"   onfocusout="validateEmail(this)" required="required" autocomplete="off"/>
      <span id="email"></span></div></td>
  </tr>
  <tr>
    <td>Contact<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" onkeyup="validateContact(this)" required="required" autocomplete="off"/>
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
    <td width="541"colspan="2"><div class="input-group">
      <label for="proof"></label>
      <input type="file" name="proof" id="proof"  onchange="fileValidation()" required="required" autocomplete="off"/><g>Aadhar/Passport/PAN Card(doc,docx,pdf,txt)</g>
    <span id="proofcss"></span></div>
  </tr>
  <tr>
    <td>Password<span class="required">  *</span></td>
    <td>
      <label for="password"></label>
      <input type="password" name="password" id="password"  required="required" autocomplete="off"  />
      <i class="fa fa-eye "id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
     <div id="message">
  	 <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  	 <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  	 <p id="number" class="invalid">A <b>number</b></p>
  	 <p id="length" class="invalid">Minimum <b>8 characters</b></p>
	 </div></td>
  </tr>
  <tr>
    <td>Confirm Password<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="cpassword"></label>
      <input type="password" name="cpassword" id="cpassword" onfocusout="validateConfirmPassword()" required="required" autocomplete="off"/>
      <span id="scpassword"></span></div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
      <input type="submit" name="btnsave" id="btnsave" value="Register"/>
      <input type="Reset" name="btncancel" id="btncancel" value="Cancel" />
    </div></td>
  </tr>
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
<script src="Validation.js"></script>
