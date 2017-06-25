<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('mark projects as complete and see the option to do that dissapears afterwards.');

$project = $I->create('project');
$I->seeInDatabase('project', [
    'name' => $project->name,
    'completedate' => ''
]);

$I->amOnPage('/project.php?open');
$I->see($project->name);
$I->click($project->name);
$I->see('MARK AS COMPLETE');
$I->dontSee('Date Completed: ' . date('Y-m-d'));
$I->click('MARK AS COMPLETE');
$I->click('YES');
$I->see('PROJECT COMPLETED!');

$I->seeInDatabase('project', [
    'name' => $project->name,
    'completedate' => date("Y-m-d")
]);

$I->click('VIEW LIST');
$I->dontSee($project->name);
$I->click('Closed Only');
$I->see($project->name);
$I->click($project->name);
$I->dontSee('MARK AS COMPLETE');
$I->see('Date Completed: ' . date('Y-m-d'));
