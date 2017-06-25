<?php 

if (isset($_GET['details'])) {
    $projectId = intval($_GET['details']);

    $project = $db->getFirst("SELECT * FROM project WHERE id = ?", [$projectId]);
    if (! count($project)) {
        die('Could not get data.');
    }

    echo "<b>{$project['name']}</b> | <b><a href='?edit=1&project={$projectId}'><font color='red'>EDIT</font></a></b><br>
        <u>{$project['plans']}<br>{$project['planuser']} | {$project['planpass']}<br><br>
        <u><a href='' rel='imgtip[0]'>Zone:</a></u> {$project['zone']} - {$project['location']}<br>
        <u>Bid Due By:</u> {$project['bidduedate']}<br>
        <u>Date Completed:</u> ";

    if ($project['completedate'] == '') { 
        echo "<font size='1'><a href='?complete=1&project=$projectId'><u><b>MARK AS COMPLETE</a></b></u></font><br><br>";
    } else { 
        echo $project['completedate'] . '<br><br>';
    }

    echo "<b><u>[ <a href='print.php?print=$projectId&name={$project['name']}' target='_new'>CALL LOG</a> ]</u></b><br><br>
        <b>[ <a href='?choose=$projectId'>CHOOSE SUB-CONTRACTORS TO BID</a> ]</b><br>
        <b>Current:</b><br>
        <font size='1'>";

    $bidders = $db->getData(
        "SELECT * FROM bid_contactors WHERE project_id = ? AND win = ? AND status != ?", 
        [$projectId, '', 'wont']
    );
    
    foreach ($bidders as $bidder) {

        if ($bidder['status'] == 'will') {
            echo "&nbsp;&nbsp;{$bidder['category']} - <b>{$bidder['company']}</b> | <a href='mailto:{$bidder['email']}?subject=Invitation to Bid&body=COMPANY NAME%0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A{$bidder['company']}%0D%0A%0D%0APROJECT NAME: {$project['name']}%0D%0APROJECT LOCATION: {$project['location']}%0D%0ABID DATE: {$project['bidduedate']}%0D%0A%0D%0APlans and Specs%0D%0A {$project['plans']} %0D%0AUser: {$project['planuser']} | Pass: {$project['planpass']}%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICENSE'>EMAIL BID INVITE</a> 

                | <b>[ <u><a href='?win=1&project={$projectId}&company={$bidder['company']}&category={$bidder['category']}&bidder={$bidder['id']}'>CHOOSE AS WINNER</a></u> ]</b><br>";
        } 

        else {
            echo "&nbsp;&nbsp;{$bidder['category']} - <b>{$bidder['company']}</b> | <a href='mailto:{$bidder['email']}?subject=Invitation to Bid&body=COMPANY NAME %0D%0A ADDRESS %0D%0A CITY STATE ZIP %0D%0APh. PHONE. Fax  FAX %0D%0Aemail:  EMAIL %0D%0A%0D%0AINVITATION TO BID%0D%0A%0D%0A{$bidder['company']}%0D%0A%0D%0APROJECT NAME: {$project['name']}%0D%0APROJECT LOCATION: {$project['location']}%0D%0ABID DATE: {$project['bidduedate']}%0D%0A%0D%0APlans and Specs%0D%0A {$project['plans']}%0D%0AUser: {$project['planuser']} | Pass: {$project['planpass']}%0D%0A%0D%0APlease return all bids by 12:00 PM of the date listed above by E-Mail or Fax.%0D%0A%0D%0A LIC NO LICSNE '>EMAIL BID INVITE</a> 

                | <b>Set Status:</b> <a href='?status=yes&id=$projectId&a={$bidder['id']}'>will bid</a> - <a href='?status=no&id=$projectId&a={$bidder['id']}'>won't bid</a><br>";
        }
    }

    if (! count($bidders)) { 
        echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i><br>"; 
    }

    echo "<br><br><b>WINNING SUB CONTRACTORS</b>:";

    $winners = $db->getData(
        "SELECT * FROM bid_contactors WHERE project_id = ? AND win = ?", 
        [$projectId, '1']
    );
    
    foreach ($winners as $winner) {
        echo "<br><br>&nbsp;&nbsp;<b>{$winner['category']}</b> - <u>{$winner['company']}</u> | <a href='mailto:{$winner['email']}'>EMAIL</a>";

        if ($winner['score'] == 'NA') { 
            echo " &nbsp;&nbsp;<u>[ <a href='?score=1&bidder={$winner['id']}&company={$winner['company']}&project=$projectId'>SCORE</a> ]</u>"; 
        }
    }

    if (! count($winners)) { 
        echo "&nbsp;&nbsp;&nbsp;&nbsp;- <i>none</i>"; 
    }

    echo "</font>";
}

