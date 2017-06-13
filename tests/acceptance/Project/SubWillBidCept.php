<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Mark a subcontractors as willing to bid a project.');

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
    'company' => $contact1->company
], 'bid_contactors');
$bidder2 = $I->create('bidder', [
    'project_id' => $projectId,
    'category' => $category->name,
    'company' => $contact2->company
], 'bid_contactors');

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

$I->seeInDatabase('bid_contactors', [
    'project_id' => $projectId,
    'status' => 'will',
    'company' => $contact1->company
]);

$I->seeInDatabase('bid_contactors', [
    'project_id' => $projectId,
    'status' => '',
    'company' => $contact2->company
]);
