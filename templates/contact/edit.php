<?php $this->layout('contact', ['title' => 'Edit Contact']) ?>
<h3>
    Edit Contact | 
    [ <a href="?delete=<?=$this->e($contact['id'])?>"><font color="red">DELETE</font></a> ]
</h3>

<form action="" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($contact['id'])?>" size='24'/>

    <p>
        <label>Company: </label>
        <input id="company" type="text" name="company" required value="<?=$this->e($contact['company'])?>" size='24'/>
    </p>
    
    <p>
        <label>Name: </label>
        <input id="first" type="text" name="first" value="<?=$this->e($contact['first'])?>" size='8'/>
        <input id="last" type="text" name="last" value="<?=$this->e($contact['last'])?>"  size='14'/>
    </p>
    
    <p>
        <label>Address: </label>
        <input id="street" type="text" name="street" value="<?=$this->e($contact['street'])?>" />
        <input id="city" type="text" name="city" value="<?=$this->e($contact['city'])?>" size='10'/>
        <input id="state" type="text" name="state" value="<?=$this->e($contact['state'])?>" maxlenght='2' size='2'/>
        <input id="zip" type="text" name="zip" value="<?=$this->e($contact['zip'])?>" maxlenght='5' size='5'/>
    </p>
    
    <p>
        <label>Email Address: </label>
        <input id="email" type="text" name="email" required value="<?=$this->e($contact['email'])?>" size='24'/>
    </p>
    
    <p>
        <label>Office Phone: </label>
        <input id="officephone" type="text" name="officephone" value="<?=$this->e($contact['officephone'])?>" />
    </p>
    
    <p>
        <label>Cell Phone: </label>
        <input id="cellphone" type="text" name="cellphone" value="<?=$this->e($contact['cellphone'])?>" />
    </p>
    
    <p>
        <label>Fax Number: </label>
        <input id="fax" type="text" name="fax" value="<?=$this->e($contact['fax'])?>"/>
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
                    <?php if (in_array($zone['id'], $contactZones)): ?> 
                    checked
                    <?php endif ?>
                    ><?=$this->e($zone['name'])?>
            </span>
        <?php endforeach ?>
    </p>

    <p>
        <label>Category: </label>
        <select name="type">
            <?php foreach($categories as $cat): ?>
                <option value='<?=$this->e($cat['id'])?>'
                    <?php if ($cat['id'] == $contact['category_id']): ?>
                    selected
                    <?php endif ?>
                ><?=$this->e($cat['name'])?></option>
            <?php endforeach ?>
        </select>
    </p>

    <input class="btn register" type="submit" name="submit" value="UPDATE" />
</form>