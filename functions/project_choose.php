<?php 


		// Starts Script

			if(isset($_GET['choose'])) {
			
				$did = $_GET['choose'];


echo "<b>[ <a href='?details=$did'>GO BACK</a> ]</b><br><br><b>CHOOSE A CATEGORY</b><br><br>";
									$sql_selectleague = "SELECT * FROM type ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<br><b><u><a href='?choose2=$did&c=$leaguename'>$leaguename</a></u></b><br>"; 
		$selectusercheck3 = "SELECT * FROM bid_contactors WHERE project_id = '$did' AND category='$leaguename'";
		$selectusercheck_works3 = mysql_query( $selectusercheck3, $connection );
		if(!$selectusercheck_works3){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row3 = mysql_fetch_array($selectusercheck_works3, MYSQL_ASSOC)){
			$company3 = $selectusercheck_row3['company'];
			echo "&nbsp;&nbsp;&nbsp;&nbsp;- $company3<br>";
		
		}
	
		if (!$company3) { echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>"; }

										}




			}


			if(isset($_GET['choose2'])) {
			
				$did = $_GET['choose2'];
				$c = $_GET['c'];

		$selectusercheck = "SELECT * FROM project WHERE id = '$did'";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$id = $selectusercheck_row['id'];
			$zone = $selectusercheck_row['zone'];
		
		}


echo "<b>[ <a href='?choose=$did'>GO BACK</a> ]</b><br><br><b>Choose a <u>$c</u> Sub-Contractor</b><br><br>

<form action='' method='POST'>
<input id='did' type='hidden' name='did' required value='$did' />
<input id='c' type='hidden' name='c' required value='$c' />
<p><select name='zone' required>	";
									$sql_selectleague = "SELECT * FROM contact WHERE type = '$c' AND (zone = '$zone' OR zone2 = '$zone' OR zone3 = '$zone' OR zone4 = '$zone' OR zone5 = '$zone' OR zone6 = '$zone' OR zone7 = '$zone' OR zone8 = '$zone' OR zone9 = '$zone') ORDER BY company";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['company'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


echo "	</select></p>
	 

   							<input class='btn register' type='submit' name='submit' value='Submit' />
    						</form><br><br><b>Sub-Contractors already selected:</b><br><br>";




		$selectusercheck3 = "SELECT * FROM bid_contactors WHERE project_id = '$did' AND category='$c'";
		$selectusercheck_works3 = mysql_query( $selectusercheck3, $connection );
		if(!$selectusercheck_works3){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row3 = mysql_fetch_array($selectusercheck_works3, MYSQL_ASSOC)){
			$company3 = $selectusercheck_row3['company'];
			echo "- $company3<br>";
		
		}
	
		if (!$company3) { echo "<i>none</i>"; }





			}




			// checks to see if posted

				if (isset($_POST['zone'])){
        				$zone = $_POST['zone'];
        				$did = $_POST['did'];
        				$c = $_POST['c'];
				

		$selectusercheck = "SELECT * FROM contact WHERE company = '$zone'";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$email = $selectusercheck_row['email'];
		
		}


				// inserts information into database

        				$query_startseason = "INSERT INTO `bid_contactors` (project_id, category, status, win, email, score, company) VALUES ('$did', '$c', '', '', '$email', 'NA', '$zone')";
        				$result_startseason = mysql_query($query_startseason);
        				if($result_startseason){
						die('<br><br>Sucess! ');

       					} else {
						die('<br><br>Error! ');
        				} 
				}


			




?>