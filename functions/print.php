<?php 

if (isset($_GET['print'])) {
    $project = $db->getFirst("SELECT p.*, s.name as super_name, s.phone as super_phone FROM projects as p, supers as s WHERE p.super_id = s.id AND p.id = ?", [intval($_GET['print'])]);
    
    if (! count($project)) {
       die('Could not get data');
    }
    
    $winners = $db->getData(
        "SELECT c.*, cat.name as category FROM contacts as c, bidders as b, categories as cat WHERE c.id = b.contact_id AND b.category_id = cat.id AND b.project_id = ? AND b.win = ? ORDER BY b.category_id", 
        [intval($_GET['print']), 1]
    );

    echo $templates->render('print', [
        'title' => 'Print Call Log',
        'project' => $project,
        'winners' => $winners
    ]);
}
