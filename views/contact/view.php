<?php $this->layout('contact') ?>
<div class="row">
    <div class="col">
        <a href='/contacts/create' class="btn btn-sm btn-success">Add Contact</a>
    </div>
    <div class="col text-right">
            view by:
            <a href='/contacts/categories'>division</a>
    </div>
</div>
<br>

<table class="table table-striped table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col"><a href='?s=company'>Company</a></th>
            <th scope="col"><a href='?s=first'>First Name</a></th>
            <th scope="col"><a href='?s=last'>Last Name</a></th>
            <th scope="col"><a href='?s=city'>City</a></th>
            <th scope="col"><a href='?s=state'>State</a></th>
            <th scope="col"><a href='?s=type'>Type</a></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($contacts as $contact): ?>
        <tr>
            <td scope="row"><?=$this->e($contact['company'])?></td>
            <td scope="row"><?=$this->e($contact['first'])?></td>
            <td scope="row"><?=$this->e($contact['last'])?></td>
            <td scope="row"><?=$this->e($contact['city'])?></td>
            <td scope="row"><?=$this->e($contact['state'])?></td>
            <td scope="row"><?=$this->e($contact['type'])?></td>
            <td scope="row" class="text-right">
                <a href='/contacts/<?=$this->e($contact['id'])?>' class="btn btn-sm btn-primary">View</a>
                <a href='/contacts/<?=$this->e($contact['id'])?>/edit' class="btn btn-sm btn-success">Edit</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<br>
