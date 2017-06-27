<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a contact\'s details');

$zone1 = $I->create('zone', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zone', ['name' => 'Test Zone 2']);
$zone3 = $I->create('zone', ['name' => 'Test Zone 3']);
$zone4 = $I->create('zone', ['name' => 'Test Zone 4']);
$zone5 = $I->create('zone', ['name' => 'Test Zone 5']);
$zone6 = $I->create('zone', ['name' => 'Test Zone 6']);
$zone7 = $I->create('zone', ['name' => 'Test Zone 7']);
$zone8 = $I->create('zone', ['name' => 'Test Zone 8']);
$zone9 = $I->create('zone', ['name' => 'Test Zone 9']);
$category1 = $I->create('categories', ['name' => 'Test Category 1']);
$category2 = $I->create('categories', ['name' => 'Test Category 2']);
$contact = $I->create('contacts', [
    'zone' => $zone1->name,
    'zone2' => $zone2->name,
    'zone3' => $zone3->name,
    'zone4' => $zone4->name,
    'zone5' => $zone5->name,
    'zone6' => $zone6->name,
    'zone7' => $zone7->name,
    'zone8' => $zone8->name,
    'zone9' => $zone9->name,
    'type' => $category1->name
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
$I->seeOptionIsSelected(['name' => 'zone'], $zone1->name);
$I->seeOptionIsSelected(['name' => 'zone2'], $zone2->name);
$I->seeOptionIsSelected(['name' => 'zone3'], $zone3->name);
$I->seeOptionIsSelected(['name' => 'zone4'], $zone4->name);
$I->seeOptionIsSelected(['name' => 'zone5'], $zone5->name);
$I->seeOptionIsSelected(['name' => 'zone6'], $zone6->name);
$I->seeOptionIsSelected(['name' => 'zone7'], $zone7->name);
$I->seeOptionIsSelected(['name' => 'zone8'], $zone8->name);
$I->seeOptionIsSelected(['name' => 'zone9'], $zone9->name);
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
$I->selectOption(['name' => 'zone'], ['value' => $zone2->name]);
$I->selectOption(['name' => 'zone2'], ['value' => $zone3->name]);
$I->selectOption(['name' => 'zone3'], ['value' => $zone4->name]);
$I->selectOption(['name' => 'zone4'], ['value' => $zone5->name]);
$I->selectOption(['name' => 'zone5'], ['value' => $zone6->name]);
$I->selectOption(['name' => 'zone6'], ['value' => $zone7->name]);
$I->selectOption(['name' => 'zone7'], ['value' => $zone8->name]);
$I->selectOption(['name' => 'zone8'], ['value' => $zone9->name]);
$I->selectOption(['name' => 'zone9'], ['value' => $zone1->name]);
$I->selectOption(['name' => 'type'], ['value' => $category2->name]);
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
$I->seeOptionIsSelected(['name' => 'zone'], $zone2->name);
$I->seeOptionIsSelected(['name' => 'zone2'], $zone3->name);
$I->seeOptionIsSelected(['name' => 'zone3'], $zone4->name);
$I->seeOptionIsSelected(['name' => 'zone4'], $zone5->name);
$I->seeOptionIsSelected(['name' => 'zone5'], $zone6->name);
$I->seeOptionIsSelected(['name' => 'zone6'], $zone7->name);
$I->seeOptionIsSelected(['name' => 'zone7'], $zone8->name);
$I->seeOptionIsSelected(['name' => 'zone8'], $zone9->name);
$I->seeOptionIsSelected(['name' => 'zone9'], $zone1->name);
$I->seeOptionIsSelected(['name' => 'type'], $category2->name);
