<?php $this->layout('project', ['title' => $title]) ?>
<h3>
    <?php if ($sort == 'open'): ?>
        View Open Projects - 
        <a href='/projects/?s=all'><u>View All</u></a>
        | <a href='/projects/?s=closed'><u>Closed Only</u></a> 
    <?php elseif ($sort == 'closed'): ?>
        View Closed Projects - 
        <a href='/projects/?s=all'><u>View All</u></a>
        | <a href='/projects/?s=open'><u>Open Only</u></a> 
    <?php else: ?>
        View All Projects - 
        <a href='/projects/?s=open'><u>Open Only</u></a> 
        | <a href='/projects/?s=closed'><u>Closed Only</u></a>
    <?php endif ?>
</h3>

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
