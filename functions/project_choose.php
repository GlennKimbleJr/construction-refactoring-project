<?php 

if (isset($_GET['choose'])) {
    $projectId = intval($_GET['choose']);

    echo "<b>[ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><br><b>CHOOSE A CATEGORY</b><br><br>";

    $categories = $db->getData("SELECT * FROM type ORDER BY name");
    
    foreach ($categories as $category) {

        echo "<br><b><u><a href='?choose2={$projectId}&c={$category['name']}'>{$category['name']}</a></u></b><br>";
        
        $bidders = $db->getData(
            "SELECT c.company FROM bidders as b, contact as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category = ?", 
            [$projectId, $category['name']]
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
    $categoryName = htmlspecialchars(trim($_GET['c']));

    $project = $db->getFirst("SELECT * FROM project WHERE id = ?", [$projectId]);
     if (! count($project)) {
       die('Could not get data');
    }

    echo "<b>[ <a href='?choose={$projectId}'>GO BACK</a> ]</b><br><br>
        <b>Choose a <u>{$categoryName}</u> Sub-Contractor</b><br><br>

        <form action='' method='POST'>

            <input id='did' type='hidden' name='did' required value='{$projectId}' />
            <input id='c' type='hidden' name='c' required value='{$categoryName}' />
            <p>
                <select name='company' required>";
                
                $zoneContacts = $db->getData(
                    "SELECT id, company FROM contact WHERE type = ? AND (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY company",
                    [
                        $categoryName, 
                        $project['zone'], $project['zone'], $project['zone'], 
                        $project['zone'], $project['zone'], $project['zone'], 
                        $project['zone'], $project['zone'], $project['zone']
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
        "SELECT c.company FROM bidders as b, contact as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category = ?",
        [$projectId, $categoryName]
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

    $contact = $db->getFirst("SELECT email FROM contact WHERE id = ?", [$contactId]);
    if (! count($contact)) {
        die('Could not get data');
    }

    // inserts information into database
    $query = $db->setData(
        "INSERT INTO `bidders` (project_id, contact_id, category, status, win, email, score) VALUES (?, ?, ?, ?, ?, ?, ?)",
        [
            intval($_POST['did']), 
            $contactId,
            htmlspecialchars(trim($_POST['c'])), 
            '', 
            '', 
            $contact['email'], 
            'NA', 
        ]
    );

    die($db->updated($query) ? '<br><br>Sucess!' : '<br><br>Error!');
}
