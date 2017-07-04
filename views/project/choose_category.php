<?php $this->layout('project', ['title' => $title]) ?>
<b>[ <a href='/projects/<?=$this->e($projectId)?>'>GO BACK</a> ]</b><br>
<br>
<b>CHOOSE A CATEGORY</b><br>
<br>
<?php foreach($categories as $category): ?>
    <br>
    <b><u>
        <a href='/projects/<?=$this->e($projectId)?>/categories/<?=$this->e($category['id'])?>/bidders'>
            <?=$this->e($category['name'])?>
        </a>
    </u></b><br>

    <?php foreach($category['bidders'] as $bidder): ?>
        &nbsp;&nbsp;&nbsp;&nbsp;- <?=$this->e($bidder['company'])?><br>
    <?php endforeach ?>

    <?php if (! count($category['bidders'])): ?>
        echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>"; 
    <?php endif ?>

<?php endforeach ?>