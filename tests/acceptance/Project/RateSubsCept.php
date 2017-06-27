<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Rate a winning subcontractor\'s preformance.');

$category1 = $I->create('category', ['name' => 'Test Category 1'], 'type');
$category2 = $I->create('category', ['name' => 'Test Category 2'], 'type');
$category3 = $I->create('category', ['name' => 'Test Category 3'], 'type');
$category4 = $I->create('category', ['name' => 'Test Category 4'], 'type');
$category5 = $I->create('category', ['name' => 'Test Category 5'], 'type');

$contact1 = $I->create('contacts', [
    'company' => 'Test Company 1',
    'type' => $category1->name
]);
$contact2 = $I->create('contacts', [
    'company' => 'Test Company 2',
    'type' => $category2->name
]);
$contact3 = $I->create('contacts', [
    'company' => 'Test Company 3',
    'type' => $category3->name
]);
$contact4 = $I->create('contacts', [
    'company' => 'Test Company 4',
    'type' => $category4->name
]);
$contact5 = $I->create('contacts', [
    'company' => 'Test Company 5',
    'type' => $category5->name
]);

$contact1Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact1->company]);
$contact2Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact2->company]);
$contact3Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact3->company]);
$contact4Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact4->company]);
$contact5Id = $I->grabFromDatabase('contacts', 'id', ['company' => $contact5->company]);

$project = $I->create('projects');
$projectId = $I->grabFromDatabase('projects', 'id', ['name' => $project->name]);

$I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category1->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact1Id
]);

$I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category2->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact2Id
]);

$I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category3->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact3Id
]);

$I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category4->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact4Id
]);

$I->create('bidders', [
    'project_id' => $projectId,
    'category' => $category5->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact5Id
]);

$I->amOnPage('/project.php?open');
$I->click($project->name);

$I->see($contact1->company);
$I->click('SCORE');
$I->click(['id'=>'happy']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact1Id,
    'score' => '5'
]);

$I->click('GO BACK');
$I->see($contact2->company);
$I->click('SCORE');
$I->click(['id'=>'good']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact2Id,
    'score' => '4'
]);

$I->click('GO BACK');
$I->see($contact3->company);
$I->click('SCORE');
$I->click(['id'=>'ok']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact3Id,
    'score' => '3'
]);

$I->click('GO BACK');
$I->see($contact4->company);
$I->click('SCORE');
$I->click(['id'=>'bad']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact4Id,
    'score' => '2'
]);

$I->click('GO BACK');
$I->see($contact5->company);
$I->click('SCORE');
$I->click(['id'=>'angry']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact5Id,
    'score' => '1'
]);
