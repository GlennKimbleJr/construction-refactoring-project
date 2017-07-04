<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesController extends BaseController
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
            'categories' => $this->db->getData("SELECT * FROM categories ORDER BY name")
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
        $request = $request->getParsedBody();

        $query = $this->db->setData('INSERT INTO `categories` (name) VALUES (?)', [
            $request['name']
        ]);
        
        return $this->view('message', [
            'template' => 'category',
            'message' => $this->db->updated($query) 
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
        $category = $this->db->getFirstOrFail('SELECT * FROM categories WHERE id = ?', [$id]);

        return $this->view('category/edit', [
            'title' => 'Edit a Category',
            'category' => $category
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
        $category = $this->db->getFirstOrFail('SELECT * FROM categories WHERE id = ?', [$id]);

        $request = $request->getParsedBody();

        $query = $this->db->setData('UPDATE categories SET name = ? WHERE id = ?', [
            $request['name'],
            $id
        ]);

        return $this->view('message', [
            'template' => 'category',
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
        $this->db->getFirstOrFail('SELECT * FROM categories WHERE id = ?', [$id]);

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
        $this->db->getFirstOrFail('SELECT * FROM categories WHERE id = ?', [$id]);

        $this->db->setData('DELETE FROM categories WHERE id = ?', [$id]);

        return $this->view('message', [
            'template' => 'category',
            'message' => '<h1>DELETED!</h1><br>'
        ]);
    }
}
