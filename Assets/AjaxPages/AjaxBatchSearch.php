
<!DOCTYPE html>
<html>
    <body>
  <table width="839" height="100" border="1" cellpadding="10">
                    <tr>
	<tr>
      <th width="69">Sl.No</th>
      <th width="88">Employee Name</th>
      <th width="103">Date</th>
      <th width="77">Start Time</th>
      <th width="87">End Time</th>
      <th width="109">Action</th>
      <th width="134">Slot</th>
    </tr>
        <?php
		include("../Connection/Connection.php");
			$min= date('Y-m-d');
			$max= date('Y-m-d', strtotime('+6 days'));

            $d = "";
            $d = $_GET["d"];
           
           $selQry1="select * from tbl_batch b inner join tbl_employee e on b.emp_id=e.emp_id and b.batch_date between '".$min."' and '".$max."'";

            if ($d != "") {
                $selQry1 .= " where b.emp_id='" .$d . "' order by batch_date";
            }
			//echo $selQry1;
            
            $row1=$con->query($selQry1);
$i=0;
while($data1=$row1->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td>&nbsp;<?php echo $data1["batch_id"]?></td>
      <td>&nbsp;<?php echo ucfirst($data1["emp_name"]);?> <?php echo ucfirst($data1["emp_middle"]);?> <?php echo ucfirst($data1["emp_last"]);?></td>
      <td>&nbsp;<?php echo $data1["batch_date"] ?></td>
       <td>&nbsp;<?php echo $data1["batch_starttime"] ?></td>
        <td>&nbsp;<?php echo $data1["batch_endtime"] ?></td>
       <td>&nbsp;<a href="Batch.php?did=<?php echo $data1["batch_id"]?>">Remove</a>/<a href="Batch.php?eid=<?php echo $data1["batch_id"]?>">Edit</a></td>
       <td>&nbsp;<a href="Slot.php?bid=<?php echo $data1["batch_id"]?>">Add Slot</a></td>
 
    </tr>
    <?php
	}
	?>
        </table>
    </form>
</body>
</html>




