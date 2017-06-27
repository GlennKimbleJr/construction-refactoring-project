<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an exiting category.');

$category = $I->create('categories');

$I->amOnPage('/categories.php?view');
$I->see($category->name);

$I->click($category->name);
$I->see('EDIT');

$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');

$I->click('VIEW LIST');
$I->dontSee($category->name);

$I->dontSeeInDatabase('categories', [
    'name' => $category->name
]);
