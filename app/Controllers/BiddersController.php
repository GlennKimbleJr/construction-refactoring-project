<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class BiddersController extends BaseController
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
        $bidder = $this->db->getFirst("SELECT project_id FROM bidders WHERE id = ?", [$id]);

        if (! count($bidder)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $request = $request->getParsedBody();

        $this->db->setData("UPDATE bidders SET status = ? WHERE id = ?", 
            [($request['status'] == 'yes') ? 'will' : 'wont', $id]);

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
        $bidder = $this->db->getFirst("SELECT b.*, c.company, cat.name as 'category_name' FROM bidders as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.category_id = cat.id AND b.id = ?", [$id]);

        if (! count($bidder)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

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
        $bidder = $this->db->getFirst("SELECT * FROM bidders WHERE id = ?", [$id]);

        if (! count($bidder)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $this->db->setData("UPDATE bidders SET win='1' WHERE id = ?", [$id]);

        $this->db->setData(
            "UPDATE bidders SET win='0' WHERE id != ? AND project_id = ? AND category_id = ?", 
            [$id, $bidder['project_id'], $bidder['category_id']]
        );

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
        $bidder = $this->db->getFirst("SELECT * FROM bidders WHERE id = ?", [$id]);

        if (! count($bidder)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

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
        $bidder = $this->db->getFirst("SELECT project_id FROM bidders WHERE id = ?", [$id]);

        if (! count($bidder)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Could not get data.'
            ]);
        }

        $request = $request->getParsedBody();

        $allowedRatings = [5,4,3,2,1];
        $rating = $request['rating'];
        if (! in_array($rating, $allowedRatings)) {
            return $this->view('message', [
                'template' => 'project',
                'message' => 'Invalid raiting.'
            ]);
        }

        $this->db->setData("UPDATE bidders SET score = ? WHERE id = ?", [$rating, $id]);

        return $this->view('message', [
            'template' => 'project',
            'message' => "<b> [ <a href='/projects/{$bidder['project_id']}'>GO BACK</a> ]</b>
                <br><br>UPDATED!"
        ]);
    }
}
