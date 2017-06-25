<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See winning subcontractors are on call log.');

$category = $I->create('category', ['name' => 'Test Category'], 'type');
$categoryId = $I->grabFromDatabase('type', 'id', ['name' => $category->name]);

$zone = $I->create('zone', ['name' => 'Test Zone']);

$contact1 = $I->create('contact', [
    'company' => 'Test Company 1',
    'zone' => $zone->name,
    'type' => $category->name
]);

$contact2 = $I->create('contact', [
    'company' => 'Test Company 2',
    'zone' => $zone->name,
    'type' => $category->name
]);

$contact1Id = $I->grabFromDatabase('contact', 'id', ['company' => $contact1->company]);
$contact2Id = $I->grabFromDatabase('contact', 'id', ['company' => $contact2->company]);

$project = $I->create('project', ['zone' => $zone->name]);
$projectId = $I->grabFromDatabase('project', 'id', ['name' => $project->name]);

$bidder1 = $I->create('bidders', [
    'project_id' => $projectId,
    'contact_id' => $contact1Id,
    'category_id' => $categoryId,
    'status' => 'won',
    'win' => 1,
]);

$bidder2 = $I->create('bidders', [
    'project_id' => $projectId,
    'contact_id' => $contact2Id,
    'category_id' => $categoryId,
    'status' => 'will',
    'win' => 0,
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);

$I->click('CALL LOG');
$I->see($contact1->company);
$I->dontSee($contact2->company);
