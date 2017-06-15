<?php 

// Starts Script
if (isset($_GET['choose'])) {

    $did = $_GET['choose'];

    echo "<b>[ <a href='?details=$did'>GO BACK</a> ]</b><br><br><b>CHOOSE A CATEGORY</b><br><br>";

    $categories = $db->getData("SELECT * FROM type ORDER BY name");
    
    foreach ($categories as $category) {

        echo "<br><b><u><a href='?choose2={$did}&c={$category['name']}'>{$category['name']}</a></u></b><br>";
        
        $bidders = $db->getData(
            "SELECT * FROM bid_contactors WHERE project_id = ? AND category = ?", 
            [$did, $category['name']]
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

    $did = $_GET['choose2'];
    $c = $_GET['c'];

    $project = $db->getFirst("SELECT * FROM project WHERE id = ?", [$did]);
     if (! count($project)) {
       die('Could not get data');
    }
    
    $id = $project['id'];
    $zone = $project['zone'];

    echo "<b>[ <a href='?choose=$did'>GO BACK</a> ]</b><br><br>
        <b>Choose a <u>$c</u> Sub-Contractor</b><br><br>

        <form action='' method='POST'>

            <input id='did' type='hidden' name='did' required value='$did' />
            <input id='c' type='hidden' name='c' required value='$c' />
            <p>
                <select name='zone' required>";
                
                $zoneContacts = $db->getData(
                    "SELECT * FROM contact WHERE type = ? AND (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY company",
                    [$c, $zone, $zone, $zone, $zone, $zone, $zone, $zone, $zone, $zone]
                );
            
                foreach ($zoneContacts as $contact) {
                    echo "<option value='{$contact['company']}'>{$contact['company']}</option>"; 
                }

                echo "</select>
            </p>

            <input class='btn register' type='submit' name='submit' value='Submit' />
        </form><br><br>

        <b>Sub-Contractors already selected:</b><br><br>";


    $bidders = $db->getData(
        "SELECT * FROM bid_contactors WHERE project_id = ? AND category=?",
        [$did, $c]
    );
    
    foreach ($bidders as $bidder) {
        echo "- {$bidder['company']}<br>";
    }

    if (! count($bidders)) { 
        echo "<i>none</i>"; 
    }
}

// checks to see if posted
if (isset($_POST['zone'])) {
    $companyName = $_POST['zone'];
    $did = $_POST['did'];
    $categoryName = $_POST['c'];

    $contact = $db->getFirst("SELECT * FROM contact WHERE company = ?", [$companyName]);
    if (! count($contact)) {
        die('Could not get data');
    }

    // inserts information into database
    $query = $db->setData(
        "INSERT INTO `bid_contactors` (project_id, category, status, win, email, score, company) VALUES (?, ?, ?, ?, ?, ?, ?)",
        [$did, $categoryName, '', '', $contact['email'], 'NA', $companyName]
    );

    if ($db->updated($query)) {
        die('<br><br>Sucess!');
    } else {
        die('<br><br>Error!');
    }
}