if (isset($_GET['status'])) {
    $status = strtolower(htmlspecialchars(trim($_GET['status'])));
    $projectId = intval($_GET['id']);
    $bidderId = intval($_GET['a']);

    if ($status == 'yes') { 
        echo "<b>[ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><br>Bid Status Updated!";

        $db->setData("UPDATE bid_contactors SET status='will' WHERE id = ?", [$bidderId]);
    }

    if ($status == 'no') { 
        echo "<b>[ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><br>Bid Status Updated!";

        $db->setData("UPDATE bid_contactors SET status='wont' WHERE id = ?", [$bidderId]);
    }
}

if (isset($_GET['win'])) {
    $projectId = intval($_GET['project']);
    $company = htmlspecialchars(trim($_GET['company']));
    $category = htmlspecialchars(trim($_GET['category']));
    $bidderId = intval($_GET['bidder']);

    echo "<h2>AWARD BID: <br>{$company}<br>{$category}<br><br>Are you sure?</h2>
        <h3><a href='?win2=1&project={$projectId}&category={$category}&bidder={$bidderId}'>YES</a> | <a href='?details={$projectId}'>NO</a><h3>";
}

if (isset($_GET['win2'])) {
    $projectId = intval($_GET['project']);
    $bidderId = intval($_GET['bidder']);

    echo "<b> [ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><h1>BID AWARDED!</h1>";

    $db->setData("UPDATE bid_contactors SET win='1' WHERE id = ? AND project_id = ?", [$bidderId, $projectId]);

    $db->setData(
        "UPDATE bid_contactors SET win='0' WHERE id != ? AND project_id = ? & category = ?", 
        [$bidderId, $projectId, htmlspecialchars(trim($_GET['category']))]
    );
}

if (isset($_GET['score'])) {
    $bidder = $_GET['bidder'];
    $projectId = intval($_GET['project']);

    echo "<b> [ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><br>

        <b>How would you rate {" . htmlspecialchars($_GET['company']) . "'s preformance on this project?</b>
        <br><br>

        <a href='?score2=1&bidder={$bidder}&rating=5&project={$projectId}' id='happy'>
            <img src='images/happy.png' border='0'>
        </a> 

        <a href='?score2=1&bidder={$bidder}&rating=4&project={$projectId}' id='good'>
            <img src='images/good.png' border='0'>
        </a> 

        <a href='?score2=1&bidder={$bidder}&rating=3&project={$projectId}' id='ok'>
            <img src='images/ok.png' border='0'>
        </a> 

        <a href='?score2=1&bidder={$bidder}&rating=2&project={$projectId}' id='bad'>
            <img src='images/bad.png' border='0'>
        </a> 

        <a href='?score2=1&bidder={$bidder}&rating=1&project={$projectId}' id='angry'>
            <img src='images/angry.png' border='0'>
        </a>";
}

if (isset($_GET['score2'])) {
    $allowedRatings = [5,4,3,2,1];
    $rating = intval($_GET['rating']);
    if (! in_array($rating, $allowedRatings)) die("Invalid raiting.");

    echo "<b> [ <a href='?details=" . intval($_GET['project']) . "'>GO BACK</a> ]</b><br>";
    
    $db->setData("UPDATE bid_contactors SET score= ? WHERE id = ?", [$rating, intval($_GET['bidder'])]);

    echo "<br>UPDATED!";
}

if (isset($_GET['complete'])) {
    $projectId = intval($_GET['project']);

    echo "<h2>COMPLETE PROJECT: <br><br>Are you sure?</h2>
        <h3><a href='?complete2=1&project={$projectId}'>YES</a> | <a href='?details={$projectId}'>NO</a><h3>";
}

if (isset($_GET['complete2'])) {
    $projectId = intval($_GET['project']);

    echo "<b> [ <a href='?details={$projectId}'>GO BACK</a> ]</b><br>
        <h1>PROJECT COMPLETED!</h1>";

    $db->setData("UPDATE project SET completedate = ? WHERE id = ?", [$date, $projectId]);
}
