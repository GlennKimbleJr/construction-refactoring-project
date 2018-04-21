<?php $this->layout('project', ['title' => $title]) ?>
    <?php if ($sort == 'open'): ?>
        view open projects -
        <a href='/projects/?s=all'><u>view all</u></a>
        | <a href='/projects/?s=closed'><u>closed only</u></a>
    <?php elseif ($sort == 'closed'): ?>
        view closed projects -
        <a href='/projects/?s=all'><u>view all</u></a>
        | <a href='/projects/?s=open'><u>open only</u></a>
    <?php else: ?>
        view all projects -
        <a href='/projects/?s=open'><u>open only</u></a>
        | <a href='/projects/?s=closed'><u>closed only</u></a>
    <?php endif ?>
    <hr>

<div id='pagenation'>

    <?php if (! count($projects)) : ?>
        Could not get data.
    <?php endif ?>

    <?php foreach($projects as $project): ?>
        <div class='z'>
            <a href='/projects/<?=$this->e($project['id'])?>'>
                <?=$this->e($project['name'])?>
            </a>
            - <?=$this->e($project['bidduedate'])?>
            | <a href='/projects/<?=$this->e($project['id'])?>/edit'>EDIT</a>
        </div>
    <?php endforeach ?>

</div><br>
<br>

<div id='pagingControls'></div>
