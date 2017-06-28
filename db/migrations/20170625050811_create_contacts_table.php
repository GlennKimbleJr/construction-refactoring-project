<?php

use Phinx\Migration\AbstractMigration;

class CreateContactsTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('contacts')) return;

        $table = $this->table('contacts')
              ->addColumn('company', 'string', ['null' => true])
              ->addColumn('first', 'string', ['null' => true])
              ->addColumn('last', 'string', ['null' => true])
              ->addColumn('street', 'string', ['null' => true])
              ->addColumn('city', 'string', ['null' => true])
              ->addColumn('state', 'string', ['null' => true])
              ->addColumn('zip', 'string', ['null' => true])
              ->addColumn('email', 'string', ['null' => true])
              ->addColumn('officephone', 'string', ['null' => true])
              ->addColumn('cellphone', 'string', ['null' => true])
              ->addColumn('fax', 'string', ['null' => true])
              ->addColumn('type', 'string', ['null' => true])
              ->addColumn('score_per', 'string', ['null' => true])
              ->addColumn('bid_per', 'string', ['null' => true])
              ->save();
    }
    
    public function down()
    {
        if (! $this->hasTable('contacts')) return;

        $this->dropTable('contacts');
    }
}
