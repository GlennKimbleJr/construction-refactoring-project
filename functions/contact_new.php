<?php

if (isset($_GET['new'])) {

    if (isset($_POST['company'])) {

        $query = $db->setData(
            "INSERT INTO `contacts` (`first`, `last`, `street`, `city`, `state`, `zone`, `email`, `officephone`, `cellphone`, `fax`, `type`, `company`, `zip`, `zone2`, `zone3`, `zone4`, `zone5`, `zone6`, `zone7`, `zone8`, `zone9`, `score_per`, `bid_per`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['zone']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                trim($_POST['type']), 
                htmlspecialchars($_POST['company']), 
                trim($_POST['zip']), 
                trim($_POST['zone2']), 
                trim($_POST['zone3']), 
                trim($_POST['zone4']), 
                trim($_POST['zone5']), 
                trim($_POST['zone6']), 
                trim($_POST['zone7']), 
                trim($_POST['zone8']), 
                trim($_POST['zone9']), 
                '0', 
                '0'
            ]);

        die($db->updated($query) ? '<br><br>Contact Added!' : '<br><br>Error! Unable to create contact.');
    }

    $zones = $db->getData('SELECT * FROM zone ORDER BY name');
    $categories = $db->getData('SELECT * FROM type ORDER BY name');
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
                Zone: <b>Choose up to 9</b> | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
            </label>

            <select name="zone">
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone2">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone3">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

        </p>


        <p>
            <select name="zone4">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone5">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone6">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

        </p>
        
        <p>
            <select name="zone7">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone8">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone9">
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

        </p>

        <p>
            <label>Category: </label>
            <select name="type">    
                <?php foreach ($categories as $cat) {
                    echo "<option value='{$cat['name']}'>{$cat['name']}</option>";
                } ?>
            </select>
        </p>

        <input class="btn register" type="submit" name="submit" value="Create">
    </form>
    <?php
}
