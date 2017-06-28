<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as wont bid for a project.');

$category = $I->create('categories', ['name' => 'Test Category']);
$contact = $I->create('contacts', [
    'company' => 'Test Company',
    'category_id' => $category->id
]);
$project = $I->create('projects');
$bidder = $I->create('bidders', [
    'project_id' => $project->id,
    'category_id' => $category->id,
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
    'project_id' => $project->id,
    'status' => 'wont'
]);
