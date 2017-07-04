<?php $this->layout('layout', ['title' => isset($title) ? $title : 'Error']) ?>
<center>
    <h1>Error!</h1>
    
    <table width='620' cellspacing='1' cellpadding='5' border='0'>
        <tr>
            <td width='120' valign='top' align='center'>
                <font size='1'>
                    <a href='/index'>back to home</a><br>
                    <br>
                </font>
            </td>
            <td width='40'>&nbsp;</td>
            <td width='660' valign='top' align='left'>
                <?=$this->section('content')?>
            </td>
        </tr>
    </table>
</center>