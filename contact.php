<?php 

	define('TITLE', 'Contact Menu');	
	require('functions/connect.php');
	include('functions/header.php');



		//start admin content area
			echo "<center><h1>CONTACT MENU</h1> <table width='620' cellspacing='1' cellpadding='5' border='0'>";
			echo "<tr><td width='120' valign='top' align='center'><font size='1'>
<img src='contact.png' width='48' height='48'><br> 
<a href='index.php'>back to home</a><br>
<br>
<a href='?new'>+ ADD NEW</a><br>
<a href='?view'>VIEW LIST</a><br>
<br>
<a href='?type'>BY TYPE</a><br>
<a href='?zone'>BY ZONE</a><br>
<br>
<a href='super.php'>Superintendent</a><br>


</font></td>";
			echo "<td width='40'>&nbsp;</td><td width='660' valign='top' align='left'>";


			require('functions/contact_new.php'); 
			require('functions/contact_view.php'); 
			require('functions/contact_details.php'); 
			require('functions/contact_edit.php'); 
			require('functions/contact_delete.php'); 

			echo "</td></tr>";

			echo "</table></center>";


	include('functions/footer.php');
?>




