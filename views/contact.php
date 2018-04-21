<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Contacts']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-2 bg-light">
            <a href='/contacts/create'>add new</a><br>
            <a href='/contacts'>view list</a><br>
            <br>
            <a href='/contacts/categories'>by type</a><br>
            <a href='/contacts/zones'>by zone</a><br>
        </div>
        <div class="col-md-10">
            <?=$this->section('content')?>
        </div>
    </div>
</div>
