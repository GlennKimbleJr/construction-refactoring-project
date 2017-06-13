<?php


		// Starts Script

			if(isset($_GET['details'])) {
				$did = $_GET['details'];





		$selectusercheck = "SELECT * FROM project WHERE id='$did'";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$id = $selectusercheck_row['id'];
			$name = $selectusercheck_row['name'];
			$datedate = $selectusercheck_row['bidduedate'];
			$complete2 = $selectusercheck_row['completedate'];
			$zone = $selectusercheck_row['zone'];
			$plans = $selectusercheck_row['plans'];
			$location = $selectusercheck_row['location'];
			$planuser = $selectusercheck_row['planuser'];
			$planpass = $selectusercheck_row['planpass'];
		
if ($complete2 == '') { $complete = "<font size='1'><a href='?complete=$id'><u><b>MARK AS COMPLETE</a></b></u></font>";} else { $complete = $complete2; }

			echo "<b>$name</b> | <b><a href='?edit=$id'><font color='red'>EDIT</font></a></b><br><u>$plans<br>$planuser | $planpass<br><br><u><a href='' rel='imgtip[0]'>Zone:</a></u> $zone - $location<br><u>Bid Due By:</u> $datedate<br><u>Date Completed:</u> $complete<br><br><b><u>[ <a href='print.php?print=$id&name=$name' target='_new'>CALL LOG</a> ]</u></b><br><br><b>[ <a href='?choose=$did'>CHOOSE SUB-CONTRACTORS TO BID</a> ]</b><br><b>Current:</b> ";
		}


