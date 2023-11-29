<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>
</head>
<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsubmit"]))
{
	$feedback=$_POST["txtfeedback"];

		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["freg_id"];
		$feeid=$datae["fid_number"];
		$feeid++;
		$length=strlen($feeid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$feedid=$reg.$zero.$feeid;
		$upQry="update tbl_regid set fid_number='".$feeid."' where id=1";
		$con->query($upQry);
			
$insQry="insert into tbl_feedback(feedback_id,feedback_content,feedback_date,emp_id)values('".$feedid."','".$feedback."',curdate(),'".$_SESSION["uid"]."')";
if($con->query($insQry))
{
		?>

        <script>
		alert("feedback Submitted");
		window.location="Feedback.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Submit Failed");
		window.location="Feedback.php";
		</script>
        <?php
				
	}	
}
?>
<br><br><br> 
<div id="tab" align="center">
	<h3>Feedback Form</h3>
	<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="338" height="110" border="1" cellpadding="0">
    <tr>
      <td width="332" height="100"><label for="txtfeedback"></label>      <textarea name="txtfeedback" id="txtfeedback" placeholder="Feedback Here..." cols="45" rows="5" required="required"></textarea></td>
    </tr>
    <tr>
      <td height="40"><div align="center">
        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
        <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</div>
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