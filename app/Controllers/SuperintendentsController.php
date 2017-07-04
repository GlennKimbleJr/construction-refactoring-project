<?php 

namespace App\Controllers;

use App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class SuperintendentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('super/view', [
            'title' => 'View All Superintendants',
            'supers' => $this->db->getData("SELECT * FROM supers ORDER BY name")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Zend\Diactoros\Response
     */
    public function create()
    {
        return $this->view('super/new', ['title' => 'Add a New Superintendant']);
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

        $query = $this->db->setData("INSERT INTO `supers` (name, phone) VALUES (?, ?)", [
            $request['name'],
            $request['phone']
        ]);

        return $this->view('message', [
            'template' => 'super',
            'message' => $this->db->updated($query) 
                ? '<br><br>Created!' 
                : '<br><br>Error! Unable to create super.'
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
        return $this->redirect("/superintendents/{$id}/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function edit($id)
    {
        $super = $this->db->getFirstOrFail("SELECT * FROM supers WHERE id = ?", [$id]);

        return $this->view('super/edit', [
            'title' => 'Edit a Superintendant',
            'super' => $super
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
        $super = $this->db->getFirstOrFail("SELECT * FROM supers WHERE id = ?", [$id]);

        $request = $request->getParsedBody();

        $query = $this->db->setData("UPDATE supers SET name = ?, phone = ? WHERE id = ?", [
            $request['name'],
            $request['phone'],
            $id
        ]);

        return $this->view('message', [
            'template' => 'super',
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
        $this->db->getFirstOrFail("SELECT * FROM supers WHERE id = ?", [$id]);

        return $this->view('message', [
            'template' => 'super',
            'message' => "<h1>ARE YOU SURE?</h1><br>
                <h2>
                    <form method='post' action='/superintendents/{$id}/delete'>
                        <button type='submit'>YES</button> | <a href='/superintendents/{$id}/edit'>NO</a>
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
        $this->db->getFirstOrFail("SELECT * FROM supers WHERE id = ?", [$id]);

        $this->db->setData("DELETE FROM `supers` WHERE id = ?", [$id]);
        
        return $this->view('message', [
            'template' => 'super',
            'message' => '<h1>DELETED!</h1><br>'
        ]);
    }
}
