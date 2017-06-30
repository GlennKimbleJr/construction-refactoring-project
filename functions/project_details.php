<?php 

if (isset($_GET['details'])) 
{
    $projectId = intval($_GET['details']);
    $project = $db->getFirst("SELECT * FROM projects WHERE id = ?", [$projectId]);

    if (! count($project)) {
        echo $templates->render('message', [
            'template' => 'project',
            'message' => 'Could not get data.'
        ]); die();
    }

    $bidders = $db->getData(
        "SELECT b.*, c.company, c.email, cat.name as category_name, cat.id as category_id FROM bidders as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = cat.id AND b.win = ? AND b.status != ?", 
        [$projectId, '', 'wont']
    );

    $winners = $db->getData(
        "SELECT b.*, c.company, c.email, cat.name as category FROM bidders as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.category_id = cat.id AND b.project_id = ? AND b.win = ?", 
        [$projectId, '1']
    );

    echo $templates->render('project/details', [
        'title' => 'View Project',
        'projectId' => $projectId,
        'project' => $project,
        'bidders' => $bidders,
        'winners' => $winners
    ]);
}

if (isset($_GET['status'])) {
    $status = strtolower(htmlspecialchars(trim($_GET['status'])));

    $db->setData("UPDATE bidders SET status = ? WHERE id = ?", [
        ($status == 'yes') ? 'will' : 'wont',
        intval($_GET['a'])
    ]);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<b>[ <a href='?details=" . intval($_GET['id']) . "'>GO BACK</a> ]</b><br><br>Bid Status Updated!"
    ]); die();
}

if (isset($_GET['win'])) {
    $projectId = intval($_GET['project']);
    $company = htmlspecialchars(trim($_GET['company']));
    $bidderId = intval($_GET['bidder']);

    $category = $db->getFirst("SELECT * FROM categories WHERE id = ?", [intval($_GET['category'])]);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<h2>AWARD BID: <br>{$company}<br>{$category['name']}<br><br>Are you sure?</h2>
        <h3><a href='?win2=1&project={$projectId}&category={$category['id']}&bidder={$bidderId}'>YES</a> | <a href='?details={$projectId}'>NO</a><h3>"
    ]);
}

if (isset($_GET['win2'])) {
    $projectId = intval($_GET['project']);
    $bidderId = intval($_GET['bidder']);

    $db->setData("UPDATE bidders SET win='1' WHERE id = ? AND project_id = ?", [$bidderId, $projectId]);

    $db->setData(
        "UPDATE bidders SET win='0' WHERE id != ? AND project_id = ? AND category_id = ?", 
        [$bidderId, $projectId, intval($_GET['category'])]
    );

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<b> [ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><h1>BID AWARDED!</h1>"
    ]);
}

if (isset($_GET['score'])) {
    echo $templates->render('project/rate', [
        'title' => 'Rate Sub-Contractor',
        'company' => $_GET['company'],
        'bidder' => $_GET['bidder'],
        'projectId' => intval($_GET['project'])
    ]);
}

if (isset($_GET['score2'])) {
    $allowedRatings = [5,4,3,2,1];
    $rating = intval($_GET['rating']);
    if (! in_array($rating, $allowedRatings)) {
        echo $templates->render('message', [
            'template' => 'project',
            'message' => 'Invalid raiting.'
        ]); die();
    }

    $db->setData("UPDATE bidders SET score= ? WHERE id = ?", [$rating, intval($_GET['bidder'])]);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<b> [ <a href='?details=" . intval($_GET['project']) . "'>GO BACK</a> ]</b><br><br>UPDATED!"
    ]);
}

if (isset($_GET['complete'])) {
    $projectId = intval($_GET['project']);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<h2>COMPLETE PROJECT: <br><br>Are you sure?</h2>
        <h3><a href='?complete2=1&project={$projectId}'>YES</a> | <a href='?details={$projectId}'>NO</a><h3>"
    ]);
}

if (isset($_GET['complete2'])) {
    $projectId = intval($_GET['project']);

    $db->setData("UPDATE projects SET completedate = ? WHERE id = ?", [$date, $projectId]);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<b> [ <a href='?details={$projectId}'>GO BACK</a> ]</b><br><h1>PROJECT COMPLETED!</h1>"
    ]);
}
