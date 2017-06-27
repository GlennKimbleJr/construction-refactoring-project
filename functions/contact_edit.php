<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['id2'])) {

        $query = $db->setData(
            'UPDATE contacts SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, zone = ?, type = ?, company = ?, zip = ?, zone2 = ?, zone3 = ?, zone4 = ?, zone5 = ?, zone6 = ?, zone7 = ?, zone8 = ?, zone9 = ? WHERE id = ?', [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                trim($_POST['zone']), 
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
                intval($_POST['id2'])
            ]);

        die($db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error');
    }

    $contact = $db->getFirst('SELECT * FROM contacts WHERE id = ?', [
        intval($_GET['edit'])
    ]);

    if (empty($contact)) {
        die('Error: Unable to find data.');
    }

    $zones = $db->getData('SELECT * FROM zones ORDER BY name');
    $categories = $db->getData('SELECT * FROM categories ORDER BY name');

    ?>

    <h3>Edit Contact | [ <a href="?delete=<?= $contact['id'] ?>"><font color="red">DELETE</font></a> ]</h3>
    <form action="" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?= $contact['id'] ?>" size='24'/>

        <p>
            <label>Company: </label>
            <input id="company" type="text" name="company" required value="<?= $contact['company'] ?>" size='24'/>
        </p>
        
        <p>
            <label>Name: </label>
            <input id="first" type="text" name="first" value="<?= $contact['first'] ?>" size='8'/>
            <input id="last" type="text" name="last" value="<?= $contact['last'] ?>"  size='14'/>
        </p>
        
        <p>
            <label>Address: </label>
            <input id="street" type="text" name="street" value="<?= $contact['street'] ?>" />
            <input id="city" type="text" name="city" value="<?= $contact['city'] ?>" size='10'/>
            <input id="state" type="text" name="state" value="<?= $contact['state'] ?>" maxlenght='2' size='2'/>
            <input id="zip" type="text" name="zip" value="<?= $contact['zip'] ?>" maxlenght='5' size='5'/>
        </p>
        
        <p>
            <label>Email Address: </label>
            <input id="email" type="text" name="email" required value="<?= $contact['email'] ?>" size='24'/>
        </p>
        
        <p>
            <label>Office Phone: </label>
            <input id="officephone" type="text" name="officephone" value="<?= $contact['officephone'] ?>" />
        </p>
        
        <p>
            <label>Cell Phone: </label>
            <input id="cellphone" type="text" name="cellphone" value="<?= $contact['cellphone'] ?>" />
        </p>
        
        <p>
            <label>Fax Number: </label>
            <input id="fax" type="text" name="fax" value="<?= $contact['fax'] ?>"/>
        </p>

        <p>
            <label>Zone: </label><b>( Choose up to 9 )</b> 
            | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a>
            <br>

            <select name="zone">    
                <option value="<?= $contact['zone'] ?>"><?= $contact['zone'] ?></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone2">   
                <option value="<?= $contact['zone2'] ?>"><?= $contact['zone2'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone3">
                <option value="<?= $contact['zone3'] ?>"><?= $contact['zone3'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <select name="zone4">
                <option value="<?= $contact['zone4'] ?>"><?= $contact['zone4'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone5">
                <option value="<?= $contact['zone5'] ?>"><?= $contact['zone5'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone6">
                <option value="<?= $contact['zone6'] ?>"><?= $contact['zone6'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <select name="zone7">
                <option value="<?= $contact['zone7'] ?>"><?= $contact['zone7'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone8">
                <option value="<?= $contact['zone8'] ?>"><?= $contact['zone8'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>

            <select name="zone9">
                <option value="<?= $contact['zone9'] ?>"><?= $contact['zone9'] ?></option>
                <option value=""></option>
                <?php foreach ($zones as $zone) {
                    echo "<option value='{$zone['name']}'>{$zone['name']}</option>";
                } ?>
            </select>
        </p>

        <p>
            <label>Category: </label>
            <select name="type">
                <option value="<?= $contact['type'] ?>"><?= $contact['type'] ?></option>
                <?php foreach ($categories as $cat) {
                    echo "<option value='{$cat['name']}'>{$cat['name']}</option>";
                } ?>
            </select>
        </p>

        <input class="btn register" type="submit" name="submit" value="UPDATE" />
    </form>

    <?php
}
