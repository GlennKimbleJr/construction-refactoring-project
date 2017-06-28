<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Rate a winning subcontractor\'s preformance.');

$category1 = $I->create('categories', ['name' => 'Test Category 1']);
$category2 = $I->create('categories', ['name' => 'Test Category 2']);
$category3 = $I->create('categories', ['name' => 'Test Category 3']);
$category4 = $I->create('categories', ['name' => 'Test Category 4']);
$category5 = $I->create('categories', ['name' => 'Test Category 5']);

$contact1 = $I->create('contacts', [
    'company' => 'Test Company 1',
    'category_id' => $category1->id
]);
$contact2 = $I->create('contacts', [
    'company' => 'Test Company 2',
    'category_id' => $category2->id
]);
$contact3 = $I->create('contacts', [
    'company' => 'Test Company 3',
    'category_id' => $category3->id
]);
$contact4 = $I->create('contacts', [
    'company' => 'Test Company 4',
    'category_id' => $category4->id
]);
$contact5 = $I->create('contacts', [
    'company' => 'Test Company 5',
    'category_id' => $category5->id
]);

$project = $I->create('projects');

$I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category1->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact1->id
]);

$I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category2->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact2->id
]);

$I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category3->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact3->id
]);

$I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category4->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact4->id
]);

$I->create('bidders', [
    'project_id' => $project->id,
    'category' => $category5->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'contact_id' => $contact5->id
]);

$I->amOnPage('/project.php?open');
$I->click($project->name);

$I->see($contact1->company);
$I->click('SCORE');
$I->click(['id'=>'happy']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact1->id,
    'score' => '5'
]);

$I->click('GO BACK');
$I->see($contact2->company);
$I->click('SCORE');
$I->click(['id'=>'good']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact2->id,
    'score' => '4'
]);

$I->click('GO BACK');
$I->see($contact3->company);
$I->click('SCORE');
$I->click(['id'=>'ok']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact3->id,
    'score' => '3'
]);

$I->click('GO BACK');
$I->see($contact4->company);
$I->click('SCORE');
$I->click(['id'=>'bad']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact4->id,
    'score' => '2'
]);

$I->click('GO BACK');
$I->see($contact5->company);
$I->click('SCORE');
$I->click(['id'=>'angry']);
$I->see('UPDATED');
$I->seeInDatabase('bidders', [
    'contact_id' => $contact5->id,
    'score' => '1'
]);
