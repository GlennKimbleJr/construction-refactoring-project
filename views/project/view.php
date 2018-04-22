<?php $this->layout('project', ['title' => $title]) ?>

<div class="row">
    <div class="col">
        <a href='/projects/create' class="btn btn-sm btn-success">Add Project</a>
    </div>
    <div class="col text-right">
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
    </div>
</div>
<br>

<table class="table table-striped table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Project Name</th>
            <th scope="col">Bid Due By</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php if (! count($projects)) : ?>
        <tr>
            <td colspan="3" class="text-center">Could not get data.</td>
        </tr>
    <?php endif ?>

    <?php foreach($projects as $project): ?>
        <tr>
            <td scope="row"><?=$this->e($project['name'])?></td>
            <td scope="row"><?=$this->e($project['bidduedate'])?></td>
            <td scope="row" class="text-right">
                <a href='/projects/<?=$this->e($project['id'])?>' class="btn btn-sm btn-primary">View</a>
                <a href='/projects/<?=$this->e($project['id'])?>/edit' class="btn btn-sm btn-success">Edit</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
