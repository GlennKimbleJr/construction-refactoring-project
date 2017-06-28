<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See a subcontractors average score change after being rated.');

$contact = $I->create('contacts');
$I->amOnPage('/reports.php?score');
$I->dontsee($contact->company);
$I->seeInDatabase('contacts', [
    'company' => $contact->company,
    'score_per' => '0'
]);

$I->create('bidders', [
    'contact_id' => $contact->id,
    'score' => '5'
]);
$I->click('SCORE');
$I->see($contact->company);
$I->canSeeInSource('<b>5</b>');
$I->seeInDatabase('contacts', [
    'company' => $contact->company,
    'score_per' => '5'
]);

$I->create('bidders', [
    'contact_id' => $contact->id,
    'score' => '1'
]);
$I->click('SCORE');
$I->see($contact->company);
$I->canSeeInSource('<b>3</b>');
$I->seeInDatabase('contacts', [
    'company' => $contact->company,
    'score_per' => '3'
]);
