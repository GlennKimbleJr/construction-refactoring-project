<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Add subcontractors to my project.');

$category = $I->create('categories', ['name' => 'Category Test']);

$zone1 = $I->create('zones', ['name' => 'Zone 1']);
$zone1Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone1->name]);
$zone1Contact = $I->create('contacts', [
    'company' => 'Company 1',
    'zone' => $zone1->name,
    'type' => $category->name
]);

$zone2 = $I->create('zones', ['name' => 'Zone 2']);
$zone2Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone2->name]);
$zone2Contact = $I->create('contacts', [
    'company' => 'Company 2',
    'zone' => $zone2->name,
    'type' => $category->name
]);

$zone1Project = $I->create('projects', ['zone_id' => $zone1Id]);

$I->amOnPage('/project.php?open');
$I->see($zone1Project->name);
$I->click($zone1Project->name);
$I->dontSee($zone1Contact->company);
$I->dontSee($zone2Contact->company);
$I->click('CHOOSE SUB-CONTRACTORS TO BID');

$I->see($category->name);
$I->dontSee($zone1Contact->company);
$I->dontSee($zone2Contact->company);
$I->click($category->name);

$I->canSeeInSource($zone1Contact->company);
$I->cantSeeInSource($zone2Contact->company);
$I->selectOption(['name' => 'company'], ['text' => $zone1Contact->company]);
$I->click('Submit');
$I->see('Sucess!');
$I->click('GO BACK');

$I->see($category->name);
$I->see($zone1Contact->company);
$I->dontSee($zone2Contact->company);
$I->click('GO BACK');

$I->see("{$category->name} - {$zone1Contact->company}");

