<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a zone\'s details');

$zone = $I->create('zones');

$I->amOnPage('/zone.php?view');
$I->see($zone->name);
$I->click($zone->name);

$I->see('EDIT');
$I->seeInField(['id' => 'name'], $zone->name);

$I->fillField(['id' => 'name'], $zone->name = 'New Name');
$I->click('Update');
$I->see('Updated!');

$I->click('VIEW LIST');
$I->see($zone->name);
$I->click($zone->name);

$I->see('EDIT');
$I->seeInField(['id' => 'name'], $zone->name);
