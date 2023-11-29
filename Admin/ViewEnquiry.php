<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enquiry</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <h1>&nbsp;</h1>
  <h1>Enquiry</h1>
  <p>&nbsp;</p>
  <table width="863" height="50"  border="1" cellpadding="10">
    <tr>
     <th width="51">Sl No</th>
      <th width="98">User Name</th>
      <th width="134">Email</th>
      <th width="250">Enquiry</th>
      <th width="91">Date</th>
        <th width="91">Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_enquiry";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
    <td><?php echo $data["enquiry_id"] ;?></td>
      <td><?php echo ucfirst($data["user_name"])?></td>
      <td><?php echo $data["user_email"]?></td>
      <td><?php echo $data["user_enquiry"]?></td>
      <td><?php echo $data["enquiry_date"]?></td>
      <td><?php if($data["reply_status"]==1)
	  			{
	  			echo "Replied";
				}
				else
				{
				?>
                <a href="EnquiryReply.php?enid=<?php echo $data["enquiry_id"] ?>">Reply</a> 
      			<?php
				}
				?></td>

    </tr>
   <?php
    }
	?>
    </table>
</form>
</body>
</html>