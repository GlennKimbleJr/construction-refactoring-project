<?php 

if (isset($_GET['edit'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {

        if (! empty($_POST['super'])) {
            $super = $db->getFirst("SELECT * FROM super WHERE name = ?", [trim($_POST['super'])]);
            $super_name = $super['name'];
            $super_phone = $super['phone'];
        }

        $query = $db->setData(
            "UPDATE project SET name=?, bidduedate=?, zone=?, plans=?, location=?, planuser=?, planpass=?, owner_name=?, owner_phone=?, super_name=?, super_phone=? WHERE id=?",
            [
                htmlspecialchars(trim($_POST['name'])),
                trim($_POST['due3']) . '-' . trim($_POST['due1']) . '-' . trim($_POST['due2']), 
                trim($_POST['zone']),
                trim($_POST['plans']), 
                trim($_POST['location']), 
                trim($_POST['planuser']), 
                trim($_POST['planpass']), 
                trim($_POST['owner_name']), 
                trim($_POST['owner_phone']), 
                isset($super_name) ? $super_name : '', 
                isset($super_phone) ? $super_phone : '', 
                intval($_POST['id2'])
            ]
        );

        die($db->updated($query) ? '<br><br>Project Updated!' : '<br><br>Update Error');
    }

    $projectId = intval($_GET['project']);

    $project = $db->getFirst("SELECT * FROM project WHERE id=?", [$projectId]);
    if (! count($project)) {
        die('Could not get data.');
    }
    
    $date1 = substr($project['bidduedate'], 5, -3);
    $date2 = substr($project['bidduedate'], 8);
    $date3 = substr($project['bidduedate'], 0, -6);
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

    ?>

    <h3>
        EDIT Project | 
        [ 
            <a href="?delete=<?=$projectId;?>">
                <font color="red">DELETE</font>
            </a> 
        ]
    </h3>

    <form action="" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?=$projectId;?>" />
        
        <p>
            <label>Project Name: </label>
            <input id="name" type="text" name="name" required value="<?=$project['name'];?>" />
        </p>
        
        <p>
            <label>Plans Directory Name: </label>
            <input size='35' id="plans" type="text" name="plans" required value="<?=$project['plans'];?>" />
        </p>
        
        <p>
            <label>Directory Login: </label>
            <input size='10' id="planuser" type="text" name="planuser" required value="<?=$project['planuser'];?>" />
            <input size='10' id="planpass" type="text" name="planpass" required value="<?=$project['planpass'];?>" />
        </p>
        
        <p>
            <label>Owner Contact: </label><br>
            <input id="owner_name" type="text" name="owner_name" required placeholder="Name" value="<?=$project['owner_name'];?>"/>
            <input id="owner_phone" type="text" name="owner_phone" required placeholder="Phone" value="<?=$project['owner_phone'];?>"/>
        </p>
        
        <p>
            <label>Bid Due By: </label>
            <select name="due1">
                <option value="<?=$date1;?>"><?=$date4;?></option>
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
                <option value="<?=$date2;?>"><?=$date2;?></option>
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

            <input id="due3" type="text" name="due3" required value="<?=$date3;?>" maxlength="4" size="4"/>
        </p>

        <p>
            <label>Zone: <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></label><br>
        
            <select name="zone">
                <option value="<?=$project['zone'];?>"><?=$project['zone'];?></option>  
                <?php
                $zones = $db->getData("SELECT * FROM zone ORDER BY name");
                foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <label>Select Superintendent:</label><br>
            <select name="super">
                <option value="<?=$project['super_name'];?>"><?=$project['super_name'];?></option>
                <option value=""></option>  
                <?php
                $supers = $db->getData("SELECT * FROM super ORDER BY name");
                foreach ($supers as $super) {
                    echo "<option value='{$super['name']}'>{$super['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <label>Project Location: </label>
            <input id="location" type="text" name="location" required value="<?=$project['location'];?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