echo "<br><font size='1'>";



		$selectusercheck3 = "SELECT * FROM bid_contactors WHERE project_id = '$did' AND win = '' AND status !='wont'";
		$selectusercheck_works3 = mysql_query( $selectusercheck3, $connection );
		if(!$selectusercheck_works3){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row3 = mysql_fetch_array($selectusercheck_works3, MYSQL_ASSOC)){
			$aid3 = $selectusercheck_row3['id'];
			$company3 = $selectusercheck_row3['company'];
			$category3 = $selectusercheck_row3['category'];
			$email3 = $selectusercheck_row3['email'];
			$status3 = $selectusercheck_row3['status'];

if ($status3 == 'will') { 
			echo "&nbsp;&nbsp;$category3 - <b>$company3</b> | <a href='mailto:$email3?subject=Invitation to Bid&body=COMPANY NAME%0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A$company3a%0D%0A%0D%0APROJECT NAME: $name%0D%0APROJECT LOCATION: $location%0D%0ABID DATE: $datedate%0D%0A%0D%0APlans and Specs%0D%0A $plans %0D%0AUser: $planuser | Pass: $planpass%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICENSE'>EMAIL BID INVITE</a> | <b>[ <u><a href='?win=$did&c=$company3&c2=$category3&c22=$aid3'>CHOOSE AS WINNER</a></u> ]</b><br>";
} else {
			echo "&nbsp;&nbsp;$category3 - <b>$company3</b> | <a href='mailto:$email3?subject=Invitation to Bid&body=COMPANY NAME %0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A$company3a%0D%0A%0D%0APROJECT NAME: $name%0D%0APROJECT LOCATION: $location%0D%0ABID DATE: $datedate%0D%0A%0D%0APlans and Specs%0D%0A $plans%0D%0AUser: $planuser | Pass: $planpass%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICSNE '>EMAIL BID INVITE</a> | <b>Set Status:</b> <a href='?status=yes&id=$did&c=$company3&a=$aid3'>will bid</a> - <a href='?status=no&id=$did&c=$company3&a=$aid3'>won't bid</a><br>";
}
		
		}
	
		if (!$company3) { echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>"; }




echo "<br><br><b>WINNING SUB CONTRACTORS</b>:";
		$selectusercheck3 = "SELECT * FROM bid_contactors WHERE project_id = '$did' AND win = '1'";
		$selectusercheck_works3 = mysql_query( $selectusercheck3, $connection );
		if(!$selectusercheck_works3){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row3 = mysql_fetch_array($selectusercheck_works3, MYSQL_ASSOC)){
			$aid3 = $selectusercheck_row3['id'];
			$company3 = $selectusercheck_row3['company'];
			$category3 = $selectusercheck_row3['category'];
			$email3 = $selectusercheck_row3['email'];
			$rate = $selectusercheck_row3['score'];

echo "<br><br>&nbsp;&nbsp;<b>$category3</b> - <u>$company3</u> | <a href='mailto:$email3'>EMAIL</a>";

if ($rate == 'NA') { echo " &nbsp;&nbsp;<u>[ <a href='?score=$aid3&n=$company3&l=$id'>SCORE</a> ]</u>"; }

		
		}
	
		if (!$company3) { echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i>"; }

















echo "</font>";
			}




			if(isset($_GET['status'])) {
				$status = $_GET['status'];
				$did = $_GET['id'];
				$company = $_GET['c'];
				$aid3 = $_GET['a'];

if ($status == 'yes') { echo "<b>[ <a href='?details=$did'>GO BACK</a> ]</b><br><br>Bid Status Updated!";

					$update_league = "UPDATE bid_contactors SET status='will' WHERE id='$aid3'";
					$update_works = mysql_query($update_league);
 }
if ($status == 'no') { echo "<b>[ <a href='?details=$did'>GO BACK</a> ]</b><br><br>Bid Status Updated!";

					$update_league = "UPDATE bid_contactors SET status='wont' WHERE id='$aid3'";
					$update_works = mysql_query($update_league);
 }

}





			if(isset($_GET['win'])) {
				$win = $_GET['win'];
				$c = $_GET['c'];
				$c2 = $_GET['c2'];
				$c22 = $_GET['c22'];
echo "<h2>AWARD BID: <br>$c<br>$c2<br><br>Are you sure?</h2>
<h3><a href='?win2=$win&c=$c&c2=$c2&c22=$c22'>YES</a> | <a href='?details=$win'>NO</a><h3>";

}




			if(isset($_GET['win2'])) {
				$win = $_GET['win2'];
				$c = $_GET['c'];
				$c2 = $_GET['c2'];
				$c22 = $_GET['c22'];
echo "<b> [ <a href='?details=$win'>GO BACK</a> ]</b><br><h1>BID AWARDED!</h1>";

					$update_league = "UPDATE bid_contactors SET win='1' WHERE id='$c22' AND project_id='$win'";
					$update_works = mysql_query($update_league);

					$update_league = "UPDATE bid_contactors SET win='0' WHERE id != '$c22' AND project_id='$win' AND category='$c2'";
					$update_works = mysql_query($update_league);

}


			if(isset($_GET['score'])) {
				$score = $_GET['score'];
				$n = $_GET['n'];
				$l = $_GET['l'];

echo "<b> [ <a href='?details=$l'>GO BACK</a> ]</b><br><br><b>How would you rate $n's preformance on this project?</b><br><br>

<a href='?score2=$score&r=happy&l=$l'><img src='images/happy.png' border='0'></a> 
<a href='?score2=$score&r=good&l=$l'><img src='images/good.png' border='0'></a> 
<a href='?score2=$score&r=ok&l=$l'><img src='images/ok.png' border='0'></a> 
<a href='?score2=$score&r=bad&l=$l'><img src='images/bad.png' border='0'></a>
<a href='?score2=$score&r=angry&l=$l'><img src='images/angry.png' border='0'></a>  
";

}

			if(isset($_GET['score2'])) {
				$score = $_GET['score2'];
				$r = $_GET['r'];
				$l = $_GET['l'];
echo "<b> [ <a href='?details=$l'>GO BACK</a> ]</b><br>";


if ($r == 'happy'){
					$update_league = "UPDATE bid_contactors SET score='5' WHERE id='$score'";
					$update_works = mysql_query($update_league);
}
if ($r == 'good'){
					$update_league = "UPDATE bid_contactors SET score='4' WHERE id='$score'";
					$update_works = mysql_query($update_league);
}
if ($r == 'ok'){
					$update_league = "UPDATE bid_contactors SET score='3' WHERE id='$score'";
					$update_works = mysql_query($update_league);
}
if ($r == 'bad'){
					$update_league = "UPDATE bid_contactors SET score='2' WHERE id='$score'";
					$update_works = mysql_query($update_league);
}
if ($r == 'angry'){
					$update_league = "UPDATE bid_contactors SET score='1' WHERE id='$score'";
					$update_works = mysql_query($update_league);
}

echo "<br>UPDATED!";


}



			if(isset($_GET['complete'])) {
				$complete = $_GET['complete'];
echo "<h2>COMPLETE PROJECT: <br><br>Are you sure?</h2>
<h3><a href='?complete2=$complete'>YES</a> | <a href='?details=$complete'>NO</a><h3>";

}




			if(isset($_GET['complete2'])) {
				$complete = $_GET['complete2'];
echo "<b> [ <a href='?details=$complete'>GO BACK</a> ]</b><br><h1>PROJECT COMPLETED!</h1>";

					$update_league = "UPDATE project SET completedate='$date' WHERE id='$complete'";
					$update_works = mysql_query($update_league);

}




?>