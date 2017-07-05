<?php 

namespace App\Controllers;

use App\Controller;
use App\Models\Zone;
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
            'zones' => (new Zone($this->db))->get()
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
        $model = new Zone($this->db);

        $request = $request->getParsedBody();

        return $this->view('message', [
            'template' => 'zone',
            'message' => $model->add($request['name'])
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
        return $this->view('zone/edit', [
            'zone' => (new Zone($this->db))->firstOrFail($id),
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
        $model = new Zone($this->db);

        $model->firstOrFail($id);

        $request = $request->getParsedBody();

        return $this->view('message', [
            'template' => 'zone',
            'message' => $model->update($id, $request['name'])
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
        (new Zone($this->db))->firstOrFail($id);

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
        $model = new Zone($this->db);

        $model->firstOrFail($id);

        $model->delete($id);

        return $this->view('message', [
            'template' => 'zone',
            'message' => '<h1>DELETED!</h1><br>'
        ]);
    }
}
