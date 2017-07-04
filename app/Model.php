<?php 

namespace App;

use App\Database;

class Model
{
    /**
     * @param App\Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}
