<?php

if (isset($_GET['new'])) {

    if (isset($_POST['company'])) {

        $query = $db->setData(
            "INSERT INTO `contacts` (`first`, `last`, `street`, `city`, `state`, `email`, `officephone`, `cellphone`, `fax`, `category_id`, `company`, `zip`, `score_per`, `bid_per`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                intval($_POST['type']), 
                htmlspecialchars($_POST['company']), 
                trim($_POST['zip']), 
                '0', 
                '0'
            ]);

        if ($db->updated($query)) {
            if (isset($_POST['zone']) && is_array($_POST['zone'])) { 
                $contact_id = $db->getID();
                
                foreach ($_POST['zone'] as $zone_id) {
                    $db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", [
                        $contact_id, 
                        $zone_id
                    ]);
                }
            }

            echo $templates->render('message', [
                'template' => 'contact',
                'message' => '<br><br>Contact Added!'
            ]); die();
        } 

        else {
            echo $templates->render('message', [
                'template' => 'contact',
                'message' => '<br><br>Error! Unable to create contact.'
            ]); die();
        }
    }

    echo $templates->render('contact/new', [
        'zones' => $db->getData('SELECT * FROM zones ORDER BY name'),
        'categories' => $db->getData('SELECT * FROM categories ORDER BY name')
    ]);
}
