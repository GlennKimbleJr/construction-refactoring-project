<?php $this->layout('report', ['title' => $title]) ?>
<h3>Bid %</h3>

<div id='pagenation'>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='35%'><font size='1'><b>company</b></font></td>
            <td align='center' width='15%'><font size='1'><b>city</b></font></td>
            <td align='center' width='10%'><font size='1'><b>state</b></font></td>
            <td align='center' width='30%'><font size='1'><b>type</b></font></td>
            <td align='center' width='10%'><font size='1'><b>bid %</b></font></td>
        </tr>
    
        <?php foreach($contacts as $contact): ?>
        <div class='z'>
            <tr>
                <td align='center' width='35%'>
                    <font size='1'><?=$this->e($contact['company'])?></font>
                </td>

                <td align='center' width='15%'>
                    <font size='1'><?=$this->e($contact['city'])?></font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'><?=$this->e($contact['state'])?></font>
                </td>
                
                <td align='center' width='30%'>
                    <font size='1'><?=$this->e($contact['type'])?></font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'><b><?=$this->e($contact['bid_per'])?> %</b></font>
                </td>
            </tr>
        </div>
        <?php endforeach ?>

    </table>
</div><br>
<br>
    
<div id='pagingControls'></div>