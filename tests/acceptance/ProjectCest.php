<?php 

class ProjectCest
{
    public function addANewProject(AcceptanceTester $I)
    {
        $zone = $I->create('zones');
        $super = $I->create('supers');
        $project = make('projects');
        $project_date = explode('-', $project->bidduedate);

        $I->amOnPage('/project.php');
        $I->click('+ ADD NEW');
        $I->see('Start a New Project');

        $I->fillField(['id' => 'name'], $project->name);
        $I->fillField(['id' => 'plans'], $project->plans);
        $I->fillField(['id' => 'planuser'], $project->planuser);
        $I->fillField(['id' => 'planpass'], $project->planpass);
        $I->fillField(['id' => 'owner_name'], $project->owner_name);
        $I->fillField(['id' => 'owner_phone'], $project->owner_phone);
        $I->selectOption(['name' => 'due1'], ['value' => $project_date[1]]);
        $I->selectOption(['name' => 'due2'], ['value' => $project_date[2]]);
        $I->fillField(['id' => 'due3'], $project_date[0]);
        $I->selectOption(['name' => 'zone'], ['value' => $zone->id]);
        $I->fillField(['id' => 'location'], $project->location);
        $I->selectOption(['name' => 'super'], ['value' => $super->id]);
        $I->click('Create');
        $I->see('Project Created!');

        $I->seeInDatabase('projects', [
            'name' => $project->name,
            'bidduedate' => $project->bidduedate,
            'completedate' => $project->completedate,
            'zone_id' => $zone->id,
            'plans' => $project->plans,
            'planuser' => $project->planuser,
            'planpass' => $project->planpass,
            'owner_name' => $project->owner_name,
            'owner_phone' => $project->owner_phone,
            'super_id' => $super->id,
        ]);

        $I->click('VIEW LIST');
        $I->see("{$project->name} - {$project->bidduedate}");
    }

    public function seeWinningSubcontractorsAreOnTheCallLog(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Test Category']);
        $zone = $I->create('zones', ['name' => 'Test Zone']);

        $contact1 = $I->create('contacts', [
            'company' => 'Test Company 1',
            'zone' => $zone->name,
            'type' => $category->name
        ]);

        $contact2 = $I->create('contacts', [
            'company' => 'Test Company 2',
            'zone' => $zone->name,
            'type' => $category->name
        ]);

        $super = $I->create('supers');
        $project = $I->create('projects', ['zone' => $zone->name, 'super_id' => $super->id]);

        $bidder1 = $I->create('bidders', [
            'project_id' => $project->id,
            'contact_id' => $contact1->id,
            'category_id' => $category->id,
            'status' => 'won',
            'win' => 1,
        ]);

        $bidder2 = $I->create('bidders', [
            'project_id' => $project->id,
            'contact_id' => $contact2->id,
            'category_id' => $category->id,
            'status' => 'will',
            'win' => 0,
        ]);

        $I->amOnPage('/project.php?open');
        $I->see($project->name);
        $I->click($project->name);

        $I->click('CALL LOG');
        $I->see($contact1->company);
        $I->dontSee($contact2->company);

        $I->see($super->name);
        $I->see($super->phone);
    }

    public function addSubcontractorsToAProject(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Category Test']);

        $zone1 = $I->create('zones', ['name' => 'Zone 1']);
        $zone1Contact = $I->create('contacts', [
            'company' => 'Company 1',
            'type' => $category->name
        ]);
        $I->create('contacts_zones', [
            'zone_id' => $zone1->id,
            'contact_id' => $zone1Contact->id
        ]);

        $zone2 = $I->create('zones', ['name' => 'Zone 2']);
        $zone2Contact = $I->create('contacts', [
            'company' => 'Company 2',
            'type' => $category->name
        ]);
        $I->create('contacts_zones', [
            'zone_id' => $zone2->id,
            'contact_id' => $zone2Contact->id
        ]);

        $zone1Project = $I->create('projects', ['zone_id' => $zone1->id]);

        $I->amOnPage('/project.php?open');
        $I->see($zone1Project->name);
        $I->click($zone1Project->name);
        $I->dontSee($zone1Contact->company);
        $I->dontSee($zone2Contact->company);
        $I->click('CHOOSE SUB-CONTRACTORS TO BID');

        $I->see($category->name);
        $I->dontSee($zone1Contact->company);
        $I->dontSee($zone2Contact->company);
        $I->click($category->name);

        $I->canSeeInSource($zone1Contact->company);
        $I->cantSeeInSource($zone2Contact->company);
        $I->selectOption(['name' => 'company'], ['text' => $zone1Contact->company]);
        $I->click('Submit');
        $I->see('Sucess!');
        $I->click('GO BACK');

        $I->see($category->name);
        $I->see($zone1Contact->company);
        $I->dontSee($zone2Contact->company);
        $I->click('GO BACK');

        $I->see("{$category->name} - {$zone1Contact->company}");
    }

