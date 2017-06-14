<?php

// Starts Script
if (isset($_GET['edit'])) {

    $did = $_GET['edit'];

    // checks to see if posted
    if (isset($_POST['id2'])) {
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

        $query = $db->setData(
            'UPDATE contact SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, zone = ?, type = ?, company = ?, zip = ?, zone2 = ?, zone3 = ?, zone4 = ?, zone5 = ?, zone6 = ?, zone7 = ?, zone8 = ?, zone9 = ? WHERE id = ?', 
            [$first, $last, $street, $city, $state, $email, $officephone, $cellphone, $fax, $zone, $type, $company, $zip, $zone2, $zone3, $zone4, $zone5, $zone6, $zone7, $zone8, $zone9, $id2]
        );

        if (! $db->updated($query)) {
            die('<br><br>Update Error');
        } else {
            die('<br><br>Updated!');
        }
    }

    $contact = $db->getFirst('SELECT * FROM contact WHERE id = ?', [$did]);

    $mid = $contact['id'];
    $mfirst = $contact['first'];
    $mlast = $contact['last'];
    $mstreet = $contact['street'];
    $mcity = $contact['city'];
    $mstate = $contact['state'];
    $mzone = $contact['zone'];
    $memail = $contact['email'];
    $mofficephone = $contact['officephone'];
    $mcellphone = $contact['cellphone'];
    $mfax = $contact['fax'];
    $mtype = $contact['type'];
    $mcompany = $contact['company'];
    $mzip = $contact['zip'];
    $mzone2 = $contact['zone2'];
    $mzone3 = $contact['zone3'];
    $mzone4 = $contact['zone4'];
    $mzone5 = $contact['zone5'];
    $mzone6 = $contact['zone6'];
    $mzone7 = $contact['zone7'];
    $mzone8 = $contact['zone8'];
    $mzone9 = $contact['zone9'];

    $zones = $db->getData('SELECT * FROM zone ORDER BY name');
    $categories = $db->getData('SELECT * FROM type ORDER BY name');

    ?>


    <h3>Edit Contact | [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]</h3>
    <form action="" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?php echo "$did" ?>" size='24'/>

        <p>
            <label>Company: </label>
            <input id="company" type="text" name="company" required value="<?php echo "$mcompany" ?>" size='24'/>
        </p>
        
        <p>
            <label>Name: </label>
            <input id="first" type="text" name="first" value="<?php echo "$mfirst" ?>" size='8'/>
            <input id="last" type="text" name="last" value="<?php echo "$mlast" ?>"  size='14'/>
        </p>
        
        <p>
            <label>Address: </label>
            <input id="street" type="text" name="street" value="<?php echo "$mstreet" ?>" />
            <input id="city" type="text" name="city" value="<?php echo "$mcity" ?>" size='10'/>
            <input id="state" type="text" name="state" value="<?php echo "$mstate" ?>" maxlenght='2' size='2'/>
            <input id="zip" type="text" name="zip" value="<?php echo "$mzip" ?>" maxlenght='5' size='5'/>
        </p>
        
        <p>
            <label>Email Address: </label>
            <input id="email" type="text" name="email" required value="<?php echo "$memail" ?>" size='24'/>
        </p>
        
        <p>
            <label>Office Phone: </label>
            <input id="officephone" type="text" name="officephone" value="<?php echo "$mofficephone" ?>" />
        </p>
        
        <p>
            <label>Cell Phone: </label>
            <input id="cellphone" type="text" name="cellphone" value="<?php echo "$mcellphone" ?>" />
        </p>
        
        <p>
            <label>Fax Number: </label>
            <input id="fax" type="text" name="fax" value="<?php echo "$mfax" ?>"/>
        </p>

        <p>
            <label>Zone: </label><b>( Choose up to 9 )</b> 
            | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a>
            <br>

            <select name="zone">    
                <option value="<?php echo "$mzone" ?>"><?php echo "$mzone" ?></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone2">   
                <option value="<?php echo "$mzone2" ?>"><?php echo "$mzone2" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone3">
                <option value="<?php echo "$mzone3" ?>"><?php echo "$mzone3" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <select name="zone4">
                <option value="<?php echo "$mzone4" ?>"><?php echo "$mzone4" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone5">
                <option value="<?php echo "$mzone5" ?>"><?php echo "$mzone5" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone6">
                <option value="<?php echo "$mzone6" ?>"><?php echo "$mzone6" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <select name="zone7">
                <option value="<?php echo "$mzone7" ?>"><?php echo "$mzone7" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone8">
                <option value="<?php echo "$mzone8" ?>"><?php echo "$mzone8" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone9">
                <option value="<?php echo "$mzone9" ?>"><?php echo "$mzone9" ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <label>Category: </label>
            <select name="type">
                <option value="<?php echo "$mtype" ?>"><?php echo "$mtype" ?></option>
                <?php foreach ($categories as $cat) {
                    echo "<option value='{$cat['name']}'>{$cat['name']}</option>";
                } ?>
            </select>
        </p>

        <input class="btn register" type="submit" name="submit" value="UPDATE" />
    </form>

    <?php
}
