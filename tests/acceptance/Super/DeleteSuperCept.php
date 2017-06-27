<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an exiting superintendant.');

$super = $I->create('supers');

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

$I->dontSeeInDatabase('supers', [
    'name' => $super->name,
    'phone' => $super->phone
]);
