<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Delete an existing contact.');

$category = $I->create('categories');
$categoryId = $I->grabFromDatabase('categories', 'id', ['name' => $category->name]);
$contact = $I->create('contacts', ['category_id' => $categoryId]);

$I->amOnPage('/contact.php?view');
$I->see($contact->company);
$I->see($contact->first);
$I->see($contact->last);
$I->see($contact->city);
$I->see($contact->state);

$I->click('EDIT');
$I->see('EDIT Contact');
$I->click('DELETE');
$I->click('YES');
$I->see('DELETED!');

$I->click('VIEW LIST');
$I->dontSee($contact->company);
$I->dontSee($contact->first);
$I->dontSee($contact->last);
$I->dontSee($contact->city);
$I->dontSee($contact->state);

$I->dontSeeInDatabase('contacts', [
    'first' => $contact->first,
    'last' => $contact->last,
    'street' => $contact->street,
    'city' => $contact->city,
    'state' => $contact->state,
    'email' => $contact->email,
    'officephone' => $contact->officephone,
    'cellphone' => $contact->cellphone,
    'fax' => $contact->fax,
    'category_id' => $contact->category_id,
    'company' => $contact->company,
    'zip' => $contact->zip,
    'score_per' => $contact->score_per,
    'bid_per' => $contact->bid_per,
]);
