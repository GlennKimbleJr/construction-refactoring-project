<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Categories Menu']) ?>
<center>
    <h1>CATEGORIES MENU</h1>
    
    <table width='620' cellspacing='1' cellpadding='5' border='0'>
        <tr>
            <td width='120' valign='top' align='center'>
                <font size='1'>
                <img src='images/categories.png' width='48' height='48'><br> 
                <a href='index.php'>back to home</a><br>
                <br>
                <a href='?new'>+ ADD NEW</a><br>
                <a href='?view'>VIEW LIST</a><br>
                </font>
            </td>
            <td width='40'>&nbsp;</td>
            <td width='660' valign='top' align='left'>
                <?=$this->section('content')?>
            </td>
        </tr>
    </table>
</center>