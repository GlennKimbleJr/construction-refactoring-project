<?php $this->layout('contact', ['title' => 'Edit Contact']) ?>

<form action="/contacts/<?=$this->e($contact['id'])?>" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($contact['id'])?>" size='24'/>

    <div class="form-group">
        <label>Company: </label>
        <input class="form-control" id="company" type="text" name="company" required value="<?=$this->e($contact['company'])?>" size='24'/>
    </div>

    <div class="form-group">
        <label>Name: </label>

        <div class="form-row">
            <div class="col">
                <input class="form-control" id="first" type="text" name="first" value="<?=$this->e($contact['first'])?>" size='8'/>
            </div>

            <div class="col">
                <input class="form-control" id="last" type="text" name="last" value="<?=$this->e($contact['last'])?>"  size='14'/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Address: </label>
        <input class="form-control" id="street" type="text" name="street" value="<?=$this->e($contact['street'])?>" /><br>

        <div class="form-row">
            <div class="col">
                <input class="form-control" id="city" type="text" name="city" value="<?=$this->e($contact['city'])?>" size='10'/>
            </div>

            <div class="col">
                <input class="form-control" id="state" type="text" name="state" value="<?=$this->e($contact['state'])?>" maxlenght='2' size='2'/>
            </div>

            <div class="col">
                <input class="form-control" id="zip" type="text" name="zip" value="<?=$this->e($contact['zip'])?>" maxlenght='5' size='5'/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Email Address: </label>
        <input class="form-control" id="email" type="text" name="email" required value="<?=$this->e($contact['email'])?>" size='24'/>
    </div>

    <div class="form-group">
        <label>Office Phone: </label>
        <input class="form-control" id="officephone" type="text" name="officephone" value="<?=$this->e($contact['officephone'])?>" />
    </div>

    <div class="form-group">
        <label>Cell Phone: </label>
        <input class="form-control" id="cellphone" type="text" name="cellphone" value="<?=$this->e($contact['cellphone'])?>" />
    </div>

    <div class="form-group">
        <label>Fax Number: </label>
        <input class="form-control" id="fax" type="text" name="fax" value="<?=$this->e($contact['fax'])?>"/>
    </div>

    <div class="form-group">
        <label>Category: </label>
        <select class="form-control" name="type">
            <?php foreach($categories as $cat): ?>
                <option value='<?=$this->e($cat['id'])?>'
                    <?php if ($cat['id'] == $contact['category_id']): ?>
                    selected
                    <?php endif ?>
                ><?=$this->e($cat['name'])?></option>
            <?php endforeach ?>
        </select>
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Update">
    <a class="btn btn-danger" href="/contacts/<?=$this->e($contact['id'])?>/delete">Delete</a>
</form>
<br>
