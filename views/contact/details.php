<?php $this->layout('contact', ['title' => 'View Contact']) ?>
<u><b><?=$this->e($contact['company'])?></b></u>&nbsp;&nbsp;&nbsp; <?=$this->e($contact['type'])?>. |
<a href='/contacts/<?=$this->e($contact['id'])?>/edit'><font color='red'>EDIT</font></a><br>
<br>

<?=$this->e($contact['first']) . ' ' . $this->e($contact['last'])?><br>
<?=$this->e($contact['street'])?>.
<?=$this->e($contact['city'])?>, <?=$this->e($contact['state'])?>. <?=$this->e($contact['zip'])?><br>
<br>

<table width='400'>
    <tr>
        <td width='33'>Cell:<br> <?=$this->e($contact['cellphone'])?></td>
        <td width='33'>Office:<br> <?=$this->e($contact['officephone'])?></td>
        <td width='33'>Fax:<br> <?=$this->e($contact['fax'])?></td>
    </tr>
</table>
<br>

<a href='mailto:<?=$this->e($contact['email'])?>'>
    <?=$this->e($contact['email'])?>
</a>
