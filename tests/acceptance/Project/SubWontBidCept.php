<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as wont bid for a project.');

$category = $I->create('category', ['name' => 'Test Category'], 'type');
$zone = $I->create('zone', ['name' => 'Test Zone']);
$contact = $I->create('contact', [
    'company' => 'Test Company',
    'zone' => $zone->name,
    'type' => $category->name
]);
$project = $I->create('projects', ['zone' => $zone->name]);
$projectId = $I->grabFromDatabase('projects', 'id', ['name' => $project->name]);
$bidder = $I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category->name,
    'company' => $contact->company
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);
$I->see("{$category->name} - {$contact->company}");
$I->click('won\'t bid');
$I->see('Bid Status Updated!');
$I->click('GO BACK');
$I->dontSee($contact->company);

$I->seeInDatabase('bidders', [
    'project_id' => $projectId,
    'status' => 'wont'
]);
