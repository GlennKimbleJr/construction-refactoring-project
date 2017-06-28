<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['id2'])) {

        $query = $db->setData(
            'UPDATE contacts SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, type = ?, company = ?, zip = ? WHERE id = ?', [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                trim($_POST['type']), 
                htmlspecialchars($_POST['company']), 
                trim($_POST['zip']), 
                intval($_POST['id2'])
            ]);

        $db->setData("DELETE FROM `contacts_zones` WHERE `contact_id` = ?", [
            intval($_POST['id2'])
        ]);

        if (isset($_POST['zone']) && is_array($_POST['zone'])) { foreach ($_POST['zone'] as $zone_id) {
            $db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", [
                intval($_POST['id2']), 
                $zone_id
            ]);
        }}

        die('<br><br>Updated!');
    }

    $contact = $db->getFirst('SELECT * FROM contacts WHERE id = ?', [
        intval($_GET['edit'])
    ]);

    $contactZones = $db->getData(
        'SELECT zone_id FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', 
        [intval($_GET['edit'])]
    );

    $contactZones = array_map(function($zone) {
        return $zone['zone_id'];
    }, $contactZones);

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
            <label>
                Zone(s): | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
            </label>

            <?php foreach ($zones as $zone) {
                echo "<span>";
                echo "<input type='checkbox' name='zone[]' id='zone_{$zone['id']}' value='{$zone['id']}'";
                if (in_array($zone['id'], $contactZones)) echo ' checked';
                echo ">{$zone['name']} ";
                echo "</span>";
            } ?>
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
