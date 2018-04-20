<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Categories']) ?>

<table width='100%' cellspacing='1' cellpadding='5' border='0'>
    <tr>
        <td width='120' valign='top' align='center'>
            <a href='/categories/create'>+ ADD NEW</a><br>
            <a href='/categories'>VIEW LIST</a><br>
        </td>
        <td width='40'>&nbsp;</td>
        <td width='660' valign='top' align='left'>
            <?=$this->section('content')?>
        </td>
    </tr>
</table>
