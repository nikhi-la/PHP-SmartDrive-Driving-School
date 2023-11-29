
<!DOCTYPE html>
<html>
    <body>
 <table width="452" border="1" cellpadding="10"><tr>
    <tr>
      <th>Sl.No</th>
      <th>Attendance Date</th>
      <th>Attendance Status</th>
    </tr>
     <?php
	include("../Connection/Connection.php");
	include("SessionValidator.php");

	$selQry1="select * from tbl_empattendance where emp_id='".$_SESSION["uid"]."' order by empattendance_date DESC ";
	$row1=$con->query($selQry1);
	$i=0;
	while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["empattendance_id"]?></td>
      <td>&nbsp;<?php echo $data1["empattendance_date"] ?></td>
      <td>&nbsp;<?php if($data1["empattendance_status"]==1)
	  						echo "Present";
	  					else
							echo "Absent";?></td>
    </tr>
    <?php
	}?>
    
    </tr> 
  </table>
    </form>
    

</body>
</html>




