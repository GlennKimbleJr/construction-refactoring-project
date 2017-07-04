<?php 

namespace App\Controllers;

use App\Controller;
use App\Models\Bidder;
use Psr\Http\Message\ServerRequestInterface as Request;

class BiddersController extends Controller
{
    /**
     * Set if a bidder will or wont bid a project they've been invited to.
     * 
     * @param \Zend\Diactoros\ServerRequest  $request
     * @param integer  $id      bidders.id
     * @return \Zend\Diactoros\Response
     */
    public function setStatus(Request $request, $id) 
    {
        $model = new Bidder($this->db);

        $bidder = $model->firstOrFail($id, 'project_id');

        $request = $request->getParsedBody();

        $model->setStatus($id, ($request['status'] == 'yes') ? 'will' : 'wont');

        return $this->view('message', [
            'template' => 'project',
            'message' => "<b>[ <a href='/projects/{$bidder['project_id']}'>GO BACK</a> ]</b><br><br>
                Bid Status Updated!"
        ]);
    }

    /**
     * Select if a bidder has won the bid for their category on a project.
     * 
     * @param integer  $id      bidders.id
     * @return \Zend\Diactoros\Response
     */
    public function winner($id) 
    {
        $model = new Bidder($this->db);

        $bidder = $model->getWinnerOrFail($id);

        return $this->view('message', [
            'template' => 'project',
            'message' => "<h2>AWARD BID: <br>{$bidder['company']}<br>
                {$bidder['category_name']}<br>
                <br>
                Are you sure?</h2>
                <h3>
                    <form method='POST' action='/bidders/{$id}/winner'>
                        <button type='submit'>YES</button> | <a href='/projects/{$bidder['project_id']}'>NO</a>
                    </form>
                <h3>"
        ]);
    }

    /**
     * Update all the bidders resources for a project setting if they've won or not.
     * 
     * @param integer  $id      bidders.id
     * @return \Zend\Diactoros\Response
     */
    public function setWinner($id) 
    {
        $model = new Bidder($this->db);

        $bidder = $model->firstOrFail($id);

        $model->award($id, $bidder['project_id'], $bidder['category_id']);

        return $this->view('message', [
            'template' => 'project',
            'message' => "<b> [ <a href='/projects/{$bidder['project_id']}'>GO BACK</a> ]</b><br>
                <h1>BID AWARDED!</h1>"
        ]);
    }

    /**
     * Rate a winning bidders preformance on a project.
     * 
     * @param integer  $id      bidders.id
     * @return \Zend\Diactoros\Response
     */
    public function rate($id) 
    {
        $model = new Bidder($this->db);

        $bidder = $model->firstOrFail($id, 'contact_id, project_id');

        return $this->view('project/rate', [
            'title' => 'Rate Sub-Contractor',
            'company' => $bidder['contact_id'],
            'bidder' => $id,
            'projectId' => $bidder['project_id']
        ]);
    }

    /**
     * Update a bidder resources rating.
     * 
     * @param \Zend\Diactoros\ServerRequest  $request
     * @param integer  $id      bidders.id
     * @return \Zend\Diactoros\Response
     */
    public function setRating(Request $request, $id) 
    {
        $model = new Bidder($this->db);

        $bidder = $model->firstOrFail($id, 'project_id');

        $request = $request->getParsedBody();

        $allowedRatings = [5,4,3,2,1];
        $rating = $request['rating'];
        if (! in_array($rating, $allowedRatings)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Invalid raiting.'
            ]);
        }

        $model->setScore($id, $rating);

        return $this->view('message', [
            'template' => 'project',
            'message' => "<b> [ <a href='/projects/{$bidder['project_id']}'>GO BACK</a> ]</b>
                <br><br>UPDATED!"
        ]);
    }
}
