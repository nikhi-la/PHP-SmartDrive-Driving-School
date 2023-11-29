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
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
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
$gender=strtolower($gender);

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


$allowedI =  array('jpeg','png' ,'jpg');
$filenameI = $_FILES['photo']['name'];
$extI = pathinfo($filenameI, PATHINFO_EXTENSION);

$allowedF =  array('pdf','doc','docx','odt','pdf','tex','txt','rtf','wps','wks','wpd');
$filenameF = $_FILES['proof']['name'];
$extF = pathinfo($filenameF, PATHINFO_EXTENSION);


if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
	{
	?>
    <script>
    alert("First Name : Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$middle))
	{
	?>
    <script>
    alert("Middle Name : Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
    }
else if (!preg_match("/^[a-zA-Z-' ]*$/",$last))
	{
	?>
    <script>
    alert("Last Name : Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
    }
else if($dob>$max || $dob<$min || $dob=="")
{
	?>
    <script>
    alert("Invalid DOB");
	window.location="EditProfile.php";
	</script>
    <?php
}
else if ($gender=="")
	{
	?>
	<script>
    alert("Select Gender");
	window.location="EditProfile.php";
	</script>
    <?php
	}
else if ($district=="")
	{
	?>
	<script>
    alert("Select District");
	window.location="EditProfile.php";
	</script>
    <?php
	}
else if (!preg_match("/^[a-zA-Z-' ]*$/",$place))
	{
	?>
    <script>
    alert("Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
    }

else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$landmark))
	{
	?>
    <script>
    alert("Landmark : Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
}
else if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$housename))
	{
	?>
    <script>
    alert("Housename : Only letters and white space allowed");
	window.location="EditProfile.php";
	</script>
    <?php
    }
else if (!preg_match("/^[0-9]{6}$/",$pincode)) 
	{
	?>
    <script>
    alert("Pincode must be in the form ###### and only contains digits");
	window.location="EditProfile.php";
	</script>
    <?php
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	?>
    <script>
    alert("Invalid email format");
	window.location="EditProfile.php";
	</script>
    <?php
    }	
else if (!preg_match("/^[0-9]{10}$/",$contact)) 
	{
	?>
    <script>
    alert("Phone Number must contain 10 digits");
	window.location="EditProfile.php";
	</script>
    <?php
}

else if(!in_array($extI,$allowedI) ) 
{
  ?>
    <script>
    alert("Invalid image type");
	window.location="EditProfile.php";
	</script>
    <?php	
}
else if(!in_array($extF,$allowedF) ) 
{
  ?>
    <script>
    alert("Invalid File type");
	window.location="EditProfile.php";
	</script>
    <?php	
}

else
{
$photo=$_FILES["photo"]["name"];
$temp=$_FILES["photo"]["tmp_name"];	
$proof=$_FILES["proof"]["name"];
$temp=$_FILES["proof"]["tmp_name"];	

move_uploaded_file($temp,"../Assets/Files/employeePhoto/".$photo);
move_uploaded_file($temp,"../Assets/Files/employeeProof/".$proof);


$updateQry="update tbl_employee set emp_name='".$name."',emp_middle='".$middle."',emp_last='".$last."',emp_dob='".$dob."',emp_gender='".$gender."',district_id='".$district."',emp_place='".$place."',emp_landmark='".$landmark."',emp_housename='".$housename."',emp_pincode='".$pincode."',emp_email='".$email."',emp_contact='".$contact."',emp_photo='".$photo."',emp_proof='".$proof."'  where emp_id='".$_SESSION["uid"]."'";		
if($con->query($updateQry))
{
?>
	<script>
	alert("Profile Updated");
	location.href="EditProfile.php";
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
	$sel="select * from tbl_employee e inner join tbl_district d  on e.district_id=d.district_id  where emp_id='".$_SESSION["uid"]."'";
	$row=$con->query($sel);
	$data1=$row->fetch_assoc();
	
?>
<br><br><br> 
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
  <h3>Edit Your Profile</h3>
  <p>&nbsp;</p>
  <table width="847" height="668" border="0" cellpadding="10">
  <tr>
    <td width="179">First Name<span class="required">  *</span></td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtname"></label>
      <input type="text" name="txtname" id="txtname"  required="required" value="<?php echo ucfirst($data1["emp_name"])?>" autocomplete="off" onkeyup="validateFirstName(this)"/>
      <span id="name"></span></div></td>
    </tr>
  <tr>
    <td width="179">Middle Name</td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtmiddle"></label>
      <input type="text" name="txtmiddle" id="txtmiddle"   autocomplete="off" value="<?php echo ucfirst($data1["emp_middle"])?>" onkeyup="validateMiddleName(this)"/>
      <span id="middle"></span></div></td>
    </tr>

  <tr>
    <td width="179">Last Name<span class="required">  *</span></td>
    <td width="616" colspan="2"><div class="input-group">
      <label for="txtlast"></label>
      <input type="text" name="txtlast" id="txtlast"  required="required" value="<?php echo ucfirst($data1["emp_last"])?>" autocomplete="off" onkeyup="validateLastName(this)"/>
      <span id="last"></span></div></td>
    </tr>  <tr>
    <td>DOB<span class="required">  *</span></td>
    <td colspan="2"><label for="txtdob"></label>
      <input type="date" name="txtdob" id="txtdob" value="<?php echo $data1["emp_dob"]?>"  max=<?php echo date('Y-m-d', strtotime('-6574 days'));?>  min=<?php echo date('Y-m-d', strtotime('-27393 days'));?> onchange="validateDOB(this)" required="required" autocomplete="off"/>
      <span id="mydateError"></span></td>
    </tr>
  <tr>
    <td>Gender<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Male" <?php if (ucfirst($data1["emp_gender"])=="Male") echo "checked";?>  autocomplete="off" required="required"/>
       &nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Female"  <?php if (ucfirst($data1["emp_gender"])=="Female") echo "checked";?> autocomplete="off" required="required"/>
      &nbsp; Female&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="txtgender" id="txtgender" onchange="validateGender(this)"  value="Others"  <?php if (ucfirst($data1["emp_gender"])=="Others") echo "checked";?> autocomplete="off" required="required"/>
      &nbsp;Others  <span id="gendererr"></span></div></td>
    </tr>
  <tr>
    <td>District<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtdistrict"></label>
      <select name="txtdistrict" id="txtdistrict"  onchange="getPlace(this.value);validateDistrict(this)" required>
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
    <td>City<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtplace"></label>
      <input type="text" name="txtplace" id="txtplace" value="<?php echo ucfirst($data1["emp_place"])?>" onkeyup="validateCity(this)"  required="required" autocomplete="off"/>
      <span id="city"></span></div></td>
    </tr>
  <tr>
    <td>Landmark<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtlandmark"></label>
      <input type="text" name="txtlandmark" id="txtlandmark" value="<?php echo ucfirst($data1["emp_landmark"])?>" onkeyup="validateLandmark(this)"  required="required" autocomplete="off"/>
      <span id="landmark"></span></div></td>
    </tr>
  <tr>
    <td>House Name<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txthousename"></label>
      <input type="text" name="txthousename" id="txthousename" value="<?php echo ucfirst($data1["emp_housename"])?>" onkeyup="validateHousename(this)" required="required" autocomplete="off"/>
      <span id="housename"></span></div></td>
  </tr>
  <tr>
    <td>Postal/Zip Code<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtpincode"></label>
      <input type="text" name="txtpincode" id="txtpincode" onkeyup="validatePincode(this)" value="<?php echo $data1["emp_pincode"]?>" required="required" autocomplete="off"/>
      <span id="pincode"></span></div></td>
    </tr>
  <tr>
    <td>Email<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail"   onkeyup="validateEmail(this)" value="<?php echo $data1["emp_email"]?>" required="required" autocomplete="off"/>
      <span id="email"></span></div></td>
  </tr>
  <tr>
    <td>Contact<span class="required">  *</span></td>
    <td colspan="2"><div class="input-group">
      <label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" onkeyup="validateContact(this)" value="<?php echo $data1["emp_contact"]?>" required="required" autocomplete="off"/>
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
    <td width="568"colspan="2"><div class="input-group">
      <label for="proof"></label>
      <input type="file" name="proof" id="proof"  onchange="fileValidation()" required="required" autocomplete="off"/><g>Aadhar/Passport/PAN Card(doc,docx,pdf,txt)</g>
    <span id="proofcss"></span></div>
  </tr>
   <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnupdate" id="btnupdate" value="Update" />
        <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
</form>

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
