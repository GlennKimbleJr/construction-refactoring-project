<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a contact\'s details');

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

$category1 = $I->create('categories', ['name' => 'Test Category 1']);
$category2 = $I->create('categories', ['name' => 'Test Category 2']);

$category1Id = $I->grabFromDatabase('categories', 'id', ['name' => $category1->name]);
$category2Id = $I->grabFromDatabase('categories', 'id', ['name' => $category2->name]);

$contact = $I->create('contacts', [
    'category_id' => $category1Id
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
$I->click('EDIT');

$I->see('EDIT Contact');
$I->seeInField(['id' => 'company'], $contact->company);
$I->seeInField(['id' => 'first'], $contact->first);
$I->seeInField(['id' => 'last'], $contact->last);
$I->seeInField(['id' => 'street'], $contact->street);
$I->seeInField(['id' => 'city'], $contact->city);
$I->seeInField(['id' => 'state'], $contact->state);
$I->seeInField(['id' => 'zip'], $contact->zip);
$I->seeInField(['id' => 'email'], $contact->email);
$I->seeInField(['id' => 'officephone'], $contact->officephone);
$I->seeInField(['id' => 'cellphone'], $contact->cellphone);
$I->seeInField(['id' => 'fax'], $contact->fax);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone2Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone5Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9Id]);
$I->seeOptionIsSelected(['name' => 'type'], $category1->name);

$I->fillField(['id' => 'company'], $contact->company = 'New Company Name');
$I->fillField(['id' => 'first'], $contact->first = 'New First');
$I->fillField(['id' => 'last'], $contact->last = 'New Last');
$I->fillField(['id' => 'street'], $contact->street = 'New Street');
$I->fillField(['id' => 'city'], $contact->city = 'New City');
$I->fillField(['id' => 'state'], $contact->state = 'New State');
$I->fillField(['id' => 'zip'], $contact->zip = $contact->zip + 1);
$I->fillField(['id' => 'email'], $contact->email = 'NewEmail@example.org');
$I->fillField(['id' => 'officephone'], $contact->officephone = '111-111-1111');
$I->fillField(['id' => 'cellphone'], $contact->cellphone = '111-111-1112');
$I->fillField(['id' => 'fax'], $contact->fax = '111-111-1113');
$I->uncheckOption(['id' => 'zone_' . $zone2Id]);
$I->uncheckOption(['id' => 'zone_' . $zone5Id]);
$I->selectOption(['name' => 'type'], ['value' => $category2Id]);
$I->click('UPDATE');
$I->see('Updated!');

$I->click('VIEW LIST');
$I->see($contact->company);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->city);
$I->see($contact->state);
$I->click('EDIT');

$I->see('EDIT Contact');
$I->seeInField(['id' => 'company'], $contact->company);
$I->seeInField(['id' => 'first'], $contact->first);
$I->seeInField(['id' => 'last'], $contact->last);
$I->seeInField(['id' => 'street'], $contact->street);
$I->seeInField(['id' => 'city'], $contact->city);
$I->seeInField(['id' => 'state'], $contact->state);
$I->seeInField(['id' => 'zip'], $contact->zip);
$I->seeInField(['id' => 'email'], $contact->email);
$I->seeInField(['id' => 'officephone'], $contact->officephone);
$I->seeInField(['id' => 'cellphone'], $contact->cellphone);
$I->seeInField(['id' => 'fax'], $contact->fax);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1Id]);
$I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $zone2Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4Id]);
$I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $zone5Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9Id]);
$I->seeOptionIsSelected(['name' => 'type'], $category2->name);
