<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('See winning subcontractors are on call log.');

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

$super = $I->create('supers');
$project = $I->create('projects', ['zone' => $zone->name, 'super_id' => $super->id]);

$bidder1 = $I->create('bidders', [
    'project_id' => $project->id,
    'contact_id' => $contact1->id,
    'category_id' => $category->id,
    'status' => 'won',
    'win' => 1,
]);

$bidder2 = $I->create('bidders', [
    'project_id' => $project->id,
    'contact_id' => $contact2->id,
    'category_id' => $category->id,
    'status' => 'will',
    'win' => 0,
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);

$I->click('CALL LOG');
$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->see($super->name);
$I->see($super->phone);
