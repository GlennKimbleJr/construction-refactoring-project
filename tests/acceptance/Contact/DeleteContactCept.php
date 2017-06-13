<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an existing contact.');

$contact = $I->create('contact');

$I->amOnPage('/contact.php?view');
$I->see($contact->company);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->city);
$I->see($contact->state);

$I->click('EDIT');
$I->see('EDIT Contact');
$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');

$I->click('VIEW LIST');
$I->dontSee($contact->company);
$I->dontSee($contact->first);
$I->dontSee($contact->last);
$I->dontSee($contact->city);
$I->dontSee($contact->state);

$I->dontSeeInDatabase('contact', [
    'first' => $contact->first,
    'last' => $contact->last,
    'street' => $contact->street,
    'city' => $contact->city,
    'state' => $contact->state,
    'zone' => $contact->zone,
    'email' => $contact->email,
    'officephone' => $contact->officephone,
    'cellphone' => $contact->cellphone,
    'fax' => $contact->fax,
    'type' => $contact->type,
    'company' => $contact->company,
    'zip' => $contact->zip,
    'zone2' => $contact->zone2,
    'zone3' => $contact->zone3,
    'zone4' => $contact->zone4,
    'zone5' => $contact->zone5,
    'zone6' => $contact->zone6,
    'zone7' => $contact->zone7,
    'zone8' => $contact->zone8,
    'zone9' => $contact->zone9,
    'score_per' => $contact->score_per,
    'bid_per' => $contact->bid_per,
]);
