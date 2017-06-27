<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as willing to bid a project.');

$category = $I->create('categories', ['name' => 'Test Category']);
$zone = $I->create('zone', ['name' => 'Test Zone']);
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

$contact1Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact1->company]);
$contact2Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact2->company]);

$project = $I->create('projects', ['zone' => $zone->name]);
$projectId = $I->grabFromDatabase('projects', 'id', ['name' => $project->name]);
$bidder1 = $I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category->name,
    'contact_id' => $contact1Id
]);
$bidder2 = $I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category->name,
    'contact_id' => $contact2Id
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
    'project_id' => $projectId,
    'status' => 'will',
    'contact_id' => $contact1Id
]);

$I->seeInDatabase('bidders', [
    'project_id' => $projectId,
    'status' => '',
    'contact_id' => $contact2Id
]);
