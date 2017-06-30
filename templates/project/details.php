<?php $this->layout('project', ['title' => $title]) ?>
<b><?=$this->e($project['name'])?></b> | 
<b><a href='?edit=1&project=<?=$this->e($projectId)?>'>
    <font color='red'>EDIT</font>
</a></b><br>

<u><?=$this->e($project['plans'])?></u><br>
<?=$this->e($project['planuser'])?> | <?=$this->e($project['planpass'])?><br>
<br>

<u><a href='' rel='imgtip[0]'>Zone:</a></u> <?=$this->e($project['zone_name'])?> - <?=$this->e($project['location'])?><br>
<u>Bid Due By:</u> <?=$this->e($project['bidduedate'])?><br>
<u>Date Completed:</u>

<?php if ($project['completedate'] == ''): ?>
    <font size='1'><a href='?complete=1&project=<?=$this->e($projectId)?>'>
        <u><b>MARK AS COMPLETE</b></u></a>
    </font><br>
    <br>
<?php else: ?>
    <?=$this->e($project['completedate'])?><br>
    <br>
<?php endif ?>

<b><u>[ <a href='print.php?print=<?=$this->e($projectId)?>&name=<?=$this->e($project['name'])?>' target='_new'>CALL LOG</a> ]</u></b><br>
<br>
<b>[ <a href='?choose=<?=$this->e($projectId)?>'>CHOOSE SUB-CONTRACTORS TO BID</a> ]</b><br>

<b>Current:</b><br>
<font size='1'>
<?php foreach($bidders as $bidder): ?>
    <?php if ($bidder['status'] == 'will'): ?>
        &nbsp;&nbsp;<?=$this->e($bidder['category_name'])?> - <b><?=$this->e($bidder['company'])?></b> | 
        <a href='mailto:<?=$this->e($bidder['email'])?>?subject=Invitation to Bid&body=COMPANY NAME%0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A<?=$this->e($bidder['company'])?>%0D%0A%0D%0APROJECT NAME: <?=$this->e($project['name'])?>%0D%0APROJECT LOCATION: <?=$this->e($project['location'])?>%0D%0ABID DATE: <?=$this->e($project['bidduedate'])?>%0D%0A%0D%0APlans and Specs%0D%0A <?=$this->e($project['plans'])?> %0D%0AUser: <?=$this->e($project['planuser'])?> | Pass: <?=$this->e($project['planpass'])?>%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICENSE'>EMAIL BID INVITE</a> 

            | <b>[ <u><a href='?win=1&project=<?=$this->e($projectId)?>&company=<?=$this->e($bidder['company'])?>&category=<?=$this->e($bidder['category_id'])?>&bidder=<?=$this->e($bidder['id'])?>'>CHOOSE AS WINNER</a></u> ]</b><br>
    <?php else: ?>
        &nbsp;&nbsp;<?=$this->e($bidder['category_name'])?> - <b><?=$this->e($bidder['company'])?></b> | <a href='mailto:<?=$this->e($bidder['email'])?>?subject=Invitation to Bid&body=COMPANY NAME %0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A<?=$this->e($bidder['company'])?>%0D%0A%0D%0APROJECT NAME: <?=$this->e($project['name'])?>%0D%0APROJECT LOCATION: <?=$this->e($project['location'])?>%0D%0ABID DATE: <?=$this->e($project['bidduedate'])?>%0D%0A%0D%0APlans and Specs%0D%0A <?=$this->e($project['plans'])?>%0D%0AUser: <?=$this->e($project['planusers'])?> | Pass: <?=$this->e($project['planpass'])?>%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICSNE '>EMAIL BID INVITE</a> 

            | <b>Set Status:</b> <a href='?status=yes&id=<?=$this->e($projectId)?>&a=<?=$this->e($bidder['id'])?>'>will bid</a> - <a href='?status=no&id=<?=$this->e($projectId)?>&a=<?=$this->e($bidder['id'])?>'>won't bid</a><br>
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
            &nbsp;&nbsp;<u>[ <a href='?score=1&bidder=<?=$this->e($winner['id'])?>&company=<?=$this->e($winner['company'])?>&project=<?=$this->e($projectId)?>'>SCORE</a> ]</u>
        <?php endif ?>
    <?php endforeach ?>

    <?php if (! count($winners)): ?>
        &nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i>
    <?php endif ?>
</font>