<?php $this->layout('project', ['title' => $title]) ?>
<h3><?=$headline?></h3>

<div id='pagenation'>

    <?php if (! count($projects)) : ?>
        Could not get data.
    <?php endif ?>

    <?php foreach($projects as $project): ?>
        <div class='z'>
            <a href='?details=<?=$this->e($project['id'])?>'>
                <?=$this->e($project['name'])?>
            </a> 
            - <?=$this->e($project['bidduedate'])?> 
            | <a href='?edit=1&project=<?=$this->e($project['id'])?>'>EDIT</a>
        </div>
    <?php endforeach ?>

</div><br>
<br>

<div id='pagingControls'></div>
