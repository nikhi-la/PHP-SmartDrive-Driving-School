<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>License Details</title>
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


if(isset($_GET["testid"]))
{
	$_SESSION["testid"]=$_GET["testid"];
}
if(isset($_POST["btnsubmit"]))
{
	$applicationno=$_POST["txtapplicationno"];
	$testdate=$_POST["txttestdate"];
 	$min=date('Y-m-d');
	$max=date('Y-m-d', strtotime('+242 days'));
if (!preg_match("/^[0-9a-zA-Z\s ]+$/",$applicationno))
	{
	?>
    <script>
    alert("Application No : Only letters and digits allowed");
	window.location="LicenseTestDetails.php";
	</script>
    <?php
}	
else if($testdate>$max || $testdate<$min || $testdate=="")
{
	?>
    <script>
    alert("Invalid Test Date");
	window.location="LicenseTestDetails.php";
	</script>
    <?php
}
else
{

$sel="select * from tbl_license l inner join tbl_student s  on l.student_id=s.student_id where license_id='".$_SESSION["testid"]."'";
$row1=$con->query($sel);
$data1=$row1->fetch_assoc();

$sel2="select * from tbl_licensetest where license_id='".$_SESSION["testid"]."'";
$row=$con->query($sel2);
if(mysqli_num_rows($row)>0)
{
	$updateQry1="update tbl_license set license_status=2,cur_date=curdate() where license_id='".$_SESSION["testid"]."'";
	$con->query($updateQry1);

	$updateQry="update tbl_licensetest set application_no='".$_POST["txtapplicationno"]."' ,test_date='".$_POST["txttestdate"]."' where license_id='".$_SESSION["testid"]."'";
	if($con->query($updateQry))
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
  
    $mail->addAddress($data1["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "License Test Date";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".ucfirst($data1["student_middle"])." ".ucfirst($data1["student_last"])." ".".Your driving test date is scheduled on"." ".$_POST["txttestdate"]." ".".and your Application Number is "." ".$_POST["txtapplicationno"]." .";
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
		alert("Data Inserted");
		window.location="ViewLicenseDates.php";
		</script>
        <?php

	}
}
else
{
		
					$sel="select * from tbl_regid where id=1";
					$row1=$con->query($sel);
					$datae=$row1->fetch_assoc();

					$reg=$datae["ltreg_id"];
					$lictestid=$datae["ltid_number"];
					$lictestid++;
					$length=strlen($lictestid);
					if($length==1)
					$zero="000";
					if($length==2)
					$zero="00";
					if($length==3)
					$zero="0";
					if($length==4)
					$zero="";
					$licentestid=$reg.$zero.$lictestid;
					$upQry="update tbl_regid set ltid_number='".$lictestid."' where id=1";
					$con->query($upQry);
		
	$insQry="insert into tbl_licensetest (licensetest_id,license_id,application_no,test_date)values('".$licentestid."','".$_SESSION["testid"]."','".$_POST["txtapplicationno"]."','".$_POST["txttestdate"]."')";
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
  
    $mail->addAddress($data1["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "License Test Date";
    $mail->Body = "Hello"." ".ucfirst($data1["student_name"])." ".".Your driving test date is scheduled on"." ".$_POST["txttestdate"]." ".".and your Application Number is "." ".$_POST["txtapplicationno"]." .";
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
		alert("Data Inserted");
		window.location="ViewLicenseDates.php";
		</script>
        <?php

	}
}
}
}
$sel1="select * from tbl_licensetest where license_id='".$_SESSION["testid"]."'";
$row2=$con->query($sel1);
$data2=$row2->fetch_assoc();
if(mysqli_num_rows($row2)>0)
{
	$appno=$data2["application_no"];
	$testdatevv=$data2["test_date"];

}
else
{
	$appno="";
	$testdatevv="";

}
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <h2>Licence Test Details</h2>
  <p>&nbsp;</p>
  <table width="503" height="264" border="1" cellpadding="10">
    <tr>
      <td width="153">Application Number</td>
      <td width="298"><label for="txtapplicationno"></label>
      <input type="text" name="txtapplicationno" id="txtapplicationno" value="<?php echo $appno ?>" required="required" autocomplete="off" onkeyup="validateApplication(this)" />
      <span id="applicationcss"></span></td>
    </tr>
    <tr>
      <td>Test Slot Date</td>
      <td><label for="txttestdate"></label>
      <input type="date" name="txttestdate" id="txttestdate" min=<?php  echo date('Y-m-d'); ?> max= <?php echo date('Y-m-d', strtotime('+242 days'));?> required="required" autocomplete="off" value="<?php echo $testdatevv ?>" /><span id="mydateError"></span></td>
    </tr>
    <tr>
    <td height="38" colspan="2"><div align="center">
      <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
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

//--------------------------------Application Validation------------------------------------------------------ 

function validateApplication(elem)
{
	var nameexp = /^[0-9a-zA-Z\s ]+$/;
   if(elem.value.match(nameexp))
       {
		document.getElementById("applicationcss").innerHTML = "";
		return true;
		   }
    else

		document.getElementById("applicationcss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>special characters  Are not Allowed</span>";
		elem.focus();
		return false;
		}
//--------------------------------learners Date Validation------------------------------------------------------ 

    var mydate = document.getElementById('txttestdate');
    mydate.addEventListener('input', function() {
            var value = new Date(mydate.value),
                min = new Date(mydate.min),
                max = new Date(mydate.max);
            if (value < min )
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
             }
			 else if(value > max)
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
			 }
			 else
			  {
						document.getElementById("mydateError").innerHTML = "";

              }
    });
	

</script>