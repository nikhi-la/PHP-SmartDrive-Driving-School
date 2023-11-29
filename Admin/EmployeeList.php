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
$sel="select * from tbl_employee where emp_id='".$_GET["did"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

	$delQry="delete from tbl_employee where emp_id='".$_GET["did"]."'";
	$con->query($delQry);
	    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($data1["emp_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Account Deactivated";
    $mail->Body = "Hello"." ".$data1["emp_name"]." ".".Your account has been deactivated.";
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
	window.location="EmployeeList.php";
    </script>
    <?php
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
      <th width="144">Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_employee e inner join tbl_district d on e.district_id=d.district_id ";
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
      <td><a href="EmployeeList.php?did=<?php echo $data["emp_id"];?>">Delete</a></td>
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