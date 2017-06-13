<?php 

	define('TITLE', 'Zone Menu');	
	require('../functions/connect.php');
	include('../functions/header.php');



		//start admin content area
			echo "<center><h1>ZONE MENU</h1> <table width='620' cellspacing='1' cellpadding='5' border='0'>";
			echo "<tr><td width='120' valign='top' align='center'><font size='1'>
<img src='images/zone.png' width='48' height='48'><br> 
<a href='index.php'>back to home</a><br>
<br>
<a href='?new'>+ ADD NEW</a><br>
<a href='?view'>VIEW LIST</a><br>

</font></td>";
			echo "<td width='40'>&nbsp;</td><td width='660' valign='top' align='left'>";


			require('../functions/zone_new.php'); 
			require('../functions/zone_view.php'); 
			require('../functions/zone_edit.php'); 
			require('../functions/zone_delete.php'); 

			echo "</td></tr>";

			echo "</table></center>";


	include('../functions/footer.php');
?>




