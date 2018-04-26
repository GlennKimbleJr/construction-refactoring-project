<?php

use Phinx\Migration\AbstractMigration;

class UsersConfirmations extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users_confirmations');
        $table->addColumn('user_id', 'integer')
              ->addColumn('email', 'string')
              ->addColumn('selector', 'string')
              ->addColumn('token', 'string')
              ->addColumn('expires', 'integer')
              ->addIndex(['selector'], ['unique' => true])
              ->addIndex(['user_id'])
              ->addIndex(['email','expires'])
              ->create();
    }
}
