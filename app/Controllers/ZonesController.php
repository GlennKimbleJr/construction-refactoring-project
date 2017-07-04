<?php 

namespace App\Controllers;

use App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('zone/view', [
            'zones' => $this->db->getData("SELECT * FROM zones ORDER BY name")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Zend\Diactoros\Response
     */
    public function create()
    {
        return $this->view('zone/new');
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

        $query = $this->db->setData("INSERT INTO `zones` (name) VALUES (?)", [$request['name']]);

        return $this->view('message', [
            'template' => 'zone',
            'message' => $this->db->updated($query) 
                ? '<br><br>Created!' 
                : '<br><br>Error! Unable to create zone.'
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
        return $this->redirect("/zones/{$id}/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function edit($id)
    {
        $zone = $this->db->getFirstOrFail("SELECT id, name FROM zones WHERE id = ?", [$id]);

        return $this->view('zone/edit', [
            'zone' => $zone,
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
        $this->db->getFirstOrFail("SELECT id, name FROM zones WHERE id = ?", [$id]);

        $request = $request->getParsedBody();

        $query = $this->db->setData("UPDATE zones SET name = ? WHERE id = ?", [
            $request['name'],
            $id
        ]);

        return $this->view('message', [
            'template' => 'zone',
            'message' => $this->db->updated($query) 
                ? '<br><br>Updated!' 
                : '<br><br>Update Error'
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
        $this->db->getFirstOrFail("SELECT id, name FROM zones WHERE id = ?", [$id]);

        return $this->view('message', [
            'template' => 'zone',
            'message' => "<h1>ARE YOU SURE?</h1><br>
                <h2>
                    <form method='post' action='/zones/{$id}/delete'>
                        <button type='submit'>YES</button> | <a href='/zones/{$id}/edit'>NO</a>
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
        $this->db->getFirstOrFail("SELECT id, name FROM zones WHERE id = ?", [$id]);

        $this->db->setData("DELETE FROM `zones` WHERE id = ?", [$id]);

        return $this->view('message', [
            'template' => 'zone',
            'message' => '<h1>DELETED!</h1><br>'
        ]);
    }
}
