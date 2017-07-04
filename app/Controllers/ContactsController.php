<?php 

namespace App\Controllers;

use App\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactZone;
use App\Models\Zone;
use Psr\Http\Message\ServerRequestInterface as Request;

class ContactsController extends Controller
{
    /**
     * List of sortable options for a query.
     * @var array
     */
    protected $orderable = [
        'company'   => "c.company",
        'first'     => "c.first, c.company",
        'last'      => "c.last, c.company",
        'city'      => "c.city, c.company",
        'state'     => "c.state, c.company",
        'type'      => "type, c.company",
    ];

    /**
     * Display a listing of the resource.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  string  $sort  default sort option for query.
     * @return \Zend\Diactoros\Response
     */
    public function index(Request $request, $sort = 'company')
    {
        return $this->view('contact/view', [
            'header' => 'View All Contacts',
            'contacts' => (new Contact($this->db))
                ->getSortable($this->getSortKey($request, $sort))
        ]);
    }

    /**
     * Display a listing of categories to select.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function selectCategory()
    {
        return $this->view('contact/view_select_category', [
            'categories' => (new Category($this->db))->get()
        ]);
    }

    /**
     * Display a listing of the resource by category.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  integer $category_id
     * @param  string  $sort  default sort option for query.
     * @return \Zend\Diactoros\Response
     */
    public function category(Request $request, $category_id, $sort = 'company')
    {
        $type = (new Category($this->db))
            ->firstOrFail($category_id, 'name');

        return $this->view('contact/view', [
            'header' => "View Contacts - {$type['name']}",
            'contacts' => (new Contact($this->db))
                ->getSortableByCategory($this->getSortKey($request, $sort), $category_id)
        ]);
    }

    /**
     * Display a listing of zones to select.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function selectZone()
    {
        return $this->view('contact/view_select_zone', [
            'zones' => (new Zone($this->db))->get()
        ]);
    }

    /**
     * Display a listing of the resource by zone.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  integer $zone_id
     * @param  string  $sort  default sort option for query.
     * @return \Zend\Diactoros\Response
     */
    public function zone(Request $request, $zone_id, $sort = 'all')
    {
        $type = (new Zone($this->db))
            ->firstOrFail($zone_id, 'name');

        return $this->view('contact/view', [
            'header' => "View Contacts - {$type['name']}",
            'contacts' => (new Contact($this->db))
                ->getSortableByZone($this->getSortKey($request, $sort), $zone_id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Zend\Diactoros\Response
     */
    public function create()
    {
        return $this->view('contact/new', [
            'zones' => (new Zone($this->db))->get(),
            'categories' => (new Category($this->db))->get()
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

        $contact_id = (new Contact($this->db))->add($request);

        if (! $contact_id) {
            return $this->view('message', [
                'template' => 'contact',
                'message' => '<br><br>Error! Unable to create contact.'
            ]);
        } 

        if (isset($request['zone']) && is_array($request['zone'])) {
            (new ContactZone($this->db))->addZones($contact_id, $request['zone']);
        }

        return $this->view('message', [
            'template' => 'contact',
            'message' => '<br><br>Contact Added!'
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
        $contact = (new Contact($this->db))->getFirstWithTypeOrFail($id);

        $contactZones = (new ContactZone($this->db))->getZonesByContact($id);
        
        $zoneString = '';
        foreach ($contactZones as $key => $value) {
            if ($key == 0) {
                $zoneString = $value['name'];
                continue;
            }

            $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$value['name']}";
        }

        return $this->view('contact/details', [
            'zoneString' => $zoneString,
            'contact' => $contact
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
        $contact = (new Contact($this->db))->firstOrFail($id);

        $contactZones = array_map(function($zone) {
            return $zone['zone_id'];
        }, (new ContactZone($this->db))->getZonesByContact($id));
        
        return $this->view('contact/edit', [
            'zones' => (new Zone($this->db))->get(),
            'categories' => (new Category($this->db))->get(),
            'contact' => $contact,
            'contactZones' => $contactZones
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
        $contact = new Contact($this->db);

        $contactZone = new ContactZone($this->db);

        $contact->firstOrFail($id);

        $request = $request->getParsedBody();

        $contact->update($id, $request);

        $contactZone->deleteAll($id);

        if (isset($request['zone']) && is_array($request['zone'])) {
            $contactZone->addZones($id, $request['zone']);
        }

        return $this->view('message', [
            'template' => 'contact',
            'message' => '<br><br>Updated!'
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
        (new Contact($this->db))->firstOrFail($id);

        return $this->view('message', [
            'template' => 'contact',
            'message' => "<h1>ARE YOU SURE?</h1><br>
                <h2>
                    <form method='post' action='/contacts/{$id}/delete'>
                        <button type='submit'>YES</button> | <a href='/contacts/{$id}/edit'>NO</a>
                    </form> 
                </h2>"
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
        $contact = new Contact($this->db);

        $contact->firstOrFail($id);

        $contact->delete($id);

        return $this->view('message', [
            'template' => 'contact',
            'message' => "<h1>contact DELETED!</h1><br>"
        ]);
    }

    /**
     * Return the default sortable key for the $orderable property.
     * 
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @param  string  $sort  default sort option for query.
     * @return $string
     */
    protected function getSortKey($request, $sort)
    {
        if (isset($request->getQueryParams()['s'])) {
            $sort = $request->getQueryParams()['s'];
        }

        if (! key_exists($sort, $this->orderable)) $sort = 'company';

        return $this->orderable[$sort];
    }
}
