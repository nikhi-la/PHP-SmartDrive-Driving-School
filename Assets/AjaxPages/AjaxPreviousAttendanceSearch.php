<!DOCTYPE html>
<html>
<head>
<style>
.required {
  color: red;
}
.butonp
{
	background-color: #360; /* Green */
  border: none;
  color: black;
  border-radius:6px;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.butona
{
	background-color: #C00; /* Green */
  border: none;
  color: black;
  border-radius:6px;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

</style>

</head>
    <body>
  <?php   		
  	include("../Connection/Connection.php");
	            $d = "";
            $d = $_GET["d"];?>
<h1><?php echo $d;?></h1>
  <table width="562" height="241" border="1" cellpadding="6" cellspacing="6">
    <tr>
      <th width="33" rowspan="2">Sl No</th>
      <th width="153" rowspan="2">Employee Name</th>
      <th colspan="2">Attendance</th>
       <th width="120" rowspan="2">Status</th>
      </tr> 
    <tr><th width="81" height="23">Present</th><th width="67">Absent</th></tr>
	<?php

	$selQry1="select * from tbl_employee";
	$row1=$con->query($selQry1);
	$i=0;
	while($data=$row1->fetch_assoc())
	{
		$i++;
	$selQry="select * from tbl_empattendance where emp_id='".$data["emp_id"]."' and empattendance_date='".$d."'";
	$row2=$con->query($selQry);
		?>
	
    <tr>
      <td>&nbsp;<?php echo $data["emp_id"]; ?></td>
    <td>&nbsp;<?php echo ucfirst($data["emp_name"]);?> <?php echo ucfirst($data["emp_middle"]);?> <?php echo ucfirst($data["emp_last"])?></td>
    
    <td><label for="checkbox"></label>
      <button class="butonp" name="checkbox1[]" id="checkbox"  value="<?php echo $data["emp_id"] ?>">P</button>
</td>
       <td><button class="butona" name="checkbox2[]" id="checkbox"  value="<?php echo $data["emp_id"] ?>">A</button></td>
       
       <td><?php 	if($data1=$row2->fetch_assoc())
	   {
	    if($data1["empattendance_status"]==1)
	   				echo "Present";
				 else if($data1["empattendance_status"]==0)
				 	echo "Absent";

	   }
				 else
				 	echo "Mark Attendance";?></td>
     <?php 
	}
	?>
    </tr>
  </table>
    </form>
</body>
</html>

<script>
$(document).ready(function() {
    $('#selectall').click(function() {
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
    })
});
</script>


