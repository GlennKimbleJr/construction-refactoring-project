<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new project.');

$zone = $I->create('zones');
$super = $I->create('supers');
$superId = $I->grabFromDatabase('supers', 'id', ['name' => $super->name]);
$project = make('projects');
$project_date = explode('-', $project->bidduedate);

$I->amOnPage('/project.php');
$I->click('+ ADD NEW');
$I->see('Start a New Project');

$I->fillField(['id' => 'name'], $project->name);
$I->fillField(['id' => 'plans'], $project->plans);
$I->fillField(['id' => 'planuser'], $project->planuser);
$I->fillField(['id' => 'planpass'], $project->planpass);
$I->fillField(['id' => 'owner_name'], $project->owner_name);
$I->fillField(['id' => 'owner_phone'], $project->owner_phone);
$I->selectOption(['name' => 'due1'], ['value' => $project_date[1]]);
$I->selectOption(['name' => 'due2'], ['value' => $project_date[2]]);
$I->fillField(['id' => 'due3'], $project_date[0]);
$I->selectOption(['name' => 'zone'], ['value' => $zone->name]);
$I->fillField(['id' => 'location'], $project->location);
$I->selectOption(['name' => 'super'], ['value' => $superId]);
$I->click('Create');
$I->see('Project Created!');

$I->seeInDatabase('projects', [
    'name' => $project->name,
    'bidduedate' => $project->bidduedate,
    'completedate' => $project->completedate,
    'zone' => $zone->name,
    'plans' => $project->plans,
    'planuser' => $project->planuser,
    'planpass' => $project->planpass,
    'owner_name' => $project->owner_name,
    'owner_phone' => $project->owner_phone,
    'super_id' => $superId,
]);

$I->click('VIEW LIST');
$I->see("{$project->name} - {$project->bidduedate}");
