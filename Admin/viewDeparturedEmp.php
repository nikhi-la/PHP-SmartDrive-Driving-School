<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Employee List</title>

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

if(isset($_GET["did"]))
{
$sel="select * from  tbl_empdeparture where emp_id='".$_GET["did"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

$employeeid=$data1["emp_id"];
$first=$data1["emp_name"];
$middle=$data1["emp_middle"];
$last=$data1["emp_last"];
$dob=$data1["emp_dob"];
$gender=$data1["emp_gender"];
$district=$data1["district_id"];
$place=$data1["emp_place"];
$landmark=$data1["emp_landmark"];
$housename=$data1["emp_housename"];
$pincode=$data1["emp_pincode"];
$email=$data1["emp_email"];
$contact=$data1["emp_contact"];
$photo=$data1["emp_photo"];
$proof=$data1["emp_proof"];
$password=$data1["emp_password"];
$doj=$data1["emp_doj"];


$insQry="insert into tbl_employee(emp_id,emp_name,emp_middle,emp_last,emp_dob,emp_gender,district_id,emp_place,emp_landmark,emp_housename,emp_pincode,emp_email,emp_contact,emp_photo,emp_proof,emp_password,emp_doj)values('".$employeeid."','".$first."','".$middle."','".$last."','".$dob."','".$gender."','".$district."','".$place."','".$landmark."','".$housename."','".$pincode."','".$email."','".$contact."','".$photo."','".$proof."','".$password."',curdate())";

if($con->query($insQry))
{
	?>
	<script>
	alert("Employee Added");
	location.href="viewDeparturedEmp.php";
	</script>
<?php

}
else
{
	?>
	<script>
	alert(" Failed");
	location.href="viewDeparturedEmp.php";
	</script>
<?php

}

$delQry="delete from tbl_empdeparture where emp_id='".$_GET["did"]."'";
$con->query($delQry);
}
?>
<br><br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="EmployeeList.php">
  <h1>Employee List</h1>
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
      <th width="114">Date of Join</th>
      <th width="144">Date of Resign</th>
     <th width="144">Action</th>

      </tr>
    <?php
    $selQry="select * from tbl_empdeparture e inner join tbl_district d on e.district_id=d.district_id ";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td height="188"><?php echo $data["emp_id"];?></td>
      <td><?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"]);?></td>
      <td><?php echo $data["emp_dob"];?></td>
      <td><?php echo ucfirst($data["emp_gender"]);?></td>
       <td>
         <p><?php echo ucfirst($data["emp_housename"]);?></p>
		 <p><?php echo ucfirst($data["emp_landmark"]);?></p>
		 <p><?php echo ucfirst($data["emp_place"]);?></p>
         <p><?php echo ucfirst($data["district_name"]);?></p>
         <p><?php echo $data["emp_pincode"]?></p></td>   
       <td><?php echo $data["emp_email"];?></td>
      <td><?php echo $data["emp_contact"];?></td>
      <td><img src="../Assets/Files/employeePhoto/<?php echo $data["emp_photo"];?>"width="100" height="100"/></td>
	<td><center><a href="../Assets/Files/employeeProof/<?php echo $data["emp_proof"];?>" download>
     <i class="fa fa-download " style="font-size:48px;cursor: pointer;color:black;"></i></center></td>
      <td><?php echo $data["emp_doj"];?></td>
      <td><?php echo $data["emp_departuredate"];?></td>
      <td><a href="ViewDeparturedEmp.php?did=<?php echo $data["emp_id"];?>">Add Back</a></td>
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