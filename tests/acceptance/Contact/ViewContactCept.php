<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a contact\'s details');

$category = $I->create('categories', ['name' => 'Test Category']);

$zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
$zone3 = $I->create('zones', ['name' => 'Test Zone 3']);
$zone4 = $I->create('zones', ['name' => 'Test Zone 4']);
$zone5 = $I->create('zones', ['name' => 'Test Zone 5']);
$zone6 = $I->create('zones', ['name' => 'Test Zone 6']);
$zone7 = $I->create('zones', ['name' => 'Test Zone 7']);
$zone8 = $I->create('zones', ['name' => 'Test Zone 8']);
$zone9 = $I->create('zones', ['name' => 'Test Zone 9']);

$zone1Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone1->name]);
$zone2Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone2->name]);
$zone3Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone3->name]);
$zone4Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone4->name]);
$zone5Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone5->name]);
$zone6Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone6->name]);
$zone7Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone7->name]);
$zone8Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone8->name]);
$zone9Id = $I->grabFromDatabase('zones', 'id', ['name' => $zone9->name]);

$contact = $I->create('contacts', [
    'type' => $category->name,
]);
$contactId = $I->grabFromDatabase('contacts', 'id', ['company' => $contact->company]);

$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone1Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone2Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone3Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone4Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone5Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone6Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone7Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone8Id
]);
$I->create('contacts_zones', [
    'contact_id' => $contactId,
    'zone_id' => $zone9Id
]);

$I->amOnPage('/contact.php?view');
$I->see($contact->company);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->city);
$I->see($contact->state);
$I->click($contact->company);

$I->see('EDIT');
$I->see($contact->company);
$I->see($category->name);
$I->see($zone1->name);
$I->see($zone2->name);
$I->see($zone3->name);
$I->see($zone4->name);
$I->see($zone5->name);
$I->see($zone6->name);
$I->see($zone7->name);
$I->see($zone8->name);
$I->see($zone9->name);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->street);
$I->see($contact->city);
$I->see($contact->state);
$I->see($contact->zip);
$I->see($contact->cellphone);
$I->see($contact->officephone);
$I->see($contact->fax);
$I->see($contact->email);

