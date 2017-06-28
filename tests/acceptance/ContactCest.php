<?php 

class ContactCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->zone1 = $I->create('zones');
        $this->zone2 = $I->create('zones');
        $this->zone3 = $I->create('zones');
        $this->zone4 = $I->create('zones');
        $this->zone5 = $I->create('zones');
        $this->zone6 = $I->create('zones');
        $this->zone7 = $I->create('zones');
        $this->zone8 = $I->create('zones');
        $this->zone9 = $I->create('zones');

        $this->category1 = $I->create('categories');
        $this->category2 = $I->create('categories');

        $this->contact = $I->create('contacts', ['category_id' => $this->category1->id]);
    }

    /** create a given number of contacts_zones relationships for the contact provided */
    protected function generateContactZones($I, $contact, $quantity = 1) 
    {
        for ($x = 1; $x < ($quantity + 1); $x++) {
            $I->create('contacts_zones', [
                'contact_id' => $contact->id,
                'zone_id' => $this->{"zone{$x}"}->id
            ]);
        }
    }

    public function addANewContact(AcceptanceTester $I)
    {
        $contact = make('contacts');

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
        $I->checkOption(['id' => 'zone_' . $this->zone1->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone2->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone3->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone4->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone5->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone6->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone7->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone8->id]);
        $I->checkOption(['id' => 'zone_' . $this->zone9->id]);
        $I->selectOption(['name' => 'type'], ['value' => $this->category1->id]);
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
            'category_id' => $this->category1->id,
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
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone1->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone4->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone9->id]);
    }

    public function editAContactsDetails(AcceptanceTester $I)
    {
        $this->generateContactZones($I, $this->contact, 9);

        $I->amOnPage('/contact.php?view');
        $I->see($this->contact->company);
        $I->see($this->contact->first);
        $I->see($this->contact->last);
        $I->see($this->contact->city);
        $I->see($this->contact->state);
        $I->click('EDIT');

        $I->see('EDIT Contact');
        $I->seeInField(['id' => 'company'], $this->contact->company);
        $I->seeInField(['id' => 'first'], $this->contact->first);
        $I->seeInField(['id' => 'last'], $this->contact->last);
        $I->seeInField(['id' => 'street'], $this->contact->street);
        $I->seeInField(['id' => 'city'], $this->contact->city);
        $I->seeInField(['id' => 'state'], $this->contact->state);
        $I->seeInField(['id' => 'zip'], $this->contact->zip);
        $I->seeInField(['id' => 'email'], $this->contact->email);
        $I->seeInField(['id' => 'officephone'], $this->contact->officephone);
        $I->seeInField(['id' => 'cellphone'], $this->contact->cellphone);
        $I->seeInField(['id' => 'fax'], $this->contact->fax);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone1->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone4->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone9->id]);
        $I->seeOptionIsSelected(['name' => 'type'], $this->category1->name);

        $I->fillField(['id' => 'company'], $this->contact->company = 'New Company Name');
        $I->fillField(['id' => 'first'], $this->contact->first = 'New First');
        $I->fillField(['id' => 'last'], $this->contact->last = 'New Last');
        $I->fillField(['id' => 'street'], $this->contact->street = 'New Street');
        $I->fillField(['id' => 'city'], $this->contact->city = 'New City');
        $I->fillField(['id' => 'state'], $this->contact->state = 'New State');
        $I->fillField(['id' => 'zip'], $this->contact->zip = 'new-zip-code');
        $I->fillField(['id' => 'email'], $this->contact->email = 'NewEmail@example.org');
        $I->fillField(['id' => 'officephone'], $this->contact->officephone = '111-111-1111');
        $I->fillField(['id' => 'cellphone'], $this->contact->cellphone = '111-111-1112');
        $I->fillField(['id' => 'fax'], $this->contact->fax = '111-111-1113');
        $I->uncheckOption(['id' => 'zone_' . $this->zone2->id]);
        $I->uncheckOption(['id' => 'zone_' . $this->zone5->id]);
        $I->selectOption(['name' => 'type'], ['value' => $this->category2->id]);
        $I->click('UPDATE');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($this->contact->company);
        $I->see($this->contact->first);
        $I->see($this->contact->last);
        $I->see($this->contact->city);
        $I->see($this->contact->state);
        $I->click('EDIT');

        $I->see('EDIT Contact');
        $I->seeInField(['id' => 'company'], $this->contact->company);
        $I->seeInField(['id' => 'first'], $this->contact->first);
        $I->seeInField(['id' => 'last'], $this->contact->last);
        $I->seeInField(['id' => 'street'], $this->contact->street);
        $I->seeInField(['id' => 'city'], $this->contact->city);
        $I->seeInField(['id' => 'state'], $this->contact->state);
        $I->seeInField(['id' => 'zip'], $this->contact->zip);
        $I->seeInField(['id' => 'email'], $this->contact->email);
        $I->seeInField(['id' => 'officephone'], $this->contact->officephone);
        $I->seeInField(['id' => 'cellphone'], $this->contact->cellphone);
        $I->seeInField(['id' => 'fax'], $this->contact->fax);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone1->id]);
        $I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $this->zone2->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone3->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone4->id]);
        $I->dontSeeCheckboxIsChecked(['id' => 'zone_' . $this->zone5->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone6->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone7->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone8->id]);
        $I->seeCheckboxIsChecked(['id' => 'zone_' . $this->zone9->id]);
        $I->seeOptionIsSelected(['name' => 'type'], $this->category2->name);
    }

    public function deleteAnExistingContact(AcceptanceTester $I)
    {
        $I->amOnPage('/contact.php?view');
        $I->see($this->contact->company);
        $I->see($this->contact->first);
        $I->see($this->contact->last);
        $I->see($this->contact->city);
        $I->see($this->contact->state);

        $I->click('EDIT');
        $I->see('EDIT Contact');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');

        $I->click('VIEW LIST');
        $I->dontSee($this->contact->company);
        $I->dontSee($this->contact->first);
        $I->dontSee($this->contact->last);
        $I->dontSee($this->contact->city);
        $I->dontSee($this->contact->state);

        $I->dontSeeInDatabase('contacts', [
            'first' => $this->contact->first,
            'last' => $this->contact->last,
            'street' => $this->contact->street,
            'city' => $this->contact->city,
            'state' => $this->contact->state,
            'email' => $this->contact->email,
            'officephone' => $this->contact->officephone,
            'cellphone' => $this->contact->cellphone,
            'fax' => $this->contact->fax,
            'category_id' => $this->contact->category_id,
            'company' => $this->contact->company,
            'zip' => $this->contact->zip,
            'score_per' => $this->contact->score_per,
            'bid_per' => $this->contact->bid_per,
        ]);
    }

    public function viewAContactsDetails(AcceptanceTester $I)
    {
        $this->generateContactZones($I, $this->contact, 9);

        $I->amOnPage('/contact.php?view');
        $I->see($this->contact->company);
        $I->see($this->contact->first);
        $I->see($this->contact->last);
        $I->see($this->contact->city);
        $I->see($this->contact->state);
        $I->click($this->contact->company);

        $I->see('EDIT');
        $I->see($this->contact->company);
        $I->see($this->category1->name);
        $I->see($this->zone1->name);
        $I->see($this->zone2->name);
        $I->see($this->zone3->name);
        $I->see($this->zone4->name);
        $I->see($this->zone5->name);
        $I->see($this->zone6->name);
        $I->see($this->zone7->name);
        $I->see($this->zone8->name);
        $I->see($this->zone9->name);
        $I->see($this->contact->first);
        $I->see($this->contact->last);
        $I->see($this->contact->street);
        $I->see($this->contact->city);
        $I->see($this->contact->state);
        $I->see($this->contact->zip);
        $I->see($this->contact->cellphone);
        $I->see($this->contact->officephone);
        $I->see($this->contact->fax);
        $I->see($this->contact->email);
    }

    public function sortContactsByZones(AcceptanceTester $I)
    {
        $contact1 = $this->contact;
        $contact2 = $I->create('contacts', ['company' => 'Company 2']);

        $I->create('contacts_zones', [
            'contact_id' => $contact1->id,
            'zone_id' => $this->zone1->id
        ]);

        $I->create('contacts_zones', [
            'contact_id' => $contact2->id,
            'zone_id' => $this->zone2->id
        ]);

        $I->amOnPage('/contact.php?view');
        $I->see($contact1->company);
        $I->see($contact2->company);

        $I->click('BY ZONE');
        $I->click($this->zone1->name);
        $I->see($contact1->company);
        $I->dontSee($contact2->company);

        $I->click('BY ZONE');
        $I->click($this->zone2->name);
        $I->see($contact2->company);
        $I->dontSee($contact1->company);
    }

    public function sortContactsByCategories(AcceptanceTester $I)
    {
        $contact1 = $this->contact;
        $contact2 = $I->create('contacts', [
            'company' => 'Company 2',
            'category_id' => $this->category2->id
        ]);

        $I->amOnPage('/contact.php?view');
        $I->see($contact1->company);
        $I->see($contact2->company);

        $I->click('BY TYPE');
        $I->click($this->category1->name);
        $I->see($contact1->company);
        $I->dontSee($contact2->company);

        $I->click('BY TYPE');
        $I->click($this->category2->name);
        $I->see($contact2->company);
        $I->dontSee($contact1->company);
    }
}
