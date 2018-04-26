<?php

use Phinx\Migration\AbstractMigration;

class UsersResets extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users_resets');
        $table->addColumn('user', 'integer')
              ->addColumn('selector', 'string')
              ->addColumn('token', 'string')
              ->addColumn('expires', 'integer')
              ->addIndex(['selector'], ['unique' => true])
              ->addIndex(['user','expires'])
              ->create();
    }
}
