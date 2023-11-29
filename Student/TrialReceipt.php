<!DOCTYPE html>
<html>
	<head>
		<style>
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}

*{
	font-family: arial;
}
.invoice_container{
	padding: 10px 10px;
}
.invoice_header{
	display: flex;
	justify-content: space-between;
	width: 100%;
	background: #e7c9c9;
}
button{
	background: #e7c9c9;
}
.logo_container{
	margin-top: auto;
	margin-bottom: auto;
	margin-left: 10px;
}
.company_address{
	margin-right: 10px;
}
.invoice_header h2{
	margin-bottom: 0;
}
.invoice_header p{
	margin-top: 10px;
}
.logo_container img{
	height: 60px;
}
.customer_container{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.customer_container h2{
	margin-bottom: 10px;
}
.customer_container h4{
	margin-bottom: 10px;
	margin-top: 0;
}
.customer_container p{
	margin: 0;
}
.in_details{
	margin-top: auto;
	margin-bottom: auto;
}
.product_container{
	padding: 0 10px;
	margin-top: 10px;
}
.item_table{
	width: 100%;
    text-align: left;
}
.item_table td,th{
	padding: 5px 10px;
}
.invoice_footer{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.invoice_footer h2{
	margin-bottom: 10px;
}
.note{
	width: 50%;
}
.invoice_footer_amount{
	margin: auto 0;
	background: #e7c9c9;
}
.amount_table td,th{
	padding: 5px 10px;
}
.in_head{
    margin: 0;
    text-align: center;
    background: #e7c9c9;
    padding: 5px;
}

		</style>
	</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice</title>
</head>
<body>
<?php
include("SessionValidator.php");
include("../ASSETS/Connection/Connection.php");
if(isset($_GET["trid"]))
{
	$_SESSION["trid"]=$_GET["trid"];
}
$curdate = date('d-m-y');
$selQry="select * from tbl_trial t inner join tbl_student s inner join tbl_district d inner join tbl_vehicletype vt inner join tbl_studentslot ss on t.studentslot_id=ss.studentslot_id and d.district_id=s.district_id  and t.vehicletype_id=vt.vehicletype_id and t.student_id=s.student_id where trial_id='".$_SESSION["trid"]."'";
$row=$con->query($selQry);
$data=$row->fetch_assoc();
if($data["payment_status"]==1)
{
?>

<page size="A4">
	<div class="invoice_container">
		<div class="invoice_header">

			  <img src="Sd.png" width="180" height="180">
		  <div class="company_address">
				<h2>Smart Drive</h2>
				<p>
					Ernakulam<br>
					Perumbavoor <br>
					+91 9745620479 <br>
                    smartdrive46@gmail.com
				</p>
			</div>
		</div>
		<div class="customer_container">
			<div>
				<h2>Billing To</h2>
				<h4><?php echo ucfirst($data["student_name"]);?> <?php echo ucfirst($data["student_middle"]);?> <?php echo ucfirst($data["student_last"])?> </h4>
				<p>
              <?php echo ucfirst($data["student_housename"]);?><br>
		 	  <?php echo ucfirst($data["student_landmark"]);?><br>
		 	  <?php echo ucfirst($data["student_place"]);?><br>
        	  <?php echo ucfirst($data["district_name"]);?><br>
        	  <?php echo $data["student_pincode"]?><br>
              +91 <?php echo $data["student_contact"];?><br>
              <?php echo $data["student_email"];?><br>
  				</p>
			</div>
			<div class="in_details">
				<h1 class="in_head">INVOICE</h1>
				<table>
					<tr>
						<td>Invoice No</td>
						<td>:</td>
						<td><b><?php echo $data["trial_id"]; ?></b></td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td><b><?php echo $curdate; ?></b></td>
					</tr>

			  </table>
			</div>
		</div>
		<div class="product_container">
			<table width="83%" border="1" cellspacing="0" class="item_table">
				<tr>
					<th width="74%">DESCRIPTION</th>
					<th width="26%">AMOUNT ( in INR )</th>
				</tr>
				<tr>
                   <td><p>Vehicle Type :<?php echo $data["vehicletype_name"]; ?></p>
                    <p>Slot Number :<?php echo $data["studentslot_number"]; ?></p>
                    <p>Slot Date :<?php echo $data["booked_date"]; ?></p>
                    <p>Start Time  :<?php echo $data["studentslot_starttime"]; ?></p>
                    <p>End Time  :<?php echo $data["studentslot_endtime"]; ?></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></td>
					<td><p><?php echo $data["trial_amount"]; ?> INR</p>
				    <p><?php 
					$words=displaywords($data["trial_amount"]);
					echo $words; ?></p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p></td>
				</tr>
			</table>
		</div>
	
				<h2 align="center">Thank You!</h2>
				
            <p align="center">If you have any questions about this invoice,please contact </p>
            <p align="center">Smart Drive,+91 9745620479,smartdrive46@gmail.com</p>
				
			</div>
            </page>
         
          <center>
            <button  id="printpagebutton" onClick="javascript:printReceipt();">Download</button>
          </center>
<?php
}
else
{       ?>
        <script>
        alert("Invalid Invoice");
        </script>
        <?php
}

function displaywords($number){
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;


     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
	$result=ucfirst($result);

  $points = ($point) ?
    "" . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : ''; 
	$points=ucfirst($points);

  if($points != ''){        
  echo $result . "Rupees  " . $points . " Paise Only";
} else {

    echo $result . "Rupees Only";
}

}

?>

</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
<script>
    function printReceipt(){
	    var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
		window.print() ;
    };
	
</script>