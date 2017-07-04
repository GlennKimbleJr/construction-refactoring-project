<?php $this->layout('zone', ['title' => 'Edit a Zone']) ?>
<h3>
    EDIT Category | 
    <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> | 
    [ <a href="/zones/<?=$this->e($zone['id'])?>/delete"><font color="red">DELETE</font></a> ]
</h3>

<form action="/zones/<?=$this->e($zone['id'])?>" method="POST">
    <p>
        <label>Name: </label>
        <input id="id2" type="hidden" name="id2" required value="<?=$this->e($zone['id'])?>" />
        <input id="name" type="text" name="name" required value="<?=$this->e($zone['name'])?>" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Update" />
</form>
