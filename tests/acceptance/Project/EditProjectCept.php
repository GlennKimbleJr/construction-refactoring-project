<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a project\'s details');

$super1 = $I->create('supers', ['name' => 'Test Super 1']);
$super2 = $I->create('supers', ['name' => 'Test Super 2']);

$super1Id = $I->grabFromDatabase('supers', 'id', ['name' => $super1->name]);
$super2Id = $I->grabFromDatabase('supers', 'id', ['name' => $super2->name]);

$zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
$zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
$project = $I->create('projects', [
    'zone' => $zone1->name,
    'super_id' => $super1Id
]);
$existing_date = explode('-', $project->bidduedate);
$month = [
    '01' => 'Jan',
    '02' => 'Feb',
    '03' => 'Mar',
    '04' => 'Apr',
    '05' => 'May',
    '06' => 'Jun',
    '07' => 'Jul',
    '08' => 'Aug',
    '09' => 'Sep',
    '10' => 'Oct',
    '11' => 'Nov',
    '12' => 'Dec'
];

$I->amOnPage('/project.php?open');
$I->see("{$project->name} - {$project->bidduedate}");
$I->click('EDIT');

$I->see('EDIT Project');
$I->seeInField(['id' => 'name'], $project->name);
$I->seeInField(['id' => 'plans'], $project->plans);
$I->seeInField(['id' => 'planuser'], $project->planuser);
$I->seeInField(['id' => 'planpass'], $project->planpass);
$I->seeInField(['id' => 'owner_name'], $project->owner_name);
$I->seeInField(['id' => 'owner_phone'], $project->owner_phone);
$I->seeOptionIsSelected(['name' => 'due1'], $month[$existing_date[1]]);
$I->seeOptionIsSelected(['name' => 'due2'], $existing_date[2]);
$I->seeInField(['id' => 'due3'], $existing_date[0]);
$I->seeOptionIsSelected(['name' => 'zone'], $zone1->name);
$I->seeInField(['id' => 'location'], $project->location);
$I->seeOptionIsSelected(['name' => 'super'], $super1->name);

$existing_date[0]++;
$existing_date[1]++;
$existing_date[2]++;
if ($existing_date[1] > 12) $existing_date[1] = '01';
if ($existing_date[2] > 31) $existing_date[2] = '01';
$existing_date[1] = str_pad($existing_date[1], 2, '0', STR_PAD_LEFT);
$existing_date[2] = str_pad($existing_date[2], 2, '0', STR_PAD_LEFT);

$I->fillField(['id' => 'name'], $project->name = 'New Project Name');
$I->fillField(['id' => 'plans'], $project->plans = 'New Directory');
$I->fillField(['id' => 'planuser'], $project->planuser = 'New User');
$I->fillField(['id' => 'planpass'], $project->planpass = 'New Password');
$I->fillField(['id' => 'owner_name'], $project->owner_name = 'New Owner');
$I->fillField(['id' => 'owner_phone'], $project->owner_phone = 'New phone');
$I->selectOption(['name' => 'due1'], ['value' => $existing_date[1]]);
$I->selectOption(['name' => 'due2'], ['value' => $existing_date[2]]);
$I->fillField(['id' => 'due3'], $existing_date[0]);
$I->selectOption(['name' => 'zone'], ['value' => $zone2->name]);
$I->fillField(['id' => 'location'], $project->location = 'New Location');
$I->selectOption(['name' => 'super'], ['value' => $super2Id]);
$I->click('Update');
$I->see('Project Updated!');

$I->click('VIEW LIST');
$I->see("{$project->name} - {$existing_date[0]}-{$existing_date[1]}-{$existing_date[2]}");
$I->click('EDIT');

$I->see('EDIT Project');
$I->seeInField(['id' => 'name'], $project->name);
$I->seeInField(['id' => 'plans'], $project->plans);
$I->seeInField(['id' => 'planuser'], $project->planuser);
$I->seeInField(['id' => 'planpass'], $project->planpass);
$I->seeInField(['id' => 'owner_name'], $project->owner_name);
$I->seeInField(['id' => 'owner_phone'], $project->owner_phone);
$I->seeOptionIsSelected(['name' => 'due1'], $month[$existing_date[1]]);
$I->seeOptionIsSelected(['name' => 'due2'], $existing_date[2]);
$I->seeInField(['id' => 'due3'], $existing_date[0]);
$I->seeOptionIsSelected(['name' => 'zone'], $zone2->name);
$I->seeInField(['id' => 'location'], $project->location);
$I->seeOptionIsSelected(['name' => 'super'], $super2->name);
