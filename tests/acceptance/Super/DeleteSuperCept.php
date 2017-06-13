<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an exiting superintendant.');

$super = $I->create('super');

$I->amOnPage('/super.php?view');
$I->see($super->name);
$I->see($super->phone);
$I->click($super->name);
$I->see('EDIT');
$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');
$I->click('VIEW LIST');
$I->dontSee($super->name);
$I->dontSee($super->phone);

$I->dontSeeInDatabase('super', [
    'name' => $super->name,
    'phone' => $super->phone
]);
