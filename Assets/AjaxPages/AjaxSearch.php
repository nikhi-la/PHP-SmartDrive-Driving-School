<!DOCTYPE html>
<html>
    <body>
         <table align="center" cellpadding="10" >     
                    <tr>

        <?php
		include("../Connection/Connection.php");
            $d = "";
            $d = $_GET["d"];
           
           $selQry1="select * from tbl_package p inner join tbl_packagetype d inner join tbl_vehicletype v on p.packagetype_id=d.packagetype_id and p.vehicletype_id=v.vehicletype_id where true";

            if ($d != "") {
                $selQry1 .= " and d.packagetype_id='" .$d . "'";
            }
			//echo $selQry1;
            
            $row1=$con->query($selQry1);
$i=0;
while($data1=$row1->fetch_assoc())
{
 $i++;

        ?>



            


                <td><p style="border:1px solid black;">
            Name: 
           <?php echo ucfirst($data1["package_name"])?>
            <br>
           Details:
            <?php echo $data1["package_details"]?>
         <br>
           Amount:
            <?php echo $data1["package_amount"]?> INR
        <br>
           Package:
             <?php echo ucfirst($data1["packagetype_name"])?>
        <br>
        <br>
           Vehicle:
            <?php echo ucfirst($data1["vehicletype_name"])?>
        <br>
            <hr><center>
         <a href="SearchPackage.php?bid=<?php echo $data1["package_id"]?>">Book Now</a></center>
         <hr>
         </p>
         </td>
        <?php
          if($i==4)
          {?>
         </tr>
         <tr><?php 
              $i=0;
              
           }
                  }
            
           
         ?>
        </tr>
        </table>
    </form>
</body>
</html>




