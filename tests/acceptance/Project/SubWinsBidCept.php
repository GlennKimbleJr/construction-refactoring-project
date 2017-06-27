<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as having won a bid for a project.');

$category = $I->create('categories', ['name' => 'Test Category']);
$categoryId = $I->grabFromDatabase('categories', 'id', ['name' => $category->name]);

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

$contact1Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact1->company]);
$contact2Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact2->company]);

$project = $I->create('projects', ['zone' => $zone->name]);
$projectId = $I->grabFromDatabase('projects', 'id', ['name' => $project->name]);
$bidder1 = $I->create('bidders', [
    'project_id' => $projectId,
    'category_id' => $categoryId,
    'status' => 'will',
    'contact_id' => $contact1Id
]);
$bidder2 = $I->create('bidders', [
    'project_id' => $projectId,
    'category_id' => $categoryId,
    'status' => 'will',
    'contact_id' => $contact2Id
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);
$I->see("{$category->name} - {$contact1->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");
$I->see("{$category->name} - {$contact2->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");

$I->click('CHOOSE AS WINNER');
$I->see('AWARD BID:');
$I->see($contact1->company);
$I->see($category->name);
$I->click('YES');
$I->see('BID AWARDED!');
$I->click('GO BACK');

$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->seeInDatabase('bidders', [
    'project_id' => $projectId,
    'status' => 'will',
    'win' => '1',
    'contact_id' => $contact1Id
]);

$I->seeInDatabase('bidders', [
    'project_id' => $projectId,
    'status' => 'will',
    'win' => '0',
    'contact_id' => $contact2Id
]);
