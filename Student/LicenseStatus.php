<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>License Status</title>

</head>

<body>
 <?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("Head.php");
$selected="";
$appno="";
$learnersdate="";
$testdate="";
$sel="select * from tbl_license where student_id='".$_SESSION["uid"]."'";
$row=$con->query($sel);
if(mysqli_num_rows($row)>0){
$data=$row->fetch_assoc();
$selected=$data["license_status"];
$sele="select * from tbl_licensetest where license_id='".$data["license_id"]."'";
$rowe=$con->query($sele);

if($datae=$rowe->fetch_assoc())
	{
	 $appno=$datae["application_no"];
	 $learnersdate=$datae["learners_date"];
	 $testdate=$datae["test_date"];
	}
}
if(isset($_POST["btnsubmitt"]))
{	
$status=$_POST["radio"];
$sel="select * from tbl_license where student_id='".$_SESSION["uid"]."'";
$row=$con->query($sel);
if(mysqli_num_rows($row)>0){
$data=$row->fetch_assoc();
$sele="select * from tbl_licensetest where license_id='".$data["license_id"]."'";
$rowe=$con->query($sele);
if(mysqli_num_rows($rowe)>0)
{
if($datae=$rowe->fetch_assoc())
	{
	 $appno=$datae["application_no"];
	 $learnersdate=$datae["learners_date"];
	 $testdate=$datae["test_date"];
	}
}


	
	
	if($status=="btn1")
	{
		$statussub=$_POST["radiosub"];
			if($statussub=="Yes")
			{
				$updateQry="update tbl_license set license_status=1,cur_date=curdate() where student_id='".$_SESSION["uid"]."'";
				if($con->query($updateQry))
				{
					?>
					<script>
					window.location="LicenseApply.php";
					</script>
					<?php
				}
			}
			if($statussub=="No")
			{
				$updateQry="update tbl_license set license_status=0,cur_date=curdate() where student_id='".$_SESSION["uid"]."'";
				$con->query($updateQry);
				

			}
	}
	if($status=="btn2")
	{
		$updateQry="update tbl_license set license_status=2,cur_date=curdate() where student_id='".$_SESSION["uid"]."'";
		$con->query($updateQry);

		$sel="select * from tbl_license l inner join tbl_student s on l.student_id=s.student_id where l.student_id='".$_SESSION["uid"]."'";
		$row2=$con->query($sel);
		$data2=$row2->fetch_assoc();
		
		$sel="select * from tbl_licensetest where license_id='".$data2["license_id"]."'";
		$row2=$con->query($sel);
		if(mysqli_num_rows($row2)>0)
			{
			$upQry="update tbl_licensetest set application_no='".$_POST["txtapplicationno"]."',learners_date='".$_POST["txtlearners"]."',test_date='".$_POST["txttest"]."' where license_id='".$data2["license_id"]."'";
			$con->query($upQry);
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

					$insQry1="insert into tbl_licensetest (licensetest_id,license_id,application_no,learners_date,test_date)values('".$licentestid."','".$data2["license_id"]."','".$_POST["txtapplicationno"]."','".$_POST["txtlearners"]."','".$_POST["txttest"]."')";
					$con->query($insQry1);
			}

	}
	if($status=="btn3")
	{
		$updateQry="update tbl_license set license_status=3,cur_date=curdate() where student_id='".$_SESSION["uid"]."'";
		$con->query($updateQry);

	}	


}
else
{
	if($status=="btn1")
	{
			$statussub=$_POST["radiosub"];
			if($statussub=="Yes")
			{

					$sel21="select * from tbl_regid where id=1";
					$row1=$con->query($sel21);
					$datae=$row1->fetch_assoc();

					$reg=$datae["lreg_id"];
					$licid=$datae["lid_number"];
					$licid++;
					$length=strlen($licid);
					if($length==1)
					$zero="000";
					if($length==2)
					$zero="00";
					if($length==3)
					$zero="0";
					if($length==4)
					$zero="";
					$licenid=$reg.$zero.$licid;
					$upQry="update tbl_regid set lid_number='".$licid."' where id=1";
					$con->query($upQry);
	
				$insQry="insert into tbl_license(license_id,student_id,license_status,cur_date)values('".$licenid."','".$_SESSION["uid"]."',1,curdate())";
				if($con->query($insQry))
				{
					?>
					<script>
					window.location="LicenseApply.php";
					</script>
					<?php
				}					
			}
			if($statussub=="No")
			{
					$sel21="select * from tbl_regid where id=1";
					$row1=$con->query($sel21);
					$datae=$row1->fetch_assoc();

					$reg=$datae["lreg_id"];
					$licid=$datae["lid_number"];
					$licid++;
					$length=strlen($licid);
					if($length==1)
					$zero="000";
					if($length==2)
					$zero="00";
					if($length==3)
					$zero="0";
					if($length==4)
					$zero="";
					$licenid=$reg.$zero.$licid;
					$upQry="update tbl_regid set lid_number='".$licid."' where id=1";
					$con->query($upQry);
	
					$insQry="insert into tbl_license(license_id,student_id,license_status,cur_date)values('".$licenid."','".$_SESSION["uid"]."',0,curdate())";
					$con->query($insQry);
				
			}
			
	}
	if($status=="btn2")
	{
					$sel="select * from tbl_regid where id=1";
					$row1=$con->query($sel);
					$datae=$row1->fetch_assoc();

					$reg=$datae["lreg_id"];
					$licid=$datae["lid_number"];
					$licid++;
					$length=strlen($licid);
					if($length==1)
					$zero="000";
					if($length==2)
					$zero="00";
					if($length==3)
					$zero="0";
					if($length==4)
					$zero="";
					$licenid=$reg.$zero.$licid;
					$upQry="update tbl_regid set lid_number='".$licid."' where id=1";
					$con->query($upQry);
	
		$insQry="insert into tbl_license(license_id,student_id,license_status,cur_date)values('".$licenid."','".$_SESSION["uid"]."',2,curdate())";
		$con->query($insQry);
		

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
					$upQry1="update tbl_regid set ltid_number='".$lictestid."' where id=1";
					$con->query($upQry1);

		$insQry1="insert into tbl_licensetest (licensetest_id,license_id,application_no,learners_date,test_date)values('".$licentestid."','".$licenid."','".$_POST["txtapplicationno"]."','".$_POST["txtlearners"]."','".$_POST["txttest"]."')";
		$con->query($insQry1);


	}
	if($status=="btn3")
	{
					$sel="select * from tbl_regid where id=1";
					$row1=$con->query($sel);
					$datae=$row1->fetch_assoc();

					$reg=$datae["lreg_id"];
					$licid=$datae["lid_number"];
					$licid++;
					$length=strlen($licid);
					if($length==1)
					$zero="000";
					if($length==2)
					$zero="00";
					if($length==3)
					$zero="0";
					if($length==4)
					$zero="";
					$licenid=$reg.$zero.$licid;
					$upQry="update tbl_regid set lid_number='".$licid."' where id=1";
					$con->query($upQry);
	
		$insQry="insert into tbl_license(license_id,student_id,license_status,cur_date)values('".$licenid."','".$_SESSION["uid"]."',3,curdate())";
		$con->query($insQry);

	}	
}
}

