<?php 


		// Starts Script

			if(isset($_GET['bid'])) {
			
$selectusercheck = "SELECT * FROM contact";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$company = $selectusercheck_row['company'];


$selectusercheck2 = "SELECT * FROM bid_contactors WHERE company = '$company' AND status='will'";
		$selectusercheck_works2 = mysql_query( $selectusercheck2, $connection );
		if(!$selectusercheck_works2){
  			die('Could not get data: ' . mysql_error());
		}

$selectusercheck3 = "SELECT * FROM bid_contactors WHERE company = '$company' AND status='wont'";
		$selectusercheck_works3 = mysql_query( $selectusercheck3, $connection );
		if(!$selectusercheck_works3){
  			die('Could not get data: ' . mysql_error());
		}

		$count1 = mysql_num_rows($selectusercheck_works2);
		$count2 = mysql_num_rows($selectusercheck_works3);
		$count3 = $count1 + $count2;
		$count4 = $count1 / $count3;
		$count5 = $count4 * 100;

if ($count3 != 0) {
					$update_league = "UPDATE contact SET bid_per='$count5' WHERE company='$company'";
					$update_works = mysql_query($update_league);
}
		
		}




			echo "<h3>Bid %</h3>


<div id='pagenation'>

<table width='100%' cellspacing='1' cellpadding='1' border='1'><tr>
<td align='center' width='35%'><font size='1'><b>company</b></font></td>
<td align='center' width='15%'><font size='1'><b>city</b></font></td>
<td align='center' width='10%'><font size='1'><b>state</b></font></td>
<td align='center' width='30%'><font size='1'><b>type</b></font></td>
<td align='center' width='10%'><font size='1'><b>bid %</b></font></td>
</tr>";


		$selectusercheck = "SELECT * FROM contact WHERE bid_per != '' ORDER BY bid_per";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$id = $selectusercheck_row['id'];
			$city2 = $selectusercheck_row['city'];
			$city = substr($city2, 0, 18);
			$state = $selectusercheck_row['state'];
			$type2 = $selectusercheck_row['type'];
			$type = substr($type2, 0, 18);
			$company2 = $selectusercheck_row['company'];
			$company = substr($company2, 0, 18);
			$bid = $selectusercheck_row['bid_per'];		
			echo "<div class='z'>
<tr>
<td align='center' width='35%'><font size='1'>$company</font></td>
<td align='center' width='15%'><font size='1'>$city</font></td>
<td align='center' width='10%'><font size='1'>$state</font></td>
<td align='center' width='30%'><font size='1'>$type</font></td>
<td align='center' width='10%'><font size='1'><b>$bid %</b></font></td>
</tr>
</div>";
		}


echo "</table></div><br><br>
<div id='pagingControls'></div>
";



}


?>