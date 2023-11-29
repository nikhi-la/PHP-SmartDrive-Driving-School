<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>

<body>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - payment checkout</title>
  
<style>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}

body{
  background: #2196F3;
  margin: 0 10px;
}

.payment{
  background: #f9f9f9;
  max-width: 360px;
  margin: 80px auto;
  height: auto;
  padding: 35px;
  padding-top: 70px;
  border-radius: 5px;
  position: relative;
}

.payment h2{
  text-align: center;
  letter-spacing: 2px;
  margin-bottom: 40px;
  color: #0d3c61;
}

.form .label{
  display: block;
  color: #555566;
  margin-bottom: 6px;
}

.input{
  padding: 13px 0px 13px 25px;
  width: 100%;
  text-align: center;
  border: 2px solid #dddddd;
  border-radius: 5px;
  letter-spacing: 1px;
  word-spacing: 3px;
  outline: none;
  font-size: 16px;
  color: #555566;
}

.card-grp{
  display: flex;
  justify-content: space-between;
}

.card-item{
  width: 48%;
}

.space{
  margin-bottom: 20px;
}

.icon-relative{
  position: relative;
}

.icon-relative .fas,
.icon-relative .far{
  position: absolute;
  bottom: 12px;
  left: 15px;
  font-size: 20px;
  color: #555555;
}

.btn{
  margin-top: 40px;
  background: #2196F3;
  padding: 12px;
  text-align: center;
  color: #f8f8f8;
  border-radius: 5px;
  cursor: pointer;
}


.payment-logo{
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  background: #f8f8f9;
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
  text-align: center;
  line-height: 85px;
}

.payment-logo:before{
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  width: 90px;
  height: 90px;
  background: #2196F3;
  border-radius: 50%;
}

.payment-logo p{
  position: relative;
  color: #f8f8f8;
  font-family: 'Baloo Bhaijaan', cursive;
  font-size: 58px;
}

input[type=submit] {
	background-color: #2196F3;
	border: none;
	color: #f8f8f8;
	font-size: 16px;
}

@media screen and (max-width: 420px){
  .card-grp{
    flex-direction: column;
  }
  .card-item{
    width: 100%;
    margin-bottom: 20px;
  }
  .btn{
    margin-top: 20px;
  }
}
</style>
</head>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("SessionValidator.php");
include("../ASSETS/Connection/Connection.php");
if(isset($_POST["btnpay"]))
{
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

if(isset($_GET["bid"]))
{
	$_SESSION["bid"]=$_GET["bid"];
}
$name=$_POST["txtname"];
$name=test_input($name);
$name=strtolower($name);

$card=$_POST["txtcard"];
$card=test_input($card);

$ccv=$_POST["txtccv"];
$ccv=test_input($ccv);

if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
	{
	?>
    <script>
    alert("First Name : Only letters and white space allowed");
	window.location="PaymentSalary.php";
	</script>
    <?php
    }
else if (!preg_match("/^[0-9]{16}$/",$card)) 
	{
	?>
    <script>
    alert("Card Number must contain 16 digits");
	window.location="PaymentSalary.php";
	</script>
    <?php
}
else if (!preg_match("/^[0-9]{3}$/",$ccv)) 
	{
	?>
    <script>
    alert("CCV must contain 3 digits");
	window.location="PaymentSalary.php";
	</script>
    <?php
}

else
{
 $sel="select * from tbl_student where student_id='".$_SESSION["uid"]."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();

	$setqry="update tbl_packagebooking set packagepayment_status=1 , packagebooking_date=curdate() where packagebooking_id='".$_SESSION["bid"]."'";
		  if($con->query($setqry))
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
  
    $mail->addAddress($_SESSION["email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Payment Succesfull..";
    $mail->Body = "Hello"." ".ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])." "."Your Payment has been completed";
  if($mail->send())
  {
 
  }
  else
  {
  }
		
		?>
        <script>
        alert("Package Booking Completed");
        window.location="ViewBookedPackages.php";
        </script>
        <?php
	}
	else
	{
		?>
        <script>
        alert("Payment Failed");
        window.location="Payment.php";
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

?>
      
    <br><br><br><br>
<!-- partial:index.partial.html -->
<jsp:useBean class="DB.ConnectionClass" id="con"></jsp:useBean>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">

<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      <p>p</p>
    </div>
    
      <form method="post">
    <h2>Payment Gateway</h2>
    <div class="form">
      <div class="card space icon-relative">
        <label class="label">Card holder:</label>
        <input type="text" class="input" name="txtname" placeholder="Card Holder" autocomplete="off" required="required" title="Name Allows Only Alphabets,Spaces " pattern="^[a-zA-Z ]*$">
        <i class="fas fa-user"></i>
      </div>
      <div class="card space icon-relative">
        <label class="label">Card number:</label>
        <input type="text" class="input" name="txtcard" placeholder="Card Number" autocomplete="off" required="required" pattern="[0-9]{16}"  title="16 digit with 0-9">
        <i class="far fa-credit-card"></i>
      </div>
      <div class="card-grp space">
        <div class="card-item icon-relative">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry-data" class="input" data-mask="00 / 00" placeholder="00 / 00" autocomplete="off" required="required">
          <i class="far fa-calendar-alt"></i>
        </div>
        <div class="card-item icon-relative">
          <label class="label">CCV:</label>
          <input type="text" class="input" name="txtccv" pattern="[0-9]{3}" placeholder="000" autocomplete="off" required="required">
          <i class="fas fa-lock"></i>
        </div>
      </div>
        
        
      <div class="btn">
      	
        <input type="submit" name="btnpay" id="btnpay" value="Pay"> 
      </div> 
      
    </div>
      </form>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js'></script>

</body>

</html>

<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
</script>
