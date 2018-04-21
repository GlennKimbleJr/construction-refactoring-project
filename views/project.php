<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Projects']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-2 bg-light">
            <a href='/projects/create'>add new</a><br>
            <a href='/projects'>view list</a><br>
        </div>
        <div class="col-md-10">
            <?=$this->section('content')?>
        </div>
    </div>
</div>
