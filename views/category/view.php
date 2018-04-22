<?php $this->layout('category', ['title' => $title]) ?>

<a href='/categories/create' class="btn btn-sm btn-success">Add Category</a><br>
<br>

<table class="table table-striped table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category): ?>
        <tr>
            <td scope="row"><?=$this->e($category['name'])?></td>
            <td scope="row" class="text-right">
                <a href='/categories/<?=$this->e($category['id'])?>/edit' class="btn btn-sm btn-success">Edit</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
