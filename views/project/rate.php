<?php $this->layout('project', ['title' => $title]) ?>
<b> [ <a href='/projects/<?=$this->e($projectId)?>'>GO BACK</a> ]</b><br><br>

<b>How would you rate <?=$this->e($company)?>'s preformance on this project?</b>
<br><br>

<form method='post' action='/bidders/<?=$this->e($bidder)?>/rate'>
    <input type='hidden' name='rating' id='rating' value='5'>
    <button type="submit" id='happy'>
        <img src='images/happy.png' border='0'>
    </button>
</form>

<form method='post' action='/bidders/<?=$this->e($bidder)?>/rate'>
    <input type='hidden' name='rating' id='rating' value='4'>
    <button type="submit" id='good'>
        <img src='images/good.png' border='0'>
    </button>
</form>

<form method='post' action='/bidders/<?=$this->e($bidder)?>/rate'>
    <input type='hidden' name='rating' id='rating' value='3'>
    <button type="submit" id='ok'>
        <img src='images/ok.png' border='0'>
    </button>
</form>

<form method='post' action='/bidders/<?=$this->e($bidder)?>/rate'>
    <input type='hidden' name='rating' id='rating' value='2'>
    <button type="submit" id='bad'>
        <img src='images/bad.png' border='0'>
    </button>
</form>

<form method='post' action='/bidders/<?=$this->e($bidder)?>/rate'>
    <input type='hidden' name='rating' id='rating' value='1'>
    <button type="submit" id='angry'>
        <img src='images/angry.png' border='0'>
    </button>
</form>