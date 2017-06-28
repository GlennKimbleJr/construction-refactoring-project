<?php 

if (isset($_GET['choose'])) {
    $projectId = intval($_GET['choose']);

    echo "<b>[ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><br><b>CHOOSE A CATEGORY</b><br><br>";

    $categories = $db->getData("SELECT * FROM categories ORDER BY name");
    
    foreach ($categories as $category) {

        echo "<br><b><u><a href='?choose2={$projectId}&c={$category['id']}'>{$category['name']}</a></u></b><br>";
        
        $bidders = $db->getData(
            "SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", 
            [$projectId, $category['id']]
        );
        
        foreach ($bidders as $bid) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;- {$bid['company']}<br>";
        }

        if (! count($bidders)) { 
            echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>"; 
        }
    }
}

if (isset($_GET['choose2'])) {

    $projectId = intval($_GET['choose2']);
    $category = $db->getFirst('SELECT * FROM categories WHERE id = ?', [intval($_GET['c'])]);

    $project = $db->getFirst("SELECT * FROM projects WHERE id = ?", [$projectId]);
     if (! count($project)) {
       die('Could not get data');
    }

    echo "<b>[ <a href='?choose={$projectId}'>GO BACK</a> ]</b><br><br>
        <b>Choose a <u>{$category['name']}</u> Sub-Contractor</b><br><br>

        <form action='' method='POST'>

            <input id='did' type='hidden' name='did' required value='{$projectId}' />
            <input id='c' type='hidden' name='c' required value='{$category['id']}' />
            <p>
                <select name='company' required>";
                
                $zoneContacts = $db->getData(
                    "SELECT c.id, c.company FROM contacts as c, contacts_zones as cz WHERE c.id = cz.contact_id AND c.category_id = ? AND cz.zone_id = ? ORDER BY c.company",
                    [
                        $category['id'], 
                        $project['zone_id']
                    ]
                );
            
                foreach ($zoneContacts as $contact) {
                    echo "<option value='{$contact['id']}'>{$contact['company']}</option>"; 
                }

                echo "</select>
            </p>

            <input class='btn register' type='submit' name='submit' value='Submit' />
        </form><br><br>

        <b>Sub-Contractors already selected:</b><br><br>";


    $bidders = $db->getData(
        "SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?",
        [$projectId, $category['id']]
    );
    
    foreach ($bidders as $bidder) {
        echo "- {$bidder['company']}<br>";
    }

    if (! count($bidders)) { 
        echo "<i>none</i>"; 
    }
}

// checks to see if posted
if (isset($_POST['company'])) {
    $contactId = intval($_POST['company']);

    if (! $db->getCount("SELECT null FROM contacts WHERE id = ?", [$contactId])) {
        die('Could not get data');
    }

    // inserts information into database
    $query = $db->setData(
        "INSERT INTO `bidders` (project_id, contact_id, category_id, status, win, score) VALUES (?, ?, ?, ?, ?, ?)",
        [
            intval($_POST['did']), 
            $contactId,
            intval($_POST['c']), 
            '', 
            '', 
            'NA', 
        ]
    );

    die($db->updated($query) ? '<br><br>Sucess!' : '<br><br>Error!');
}
