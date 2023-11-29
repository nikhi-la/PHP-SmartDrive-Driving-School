<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>studentloyee List</title>

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

$first="";
$middle="";
$last="";
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

if(isset($_GET["did"]))
{
$sel="select * from tbl_student  where student_id='".$_GET["did"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

$studentid=$data1["student_id"];
$first=$data1["student_name"];
$middle=$data1["student_middle"];
$last=$data1["student_last"];
$dob=$data1["student_dob"];
$gender=$data1["student_gender"];
$district=$data1["district_id"];
$place=$data1["student_place"];
$landmark=$data1["student_landmark"];
$housename=$data1["student_housename"];
$pincode=$data1["student_pincode"];
$email=$data1["student_email"];
$contact=$data1["student_contact"];
$photo=$data1["student_photo"];
$proof=$data1["student_proof"];
$password=$data1["student_password"];
$doj=$data1["student_doj"];


$insQry="insert into tbl_studentdeparture(student_id,student_name,student_middle,student_last,student_dob,student_gender,district_id,student_place,student_landmark,student_housename,student_pincode,student_email,student_contact,student_photo,student_proof,student_password,student_doj,student_departuredate)values('".$studentid."','".$first."','".$middle."','".$last."','".$dob."','".$gender."','".$district."','".$place."','".$landmark."','".$housename."','".$pincode."','".$email."','".$contact."','".$photo."','".$proof."','".$password."','".$doj."',curdate())";

if($con->query($insQry))
{
	?>
	<script>
	alert("student Removed");
	location.href="ViewStudent.php";
	</script>
<?php

}
else
{
	?>
	<script>
	alert(" Failed");
	location.href="ViewStudent.php";
	</script>
<?php

}

$delQry="delete from tbl_student where student_id='".$_GET["did"]."'";
$con->query($delQry);
}
?>
<br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="studentloyeeList.php">
  <h1>Student List</h1>
  <table width="1227" height="98" border="1" cellpadding="10">
    <tr>
      <th width="50">Sl.No</th>
      <th width="106">Name</th>
      <th width="105">DOB</th>
      <th width="82">Gender</th>
       <th width="132">Address</th>
        <th width="51">Email</th>
      <th width="85">Contact</th>
      <th width="114">Photo</th>
      <th width="114">Proof</th>
      <th width="144">Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_student e inner join tbl_district d on e.district_id=d.district_id where  student_vstatus=1";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td height="188"><?php echo $data["student_id"];?></td>
      <td><?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"]);?></td>
      <td><?php echo $data["student_dob"];?></td>
      <td><?php echo ucfirst($data["student_gender"]);?></td>
       <td>
         <p><?php echo ucfirst($data["student_housename"]);?></p>
		 <p><?php echo ucfirst($data["student_landmark"]);?></p>
		 <p><?php echo ucfirst($data["student_place"]);?></p>
         <p><?php echo ucfirst($data["district_name"]);?></p>
         <p><?php echo $data["student_pincode"]?></p></td>   
       <td><?php echo $data["student_email"];?></td>
      <td><?php echo $data["student_contact"];?></td>
      <td><img src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"];?>"width="100" height="100"/></td>
	<td><center><a href="../Assets/Files/studentProof/<?php echo $data["student_proof"];?>" download>
     <i class="fa fa-download " style="font-size:48px;cursor: pointer;color:black;"></i></center></td>
      <td><a href="ViewStudent.php?did=<?php echo $data["student_id"];?>">Remove Resigned</a></td>
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