<?php 

class ContactCest
{
    public function addANewContact(AcceptanceTester $I)
    {
        $contact = make('contacts');
        $category = $I->create('categories');

        $zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
        $zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
        $zone3 = $I->create('zones', ['name' => 'Test Zone 3']);
        $zone4 = $I->create('zones', ['name' => 'Test Zone 4']);
        $zone5 = $I->create('zones', ['name' => 'Test Zone 5']);
        $zone6 = $I->create('zones', ['name' => 'Test Zone 6']);
        $zone7 = $I->create('zones', ['name' => 'Test Zone 7']);
        $zone8 = $I->create('zones', ['name' => 'Test Zone 8']);
        $zone9 = $I->create('zones', ['name' => 'Test Zone 9']);

        $I->amOnPage('/contact.php');
        $I->click('+ ADD NEW');
        $I->see('New Contact');

        $I->fillField(['id' => 'company'], $contact->company);
        $I->fillField(['id' => 'first'], $contact->first);
        $I->fillField(['id' => 'last'], $contact->last);
        $I->fillField(['id' => 'street'], $contact->street);
        $I->fillField(['id' => 'city'], $contact->city);
        $I->fillField(['id' => 'state'], $contact->state);
        $I->fillField(['id' => 'zip'], $contact->zip);
        $I->fillField(['id' => 'email'], $contact->email);
        $I->fillField(['id' => 'officephone'], $contact->officephone);
        $I->fillField(['id' => 'cellphone'], $contact->cellphone);
        $I->fillField(['id' => 'fax'], $contact->fax);
        $I->checkOption(['id' => 'zone_' . $zone1->id]);
        $I->checkOption(['id' => 'zone_' . $zone2->id]);
        $I->checkOption(['id' => 'zone_' . $zone3->id]);
        $I->checkOption(['id' => 'zone_' . $zone4->id]);
        $I->checkOption(['id' => 'zone_' . $zone5->id]);
        $I->checkOption(['id' => 'zone_' . $zone6->id]);
        $I->checkOption(['id' => 'zone_' . $zone7->id]);
        $I->checkOption(['id' => 'zone_' . $zone8->id]);
        $I->checkOption(['id' => 'zone_' . $zone9->id]);
        $I->selectOption(['name' => 'type'], ['value' => $category->id]);
        $I->click('Create');
        $I->see('Contact Added!');

        $I->seeInDatabase('contacts', [
            'first' => $contact->first,
            'last' => $contact->last,
            'street' => $contact->street,
            'city' => $contact->city,
            'state' => $contact->state,
            'email' => $contact->email,
            'officephone' => $contact->officephone,
            'cellphone' => $contact->cellphone,
            'fax' => $contact->fax,
            'category_id' => $category->id,
            'company' => $contact->company,
            'zip' => $contact->zip,
            'score_per' => $contact->score_per,
            'bid_per' => $contact->bid_per
        ]);

        $I->click('VIEW LIST');
        $I->see($contact->company);
        $I->see($contact->first);
        $I->see($contact->last);
        $I->see($contact->city);
        $I->see($contact->state);

        $I->click('EDIT');
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9->id]);
    }

    public function deleteAnExistingContact(AcceptanceTester $I)
    {
        $category = $I->create('categories');
        $contact = $I->create('contacts', ['category_id' => $category->id]);

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
    }

    public function editAContactsDetails(AcceptanceTester $I)
    {
        $zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
        $zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
        $zone3 = $I->create('zones', ['name' => 'Test Zone 3']);
        $zone4 = $I->create('zones', ['name' => 'Test Zone 4']);
        $zone5 = $I->create('zones', ['name' => 'Test Zone 5']);
        $zone6 = $I->create('zones', ['name' => 'Test Zone 6']);
        $zone7 = $I->create('zones', ['name' => 'Test Zone 7']);
        $zone8 = $I->create('zones', ['name' => 'Test Zone 8']);
        $zone9 = $I->create('zones', ['name' => 'Test Zone 9']);

        $category1 = $I->create('categories', ['name' => 'Test Category 1']);
        $category2 = $I->create('categories', ['name' => 'Test Category 2']);

        $contact = $I->create('contacts', [
            'category_id' => $category1->id
        ]);

        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone1->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone2->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone3->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone4->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone5->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone6->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone7->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone8->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone9->id
        ]);

        $I->amOnPage('/contact.php?view');
        $I->see($contact->company);
        $I->see($contact->first);
        $I->see($contact->last);
        $I->see($contact->city);
        $I->see($contact->state);
        $I->click('EDIT');

        $I->see('EDIT Contact');
        $I->seeInField(['id' => 'company'], $contact->company);
        $I->seeInField(['id' => 'first'], $contact->first);
        $I->seeInField(['id' => 'last'], $contact->last);
        $I->seeInField(['id' => 'street'], $contact->street);
        $I->seeInField(['id' => 'city'], $contact->city);
        $I->seeInField(['id' => 'state'], $contact->state);
        $I->seeInField(['id' => 'zip'], $contact->zip);
        $I->seeInField(['id' => 'email'], $contact->email);
        $I->seeInField(['id' => 'officephone'], $contact->officephone);
        $I->seeInField(['id' => 'cellphone'], $contact->cellphone);
        $I->seeInField(['id' => 'fax'], $contact->fax);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9->id]);
        $I->seeOptionIsSelected(['name' => 'type'], $category1->name);

        $I->fillField(['id' => 'company'], $contact->company = 'New Company Name');
        $I->fillField(['id' => 'first'], $contact->first = 'New First');
        $I->fillField(['id' => 'last'], $contact->last = 'New Last');
        $I->fillField(['id' => 'street'], $contact->street = 'New Street');
        $I->fillField(['id' => 'city'], $contact->city = 'New City');
        $I->fillField(['id' => 'state'], $contact->state = 'New State');
        $I->fillField(['id' => 'zip'], $contact->zip = $contact->zip + 1);
        $I->fillField(['id' => 'email'], $contact->email = 'NewEmail@example.org');
        $I->fillField(['id' => 'officephone'], $contact->officephone = '111-111-1111');
        $I->fillField(['id' => 'cellphone'], $contact->cellphone = '111-111-1112');
        $I->fillField(['id' => 'fax'], $contact->fax = '111-111-1113');
        $I->uncheckOption(['id' => 'zone_' . $zone2->id]);
        $I->uncheckOption(['id' => 'zone_' . $zone5->id]);
        $I->selectOption(['name' => 'type'], ['value' => $category2->id]);
        $I->click('UPDATE');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($contact->company);
        $I->see($contact->first);
        $I->see($contact->last);
        $I->see($contact->city);
        $I->see($contact->state);
        $I->click('EDIT');

        $I->see('EDIT Contact');
        $I->seeInField(['id' => 'company'], $contact->company);
        $I->seeInField(['id' => 'first'], $contact->first);
        $I->seeInField(['id' => 'last'], $contact->last);
        $I->seeInField(['id' => 'street'], $contact->street);
        $I->seeInField(['id' => 'city'], $contact->city);
        $I->seeInField(['id' => 'state'], $contact->state);
        $I->seeInField(['id' => 'zip'], $contact->zip);
        $I->seeInField(['id' => 'email'], $contact->email);
        $I->seeInField(['id' => 'officephone'], $contact->officephone);
        $I->seeInField(['id' => 'cellphone'], $contact->cellphone);
        $I->seeInField(['id' => 'fax'], $contact->fax);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone1->id]);
        $I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone4->id]);
        $I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $zone9->id]);
        $I->seeOptionIsSelected(['name' => 'type'], $category2->name);
    }

    public function sortContactsByZonesAndCategories(AcceptanceTester $I)
    {
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
    }

    public function viewAContactsDetails(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Test Category']);

        $zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
        $zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
        $zone3 = $I->create('zones', ['name' => 'Test Zone 3']);
        $zone4 = $I->create('zones', ['name' => 'Test Zone 4']);
        $zone5 = $I->create('zones', ['name' => 'Test Zone 5']);
        $zone6 = $I->create('zones', ['name' => 'Test Zone 6']);
        $zone7 = $I->create('zones', ['name' => 'Test Zone 7']);
        $zone8 = $I->create('zones', ['name' => 'Test Zone 8']);
        $zone9 = $I->create('zones', ['name' => 'Test Zone 9']);

        $contact = $I->create('contacts', [
            'type' => $category->name,
        ]);

        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone1->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone2->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone3->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone4->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone5->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone6->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone7->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone8->id
        ]);
        $I->create('contacts_zones', [
            'contact_id' => $contact->id,
            'zone_id' => $zone9->id
        ]);

        $I->amOnPage('/contact.php?view');
        $I->see($contact->company);
        $I->see($contact->first);
        $I->see($contact->last);
        $I->see($contact->city);
        $I->see($contact->state);
        $I->click($contact->company);

        $I->see('EDIT');
        $I->see($contact->company);
        $I->see($category->name);
        $I->see($zone1->name);
        $I->see($zone2->name);
        $I->see($zone3->name);
        $I->see($zone4->name);
        $I->see($zone5->name);
        $I->see($zone6->name);
        $I->see($zone7->name);
        $I->see($zone8->name);
        $I->see($zone9->name);
        $I->see($contact->first);
        $I->see($contact->last);
        $I->see($contact->street);
        $I->see($contact->city);
        $I->see($contact->state);
        $I->see($contact->zip);
        $I->see($contact->cellphone);
        $I->see($contact->officephone);
        $I->see($contact->fax);
        $I->see($contact->email);
    }
}
