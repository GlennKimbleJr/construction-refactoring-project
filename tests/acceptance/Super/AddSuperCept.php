<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new superintendent.');

$I->amOnPage('/super.php');
$I->click('+ ADD NEW');
$I->see('Add New Superintendent');

$super = make('super');

$I->fillField(['id' => 'name'], $super->name);
$I->fillField(['id' => 'phone'], $super->phone);
$I->click('Add');
$I->see('Created!');

$I->seeInDatabase('super', [
    'name' => $super->name, 
    'phone' => $super->phone
]);

$I->click('VIEW LIST');
$I->see("{$super->name} - {$super->phone}");
