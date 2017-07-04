<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Contact Menu']) ?>
<center>
    <h1>CONTACT MENU</h1>
    
    <table width='620' cellspacing='1' cellpadding='5' border='0'>
        <tr>
            <td width='120' valign='top' align='center'>
                <font size='1'>
                <img src='/images/contact.png' width='48' height='48'><br> 
                <a href='/index'>back to home</a><br>
                <br>
                <a href='/contacts/create'>+ ADD NEW</a><br>
                <a href='/contacts'>VIEW LIST</a><br>
                <br>
                <a href='/contacts/categories'>BY TYPE</a><br>
                <a href='/contacts/zones'>BY ZONE</a><br>
                <br>
                <a href='/superintendents'>Superintendent</a><br>
                </font>
            </td>
            <td width='40'>&nbsp;</td>
            <td width='660' valign='top' align='left'>
                <?=$this->section('content')?>
            </td>
        </tr>
    </table>
</center>