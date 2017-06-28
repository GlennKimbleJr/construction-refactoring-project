<?php

if (isset($_GET['new'])) {

    if (isset($_POST['company'])) {

        $query = $db->setData(
            "INSERT INTO `contacts` (`first`, `last`, `street`, `city`, `state`, `email`, `officephone`, `cellphone`, `fax`, `category_id`, `company`, `zip`, `score_per`, `bid_per`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                intval($_POST['type']), 
                htmlspecialchars($_POST['company']), 
                trim($_POST['zip']), 
                '0', 
                '0'
            ]);

        if ($db->updated($query)) {
            if (isset($_POST['zone']) && is_array($_POST['zone'])) { 
                $contact_id = $db->getID();
                
                foreach ($_POST['zone'] as $zone_id) {
                    $db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", [
                        $contact_id, 
                        $zone_id
                    ]);
                }
            }

            die('<br><br>Contact Added!');
        } 

        else {
            die('<br><br>Error! Unable to create contact.');
        }
    }

    $zones = $db->getData('SELECT * FROM zones ORDER BY name');
    $categories = $db->getData('SELECT * FROM categories ORDER BY name');
    ?>

    <h3>New Contact</h3>
    <form action="" method="POST">
        <p>
            <label>Company: </label>
            <input id="company" type="text" name="company" required size='24'>
        </p>
        
        <p>
            <label>Name: </label>
            <input id="first" type="text" name="first" placeholder="First Name" size='8'>
            <input id="last" type="text" name="last" placeholder="Last Name"  size='14'>
        </p>
        
        <p>
            <label>Address: </label>
            <input id="street" type="text" name="street" placeholder="Street">
            <input id="city" type="text" name="city" placeholder="City" size='10'>
            <input id="state" type="text" name="state" placeholder="State" maxlenght='2' size='2'>
            <input id="zip" type="text" name="zip" placeholder="Zip" maxlenght='5' size='5'>
        </p>
        
        <p>
            <label>Email Address: </label>
            <input id="email" type="text" name="email" required size='24'>
        </p>
        
        <p>
            <label>Office Phone: </label>
            <input id="officephone" type="text" name="officephone">
        </p>
        
        <p>
            <label>Cell Phone: </label>
            <input id="cellphone" type="text" name="cellphone">
        </p>
        
        <p>
            <label>Fax Number: </label>
            <input id="fax" type="text" name="fax">
        </p>

        <p>
            <label>
                Zone(s): | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
            </label>

            <?php foreach ($zones as $zone) {
                echo "<span>
                    <input type='checkbox' name='zone[]' id='zone_{$zone['id']}' value='{$zone['id']}'>{$zone['name']} 
                </span>";
            } ?>
        </p>

        <p>
            <label>Category: </label>
            <select name="type">    
                <?php foreach ($categories as $cat) {
                    echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                } ?>
            </select>
        </p>

        <input class="btn register" type="submit" name="submit" value="Create">
    </form>
    <?php
}
