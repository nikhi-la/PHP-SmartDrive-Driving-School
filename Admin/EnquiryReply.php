<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enquiry Reply</title>
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
if(isset($_POST["btnsubmit"]))
{
	$enquiry=$_POST["txtenquiry"];
	
$updateQry="update tbl_enquiry set enquiry_reply='".$enquiry."' , reply_status=1,enquiry_replydate=curdate() where enquiry_id='".$_GET["enid"]."'";
if($con->query($updateQry))
{
    $selQry="select * from tbl_enquiry where enquiry_id='".$_GET["enid"]."'";
	$row=$con->query($selQry);
	$i=0;
	if($data=$row->fetch_assoc())
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
  
    $mail->addAddress($data["user_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Enquiry Reply";
    $mail->Body = "Hello"." ".ucfirst($data["user_name"])." "." ".$_POST["txtenquiry"]." ".".Thank You.";
  if($mail->send())
  {
    echo "Sended";
  }
  else
  {
    echo "Failed";
  }
	}

		?>
        <script>
		alert("Reply Submitted");
		window.location="Viewenquiry.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Reply Failed");
		window.location="enquiryReply.php";
		</script>
        <?php
				
	}	
}
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
	<h1>Reply</h1>
  <table width="338" height="110" border="1" cellpadding="0">
    <tr>
      <td width="100" height="70"><label for="txtenquiry"></label>
      <textarea name="txtenquiry" id="txtenquiry" cols="45" rows="5" placeholder="Type Your Reply Here" required="required"></textarea></td>
    </tr>
    <tr>
      <td height="40"><div align="center">
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
</script>