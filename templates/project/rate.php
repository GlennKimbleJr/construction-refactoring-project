<?php $this->layout('project', ['title' => $title]) ?>
<b> [ <a href='?details=<?=$this->e($projectId)?>'>GO BACK</a> ]</b><br><br>

<b>How would you rate <?=$this->e($company)?>'s preformance on this project?</b>
<br><br>

<a href='?score2=1&bidder=<?=$this->e($bidder)?>&rating=5&project=<?=$this->e($projectId)?>' id='happy'>
    <img src='images/happy.png' border='0'>
</a> 

<a href='?score2=1&bidder=<?=$this->e($bidder)?>&rating=4&project=<?=$this->e($projectId)?>' id='good'>
    <img src='images/good.png' border='0'>
</a> 

<a href='?score2=1&bidder=<?=$this->e($bidder)?>&rating=3&project=<?=$this->e($projectId)?>' id='ok'>
    <img src='images/ok.png' border='0'>
</a> 

<a href='?score2=1&bidder=<?=$this->e($bidder)?>&rating=2&project=<?=$this->e($projectId)?>' id='bad'>
    <img src='images/bad.png' border='0'>
</a> 

<a href='?score2=1&bidder=<?=$this->e($bidder)?>&rating=1&project=<?=$this->e($projectId)?>' id='angry'>
    <img src='images/angry.png' border='0'>
</a>"