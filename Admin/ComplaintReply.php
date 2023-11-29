<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Reply</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsubmit"]))
{
	$complaint=$_POST["txtcomplaint"];
	
$updateQry="update tbl_complaint set complaint_reply='".$complaint."' , complaint_status=1,complaint_replydate=curdate() where complaint_id='".$_GET["cid"]."'";
if($con->query($updateQry))
{
		?>

        <script>
		alert("Reply Submitted");
		window.location="ViewComplaint.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Reply Failed");
		window.location="ComplaintReply.php";
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
      <td width="100" height="70"><label for="txtcomplaint"></label>
      <textarea name="txtcomplaint" id="txtcomplaint" cols="45" rows="5" placeholder="Type Your Reply Here" required="required"></textarea></td>
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