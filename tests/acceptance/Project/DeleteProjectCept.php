<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an exiting project.');

$zone = $I->create('zones', ['name' => 'Test Zone 1']);
$project = $I->create('projects', ['zone_id' => $zone->id]);

$I->amOnPage('/project.php?open');
$I->see("{$project->name} - {$project->bidduedate}");
$I->click('EDIT');

$I->see('EDIT Project');
$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');
$I->click('VIEW LIST');
$I->dontSee("{$project->name} - {$project->bidduedate}");

$I->dontSeeInDatabase('projects', [
    'name' => $project->name,
    'bidduedate' => $project->bidduedate,
    'completedate' => $project->completedate,
    'zone_id' => $project->zone_id,
    'plans' => $project->plans,
    'location' => $project->location,
    'planuser' => $project->planuser,
    'planpass' => $project->planpass,
    'owner_name' => $project->owner_name,
    'owner_phone' => $project->owner_phone,
    'super_id' => $project->super_id
]);
