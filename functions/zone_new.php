<?php 


		// Starts Script

			if(isset($_GET['new'])) {

			// checks to see if posted

				if (isset($_POST['name'])){
        				$name2 = $_POST['name'];
					$name = mysql_real_escape_string($name2);




				// inserts information into database

        				$query_startseason = "INSERT INTO `zone` (name) VALUES ('$name')";
        				$result_startseason = mysql_query($query_startseason);
        				if($result_startseason){
           					die('<br><br>Created!');

       					} else {
						die('<br><br>Error! Unable to create zone.');
        				} 
				}


			



				?>
				

					<h3>Start a New Zone | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></h3>
						<form action="" method="POST">
    							<p><label>Name: </label>
							<input id="name" type="text" name="name" required placeholder="FL - Northwest" /></p>
    						
   							<input class="btn register" type="submit" name="submit" value="Create" />
    						</form>


				<?php

			}



?>