?>
<br><br>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
 <p>&nbsp;</p> <p>&nbsp;</p>
  <table width="636" height="30" border="1" cellpadding="10">
    <tr>
      <th width="155" height="67">Licence Status</th>
      <td width="429"><input type="radio" name="radio" id="btn1" value="btn1" <?php if ($selected=="1") echo "checked";if ($selected=="0") echo "checked"; ?> onclick="showN()" />
      <label for="btn1">Not Applied&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio" id="btn2" value="btn2" <?php if ($selected=="2") echo "checked";?> onclick="showA()" />
      Applied&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio" id="btn3" value="btn3" <?php if ($selected=="3") echo "checked";?> onclick="showR()" />
      Received</label>
      </td>
    </tr>
<tr>
<th height="27"></th>
<th>      <div id='patient'> Do you want us to apply for your license?  <p>&nbsp;</p>
			<input type="radio" name="radiosub" id="yes" value="Yes" />
			<label for="yes">Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="radiosub" id="no" value="No" />
			<label for="no">No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
           <div id='learners'>
             <p>
               <label for="txtapplicationno">Application No&nbsp;</label>
               <input type="text" name="txtapplicationno" id="txtapplicationno" value="<?php echo $appno;?>" autocomplete="off" />
             </p>
             <p><br>
             <p>
               <label for="txtlearners">learners Date&nbsp;&nbsp;&nbsp;</label>
               <input type="date" name="txtlearners" id="txtlearners" autocomplete="off"  value=<?php echo $learnersdate;?>  />
             </p>
             <p><br>
               <label for="txtlearners">Test Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
               <input type="date" name="txttest" id="txttest" autocomplete="off" value=<?php echo $testdate;?> />
             </p>
			</div>

</th>
</tr>
<tr>
<td height="25" colspan="2"><div align="center">
  <input type="submit" name="btnsubmitt" id="btnsubmitt" value="Submit" />
  <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
</div></td>
</tr>
  </table>
 <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<?php
include("Foot.php");
?>
</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
 <script type="text/javascript">
var pv0 = document.getElementById("patient");
var pv2 = document.getElementById("learners");
    pv2.style.display='none';
   pv0.style.display='none';
function showN(){
var pvs = document.getElementsByName('radio');
var pv0 = document.getElementById("patient");
 var pv1 = document.getElementById("visitor");

if (pvs[0].checked){
    pv2.style.display='none';  
    pv0.style.display='inline-block';
   pv1.style.display='none';

}else{
   pv0.style.display='none';
   pv1.style.display='none';
    pv2.style.display='none';
}
}

function showA(){
var pvs = document.getElementsByName('radio');
var pv0 = document.getElementById("patient");
 var pv1 = document.getElementById("visitor");
 var pv2 = document.getElementById("learners");

if (pvs[1].checked){
    pv2.style.display='inline-block';
   pv0.style.display='none';
   pv1.style.display='none';
   pv2.style.display='none';
}else{
   pv2.style.display='none';
   pv0.style.display='none';
   pv1.style.display='none';
   pv2.style.display='none';

}
}

function showR(){
var pvs = document.getElementsByName('radio');
var pv0 = document.getElementById("patient");
 var pv2 = document.getElementById("learners");

if (pvs[2].checked){
   pv0.style.display='none';
    pv2.style.display='none';

}else{
   pv0.style.display='none';
    pv2.style.display='none';

}
}

</script>