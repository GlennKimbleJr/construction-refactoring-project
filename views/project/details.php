<?php $this->layout('project', ['title' => $title]) ?>
<b><?=$this->e($project['name'])?></b> | 
<b><a href='/projects/<?=$this->e($projectId)?>/edit'>
    <font color='red'>EDIT</font>
</a></b><br>

<u><?=$this->e($project['plans'])?></u><br>
<?=$this->e($project['planuser'])?> | <?=$this->e($project['planpass'])?><br>
<br>

<u><a href='' rel='imgtip[0]'>Zone:</a></u> <?=$this->e($project['zone_name'])?> - <?=$this->e($project['location'])?><br>
<u>Bid Due By:</u> <?=$this->e($project['bidduedate'])?><br>
<u>Date Completed:</u>

<?php if ($project['completedate'] == ''): ?>
    <font size='1'><a href='/projects/<?=$this->e($projectId)?>/complete'>
        <u><b>MARK AS COMPLETE</b></u></a>
    </font><br>
    <br>
<?php else: ?>
    <?=$this->e($project['completedate'])?><br>
    <br>
<?php endif ?>

<b><u>[ <a href='/projects/<?=$this->e($projectId)?>/calllog' target='_new'>CALL LOG</a> ]</u></b><br>
<br>
<b>[ <a href='/projects/<?=$this->e($projectId)?>/categories'>CHOOSE SUB-CONTRACTORS TO BID</a> ]</b><br>

<b>Current:</b><br>
<font size='1'>
<?php foreach($bidders as $bidder): ?>
    <?php if ($bidder['status'] == 'will'): ?>
        &nbsp;&nbsp;<?=$this->e($bidder['category_name'])?> - <b><?=$this->e($bidder['company'])?></b> | 
        <a href='mailto:<?=$this->e($bidder['email'])?>?subject=Invitation to Bid&body=COMPANY NAME%0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A<?=$this->e($bidder['company'])?>%0D%0A%0D%0APROJECT NAME: <?=$this->e($project['name'])?>%0D%0APROJECT LOCATION: <?=$this->e($project['location'])?>%0D%0ABID DATE: <?=$this->e($project['bidduedate'])?>%0D%0A%0D%0APlans and Specs%0D%0A <?=$this->e($project['plans'])?> %0D%0AUser: <?=$this->e($project['planuser'])?> | Pass: <?=$this->e($project['planpass'])?>%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICENSE'>EMAIL BID INVITE</a> 

            | <b>[ <u><a href='/bidders/<?=$this->e($bidder['id'])?>/winner'>CHOOSE AS WINNER</a></u> ]</b><br>
    <?php else: ?>
        &nbsp;&nbsp;<?=$this->e($bidder['category_name'])?> - <b><?=$this->e($bidder['company'])?></b> | <a href='mailto:<?=$this->e($bidder['email'])?>?subject=Invitation to Bid&body=COMPANY NAME %0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A<?=$this->e($bidder['company'])?>%0D%0A%0D%0APROJECT NAME: <?=$this->e($project['name'])?>%0D%0APROJECT LOCATION: <?=$this->e($project['location'])?>%0D%0ABID DATE: <?=$this->e($project['bidduedate'])?>%0D%0A%0D%0APlans and Specs%0D%0A <?=$this->e($project['plans'])?>%0D%0AUser: <?=$this->e($project['planusers'])?> | Pass: <?=$this->e($project['planpass'])?>%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICSNE '>EMAIL BID INVITE</a> 

            | <b>Set Status:</b> 
            <form method="POST" action="/bidders/<?=$this->e($bidder['id'])?>/status">
                <input type="hidden" name="status" id="status" value="yes">
                <button type="submit">will bid</button>
            </form>

            <form method="POST" action="/bidders/<?=$this->e($bidder['id'])?>/status">
                <input type="hidden" name="status" id="status" value="no">
                <button type="submit">won't bid</button>
            </form>

            <br>
    <?php endif ?>
<?php endforeach ?>

<?php if (! count($bidders)): ?>
    &nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>
<?php endif ?>

    <br>
    <br>
    <b>WINNING SUB CONTRACTORS</b>:

    <?php foreach($winners as $winner): ?>
        <br><br>&nbsp;&nbsp;<b><?=$this->e($winner['category'])?></b> - <u><?=$this->e($winner['company'])?></u> | <a href='mailto:<?=$this->e($winner['email'])?>'>EMAIL</a>

        <?php if ($winner['score'] == 'NA'): ?>
            &nbsp;&nbsp;<u>[ <a href='/bidders/<?=$this->e($winner['id'])?>/rate'>SCORE</a> ]</u>
        <?php endif ?>
    <?php endforeach ?>

    <?php if (! count($winners)): ?>
        &nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i>
    <?php endif ?>
</font>