<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class ContactsController extends BaseController
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
        $sort = $this->getSortKey($request, $sort);

        return $this->view('contact/view', [
            'header' => 'View All Contacts',
            'contacts' => $this->db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY " . $this->orderable[$sort])
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
            'categories' => $this->db->getData("SELECT * FROM categories ORDER BY name")
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
        $type = $this->db->getFirstOrFail("SELECT name FROM categories WHERE id = ?", [$category_id]);

        $sort = $this->getSortKey($request, $sort);

        return $this->view('contact/view', [
            'header' => "View Contacts - {$type['name']}",
            'contacts' => $this->db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY " . $this->orderable[$sort], [$category_id])
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
            'zones' => $this->db->getData("SELECT * FROM zones ORDER BY name")
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
        $zone = $this->db->getFirstOrFail("SELECT * FROM zones WHERE id = ?", [$zone_id]);
        
        $sort = $this->getSortKey($request, $sort);

        return $this->view('contact/view', [
            'header' => "View Contacts - {$zone['name']}",
            'contacts' => $this->db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY " . $this->orderable[$sort], [$zone_id])
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
            'zones' => $this->db->getData('SELECT * FROM zones ORDER BY name'),
            'categories' => $this->db->getData('SELECT * FROM categories ORDER BY name')
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

        $query = $this->db->setData(
            "INSERT INTO `contacts` (`first`, `last`, `street`, `city`, `state`, `email`, `officephone`, `cellphone`, `fax`, `category_id`, `company`, `zip`, `score_per`, `bid_per`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $request['first'],
                $request['last'],
                $request['street'],
                $request['city'],
                $request['state'],
                $request['email'],
                $request['officephone'],
                $request['cellphone'],
                $request['fax'],
                $request['type'],
                $request['company'],
                $request['zip'],
                '0',
                '0'
            ]);

        if (! $this->db->updated($query)) {
            return $this->view('message', [
                'template' => 'contact',
                'message' => '<br><br>Error! Unable to create contact.'
            ]);
        } 

        if (isset($request['zone']) && is_array($request['zone'])) { 
            $contact_id = $this->db->getID();
            
            foreach ($request['zone'] as $zone_id) {
                $this->db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", [
                    $contact_id, 
                    $zone_id
                ]);
            }
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
        $contact = $this->db->getFirstOrFail('SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.id = ?', [$id]);

        $contactZones = $this->db->getData('SELECT * FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', [$id]);
        
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
        $contact = $this->db->getFirstOrFail('SELECT * FROM contacts WHERE id = ?', [$id]);

        $contactZones = $this->db->getData('SELECT zone_id FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', [$id]);

        $contactZones = array_map(function($zone) {
            return $zone['zone_id'];
        }, $contactZones);
        
        return $this->view('contact/edit', [
            'zones' => $this->db->getData('SELECT * FROM zones ORDER BY name'),
            'categories' => $this->db->getData('SELECT * FROM categories ORDER BY name'),
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
        $contact = $this->db->getFirstOrFail('SELECT * FROM contacts WHERE id = ?', [$id]);

        $request = $request->getParsedBody();

        $query = $this->db->setData('UPDATE contacts SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, category_id = ?, company = ?, zip = ? WHERE id = ?', [
                $request['first'],
                $request['last'],
                $request['street'],
                $request['city'],
                $request['state'],
                $request['email'],
                $request['officephone'],
                $request['cellphone'],
                $request['fax'],
                $request['type'],
                $request['company'],
                $request['zip'],
                $id
            ]);

        $this->db->setData("DELETE FROM `contacts_zones` WHERE `contact_id` = ?", [$id]);

        if (isset($request['zone']) && is_array($request['zone'])) { foreach ($request['zone'] as $zone_id) {
            $this->db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", 
                [$id, $zone_id]
            );
        }}

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
        $this->db->getFirstOrFail('SELECT * FROM contacts WHERE id = ?', [$id]);

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
        $this->db->getFirstOrFail('SELECT * FROM contacts WHERE id = ?', [$id]);

        $this->db->setData('DELETE FROM contacts WHERE id = ?', [$id]);

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

        return $sort;
    }
}
