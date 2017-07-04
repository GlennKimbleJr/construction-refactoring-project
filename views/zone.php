<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Zone Menu']) ?>
<center>
    <h1>ZONE MENU</h1>
    
    <table width='620' cellspacing='1' cellpadding='5' border='0'>
        <tr>
            <td width='120' valign='top' align='center'>
                <font size='1'>
                <img src='/images/zone.png' width='48' height='48'><br> 
                <a href='/index'>back to home</a><br>
                <br>
                <a href='/zones/create'>+ ADD NEW</a><br>
                <a href='/zones'>VIEW LIST</a><br>
                </font>
            </td>
            <td width='40'>&nbsp;</td>
            <td width='660' valign='top' align='left'>
                <?=$this->section('content')?>
            </td>
        </tr>
    </table>
</center>