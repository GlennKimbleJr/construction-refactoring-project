<?php $this->layout('contact', ['title' => 'Add New Contact']) ?>

<form action="/contacts" method="POST">
    <div class="form-group">
        <label>Company: </label>
        <input class="form-control" id="company" type="text" name="company" required size='24'>
    </div>

    <div class="form-group">
        <label>Name: </label>

        <div class="form-row">
            <div class="col">
                <input class="form-control" id="first" type="text" name="first" placeholder="First Name" size='8'>
            </div>

            <div class="col">
                <input class="form-control" id="last" type="text" name="last" placeholder="Last Name"  size='14'>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Address: </label>
        <input class="form-control" id="street" type="text" name="street" placeholder="Street"><br>

        <div class="form-row">
            <div class="col">
                <input class="form-control" id="city" type="text" name="city" placeholder="City" size='10'>
            </div>

            <div class="col">
                <input class="form-control" id="state" type="text" name="state" placeholder="State" maxlenght='2' size='2'>
            </div>

            <div class="col">
                <input class="form-control" id="zip" type="text" name="zip" placeholder="Zip" maxlenght='5' size='5'>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Email Address: </label>
        <input class="form-control" id="email" type="text" name="email" required size='24'>
    </div>

    <div class="form-group">
        <label>Office Phone: </label>
        <input class="form-control" id="officephone" type="text" name="officephone">
    </div>

    <div class="form-group">
        <label>Cell Phone: </label>
        <input class="form-control" id="cellphone" type="text" name="cellphone">
    </div>

    <div class="form-group">
        <label>Fax Number: </label>
        <input class="form-control" id="fax" type="text" name="fax">
    </div>

    <div class="form-group">
        <label>
            Zone(s): | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a><br>
        </label><br>

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
    </div>

    <div class="form-group">
        <label>Category: </label>
        <select name="type" class="form-control">
            <?php foreach($categories as $cat): ?>
                <option value='<?=$this->e($cat['id'])?>'>
                    <?=$this->e($cat['name'])?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Create"><br>
</form>
<br>
