<?php 


		// Starts Script

			if(isset($_GET['score'])) {
			
$selectusercheck = "SELECT * FROM contact";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$company = $selectusercheck_row['company'];


$selectusercheck2 = "SELECT sum(score) FROM bid_contactors WHERE company = '$company' AND score != 'NA'";
		$selectusercheck_works2 = mysql_query( $selectusercheck2, $connection );
		if(!$selectusercheck_works2){
  			die('Could not get data: ' . mysql_error());
		}

$selectusercheck2a = "SELECT * FROM bid_contactors WHERE company = '$company' AND score != 'NA'";
		$selectusercheck_works2a = mysql_query( $selectusercheck2a, $connection );
		if(!$selectusercheck_works2a){
  			die('Could not get data: ' . mysql_error());
		}

		$sum = mysql_fetch_array($selectusercheck_works2);

		$count1 = mysql_num_rows($selectusercheck_works2a);

$sum2 = $sum[0];

$final = $sum2 / $count1;

if ($sum2 != 0) {
					$update_league = "UPDATE contact SET score_per='$final' WHERE company='$company'";
					$update_works = mysql_query($update_league);
}






		
		}




			echo "<h3>Score %</h3>


<div id='pagenation'>

<table width='100%' cellspacing='1' cellpadding='1' border='1'><tr>
<td align='center' width='35%'><font size='1'><b>company</b></font></td>
<td align='center' width='15%'><font size='1'><b>city</b></font></td>
<td align='center' width='10%'><font size='1'><b>state</b></font></td>
<td align='center' width='30%'><font size='1'><b>type</b></font></td>
<td align='center' width='10%'><font size='1'><b>score</b></font></td>
</tr>";


		$selectusercheck = "SELECT * FROM contact WHERE score_per != '' ORDER BY score_per";
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
			$score = $selectusercheck_row['score_per'];		
			echo "<div class='z'>
<tr>
<td align='center' width='35%'><font size='1'>$company</font></td>
<td align='center' width='15%'><font size='1'>$city</font></td>
<td align='center' width='10%'><font size='1'>$state</font></td>
<td align='center' width='30%'><font size='1'>$type</font></td>
<td align='center' width='10%'><font size='1'><b>$score</b></font></td>
</tr>
</div>";
		}


echo "</table></div><br><br>
<div id='pagingControls'></div>
";



}


?>