    public function markProjectAsCompleteAndThenSeeTheOptionToDoSoDisapear(AcceptanceTester $I)
    {
        $project = $I->create('projects');
        $I->seeInDatabase('projects', [
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

        $I->seeInDatabase('projects', [
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
    }

    public function deleteAnExistingProject(AcceptanceTester $I)
    {
        $zone = $I->create('zones', ['name' => 'Test Zone 1']);
        $project = $I->create('projects', ['zone_id' => $zone->id]);

        $I->amOnPage('/project.php?open');
        $I->see("{$project->name} - {$project->bidduedate}");
        $I->click('EDIT');

        $I->see('EDIT Project');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');
        $I->click('VIEW LIST');
        $I->dontSee("{$project->name} - {$project->bidduedate}");

        $I->dontSeeInDatabase('projects', [
            'name' => $project->name,
            'bidduedate' => $project->bidduedate,
            'completedate' => $project->completedate,
            'zone_id' => $project->zone_id,
            'plans' => $project->plans,
            'location' => $project->location,
            'planuser' => $project->planuser,
            'planpass' => $project->planpass,
            'owner_name' => $project->owner_name,
            'owner_phone' => $project->owner_phone,
            'super_id' => $project->super_id
        ]);
    }

    public function editAProjectsDetails(AcceptanceTester $I)
    {
        $super1 = $I->create('supers', ['name' => 'Test Super 1']);
        $super2 = $I->create('supers', ['name' => 'Test Super 2']);
        $zone1 = $I->create('zones', ['name' => 'Test Zone 1']);
        $zone2 = $I->create('zones', ['name' => 'Test Zone 2']);
        $project = $I->create('projects', [
            'zone_id' => $zone1->id,
            'super_id' => $super1->id
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
        $I->selectOption(['name' => 'zone'], ['value' => $zone2->id]);
        $I->fillField(['id' => 'location'], $project->location = 'New Location');
        $I->selectOption(['name' => 'super'], ['value' => $super2->id]);
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
    }

    public function rateAWinningSubcontractorsPreformance(AcceptanceTester $I)
    {
        $category1 = $I->create('categories', ['name' => 'Test Category 1']);
        $category2 = $I->create('categories', ['name' => 'Test Category 2']);
        $category3 = $I->create('categories', ['name' => 'Test Category 3']);
        $category4 = $I->create('categories', ['name' => 'Test Category 4']);
        $category5 = $I->create('categories', ['name' => 'Test Category 5']);

        $contact1 = $I->create('contacts', [
            'company' => 'Test Company 1',
            'category_id' => $category1->id
        ]);
        $contact2 = $I->create('contacts', [
            'company' => 'Test Company 2',
            'category_id' => $category2->id
        ]);
        $contact3 = $I->create('contacts', [
            'company' => 'Test Company 3',
            'category_id' => $category3->id
        ]);
        $contact4 = $I->create('contacts', [
            'company' => 'Test Company 4',
            'category_id' => $category4->id
        ]);
        $contact5 = $I->create('contacts', [
            'company' => 'Test Company 5',
            'category_id' => $category5->id
        ]);

        $project = $I->create('projects');

        $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category1->name,
            'status' => 'won',
            'win' => '1',
            'score' => 'NA',
            'contact_id' => $contact1->id
        ]);

        $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category2->name,
            'status' => 'won',
            'win' => '1',
            'score' => 'NA',
            'contact_id' => $contact2->id
        ]);

        $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category3->name,
            'status' => 'won',
            'win' => '1',
            'score' => 'NA',
            'contact_id' => $contact3->id
        ]);

        $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category4->name,
            'status' => 'won',
            'win' => '1',
            'score' => 'NA',
            'contact_id' => $contact4->id
        ]);

        $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category5->name,
            'status' => 'won',
            'win' => '1',
            'score' => 'NA',
            'contact_id' => $contact5->id
        ]);

        $I->amOnPage('/project.php?open');
        $I->click($project->name);

        $I->see($contact1->company);
        $I->click('SCORE');
        $I->click(['id'=>'happy']);
        $I->see('UPDATED');
        $I->seeInDatabase('bidders', [
            'contact_id' => $contact1->id,
            'score' => '5'
        ]);

        $I->click('GO BACK');
        $I->see($contact2->company);
        $I->click('SCORE');
        $I->click(['id'=>'good']);
        $I->see('UPDATED');
        $I->seeInDatabase('bidders', [
            'contact_id' => $contact2->id,
            'score' => '4'
        ]);

        $I->click('GO BACK');
        $I->see($contact3->company);
        $I->click('SCORE');
        $I->click(['id'=>'ok']);
        $I->see('UPDATED');
        $I->seeInDatabase('bidders', [
            'contact_id' => $contact3->id,
            'score' => '3'
        ]);

        $I->click('GO BACK');
        $I->see($contact4->company);
        $I->click('SCORE');
        $I->click(['id'=>'bad']);
        $I->see('UPDATED');
        $I->seeInDatabase('bidders', [
            'contact_id' => $contact4->id,
            'score' => '2'
        ]);

        $I->click('GO BACK');
        $I->see($contact5->company);
        $I->click('SCORE');
        $I->click(['id'=>'angry']);
        $I->see('UPDATED');
        $I->seeInDatabase('bidders', [
            'contact_id' => $contact5->id,
            'score' => '1'
        ]);
    }

    public function sortProjectsByCompleteAndIncomplete(AcceptanceTester $I)
    {
        $completedProject = $I->create('projects', [
            'name' => 'Complete Project 1',
            'completedate' => '2017-01-01',
        ]);

        $incompletedProject = $I->create('projects', [
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
    }

    public function markASubContractorAsWillingToBidAProject(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Test Category']);
        $zone = $I->create('zones', ['name' => 'Test Zone']);
        $contact1 = $I->create('contacts', [
            'company' => 'Test Company 1',
            'zone' => $zone->name,
            'type' => $category->name
        ]);
        $contact2 = $I->create('contacts', [
            'company' => 'Test Company 2',
            'zone' => $zone->name,
            'type' => $category->name
        ]);

        $project = $I->create('projects', ['zone' => $zone->name]);
        $bidder1 = $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category->name,
            'contact_id' => $contact1->id
        ]);
        $bidder2 = $I->create('bidders', [
            'project_id' => $project->id,
            'category' => $category->name,
            'contact_id' => $contact2->id
        ]);

        $I->amOnPage('/project.php?open');
        $I->see($project->name);
        $I->click($project->name);
        $I->see("{$category->name} - {$contact1->company}");
        $I->see("{$category->name} - {$contact2->company}");
        $I->click('will bid');
        $I->see('Bid Status Updated!');
        $I->click('GO BACK');
        $I->see("{$category->name} - {$contact1->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");
        $I->see("{$category->name} - {$contact2->company} | EMAIL BID INVITE | Set Status: will bid - won't bid");

        $I->seeInDatabase('bidders', [
            'project_id' => $project->id,
            'status' => 'will',
            'contact_id' => $contact1->id
        ]);

        $I->seeInDatabase('bidders', [
            'project_id' => $project->id,
            'status' => '',
            'contact_id' => $contact2->id
        ]);
    }

    public function markASubContractorAsHavingWonAProject(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Test Category']);
        $zone = $I->create('zones', ['name' => 'Test Zone']);
        $project = $I->create('projects', ['zone_id' => $zone->id]);

        $contact1 = $I->create('contacts', [
            'company' => 'Test Company 1',
            'zone' => $zone->name,
            'cat' => $category->name
        ]);

        $contact2 = $I->create('contacts', [
            'company' => 'Test Company 2',
            'zone' => $zone->name,
            'type' => $category->name
        ]);

        $bidder1 = $I->create('bidders', [
            'project_id' => $project->id,
            'category_id' => $category->id,
            'status' => 'will',
            'contact_id' => $contact1->id
        ]);
        $bidder2 = $I->create('bidders', [
            'project_id' => $project->id,
            'category_id' => $category->id,
            'status' => 'will',
            'contact_id' => $contact2->id
        ]);

        $I->amOnPage('/project.php?open');
        $I->see($project->name);
        $I->click($project->name);
        $I->see("{$category->name} - {$contact1->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");
        $I->see("{$category->name} - {$contact2->company} | EMAIL BID INVITE | [ CHOOSE AS WINNER ]");

        $I->click('CHOOSE AS WINNER');
        $I->see('AWARD BID:');
        $I->see($contact1->company);
        $I->see($category->name);
        $I->click('YES');
        $I->see('BID AWARDED!');
        $I->click('GO BACK');

        $I->see($contact1->company);
        $I->dontSee($contact2->company);

        $I->seeInDatabase('bidders', [
            'project_id' => $project->id,
            'status' => 'will',
            'win' => '1',
            'contact_id' => $contact1->id
        ]);

        $I->seeInDatabase('bidders', [
            'project_id' => $project->id,
            'status' => 'will',
            'win' => '0',
            'contact_id' => $contact2->id
        ]);
    }

    public function markASubContractorAsUnwillingToBidAProject(AcceptanceTester $I)
    {
        $category = $I->create('categories', ['name' => 'Test Category']);
        $contact = $I->create('contacts', [
            'company' => 'Test Company',
            'category_id' => $category->id
        ]);
        $project = $I->create('projects');
        $bidder = $I->create('bidders', [
            'project_id' => $project->id,
            'category_id' => $category->id,
            'company' => $contact->company
        ]);

        $I->amOnPage('/project.php?open');
        $I->see($project->name);
        $I->click($project->name);
        $I->see("{$category->name} - {$contact->company}");
        $I->click('won\'t bid');
        $I->see('Bid Status Updated!');
        $I->click('GO BACK');
        $I->dontSee($contact->company);

        $I->seeInDatabase('bidders', [
            'project_id' => $project->id,
            'status' => 'wont'
        ]);
    }
}
