<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new contact.');

$contact = make('contacts');
$category = $I->create('categories');

$zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
$zone3 = $I->create('zones', ['name' => 'Test Zone 3']);
$zone4 = $I->create('zones', ['name' => 'Test Zone 4']);
$zone5 = $I->create('zones', ['name' => 'Test Zone 5']);
$zone6 = $I->create('zones', ['name' => 'Test Zone 6']);
$zone7 = $I->create('zones', ['name' => 'Test Zone 7']);
$zone8 = $I->create('zones', ['name' => 'Test Zone 8']);
$zone9 = $I->create('zones', ['name' => 'Test Zone 9']);

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
$I->checkOption(['id' => 'zone_' . $zone1->id]);
$I->checkOption(['id' => 'zone_' . $zone2->id]);
$I->checkOption(['id' => 'zone_' . $zone3->id]);
$I->checkOption(['id' => 'zone_' . $zone4->id]);
$I->checkOption(['id' => 'zone_' . $zone5->id]);
$I->checkOption(['id' => 'zone_' . $zone6->id]);
$I->checkOption(['id' => 'zone_' . $zone7->id]);
$I->checkOption(['id' => 'zone_' . $zone8->id]);
$I->checkOption(['id' => 'zone_' . $zone9->id]);
$I->selectOption(['name' => 'type'], ['value' => $category->id]);
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
    'category_id' => $category->id,
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
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone2->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone5->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8->id]);
$I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9->id]);
