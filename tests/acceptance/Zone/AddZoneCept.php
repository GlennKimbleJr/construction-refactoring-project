<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new zone.');

$I->amOnPage('/zone.php');
$I->click('+ ADD NEW');
$I->see('Start a New Zone');

$zone = make('zones');

$I->fillField(['id' => 'name'], $zone->name);
$I->click('Create');
$I->see('Created!');

$I->seeInDatabase('zones', [
    'name' => $zone->name
]);

$I->click('VIEW LIST');
$I->see($zone->name);
