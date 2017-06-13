<?php

// Starts Script
if (isset($_GET['new'])) {

    // checks to see if posted
    if (isset($_POST['company'])) {
        $company2 = $_POST['company'];
        $company = mysql_real_escape_string($company2);
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
        $zip = $_POST['zip'];
        $zone2 = $_POST['zone2'];
        $zone3 = $_POST['zone3'];
        $zone4 = $_POST['zone4'];
        $zone5 = $_POST['zone5'];
        $zone6 = $_POST['zone6'];
        $zone7 = $_POST['zone7'];
        $zone8 = $_POST['zone8'];
        $zone9 = $_POST['zone9'];

        // inserts information into database
        $query_startseason = "INSERT INTO `contact` (first, last, street, city, state, zone, email, officephone, cellphone, fax, type, company, zip, zone2, zone3, zone4, zone5, zone6, zone7, zone8, zone9, score_per, bid_per) VALUES ('$first', '$last', '$street', '$city', '$state', '$zone', '$email', '$officephone', '$cellphone', '$fax', '$type', '$company', '$zip', '$zone2', '$zone3', '$zone4', '$zone5', '$zone6', '$zone7', '$zone8', '$zone9', 0, 0)";
        $result_startseason = mysql_query($query_startseason);
        if ($result_startseason) {
            die('<br><br>Contact Added!');
        } else {
            die('<br><br>Error! Unable to create contact.');
        }
    }
    ?>

    <h3>New Contact</h3>
    <form action="" method="POST">
        <p>
            <label>Company: </label>
            <input id="company" type="text" name="company" required placeholder="Construction Company" size='24'/>
        </p>
        
        <p>
            <label>Name: </label>
            <input id="first" type="text" name="first" placeholder="Lloyd" size='8'/>
            <input id="last" type="text" name="last" placeholder="Martin"  size='14'/>
        </p>
        
        <p>
            <label>Address: </label>
            <input id="street" type="text" name="street" placeholder="123 Main St." />
            <input id="city" type="text" name="city" placeholder="Beverly Hills" size='10'/>
            <input id="state" type="text" name="state" placeholder="CA" maxlenght='2' size='2'/>
            <input id="zip" type="text" name="zip" placeholder="90210" maxlenght='5' size='5'/>
        </p>
        
        <p>
            <label>Email Address: </label>
            <input id="email" type="text" name="email" required placeholder="bob@email.com" size='24'/>
        </p>
        
        <p>
            <label>Office Phone: </label>
            <input id="officephone" type="text" name="officephone" placeholder="(555) 555-5555" />
        </p>
        
        <p>
            <label>Cell Phone: </label>
            <input id="cellphone" type="text" name="cellphone" placeholder="(555) 555-5555" />
        </p>
        
        <p>
            <label>Fax Number: </label>
            <input id="fax" type="text" name="fax" placeholder="(555) 555-5555" />
        </p>

        <p>
            <label>
                Zone: <b>Choose up to 9</b> | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
            </label>

            <select name="zone">
            <?php

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>";
                }
            ?>
            </select>

            <select name="zone2">
                <option value=""></option>
                <?php

                    $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                    $works_selectleague = mysql_query( $sql_selectleague, $connection );
                    if(! $works_selectleague) {
                        die('Could not get data: ' . mysql_error());
                    }
                    while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                        $leaguename = $row_selectleague['name'];
                        echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                    }
                ?>
            </select>

            <select name="zone3">
                <option value=""></option>
                <?php 

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

        </p>


        <p>
            <select name="zone4">
                <option value=""></option>
                <?php 

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

            <select name="zone5">
                <option value=""></option>
                <?php

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

            <select name="zone6">
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
                <option value=""></option>
                <?php 

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

            <select name="zone8">
                <option value=""></option>
                <?php 

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

            <select name="zone9">
                <option value=""></option>
                <?php 

                $sql_selectleague = "SELECT * FROM zone ORDER BY name";
                $works_selectleague = mysql_query( $sql_selectleague, $connection );
                if (! $works_selectleague) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague = mysql_fetch_array($works_selectleague, MYSQL_ASSOC)) {
                    $leaguename = $row_selectleague['name'];
                    echo "<option value='" . $leaguename . "'>"; ?><?php echo "$leaguename";?><?php echo "</option>"; 
                }
                ?>
            </select>

        </p>

        <p>
            <label>Category: </label>
            <select name="type">    
            <?php

                $sql_selectleague2 = "SELECT * FROM type ORDER BY name";
                $works_selectleague2 = mysql_query( $sql_selectleague2, $connection );
                if (! $works_selectleague2) {
                    die('Could not get data: ' . mysql_error());
                }
                while ($row_selectleague2 = mysql_fetch_array($works_selectleague2, MYSQL_ASSOC)) {
                    $leaguename2 = $row_selectleague2['name'];
                    echo "<option value='" . $leaguename2 . "'>"; ?><?php echo "$leaguename2";?><?php echo "</option>"; 
                }
            ?>
            </select>
        </p>

        <input class="btn register" type="submit" name="submit" value="Create" />
    </form>
    <?php
}
