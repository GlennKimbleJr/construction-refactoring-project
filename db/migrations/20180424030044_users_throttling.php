<?php

use Phinx\Migration\AbstractMigration;

class UsersThrottling extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users_throttling');
        $table->addColumn('bucket', 'string')
              ->addColumn('tokens', 'float')
              ->addColumn('replenished_at', 'integer')
              ->addColumn('expires_at', 'integer')
              ->addIndex(['expires_at'])
              ->create();
    }
}
