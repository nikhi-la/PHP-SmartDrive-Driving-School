<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Search</title>


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

$bid="";
$bookingid="";
if(isset($_GET["bid"]))
{
	$bid=$_GET["bid"];
	
$sel="select * from tbl_regid where id=1";
$row2=$con->query($sel);
$datae=$row2->fetch_assoc();

$reg=$datae["pbreg_id"];
$pbid=$datae["pbid_number"];
$pbid++;
$length=strlen($pbid);
if($length==1)
$zero="000";
if($length==2)
$zero="00";
if($length==3)
$zero="0";
if($length==4)
$zero="";
$pbookingid=$reg.$zero.$pbid;
$upQry="update tbl_regid set pbid_number='".$pbid."' where id=1";
$con->query($upQry);


	$insQry="insert into tbl_packagebooking(packagebooking_id,student_id,package_id)values('".$pbookingid."','".$_SESSION["uid"]."','".$bid."')";
	if($con->query($insQry))
	{
    $selQry="select * from tbl_student where student_id='".$_SESSION["uid"]."'";
	$row5=$con->query($selQry);
	if($data5=$row5->fetch_assoc())
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
  
    $mail->addAddress($data5["student_email"]);
  
    $mail->isHTML(true);
  
    $mail->Subject = "Package Progressing";
    $mail->Body = "Hello"." ".ucfirst($data5["student_name"])." ".ucfirst($data5["student_middle"])." ".ucfirst($data5["student_last"])." "."We will inform you once ready to proceed with package payment.Thank You.";
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
alert("Package Booking Started");
window.location="ViewBookedPackages.php";
</script>
<?php	
}
}
  ?>
  <br><br>
<div class="t">
<form id="form1" name="form1" method="post" action="">
<center>
<h5>You can take  trial run only. <a href="TrialRunSlot.php">Book Trial Run Slot</a> !!!</h5>

  <table  border="0" cellpadding="10">
    <tr>
      <td >PackageType</td>
      <td ><label for="txtpackage"></label>
        <select name="txtpackage" id="txtpackage" onchange="getSearch()">
        <option selected="selected" value="">---Select---</option>
         <?php
		  $selQry4="select * from tbl_packagetype";
		  $row4=$con->query($selQry4);
		  while($data4=$row4->fetch_assoc())
		  {
		  ?>
          <option  value="<?php echo $data4["packagetype_id"] ?>"><?php echo ucfirst($data4["packagetype_name"]) ?></option>
          <?php
		  }
		  ?>
      </select>
      </td>
      
     </tr>
            <hr>
            </table>
            <div id="txtdiv">            
            <hr>
             <table align="center" cellpadding="10" > 
                
             <tr>  

<?php
	
  $selQry1="select * from tbl_package p inner join tbl_packagetype d inner join tbl_vehicletype v on p.packagetype_id=d.packagetype_id and p.vehicletype_id=v.vehicletype_id";
$row1=$con->query($selQry1);
$i=0;
while($data1=$row1->fetch_assoc())
{
 $i++;
	?>
    <td width="30%"><p style="border:1px solid black;">
            Name: 
           <?php echo ucfirst($data1["package_name"])?>
            <br>
           Details:
            <?php echo $data1["package_details"]?>
         <br>
           Amount:
            <?php echo $data1["package_amount"]?> Rs.
        <br>
           Package:
             <?php echo ucfirst($data1["packagetype_name"])?>
        <br>
        <br>
           Vehicle:
            <?php echo ucfirst($data1["vehicletype_name"])?>
        <br>
            <hr><center>
         <a href="SearchPackage.php?bid=<?php echo $data1["package_id"]?>">Book Now</a></center>
         <hr>
         </p>
         </td>
        <?php
          if($i==3)
          {
			  ?>
         </tr>
         <tr>
		 <?php 
              $i=0;
              
           }
                  
}
           
         ?>
        </table>
             <p>&nbsp;</p>
            </div>
  </center>
</form>
 


</body>
<script src="../Assets/Jquery/jQuery.js"></script>
<script>
function getSearch()
{
  var d=document.getElementById("txtpackage").value;  
  //alert(did);
	$.ajax({
	url: "../Assets/AjaxPages/AjaxSearch.php?d="+d,
	 
	  success: function(html){
		$("#txtdiv").html(html);
               // alert(html);
		
	  }
	});
}

</script>
<?php
include("Foot.php");
?>
</html>