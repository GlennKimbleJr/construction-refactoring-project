<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Sort contacts by zones and categories.');

$category1 = $I->create('categories', ['name' => 'Category 1']);
$zone1 = $I->create('zones', ['name' => 'Zone 1']);
$contact1 = $I->create('contacts', [
    'company' => 'Company 1',
    'category_id' => $category1->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact1->id,
    'zone_id' => $zone1->id
]);

$category2 = $I->create('categories', ['name' => 'Category 2']);
$zone2 = $I->create('zones', ['name' => 'Zone 2']);
$contact2 = $I->create('contacts', [
    'company' => 'Company 2',
    'category_id' => $category2->id
]);
$I->create('contacts_zones', [
    'contact_id' => $contact2->id,
    'zone_id' => $zone2->id
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
