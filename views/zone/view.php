<?php $this->layout('zone', ['title' => 'Zones']) ?>

<a href='/zones/create' class="btn btn-sm btn-success">Add Zone</a><br>
<br>

<table class="table table-striped table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($zones as $zone): ?>
        <tr>
            <td scope="row"><?=$this->e($zone['name'])?></td>
            <td scope="row" class="text-right">
                <a href='/zones/<?=$this->e($zone['id'])?>/edit' class="btn btn-sm btn-success">Edit</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
