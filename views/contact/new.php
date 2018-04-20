<?php $this->layout('contact', ['title' => 'Add New Contact']) ?>

<form action="/contacts" method="POST">
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

        <?php foreach($zones as $zone): ?>
        <span>
            <input
                type='checkbox'
                name='zone[]'
                id='zone_<?=$this->e($zone['id'])?>'
                value='<?=$this->e($zone['id'])?>'
            > <?=$this->e($zone['name'])?>
        </span>
        <?php endforeach ?>
    </p>

    <p>
        <label>Category: </label>
        <select name="type">
            <?php foreach($categories as $cat): ?>
                <option value='<?=$this->e($cat['id'])?>'>
                    <?=$this->e($cat['name'])?>
                </option>
            <?php endforeach ?>
        </select>
    </p>

    <input class="btn btn-sm btn-success register" type="submit" name="submit" value="Create">
</form>
