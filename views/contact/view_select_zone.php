<?php $this->layout('contact', ['title' => 'Select a Zone']) ?>
<h3>SELECT A ZONE</h3>

<?php foreach($zones as $zone): ?>
<a href='?z=<?=$this->e($zone['id'])?>'>
    <?=$this->e($zone['name'])?>
</a><br>
<?php endforeach ?>