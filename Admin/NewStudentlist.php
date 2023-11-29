<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student List</title>

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

if(isset($_GET["aid"]))
{
$sel="select * from tbl_student  where student_id='".$_GET["aid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();


$updateQry="update tbl_student set student_vstatus=1 where student_id='".$_GET["aid"]."'";
$con->query($updateQry);	

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($data1["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Verified";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your details has been verifed.You can now login with your email and password.";
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
	window.location="NewStudentlist.php";
	</script>
    <?php  
}
if(isset($_GET["rid"]))
{
$sel1="select * from tbl_student  where student_id='".$_GET["rid"]."'";
$row2=$con->query($sel1);
$data2=$row2->fetch_assoc();	
	

$updateQry1="update tbl_student set student_vstatus=2 where student_id='".$_GET["rid"]."'";
$con->query($updateQry1);

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartdrive46@gmail.com'; // Your gmail
    $mail->Password = 'ugfxclyriaagqgcm'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('smartdrive46@gmail.com'); // Your gmail
  
    $mail->addAddress($data2["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Verification Cancelled";
    $mail->Body = "Hello"." ".ucfirst($data2["student_name"])." ".ucfirst($data2["student_middle"])." ".ucfirst($data2["student_last"])." ".".Your registration has been cancelled.Sorry for the inconvenience";
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
	window.location="NewStudentlist.php";
	</script>
    <?php  
}
?>
<br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="NewStudentlist.php" enctype="multipart/form-data">
  <h1>&nbsp;</h1>
  <h1>New Students List</h1>
  <h1>&nbsp;</h1>
  <table  border="1" cellpadding="10">
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
    $selQry="select * from tbl_student s inner join tbl_district d  on s.district_id=d.district_id  where student_vstatus=0";
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
      <td><a href="NewStudentlist.php?aid=<?php echo $data["student_id"];?>">Accept</a>/<a href="NewStudentlist.php?rid=<?php echo $data["student_id"];?>">Reject</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</div>
</body>
</html>