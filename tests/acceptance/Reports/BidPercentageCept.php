<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See a subcontractors bid percentage change after accepting and declining bids.');

$contact = $I->create('contact');
$contactId = $I->grabFromDatabase('contact', 'id', ['company' => $contact->company]);

$I->amOnPage('/reports.php?bid');
$I->dontsee($contact->company);
$I->seeInDatabase('contact', [
    'company' => $contact->company,
    'bid_per' => '0'
]);

$I->create('bidders', [
    'status' => 'will',
    'contact_id' => $contactId
]);
$I->click('BID');
$I->see($contact->company);
$I->see('100 %');
$I->seeInDatabase('contact', [
    'company' => $contact->company,
    'bid_per' => '100'
]);

$I->create('bidders', [
    'status' => 'wont',
    'contact_id' => $contactId
]);
$I->click('BID');
$I->see($contact->company);
$I->see('50 %');
$I->seeInDatabase('contact', [
    'company' => $contact->company,
    'bid_per' => '50'
]);
