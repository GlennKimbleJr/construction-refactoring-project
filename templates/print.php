<?php $this->layout('layout', ['title' => $title ])?>
<b>General Contractor:</b> Company Name. Contact Phone<br>
License # License.<br>
<br>
<b>Owner:</b> <?=$this->e($project['owner_name'])?> - <?=$this->e($project['owner_phone'])?><br>
<br>
<b>Superintendent:</b> <?=$this->e($project['super_name'])?> - <?=$this->e($project['super_phone'])?>

<h1><b><?=$this->e($_GET['name'])?></b></h1>

<table width='850' cellspacing='2' cellpadding='2' border='1'>
    <tr>
        <td width='350'><b>Division</b></td>
        <td width='250'><b>Company</b></td>
        <td width='125' align='center'><b>Office Phone</b></td>
        <td width='125' align='center'><b>Cell Phone</b></td>
    </tr>
</table>
    
<?php foreach($winners as $winner): ?>
<table width='850' cellspacing='2' cellpadding='2' border='1'>
    <tr>
        <td width='350'><?=$this->e($winner['category'])?></td>
        <td width='250'><b><?=$this->e($winner['company'])?></b></td>
        <td width='125' align='center'><?=$this->e($winner['officephone'])?></td>
        <td width='125' align='center'><?=$this->e($winner['cellphone'])?></td>
    </tr>
</table>
<?php endforeach ?>
