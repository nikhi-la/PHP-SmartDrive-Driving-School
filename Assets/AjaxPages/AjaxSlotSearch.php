
<!DOCTYPE html>
<html>
    <body>
         <table align="center" cellpadding="10" >     
                    <tr>

        <?php
		session_start();
		include("../Connection/Connection.php");
            $d = "";
            $d = $_GET["d"];
           
           $selQry1="select * from tbl_studentslot s inner join tbl_batch b on s.batch_id=b.batch_id where b.emp_id='".$_SESSION["eid"]."'";

            if ($d != "") {
                $selQry1 .= " and studentslot_date='" .$d . "'";
            }
			//echo $selQry1;
            
            $row1=$con->query($selQry1);
$i=0;
while($data=$row1->fetch_assoc())
{
 $i++;

        ?>



            


                <td><p style="border:1px solid black;">
                        Name: 
           <?php echo $data["studentslot_number"]?>
            <br>
           StartTime:
            <?php echo $data["studentslot_starttime"]  ?>
         <br>
           EndTime:
           <?php echo $data["studentslot_endtime"]  ?>
        <br>
       <hr>
         <a href="viewSlot.php?bid=<?php echo $data["studentslot_id"]?>">Book Now</a>
         <hr>
         </p>
         </td>
        <?php
          if($i==4)
          {
			  ?>
         </tr>
         <tr>
		 <?php 
              $i=0;
              
           }
                  
}
           
         ?>
        </table>
    </form>
</body>
</html>




