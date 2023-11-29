<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted List</title>

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

if(isset($_GET["rid"]))
{
$sel1="select * from tbl_student  where student_id='".$_GET["rid"]."'";
$row2=$con->query($sel1);
$data2=$row2->fetch_assoc();	

	
$updateQry="update tbl_student set student_vstatus=2 where student_id='".$_GET["rid"]."'";
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
  
    $mail->addAddress($data2["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Account Deactivated";
    $mail->Body = "Hello"." ".ucfirst($data2["student_name"])." ".ucfirst($data2["student_middle"])." ".ucfirst($data2["student_last"])." ".".Your smartdrive account has been deactivated.Sorry for the inconvenience";
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
	window.location="AcceptedStudent.php";
	</script>
    <?php  
}
?>


<br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="AcceptedStudent.php">
  <h1>Accepted Student List</h1>
  <table  border="1" cellpadding="10">
    <tr>
      <th width="58">Sl.No</th>
	  <th width="106">Name</th>
      <th width="105">DOB</th>
      <th width="82">Gender</th>
       <th width="132">Address</th>
        <th width="51">Email</th>
      <th width="85">Contact</th>
      <th width="119">Photo</th>
      <th width="63">Proof</th>
      <th width="76">Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_student s inner join tbl_district d on s.district_id=d.district_id where student_vstatus=1";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td height="145">&nbsp;<?php echo $data["student_id"];?></td>
      <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"]);?></td>
      <td><?php echo $data["student_dob"];?></td>
      <td><?php echo ucfirst($data["student_gender"]);?></td>
       <td>
         <?php echo ucfirst($data["student_housename"]);?>
		 <?php echo ucfirst($data["student_landmark"]);?>
		 <?php echo ucfirst($data["student_place"]);?>
         <?php echo ucfirst($data["district_name"]);?>
         <?php echo $data["student_pincode"]?></td>   
       <td><?php echo $data["student_email"];?></td>
      <td><?php echo $data["student_contact"];?></td>
      <td width="114">&nbsp;<img src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"];?>"width="100" height="100"/></td>
      <td><center><a href="../Assets/Files/studentProof/<?php echo $data["student_proof"];?>" download>
     <i class="fa fa-download " style="font-size:48px;cursor: pointer;color:black;"></i></center></td>
      <td width="81">&nbsp;<a href="AcceptedStudent.php?rid=<?php echo $data["student_id"];?>">Reject</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</div>
</body>
</html>