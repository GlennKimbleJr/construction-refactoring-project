<?php 

namespace App\Controllers;

use App\Controller;
use App\Models\Category;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('category/view', [
            'title' => 'View Categories',
            'categories' => (new Category($this->db))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Zend\Diactoros\Response
     */
    public function create()
    {
        return $this->view('category/new', ['title' => 'Add a New Category']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Zend\Diactoros\ServerRequest  $request
     * @return \Zend\Diactoros\Response
     */
    public function store(Request $request)
    {
        $model = new Category($this->db);

        $request = $request->getParsedBody();
        
        return $this->view('message', [
            'template' => 'category',
            'message' => $model->add($request['name']) 
                ? '<br><br>Created!' 
                : '<br><br>Error! Unable to create categories.'
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
        return $this->redirect("/categories/{$id}/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Zend\Diactoros\Response
     */
    public function edit($id)
    {
        $model = new Category($this->db);

        return $this->view('category/edit', [
            'title' => 'Edit a Category',
            'category' => $model->firstOrFail($id)
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
        $model = new Category($this->db);

        $model->firstOrFail($id, 'null');

        $request = $request->getParsedBody();

        return $this->view('message', [
            'template' => 'category',
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
        $model = new Category($this->db);

        $model->firstOrFail($id, 'null');

        return $this->view('message', [
            'template' => 'category',
            'message' => "<h1>ARE YOU SURE?</h1>
            <br>
            <h2>
                <form method='post' action='/categories/{$id}/delete'>
                    <button type='submit'>YES</button> | <a href='/categories/{$id}/edit'>NO</a>
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
        $model = new Category($this->db);

        $model->firstOrFail($id, 'null');

        $model->delete($id);

        return $this->view('message', [
            'template' => 'category',
            'message' => '<h1>DELETED!</h1><br>'
        ]);
    }
}
