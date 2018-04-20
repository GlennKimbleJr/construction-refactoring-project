<?php $this->layout('contact') ?>

<table width='100%' cellspacing='1' cellpadding='1' border='1'>
    <tr>
        <td align='center' width='25%'><font size='1'><a href='?s=company'><b>company</b></a></font></td>
        <td align='center' width='14%'><font size='1'><a href='?s=first'><b>first</b></a></font></td>
        <td align='center' width='14%'><font size='1'><a href='?s=last'><b>last</b></a></font></td>
        <td align='center' width='14%'><font size='1'><a href='?s=city'><b>city</b></a></font></td>
        <td align='center' width='6%'><font size='1'><a href='?s=state'><b>state</b></a></font></td>
        <td align='center' width='17%'><font size='1'><a href='?s=type'><b>type</b></a></font></td>
        <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
    </tr>
</table>

<div id='pagenation'>
    <?php foreach($contacts as $contact): ?>
    <div class='z'>
        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><font size='1'>
                    <a href='/contacts/<?=$this->e($contact['id'])?>'><?=$this->e($contact['company'])?></a>
                </font></td>
                <td align='center' width='14%'><font size='1'><?=$this->e($contact['first'])?></font></td>
                <td align='center' width='14%'><font size='1'><?=$this->e($contact['last'])?></font></td>
                <td align='center' width='14%'><font size='1'><?=$this->e($contact['city'])?></font></td>
                <td align='center' width='6%'><font size='1'><?=$this->e($contact['state'])?></font></td>
                <td align='center' width='17%'><font size='1'><?=$this->e($contact['type'])?></font></td>
                <td align='center' width='10%'><font size='1'>
                    <a href='/contacts/<?=$this->e($contact['id'])?>/edit'>EDIT</a>
                </font></td>
            </tr>
        </table>
    </div>
    <?php endforeach ?>
</div><br>
<br>

<div id='pagingControls'></div>
