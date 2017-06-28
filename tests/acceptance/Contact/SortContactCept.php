<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Sort contacts by zones and categories.');

$category1 = $I->create('categories', ['name' => 'Category 1']);
$zone1 = $I->create('zones', ['name' => 'Zone 1']);
$zone1Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone1->name]);
$contact1 = $I->create('contacts', [
    'company' => 'Company 1',
    'type' => $category1->name
]);
$contact1Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact1->company]);
$I->create('contacts_zones', [
    'contact_id' => $contact1Id,
    'zone_id' => $zone1Id
]);

$category2 = $I->create('categories', ['name' => 'Category 2']);
$zone2 = $I->create('zones', ['name' => 'Zone 2']);
$zone2Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone2->name]);
$contact2 = $I->create('contacts', [
    'company' => 'Company 2',
    'type' => $category2->name
]);
$contact2Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact2->company]);
$I->create('contacts_zones', [
    'contact_id' => $contact2Id,
    'zone_id' => $zone2Id
]);

$I->amOnPage('/contact.php?view');
$I->see($contact1->company);
$I->see($contact2->company);

$I->click('BY TYPE');
$I->click($category1->name);
$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->click('BY TYPE');
$I->click($category2->name);
$I->see($contact2->company);
$I->dontSee($contact1->company);

$I->click('BY ZONE');
$I->click($zone1->name);
$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->click('BY ZONE');
$I->click($zone2->name);
$I->see($contact2->company);
$I->dontSee($contact1->company);
