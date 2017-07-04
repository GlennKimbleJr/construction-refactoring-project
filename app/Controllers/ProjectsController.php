<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class ProjectsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  string  $sort
     * @return \Zend\Diactoros\Response
     */
    public function index(Request $request, $sort = 'all')
    {
        if (isset($request->getQueryParams()['s'])) {
            $sort = $request->getQueryParams()['s'];
        }

        $orderable = [
            'all' => "ORDER BY bidduedate",
            'open' => "WHERE completedate = '' ORDER BY bidduedate",
            'closed' => "WHERE completedate != '' ORDER BY bidduedate"
        ];

        if (! key_exists($sort, $orderable)) $sort = 'all';

        return $this->view('project/view', [
            'title' => 'Project Menu',
            'projects' => $this->db->getData("SELECT * FROM projects " . $orderable[$sort]),
            'sort' => $sort
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Zend\Diactoros\Response
     */
    public function create()
    {
        return $this->view('project/new', [
            'title' => 'Add New Project',
            'supers' => $this->db->getData("SELECT * FROM supers ORDER BY name"),
            'zones' => $this->db->getData("SELECT * FROM zones ORDER BY name")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @return \Zend\Diactoros\Response
     */
    public function store(Request $request)
    {
        $request = $request->getParsedBody();
        
        $query = $this->db->setData("INSERT INTO `projects` (name, bidduedate, completedate, zone_id, plans, location, planuser, planpass, owner_name, owner_phone, super_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $request['name'],
            $request['due3'] . '-' . $request['due1'] . '-' . $request['due2'],
            '', 
            $request['zone'],
            $request['plans'],
            $request['location'],
            $request['planuser'],
            $request['planpass'],
            $request['owner_name'],
            $request['owner_phone'],
            $request['super']
        ]);

        return $this->view('message', [
            'template' => 'project',
            'message' => $this->db->updated($query) ? 
                '<br><br>Project Created!' : 
                '<br><br>Error! Unable to create project.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function show($id)
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $bidders = $this->db->getData(
            "SELECT b.*, c.company, c.email, cat.name as category_name, cat.id as category_id FROM bidders as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = cat.id AND b.win = ? AND b.status != ?", 
            [$id, '', 'wont']
        );

        $winners = $this->db->getData(
            "SELECT b.*, c.company, c.email, cat.name as category FROM bidders as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.category_id = cat.id AND b.project_id = ? AND b.win = ?", 
            [$id, '1']
        );

        return $this->view('project/details', [
            'title' => 'View Project',
            'projectId' => $id,
            'project' => $project,
            'bidders' => $bidders,
            'winners' => $winners
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function edit($id)
    {
        $project = $this->db->getFirst("SELECT p.*, z.name as zone_name FROM projects as p, zones as z WHERE p.zone_id = z.id AND p.id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }
        
        $date1 = substr($project['bidduedate'], 5, -3);
        $date2 = substr($project['bidduedate'], 8);
        $date3 = substr($project['bidduedate'], 0, -6);
        if ($date1 == "01") { $date4 = "Jan"; }
        if ($date1 == "02") { $date4 = "Feb"; }
        if ($date1 == "03") { $date4 = "Mar"; }
        if ($date1 == "04") { $date4 = "Apr"; }
        if ($date1 == "05") { $date4 = "May"; }
        if ($date1 == "06") { $date4 = "Jun"; }
        if ($date1 == "07") { $date4 = "Jul"; }
        if ($date1 == "08") { $date4 = "Aug"; }
        if ($date1 == "09") { $date4 = "Sep"; }
        if ($date1 == "10") { $date4 = "Oct"; }
        if ($date1 == "11") { $date4 = "Nov"; }
        if ($date1 == "12") { $date4 = "Dec"; }

        return $this->view('project/edit', [
            'title' => 'Edit Project',
            'project' => $project,
            'date1' => $date1,
            'date2' => $date2,
            'date3' => $date3,
            'date4' => $date4,
            'zones' => $this->db->getData("SELECT * FROM zones ORDER BY name"),
            'supers' => $this->db->getData("SELECT id, name FROM supers ORDER BY name")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->getParsedBody();

        $query = $this->db->setData(
            "UPDATE projects SET name=?, bidduedate=?, zone_id=?, plans=?, location=?, planuser=?, planpass=?, owner_name=?, owner_phone=?, super_id=? WHERE id=?",
            [
                $request['name'],
                $request['due3'] . '-' . $request['due1'] . '-' . $request['due2'],
                $request['zone'],
                $request['plans'],
                $request['location'],
                $request['planuser'],
                $request['planpass'],
                $request['owner_name'],
                $request['owner_phone'],
                $request['super'],
                $id
            ]
        );

        return $this->view('message', [
            'template' => 'project',
            'message' => $this->db->updated($query) ? '<br><br>Project Updated!' : '<br><br>Update Error'
        ]);
    }

    /**
     * Confirm you want to remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function delete($id)
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        return $this->view('message', [
            'template' => 'project',
            'message' => "<h1>ARE YOU SURE?</h1><br>
                <h3>
                    <form method='post' action='/projects/{$id}/delete'>
                        <button type='submit'>YES</button> | <a href='/projects/{$id}/edit'>NO</a>
                    </form> 
                <h3>"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function destroy($id)
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $this->db->setData("DELETE FROM `projects` WHERE id = ?", [$id]);
        
        return $this->view('message', [
            'template' => 'project',
            'message' => '<h1>PROJECT DELETED!</h1><br>'
        ]);
    }

    /**
     * Confirm if the project is completed.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function complete($id) 
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        return $this->view('message', [
            'template' => 'project',
            'message' => "<h2>COMPLETE PROJECT: <br><br>Are you sure?</h2>
                <h3>
                    <form method='post' action='/projects/{$id}/complete'>
                        <button type='submit'>YES</button> | <a href='/projects/{$id}'>NO</a>
                    </form> 
                <h3>"
        ]);
    }
    
    /**
     * Marks the project as being complete.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function completed($id) 
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $this->db->setData("UPDATE projects SET completedate = ? WHERE id = ?", [date("Y-m-d"), $id]);

        return $this->view('message', [
            'template' => 'project',
            'message' => "<b> [ <a href='/projects/{$id}'>GO BACK</a> ]</b><br><h1>PROJECT COMPLETED!</h1>"
        ]);
    }

    /**
     * List of categories to select bidders for.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function selectCat($id) 
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);

        if (! count($project)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $categories = $this->db->getData("SELECT * FROM categories ORDER BY name");

        foreach ($categories as $key=>$category) {
            $categories[$key]['bidders'] = $this->db->getData( "SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", [
                    $id, 
                    $category['id']
            ]);
        }

        return $this->view('project/choose_category', [
            'title' => 'Choose a Category',
            'projectId' => $id,
            'categories' => $categories
        ]);
    }

    /**
     * List of bidders to invite for a specific category.
     *
     * @param  int  $id
     * @param  int  $category_id
     * @return \Zend\Diactoros\Response
     */
    public function selectBid($id, $category_id) 
    {
        $project = $this->db->getFirst("SELECT * FROM projects WHERE id = ?", [$id]);
        $category = $this->db->getFirst("SELECT * FROM categories WHERE id = ?", [$category_id]);

        if (! count($project) || ! count($category)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $zoneContacts = $this->db->getData("SELECT c.id, c.company FROM contacts as c, contacts_zones as cz WHERE c.id = cz.contact_id AND c.category_id = ? AND cz.zone_id = ? ORDER BY c.company", [
            $category['id'], 
            $project['zone_id']
        ]);

        $bidders = $this->db->getData("SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", [
            $id, 
            $category_id
        ]);

        return $this->view('project/choose_sub', [
            'title' => 'Choose a Sub-Contractor',
            'projectId' => $id,
            'category' => $category,
            'project' => $project,
            'zoneContacts' => $zoneContacts,
            'bidders' => $bidders,
        ]);
    }

    /**
     * Creates a bidders resource (project/contact relationship) in storage.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function addBid($id) 
    {
        $contact = $this->db->getFirst("SELECT * FROM contacts WHERE id = ?", [intval($_POST['company'])]);

        if (! $this->db->getCount("SELECT null FROM projects WHERE id = ?", [$id])
            || ! count($contact)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $query = $this->db->setData(
            "INSERT INTO `bidders` (project_id, contact_id, category_id, status, win, score) 
                VALUES (?, ?, ?, ?, ?, ?)", [
                    $id,
                    $contact['id'],
                    $contact['category_id'],
                    '',
                    '',
                    'NA'
                ]
            );

        $message = "<b> [ <a href='/projects/{$id}/categories/{$contact['category_id']}/bidders'>GO BACK</a> ]</b><br>";
        $message .= $this->db->updated($query) ? '<br><br>Sucess!' : '<br><br>Error!';

        return $this->view('message', [
            'template' => 'project',
            'message' => $message
        ]);
    }

    /**
     * Display a list of the project contain details and winning bidders contact details.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function calllog($id)
    {
        $project = $this->db->getFirst("SELECT p.*, s.name as super_name, s.phone as super_phone FROM projects as p, supers as s WHERE p.super_id = s.id AND p.id = ?", [$id]);
        
        if (! count($project)) {
           die('Could not get data');
        }
        
        $winners = $this->db->getData(
            "SELECT c.*, cat.name as category FROM contacts as c, bidders as b, categories as cat WHERE c.id = b.contact_id AND b.category_id = cat.id AND b.project_id = ? AND b.win = ? ORDER BY b.category_id", 
            [$id, 1]
        );

        return $this->view('print', [
            'title' => 'Print Call Log',
            'project' => $project,
            'winners' => $winners
        ]);
    }
}
