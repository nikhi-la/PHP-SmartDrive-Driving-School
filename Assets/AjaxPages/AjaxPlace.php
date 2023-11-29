<option value="">---select---</option>
<?php
include("../Connection/Connection.php");

		  $selQry1="select * from tbl_place where district_id='".$_GET["did"]."'";
		  $row=$con->query($selQry1);
		  while($data1=$row->fetch_assoc())
		  {
		  ?>
          <option value="<?php echo $data1["place_id"]?>"><?php echo ucfirst($data1["place_name"])?></option>
          <?php
		  }
		  ?>