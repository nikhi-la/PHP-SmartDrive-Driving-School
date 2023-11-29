<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsubmit"]))
{
	$complaint=$_POST["txtcomplaint"];
	
		$sel="select * from tbl_regid where id=1";
		$row1=$con->query($sel);
		$datae=$row1->fetch_assoc();

		$reg=$datae["creg_id"];
		$comid=$datae["cid_number"];
		$comid++;
		$length=strlen($comid);
		if($length==1)
		$zero="000";
		if($length==2)
		$zero="00";
		if($length==3)
		$zero="0";
		if($length==4)
		$zero="";
		$compid=$reg.$zero.$comid;
		$upQry="update tbl_regid set cid_number='".$comid."' where id=1";
		$con->query($upQry);

	
$insQry="insert into tbl_complaint(complaint_id,complaint_content,complaint_date,student_id)values('".$compid."','".$complaint."',curdate(),'".$_SESSION["uid"]."')";
if($con->query($insQry))
{
		?>

        <script>
		alert("Complaint Submitted");
		window.location="Complaint.php";
		</script>
        <?php
	
	}
	else
	{ 
		?>
        <script>
		alert("Submit Failed");
		window.location="Complaint.php";
		</script>
        <?php
				
	}	
}
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h3>Complaint  </h3>
  <table width="338" height="110" border="1" cellpadding="0">
    <tr>
      <td width="100" height="70"><label for="txtcomplaint"></label>
      <textarea name="txtcomplaint" id="txtcomplaint" cols="45" rows="5" placeholder="Type Your Complaint Here" required="required" ></textarea></td>
    </tr>
    <tr>
      <td height="40"><div align="center">
        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
        <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
      </div></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <table  border="1" cellpadding="10">
    <tr>
      <th>Sl No</th>
      <th>Complaint Content</th>
      <th>Complaint Reply</th>
      <th>Reply Date</th>
    </tr>
    <?php
    $selQry="select * from tbl_complaint where student_id='".$_SESSION["uid"]."' ";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $data["complaint_id"];?></td>
      <td><?php echo $data["complaint_content"];?></td>
      <td><?php if($data["complaint_status"]==0)
	  				echo "Not Replied"; 
				else
					echo $data["complaint_reply"];?></td>
      <td><?php  if($data["complaint_status"]==0)
	  				echo "Not Replied"; 
				else
					echo $data["complaint_replydate"];?></td>
    </tr>
    <?php
    }
    ?>
  </table>
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