<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new category.');

$I->amOnPage('/categories.php');
$I->click('+ ADD NEW');
$I->see('Start a New Category');

$category = make('category');

$I->fillField(['id' => 'name'], $category->name);
$I->click('Create');
$I->see('Created!');

$I->seeInDatabase('type', [
    'name' => $category->name
]);

$I->click('VIEW LIST');
$I->see($category->name);
