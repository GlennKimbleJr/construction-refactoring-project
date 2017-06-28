<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new contact.');

$contact = make('contacts');
$category = $I->create('categories');
$categoryId = $I->grabFromDatabase('categories', 'id', ['name' => $category->name]);

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

$I->amOnPage('/contact.php');
$I->click('+ ADD NEW');
$I->see('New Contact');

$I->fillField(['id' => 'company'], $contact->company);
$I->fillField(['id' => 'first'], $contact->first);
$I->fillField(['id' => 'last'], $contact->last);
$I->fillField(['id' => 'street'], $contact->street);
$I->fillField(['id' => 'city'], $contact->city);
$I->fillField(['id' => 'state'], $contact->state);
$I->fillField(['id' => 'zip'], $contact->zip);
$I->fillField(['id' => 'email'], $contact->email);
$I->fillField(['id' => 'officephone'], $contact->officephone);
$I->fillField(['id' => 'cellphone'], $contact->cellphone);
$I->fillField(['id' => 'fax'], $contact->fax);
$I->checkOption(['id' => 'zone_' . $zone1Id]);
$I->checkOption(['id' => 'zone_' . $zone2Id]);
$I->checkOption(['id' => 'zone_' . $zone3Id]);
$I->checkOption(['id' => 'zone_' . $zone4Id]);
$I->checkOption(['id' => 'zone_' . $zone5Id]);
$I->checkOption(['id' => 'zone_' . $zone6Id]);
$I->checkOption(['id' => 'zone_' . $zone7Id]);
$I->checkOption(['id' => 'zone_' . $zone8Id]);
$I->checkOption(['id' => 'zone_' . $zone9Id]);
$I->selectOption(['name' => 'type'], ['value' => $categoryId]);
$I->click('Create');
$I->see('Contact Added!');

$I->seeInDatabase('contacts', [
    'first' => $contact->first,
    'last' => $contact->last,
    'street' => $contact->street,
    'city' => $contact->city,
    'state' => $contact->state,
    'email' => $contact->email,
    'officephone' => $contact->officephone,
    'cellphone' => $contact->cellphone,
    'fax' => $contact->fax,
    'category_id' => $categoryId,
    'company' => $contact->company,
    'zip' => $contact->zip,
    'score_per' => $contact->score_per,
    'bid_per' => $contact->bid_per
]);

$I->click('VIEW LIST');
$I->see($contact->company);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->city);
$I->see($contact->state);

$I->click('EDIT');
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone2Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone5Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8Id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9Id]);
