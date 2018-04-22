<?php $this->layout('super', ['title' => $title]) ?>

<a href='/superintendents/create' class="btn btn-sm btn-success">Add Employee</a><br>
<br>

<table class="table table-striped table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($supers as $super): ?>
        <tr>
            <td scope="row"><?=$this->e($super['name'])?></td>
            <td scope="row"><?=$this->e($super['phone'])?></td>
            <td scope="row" class="text-right">
                <a href='/superintendents/<?=$this->e($super['id'])?>/edit' class="btn btn-sm btn-success">Edit</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
