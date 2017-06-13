<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Sort projects by complete and incomplete.');

$completedProject = $I->create('project', [
    'name' => 'Complete Project 1',
    'completedate' => '2017-01-01',
]);

$incompletedProject = $I->create('project', [
    'name' => 'Incomplete Project 2',
    'completedate' => '',
]);

$I->amOnPage('/project.php?view');
$I->see($completedProject->name);
$I->see($incompletedProject->name);

$I->click('Open Only');
$I->see($incompletedProject->name);
$I->dontSee($completedProject->name);

$I->click('Closed Only');
$I->see($completedProject->name);
$I->dontSee($incompletedProject->name);