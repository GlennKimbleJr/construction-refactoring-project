<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See a subcontractors bid percentage change after accepting and declining bids.');

$contact = $I->create('contacts');
$contactId = $I->grabFromDatabase('contacts', 'id', ['company' => $contact->company]);

$I->amOnPage('/reports.php?bid');
$I->dontsee($contact->company);
$I->seeInDatabase('contacts', [
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
$I->seeInDatabase('contacts', [
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
$I->seeInDatabase('contacts', [
    'company' => $contact->company,
    'bid_per' => '50'
]);
