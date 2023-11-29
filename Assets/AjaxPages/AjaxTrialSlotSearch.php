<option value="">---select---</option>
<?php
	$min= date('Y-m-d');
	$max= date('Y-m-d', strtotime('+6 days'));

include("../Connection/Connection.php");

		  $selQry1="select * from tbl_batch where emp_id='".$_GET["did"]."' and batch_date between '".$min."' and '".$max."'";
		  $row=$con->query($selQry1);
		  while($data1=$row->fetch_assoc())
		  {
		  ?>
          <option value="<?php echo $data1["batch_id"]?>"><?php echo $data1["batch_date"]?></option>
          <?php
		  }
		  ?>