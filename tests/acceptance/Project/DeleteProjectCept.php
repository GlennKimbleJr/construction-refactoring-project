<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an exiting project.');

$project = $I->create('projects');

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
    'zone' => $project->zone,
    'plans' => $project->plans,
    'location' => $project->location,
    'planuser' => $project->planuser,
    'planpass' => $project->planpass,
    'owner_name' => $project->owner_name,
    'owner_phone' => $project->owner_phone,
    'super_name' => $project->super_name,
    'super_phone' => $project->super_phone
]);
