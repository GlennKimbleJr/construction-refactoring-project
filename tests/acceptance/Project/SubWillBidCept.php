<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as willing to bid a project.');

$category = $I->create('categories', ['name' => 'Test Category']);
$zone = $I->create('zones', ['name' => 'Test Zone']);
$contact1 = $I->create('contacts', [
    'company' => 'Test Company 1',
    'zone' => $zone->name,
    'type' => $category->name
]);
$contact2 = $I->create('contacts', [
    'company' => 'Test Company 2',
    'zone' => $zone->name,
    'type' => $category->name
]);

$project = $I->create('projects', ['zone' => $zone->name]);
$bidder1 = $I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category->name,
    'contact_id' => $contact1->id
]);
$bidder2 = $I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category->name,
    'contact_id' => $contact2->id
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);
$I->see("{$category->name} - {$contact1->company}");
$I->see("{$category->name} - {$contact2->company}");
$I->click('will bid');
$I->see('Bid Status Updated!');
$I->click('GO BACK');
$I->see("{$category->name} - {$contact1->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");
$I->see("{$category->name} - {$contact2->company} | EMAIL BID INVITE | Set Status: will bid - won't bid");

$I->seeInDatabase('bidders', [
    'project_id' => $project->id,
    'status' => 'will',
    'contact_id' => $contact1->id
]);

$I->seeInDatabase('bidders', [
    'project_id' => $project->id,
    'status' => '',
    'contact_id' => $contact2->id
]);
