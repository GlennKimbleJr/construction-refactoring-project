<?php 

// Starts Script
if (isset($_GET['edit'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {
        $id2 = $_POST['id2'];
        $name = $_POST['name'];
        $name2 = mysql_real_escape_string($name);
        $due1 = $_POST['due1'];
        $due2 = $_POST['due2'];
        $due3 = $_POST['due3'];
        $due = "$due3-$due1-$due2";
        $zone = $_POST['zone'];
        $plans = $_POST['plans'];
        $location = $_POST['location'];
        $planuser = $_POST['planuser'];
        $planpass = $_POST['planpass'];
        $owner_name = $_POST['owner_name'];
        $owner_phone = $_POST['owner_phone'];
        $super = $_POST['super'];

        $sql_selectleaguera = "SELECT * FROM super WHERE name = '$super'";
        $works_selectleaguera = mysql_query( $sql_selectleaguera, $connection );
        if(! $works_selectleaguera) {
            die('Could not get data: ' . mysql_error());
        }

        while ($row_selectleaguera = mysql_fetch_array($works_selectleaguera, MYSQL_ASSOC)) {
            $super_name = $row_selectleaguera['name'];
            $super_phone = $row_selectleaguera['phone'];
        }

        // updates information in the database
        $update_league = "UPDATE project SET name='$name2', bidduedate='$due', zone='$zone', plans='$plans', location='$location', planuser='$planuser', planpass='$planpass', owner_name='$owner_name', owner_phone='$owner_phone', super_name='$super_name', super_phone='$super_phone' WHERE id='$id2'";
        $update_works = mysql_query($update_league);
        if (! $update_works) {
            die('<br><br>Update Error');
        } else {
            die('<br><br>Project Updated!');
        }
    }

    $did = $_GET['edit'];

    $selectusercheck = "SELECT * FROM project WHERE id='$did'";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $Mid = $selectusercheck_row['id'];
        $Mname = $selectusercheck_row['name'];
        $Mdatedate = $selectusercheck_row['bidduedate'];
        $Mcomplete = $selectusercheck_row['completedate'];
        $Mzone = $selectusercheck_row['zone'];
        $Mplans = $selectusercheck_row['plans'];
        $Mlocation = $selectusercheck_row['location'];
        $Mplanuser = $selectusercheck_row['planuser'];
        $Mplanpass = $selectusercheck_row['planpass'];
        $Mowner_name = $selectusercheck_row['owner_name'];
        $Mowner_phone = $selectusercheck_row['owner_phone'];
        $Msuper = $selectusercheck_row['super_name'];
        $date1 = substr($Mdatedate, 5, -3);
        $date2 = substr($Mdatedate, 8);
        $date3 = substr($Mdatedate, 0, -6);
        if ($date1 == "01") { $date4 = "Jan"; }
        if ($date1 == "02") { $date4 = "Feb"; }
        if ($date1 == "03") { $date4 = "Mar"; }
        if ($date1 == "04") { $date4 = "Apr"; }
        if ($date1 == "05") { $date4 = "May"; }
        if ($date1 == "06") { $date4 = "Jun"; }
        if ($date1 == "07") { $date4 = "Jul"; }
        if ($date1 == "08") { $date4 = "Aug"; }
        if ($date1 == "09") { $date4 = "Sep"; }
        if ($date1 == "10") { $date4 = "Oct"; }
        if ($date1 == "11") { $date4 = "Nov"; }
        if ($date1 == "12") { $date4 = "Dec"; }
    }

    ?>

    <h3>EDIT Project | [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]</h3>
    <form action="" method="POST">

        <input id="id2" type="hidden" name="id2" required value="<?php echo"$did"; ?>" />
        
        <p>
            <label>Project Name: </label>
            <input id="name" type="text" name="name" required value="<?php echo"$Mname"; ?>" />
        </p>
        
        <p>
            <label>Plans Directory Name: </label>
            <input size='35' id="plans" type="text" name="plans" required value="<?php echo"$Mplans"; ?>" />
        </p>
        
        <p>
            <label>Directory Login: </label>
            <input size='10' id="planuser" type="text" name="planuser" required value="<?php echo"$Mplanuser"; ?>" />
            <input size='10' id="planpass" type="text" name="planpass" required value="<?php echo"$Mplanpass"; ?>" />
        </p>
        
        <p>
            <label>Owner Contact: </label><br>
            <input id="owner_name" type="text" name="owner_name" required placeholder="Name" value="<?php echo"$Mowner_name"; ?>"/>
            <input id="owner_phone" type="text" name="owner_phone" required placeholder="Phone" value="<?php echo"$Mowner_phone"; ?>"/>
        </p>
        
        <p>
            <label>Bid Due By: </label>
            <select name="due1">
                <option value="<?php echo"$date1"; ?>"><?php echo"$date4"; ?></option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">Apr</option>
                <option value="05">May</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>

            <select name="due2">
                <option value="<?php echo"$date2"; ?>"><?php echo"$date2"; ?></option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>

            <input id="due3" type="text" name="due3" required value="<?php echo"$date3"; ?>" maxlength="4" size="4"/>
        </p>

        <p>
            <label>Zone: <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></label><br>
        
            <select name="zone">
                <option value="<?php echo"$Mzone"; ?>"><?php echo"$Mzone"; ?></option>  
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
            <label>Select Superintendent:</label><br>
            <select name="super">
                <option value="<?php echo"$Msuper"; ?>"><?php echo"$Msuper"; ?></option>
                <option value=""></option>  
                <?php

                $sql_selectleaguer = "SELECT * FROM super ORDER BY name";
                $works_selectleaguer = mysql_query( $sql_selectleaguer, $connection );
                if (! $works_selectleaguer) {
                    die('Could not get data: ' . mysql_error());
                }

                while ($row_selectleaguer = mysql_fetch_array($works_selectleaguer, MYSQL_ASSOC)) {
                    $leaguenamer = $row_selectleaguer['name'];
                    echo "<option value='" . $leaguenamer . "'>"; ?><?php echo "$leaguenamer";?><?php echo "</option>"; 
                }
                ?>
            </select>
        </p>

        <p>
            <label>Project Location: </label>
            <input id="location" type="text" name="location" required value="<?php echo"$Mlocation"; ?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
