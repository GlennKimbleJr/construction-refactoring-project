<?php 


		// Starts Script

			if(isset($_GET['edit'])) {

			// checks to see if posted

				if (isset($_POST['name'])){
        				$id2 = $_POST['id2'];
        				$name = $_POST['name'];
					$name2 = mysql_real_escape_string($name);
        				$phone = $_POST['phone'];



	// updates information in the database


					$update_league = "UPDATE super SET name='$name2', phone='$phone' WHERE id='$id2'";
					$update_works = mysql_query($update_league);
					if(!$update_works){
						die('<br><br>Update Error');
					} else {
						die('<br><br>Updated!');
					} 

				}


			
				$did = $_GET['edit'];





		$selectusercheck = "SELECT * FROM super WHERE id='$did'";
		$selectusercheck_works = mysql_query( $selectusercheck, $connection );
		if(!$selectusercheck_works){
  			die('Could not get data: ' . mysql_error());
		}
		while($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)){
			$Mid = $selectusercheck_row['id'];
			$Mname = $selectusercheck_row['name'];
			$Mphone = $selectusercheck_row['phone'];
		}

				?>
				

					<h3>EDIT Superintendent | [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]</h3>
						<form action="" method="POST">
    							<p><label>Name: </label>
<input id="id2" type="hidden" name="id2" required value="<?php echo"$did"; ?>" />
							<input id="name" type="text" name="name" required value="<?php echo"$Mname"; ?>" /></p>
    							<p><label>Phone: </label>
							<input id="phone" type="text" name="phone" required value="<?php echo"$Mphone"; ?>" /></p>
    							
	 
   							<input class="btn register" type="submit" name="submit" value="Update" />
    						</form>


				<?php

			}



?>