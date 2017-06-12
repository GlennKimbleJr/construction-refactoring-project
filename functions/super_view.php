<?php 


		// Starts Script

			if(isset($_GET['view'])) {
			
			echo "<h3>View All Superintendents</h3>


<div id='pagenation'>";


		$selectusercheck = "SELECT * FROM super ORDER BY name";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$id = $selectusercheck_row['id'];
			$name = $selectusercheck_row['name'];
			$phone = $selectusercheck_row['phone'];
		
			echo "<div class='z'><a href='?edit=$id'>$name</a> - $phone</div>";
		}


echo "</div><br><br>
<div id='pagingControls'></div>

";





			}

?>