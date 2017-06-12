<?php 

	define('TITLE', 'Home');	
	require('functions/connect.php');
	include('functions/header.php');




		//start admin content area
			echo "<center><h1>CONSTRUCTION DATABASE</h1> <table width='600' cellspacing='1' cellpadding='1' border='1'>";
			echo "<tr><td width='120' height='100' valign='center' align='center'><a href='project.php'><img src='project.png' width='48' height='48'><br>Project Menu</a></td>";
			echo "<td width='120' height='100' valign='center' align='center'><a href='contact.php?view'><img src='contact.png' width='48' height='48'><br>Contact Menu</a></td>";
			echo "<td width='110' height='100' valign='center' align='center'><a href='categories.php?view'><img src='categories.png' width='48' height='48'><br>Categories Menu</a></td>";
			echo "<td width='130' height='100' valign='center' align='center'><a href='zone.php?view'><img src='zone.png' width='48' height='48'><br>Zone Menu</a></td>";
			echo "<td width='130' height='100' valign='center' align='center'><a href='reports.php'><img src='reports.png' width='48' height='48'><br>Reports Menu</a></td></tr>";
			echo "</table></center>";



	include('functions/footer.php');

?>




