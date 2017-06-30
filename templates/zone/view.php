<?php $this->layout('zone', ['title' => 'View Zones']) ?>

<h3>View All zone | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></h3>

<div id='pagenation'>";

    <?php foreach($zones as $zone): ?>
        <div class='z'>
            <a href='?edit=<?=$this->e($zone['id'])?>'>
                <?=$this->e($zone['name'])?>
            </a>
        </div>
    <?php endforeach ?>

</div><br>
<br>

<div id='pagingControls'></div>