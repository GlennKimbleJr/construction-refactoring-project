<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a contact\'s details');

$category = $I->create('category', ['name' => 'Test Category'], 'type');
$zone1 = $I->create('zone', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zone', ['name' => 'Test Zone 2']);
$zone3 = $I->create('zone', ['name' => 'Test Zone 3']);
$zone4 = $I->create('zone', ['name' => 'Test Zone 4']);
$zone5 = $I->create('zone', ['name' => 'Test Zone 5']);
$zone6 = $I->create('zone', ['name' => 'Test Zone 6']);
$zone7 = $I->create('zone', ['name' => 'Test Zone 7']);
$zone8 = $I->create('zone', ['name' => 'Test Zone 8']);
$zone9 = $I->create('zone', ['name' => 'Test Zone 9']);
$contact = $I->create('contacts', [
    'type' => $category->name,
    'zone' => $zone1->name,
    'zone2' => $zone2->name,
    'zone3' => $zone3->name,
    'zone4' => $zone4->name,
    'zone5' => $zone5->name,
    'zone6' => $zone6->name,
    'zone7' => $zone7->name,
    'zone8' => $zone8->name,
    'zone9' => $zone9->name
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

