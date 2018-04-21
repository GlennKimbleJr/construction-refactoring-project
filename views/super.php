<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Superintendents']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-2 bg-light">
            <a href='/superintendents/create'>add new</a><br>
            <a href='/superintendents'>view list</a><br>
        </div>
        <div class="col-md-10">
            <?=$this->section('content')?>
        </div>
    </div>
</div>
