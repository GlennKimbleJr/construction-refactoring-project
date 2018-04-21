<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Categories']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-2 bg-light">
            <a href='/categories/create'>add new</a><br>
            <a href='/categories'>view list</a><br>
        </div>
        <div class="col-md-10">
            <?=$this->section('content')?>
        </div>
    </div>
</div>
