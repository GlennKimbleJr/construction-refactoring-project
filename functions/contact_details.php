<?php 


		// Starts Script

			if(isset($_GET['details'])) {
		$did = $_GET['details'];




		$selectusercheck = "SELECT * FROM contact WHERE id='$did'";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$mid = $selectusercheck_row['id'];
			$mfirst = $selectusercheck_row['first'];
			$mlast = $selectusercheck_row['last'];
			$mstreet = $selectusercheck_row['street'];
			$mcity = $selectusercheck_row['city'];
			$mstate = $selectusercheck_row['state'];
			$mzone = $selectusercheck_row['zone'];
			$memail = $selectusercheck_row['email'];
			$mofficephone = $selectusercheck_row['officephone'];
			$mcellphone = $selectusercheck_row['cellphone'];
			$mfax = $selectusercheck_row['fax'];
			$mtype = $selectusercheck_row['type'];
			$mcompany = $selectusercheck_row['company'];
			$mzip = $selectusercheck_row['zip'];
			$mzone2a = $selectusercheck_row['zone2'];
			$mzone3a = $selectusercheck_row['zone3'];
			$mzone4a = $selectusercheck_row['zone4'];
			$mzone5a = $selectusercheck_row['zone5'];
			$mzone6a = $selectusercheck_row['zone6'];
			$mzone7a = $selectusercheck_row['zone7'];
			$mzone8a = $selectusercheck_row['zone8'];
			$mzone9a = $selectusercheck_row['zone9'];

if ($mzone2a != '') { $mzone2 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone2a"; }
if ($mzone3a != '') { $mzone3 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone3a"; }
if ($mzone4a != '') { $mzone4 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone4a"; }
if ($mzone5a != '') { $mzone5 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone5a"; }
if ($mzone6a != '') { $mzone6 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone6a"; }
if ($mzone7a != '') { $mzone7 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone7a"; }
if ($mzone8a != '') { $mzone8 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone8a"; }
if ($mzone9a != '') { $mzone9 = "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone9a"; }

			echo "<u><b>$mcompany</b></u>&nbsp;&nbsp;&nbsp; $mtype. | <a href='?edit=$did'><font color='red'>EDIT</font></a><br><br><table width='100%'><tr><td width='5%'>&nbsp;</td><td width='95%'><font size='1'>$mzone $mzone2 $mzone3 $mzone4 $mzone5 $mzone6 $mzone7 $mzone8 $mzone9<br>{ <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> }</font></td></tr></table><br> $mfirst $mlast<br>$mstreet. $mcity, $mstate. $mzip<br><br>
<table width='400'><tr><td width='33'>Cell:<br> $mcellphone</td><td width='33'>Office:<br> $mofficephone</td><td width='33'>Fax:<br> $mfax</td></tr></table>
<h2><a href='mailto:$memail'>$memail</a></h2>";
		}







			}


?>