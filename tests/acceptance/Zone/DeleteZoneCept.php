<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an existing zone.');

$zone = $I->create('zones');

$I->amOnPage('/zone.php?view');
$I->see($zone->name);
$I->click($zone->name);
$I->see('EDIT');
$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');
$I->click('VIEW LIST');
$I->dontSee($zone->name);

$I->dontSeeInDatabase('zones', [
    'name' => $zone->name
]);
