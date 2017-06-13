<?php 

	define('TITLE', 'Project Menu');	
	require('../functions/connect.php');
	include('../functions/header.php');



		//start admin content area
			echo "<center><h1>PROJECT MENU</h1> <table width='620' cellspacing='1' cellpadding='5' border='0'>";
			echo "<tr><td width='120' valign='top' align='center'><font size='1'>
<img src='images/project.png' width='48' height='48'><br> 
<a href='index.php'>back to home</a><br>
<br>
<a href='?new'>+ ADD NEW</a><br>
<a href='?open'>VIEW LIST</a><br>
<br>
<a href='super.php'>Superintendent</a><br>

</font></td>";
			echo "<td width='40'>&nbsp;</td><td width='660' valign='top' align='left'>";


			require('../functions/project_new.php'); 
			require('../functions/project_view.php'); 
			require('../functions/project_details.php'); 
			require('../functions/project_edit.php'); 
			require('../functions/project_delete.php'); 
			require('../functions/project_choose.php'); 

			echo "</td></tr>";

			echo "</table></center>";


	include('../functions/footer.php');
?>




