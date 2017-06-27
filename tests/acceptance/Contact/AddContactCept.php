<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new contact.');

$contact = make('contacts');
$category = $I->create('categories');
$zone1 = $I->create('zone', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zone', ['name' => 'Test Zone 2']);
$zone3 = $I->create('zone', ['name' => 'Test Zone 3']);
$zone4 = $I->create('zone', ['name' => 'Test Zone 4']);
$zone5 = $I->create('zone', ['name' => 'Test Zone 5']);
$zone6 = $I->create('zone', ['name' => 'Test Zone 6']);
$zone7 = $I->create('zone', ['name' => 'Test Zone 7']);
$zone8 = $I->create('zone', ['name' => 'Test Zone 8']);
$zone9 = $I->create('zone', ['name' => 'Test Zone 9']);

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
$I->selectOption(['name' => 'zone'], ['value' => $zone1->name]);
$I->selectOption(['name' => 'zone2'], ['value' => $zone2->name]);
$I->selectOption(['name' => 'zone3'], ['value' => $zone3->name]);
$I->selectOption(['name' => 'zone4'], ['value' => $zone4->name]);
$I->selectOption(['name' => 'zone5'], ['value' => $zone5->name]);
$I->selectOption(['name' => 'zone6'], ['value' => $zone6->name]);
$I->selectOption(['name' => 'zone7'], ['value' => $zone7->name]);
$I->selectOption(['name' => 'zone8'], ['value' => $zone8->name]);
$I->selectOption(['name' => 'zone9'], ['value' => $zone9->name]);
$I->selectOption(['name' => 'type'], ['value' => $category->name]);
$I->click('Create');
$I->see('Contact Added!');

$I->seeInDatabase('contacts', [
    'first' => $contact->first,
    'last' => $contact->last,
    'street' => $contact->street,
    'city' => $contact->city,
    'state' => $contact->state,
    'zone' => $zone1->name,
    'email' => $contact->email,
    'officephone' => $contact->officephone,
    'cellphone' => $contact->cellphone,
    'fax' => $contact->fax,
    'type' => $category->name,
    'company' => $contact->company,
    'zip' => $contact->zip,
    'zone2' => $zone2->name,
    'zone3' => $zone3->name,
    'zone4' => $zone4->name,
    'zone5' => $zone5->name,
    'zone6' => $zone6->name,
    'zone7' => $zone7->name,
    'zone8' => $zone8->name,
    'zone9' => $zone9->name,
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
$I->seeOptionIsSelected(['name' => 'zone'], $zone1->name);
$I->seeOptionIsSelected(['name' => 'zone2'], $zone2->name);
$I->seeOptionIsSelected(['name' => 'zone3'], $zone3->name);
$I->seeOptionIsSelected(['name' => 'zone4'], $zone4->name);
$I->seeOptionIsSelected(['name' => 'zone5'], $zone5->name);
$I->seeOptionIsSelected(['name' => 'zone6'], $zone6->name);
$I->seeOptionIsSelected(['name' => 'zone7'], $zone7->name);
$I->seeOptionIsSelected(['name' => 'zone8'], $zone8->name);
$I->seeOptionIsSelected(['name' => 'zone9'], $zone9->name);
