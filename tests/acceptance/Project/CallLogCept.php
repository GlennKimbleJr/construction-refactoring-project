<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See winning subcontractors are on call log.');

$category = $I->create('category', ['name' => 'Test Category'], 'type');
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

$project = $I->create('project', ['zone' => $zone->name]);
$projectId = $I->grabFromDatabase('project', 'id', ['name' => $project->name]);

$bidder1 = $I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category->name,
    'status' => 'won',
    'win' => 1,
    'company' => $contact1->company
], 'bid_contactors');

$bidder2 = $I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category->name,
    'status' => 'will',
    'win' => 0,
    'company' => $contact2->company
], 'bid_contactors');

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);

$I->click('CALL LOG');
$I->see($contact1->company);
$I->dontSee($contact2->company);
