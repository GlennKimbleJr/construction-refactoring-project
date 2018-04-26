<?php

use Phinx\Migration\AbstractMigration;

class UsersRemembered extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users_remembered');
        $table->addColumn('user', 'integer')
              ->addColumn('selector', 'string')
              ->addColumn('token', 'string')
              ->addColumn('expires', 'integer')
              ->addIndex(['selector'], ['unique' => true])
              ->addIndex(['user'])
              ->create();
    }
}
