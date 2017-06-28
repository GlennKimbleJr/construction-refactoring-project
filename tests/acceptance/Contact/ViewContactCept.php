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

$contact = $I->create('contacts', [
    'type' => $category->name,
]);

$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone1->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone2->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone3->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone4->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone5->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone6->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone7->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone8->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact->id,
    'zone_id' => $zone9->id
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

