<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Rate a winning subcontractor\'s preformance.');

$category1 = $I->create('category', ['name' => 'Test Category 1'], 'type');
$category2 = $I->create('category', ['name' => 'Test Category 2'], 'type');
$category3 = $I->create('category', ['name' => 'Test Category 3'], 'type');
$category4 = $I->create('category', ['name' => 'Test Category 4'], 'type');
$category5 = $I->create('category', ['name' => 'Test Category 5'], 'type');

$contact1 = $I->create('contact', [
    'company' => 'Test Company 1',
    'type' => $category1->name
]);
$contact2 = $I->create('contact', [
    'company' => 'Test Company 2',
    'type' => $category2->name
]);
$contact3 = $I->create('contact', [
    'company' => 'Test Company 3',
    'type' => $category3->name
]);
$contact4 = $I->create('contact', [
    'company' => 'Test Company 4',
    'type' => $category4->name
]);
$contact5 = $I->create('contact', [
    'company' => 'Test Company 5',
    'type' => $category5->name
]);

$project = $I->create('project');
$projectId = $I->grabFromDatabase('project', 'id', ['name' => $project->name]);

$I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category1->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'company' => $contact1->company
], 'bid_contactors');

$I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category2->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'company' => $contact2->company
], 'bid_contactors');

$I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category3->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'company' => $contact3->company
], 'bid_contactors');

$I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category4->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'company' => $contact4->company
], 'bid_contactors');

$I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category5->name,
    'status' => 'won',
    'win' => '1',
    'score' => 'NA',
    'company' => $contact5->company
], 'bid_contactors');

$I->amOnPage('/project.php?open');
$I->click($project->name);

$I->see($contact1->company);
$I->click('SCORE');
$I->click(['id'=>'happy']);
$I->see('UPDATED');
$I->seeInDatabase('bid_contactors', [
    'company' => $contact1->company,
    'score' => '5'
]);

$I->click('GO BACK');
$I->see($contact2->company);
$I->click('SCORE');
$I->click(['id'=>'good']);
$I->see('UPDATED');
$I->seeInDatabase('bid_contactors', [
    'company' => $contact2->company,
    'score' => '4'
]);

$I->click('GO BACK');
$I->see($contact3->company);
$I->click('SCORE');
$I->click(['id'=>'ok']);
$I->see('UPDATED');
$I->seeInDatabase('bid_contactors', [
    'company' => $contact3->company,
    'score' => '3'
]);

$I->click('GO BACK');
$I->see($contact4->company);
$I->click('SCORE');
$I->click(['id'=>'bad']);
$I->see('UPDATED');
$I->seeInDatabase('bid_contactors', [
    'company' => $contact4->company,
    'score' => '2'
]);

$I->click('GO BACK');
$I->see($contact5->company);
$I->click('SCORE');
$I->click(['id'=>'angry']);
$I->see('UPDATED');
$I->seeInDatabase('bid_contactors', [
    'company' => $contact5->company,
    'score' => '1'
]);
