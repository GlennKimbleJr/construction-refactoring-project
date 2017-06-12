<?php 

		// Starts Script

			if(isset($_GET['edit'])) {

			// checks to see if posted

				if (isset($_POST['id2'])){
        				$id2 = $_POST['id2'];
        				$first = $_POST['first'];
        				$last = $_POST['last'];
        				$street = $_POST['street'];
        				$city = $_POST['city'];
        				$state = $_POST['state'];
        				$zone = $_POST['zone'];
        				$email = $_POST['email'];
        				$officephone = $_POST['officephone'];
        				$cellphone = $_POST['cellphone'];
        				$fax = $_POST['fax'];
        				$type = $_POST['type'];
        				$company2 = $_POST['company'];
					$company = mysql_real_escape_string($company2);
        				$zip = $_POST['zip'];
        				$zone2 = $_POST['zone2'];
        				$zone3 = $_POST['zone3'];
        				$zone4 = $_POST['zone4'];
        				$zone5 = $_POST['zone5'];
        				$zone6 = $_POST['zone6'];
        				$zone7 = $_POST['zone7'];
        				$zone8 = $_POST['zone8'];
        				$zone9 = $_POST['zone9'];



	// updates information in the database


					$update_league = "UPDATE contact SET first='$first', last='$last', street='$street', city='$city', state='$state', email='$email', officephone='$officephone', cellphone='$cellphone', fax='$fax', zone='$zone', type='$type', company='$company', zip='$zip', zone2='$zone2', zone3='$zone3', zone4='$zone4', zone5='$zone5', zone6='$zone6', zone7='$zone7', zone8='$zone8', zone9='$zone9' WHERE id='$id2'";
					$update_works = mysql_query($update_league);
					if(!$update_works){
						die('<br><br>Update Error');
					} else {
						die('<br><br>Updated!');
					} 

				}


			
				$did = $_GET['edit'];





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
			$mzone2 = $selectusercheck_row['zone2'];
			$mzone3 = $selectusercheck_row['zone3'];
			$mzone4 = $selectusercheck_row['zone4'];
			$mzone5 = $selectusercheck_row['zone5'];
			$mzone6 = $selectusercheck_row['zone6'];
			$mzone7 = $selectusercheck_row['zone7'];
			$mzone8 = $selectusercheck_row['zone8'];
			$mzone9 = $selectusercheck_row['zone9'];

		}

				?>
				

					<h3>Edit Contact | [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]</h3>
						<form action="" method="POST">
							<input id="id2" type="hidden" name="id2" required value="<?php echo "$did" ?>" size='24'/>
    							<p><label>Company: </label>
							<input id="company" type="text" name="company" required value="<?php echo "$mcompany" ?>" size='24'/></p>
    							<p><label>Name: </label>
							<input id="first" type="text" name="first" value="<?php echo "$mfirst" ?>" size='8'/>
							<input id="last" type="text" name="last" value="<?php echo "$mlast" ?>"  size='14'/></p>
    							<p><label>Address: </label>
							<input id="street" type="text" name="street" value="<?php echo "$mstreet" ?>" />
							<input id="city" type="text" name="city" value="<?php echo "$mcity" ?>" size='10'/>
							<input id="state" type="text" name="state" value="<?php echo "$mstate" ?>" maxlenght='2' size='2'/>
							<input id="zip" type="text" name="zip" value="<?php echo "$mzip" ?>" maxlenght='5' size='5'/></p>
    							<p><label>Email Address: </label>
							<input id="email" type="text" name="email" required value="<?php echo "$memail" ?>" size='24'/></p>
    							<p><label>Office Phone: </label>
							<input id="officephone" type="text" name="officephone" value="<?php echo "$mofficephone" ?>" /></p>
    							<p><label>Cell Phone: </label>
							<input id="cellphone" type="text" name="cellphone" value="<?php echo "$mcellphone" ?>" /></p>
    							<p><label>Fax Number: </label>
							<input id="fax" type="text" name="fax" value="<?php echo "$mfax" ?>"/></p>





							<p><label>Zone: </label><b>( Choose up to 9 )</b> | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
								<select name="zone">	
							<option value="<?php echo "$mzone" ?>"><?php echo "$mzone" ?></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone2">	
							<option value="<?php echo "$mzone2" ?>"><?php echo "$mzone2" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone3">	
							<option value="<?php echo "$mzone3" ?>"><?php echo "$mzone3" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
							</p>
							<p>
								<select name="zone4">	
							<option value="<?php echo "$mzone4" ?>"><?php echo "$mzone4" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone5">	
							<option value="<?php echo "$mzone5" ?>"><?php echo "$mzone5" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone6">	
							<option value="<?php echo "$mzone6" ?>"><?php echo "$mzone6" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
							</p>

	 							<p>
								<select name="zone7">	
							<option value="<?php echo "$mzone7" ?>"><?php echo "$mzone7" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone8">	
							<option value="<?php echo "$mzone8" ?>"><?php echo "$mzone8" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
								<select name="zone9">	
							<option value="<?php echo "$mzone9" ?>"><?php echo "$mzone9" ?></option>
							<option value=""></option>
								<?php 


									$sql_selectleague = "SELECT * FROM zone ORDER BY name";
									$works_selectleague = mysql_query( $sql_selectleague, $connection );
									if(!$works_selectleague)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC))
										{
											$leaguename = $row_selectleague['name'];
											echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
										}


								?>
								</select>
							</p>

	 


							<p><label>Category: </label>
								<select name="type">	
							<option value="<?php echo "$mtype" ?>"><?php echo "$mtype" ?></option>
								<?php 


									$sql_selectleague2 = "SELECT * FROM type ORDER BY name";
									$works_selectleague2 = mysql_query( $sql_selectleague2, $connection );
									if(!$works_selectleague2)
										{
											die('Could not get data: ' . mysql_error());
										}
									while($row_selectleague2 = mysql_fetch_array($works_selectleague2, MYSQL_ASSOC))
										{
											$leaguename2 = $row_selectleague2['name'];
											echo "<option value='" . $leaguename2 . "'>"; ?><?php echo "$leaguename2";?><?php echo "</option>"; 
										}


								?>
								</select>
							</p>
	 

   							<input class="btn register" type="submit" name="submit" value="UPDATE" />
    						</form>




				<?php

			}



?>