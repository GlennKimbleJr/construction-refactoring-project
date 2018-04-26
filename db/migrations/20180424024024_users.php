<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['null' => true])
              ->addColumn('password', 'string')
              ->addColumn('email', 'string')
              ->addColumn('status', 'integer', ['default' => 0])
              ->addColumn('verified', 'integer', ['default' => 0])
              ->addColumn('resettable', 'integer', ['default' => 1])
              ->addColumn('roles_mask', 'integer', ['default' => 0])
              ->addColumn('registered', 'integer', ['default' => 0])
              ->addColumn('last_login', 'integer', ['default' => 0])
              ->addColumn('force_logout', 'integer', ['default' => 0])
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
