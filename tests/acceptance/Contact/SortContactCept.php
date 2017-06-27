<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Sort contacts by zones and categories.');

$zone1 = $I->create('zone', ['name' => 'Zone 1']);
$category1 = $I->create('category', ['name' => 'Category 1'], 'type');
$contact1 = $I->create('contacts', [
    'company' => 'Company 1',
    'zone' => $zone1->name,
    'type' => $category1->name
]);

$zone2 = $I->create('zone', ['name' => 'Zone 2']);
$category2 = $I->create('category', ['name' => 'Category 2'], 'type');
$contact2 = $I->create('contacts', [
    'company' => 'Company 2',
    'zone' => $zone2->name,
    'type' => $category2->name
]);

$I->amOnPage('/contact.php?view');
$I->see($contact1->company);
$I->see($contact2->company);

$I->click('BY TYPE');
$I->click($category1->name);
$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->click('BY TYPE');
$I->click($category2->name);
$I->see($contact2->company);
$I->dontSee($contact1->company);

$I->click('BY ZONE');
$I->click($zone1->name);
$I->see($contact1->company);
$I->dontSee($contact2->company);

$I->click('BY ZONE');
$I->click($zone2->name);
$I->see($contact2->company);
$I->dontSee($contact1->company);
