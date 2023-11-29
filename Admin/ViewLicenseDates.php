<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Licence Status</title>
</head>

<body>
<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");

	$sel="select * from tbl_licensetest lt  inner join tbl_license l inner join tbl_student s  on lt.license_id=l.license_id and l.student_id=s.student_id ";
	$row=$con->query($sel);
	$data=$row->fetch_assoc();

if(isset($_GET["did"]))
{
	$updateQry1="update tbl_license set license_status=1,cur_date=curdate() where license_id='".$_GET["did"]."'";
	$con->query($updateQry1);

	$delQry="delete from tbl_licensetest where license_id='".$_GET["did"]."'";
	$con->query($delQry);
			?>
			<script>
			window.location="ViewLicenseDates.php";
			</script>
			<?php
}

?>
<br><br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
   <h2>Licence Dates</h2>
    <p>&nbsp;</p>
  <table width="797" height="50" border="1" cellpadding="10">
    <tr>
       <th width="67">Sl.No</th>
      <th width="81">Student Name</th>
      <th width="103">Application Number</th>
      <th width="95">learners Date</th>
      <th width="103">Test Date</th>
      <th width="56">Delete</th>
      <th width="120">Edit</th>
    </tr>
    <?php
	$selQry="select * from tbl_licensetest lt  inner join tbl_license l inner join tbl_student s  on lt.license_id=l.license_id and l.student_id=s.student_id  ";
	$row=$con->query($selQry);
	$i=0;
	while($data=$row->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td><?php echo $data["licensetest_id"];?></td>
	 <td><?php echo ucfirst($data["student_name"])." ".ucfirst($data["student_middle"])." ".ucfirst($data["student_last"])?></td>
      <td><?php echo $data["application_no"];?></td>
      <td><?php if($data["learners_date"]=="0000-00-00") echo "-----";
	  				else 
				echo $data["learners_date"];?></td>
      <td><?php if($data["test_date"]=="0000-00-00") echo "-----";
	  			else
				echo $data["test_date"];?></td>
       <td><center><a href="ViewLicenseDates.php?did=<?php echo $data["license_id"]?>"><i class="fa fa-trash-o" style="font-size:24px"></i></a></center></td>
       <td><p><a href="LicenselearnersDetails.php?learnersid=<?php echo $data["license_id"]?>">Edit learners</a></p>
         <p>
           <a href="LicenseTestDetails.php?testid=<?php echo $data["license_id"]?>">Edit Test Details</a></p>
      </td>

    </tr>
   <?php
    }
	?>
  </table>
</form>
</body>
</html>