<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a super intendants\'s details');

$super = $I->create('supers');

$I->amOnPage('/super.php?view');
$I->see($super->name);
$I->see($super->phone);
$I->click($super->name);

$I->see('EDIT Superintendent');
$I->seeInField(['id' => 'name'], $super->name);
$I->seeInField(['id' => 'phone'], $super->phone);

$I->fillField(['id' => 'name'], $super->name = 'New Name');
$I->fillField(['id' => 'phone'], $super->phone = '111-111-1111');
$I->click('Update');
$I->see('Updated!');

$I->click('VIEW LIST');
$I->see($super->name);
$I->see($super->phone);
$I->click($super->name);

$I->see('EDIT Superintendent');
$I->seeInField(['id' => 'name'], $super->name);
$I->seeInField(['id' => 'phone'], $super->phone);
