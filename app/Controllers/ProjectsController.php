<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Bidder;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Superintendent;
use App\Models\Zone;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProjectsController extends Controller
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
            'title' => 'Projects',
            'projects' => (new Project($this->db))->getSortable($orderable[$sort]),
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
            'supers' => (new Superintendent($this->db))->get('*', 'ORDER BY name'),
            'zones' => (new Zone($this->db))->get('*', 'ORDER BY name')
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
        return $this->view('message', [
            'template' => 'project',
            'message' => (new Project($this->db))->add($request->getParsedBody()) ?
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
        $project = (new Project($this->db))->firstOrFail($id);

        $bidder = new Bidder($this->db);

        return $this->view('project/details', [
            'title' => 'View Project',
            'projectId' => $id,
            'project' => $project,
            'bidders' => $bidder->getProjectParticipatingBiddersForUndecidedCategories($id),
            'winners' => $bidder->getProjectWinners($id)
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
        $project = (new Project($this->db))->withZoneNameOrFail($id);

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
            'supers' => (new Superintendent($this->db))->get('*', 'ORDER BY name'),
            'zones' => (new Zone($this->db))->get('*', 'ORDER BY name')
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
        $model = new Project($this->db);

        $model->firstOrFail($id);

        $query = $model->update($id, $request->getParsedBody());

        return $this->view('message', [
            'template' => 'project',
            'message' => $query ? '<br><br>Project Updated!' : '<br><br>Update Error'
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
        (new Project($this->db))
            ->firstOrFail($id);

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
        $project = new Project($this->db);

        $project->firstOrFail($id);

        $project->delete($id);

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
        (new Project($this->db))
            ->firstOrFail($id);

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
        $project = new Project($this->db);

        $project->firstOrFail($id);

        $project->complete($id);

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
        (new Project($this->db))
            ->firstOrFail($id);

        return $this->view('project/choose_category', [
            'title' => 'Choose a Category',
            'projectId' => $id,
            'categories' => (new Category($this->db))->withBiddersForProject($id)
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
        $project = (new Project($this->db))->firstOrFail($id);

        $category = (new Category($this->db))->firstOrFail($id);

        $zoneContacts = (new Contact($this->db))
            ->getFromCategoryAndZone($category['id'], $project['zone_id']);

        $bidders = (new Bidder($this->db))
            ->getSelectedBiddersForProjectByCategory($id, $category_id);

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
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function addBid(Request $request, $id)
    {
        (new Project($this->db))
            ->firstOrFail($id);

        $contact = (new Contact($this->db))
            ->firstOrFail($request->getParsedBody()['company']);

        $query = (new Bidder($this->db))->add($id, $contact['id'], $contact['category_id']);

        $message = "<b> [ <a href='/projects/{$id}/categories/{$contact['category_id']}/bidders'>GO BACK</a> ]</b><br>";
        $message .= $query ? '<br><br>Sucess!' : '<br><br>Error!';

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
        return $this->view('print', [
            'title' => 'Print Call Log',
            'project' => (new Project($this->db))->withSuperintendantOrFail($id),
            'winners' => (new Bidder($this->db))->getProjectWinners($id)
        ]);
    }
}
