<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Error']) ?>

<h1>Error!</h1>

<?=$this->section('content')?>
