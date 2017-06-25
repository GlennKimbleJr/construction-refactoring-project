<?php

use Phinx\Migration\AbstractMigration;

class CreateContactsTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('contact')) return;

        $table = $this->table('contact');
        $table->addColumn('first', 'string', ['null' => true])
              ->addColumn('last', 'string', ['null' => true])
              ->addColumn('street', 'string', ['null' => true])
              ->addColumn('city', 'string', ['null' => true])
              ->addColumn('state', 'string', ['null' => true])
              ->addColumn('zone', 'string', ['null' => true])
              ->addColumn('email', 'string', ['null' => true])
              ->addColumn('officephone', 'string', ['null' => true])
              ->addColumn('cellphone', 'string', ['null' => true])
              ->addColumn('fax', 'string', ['null' => true])
              ->addColumn('type', 'string', ['null' => true])
              ->addColumn('company', 'string', ['null' => true])
              ->addColumn('zip', 'string', ['null' => true])
              ->addColumn('zone2', 'string', ['null' => true])
              ->addColumn('zone3', 'string', ['null' => true])
              ->addColumn('zone4', 'string', ['null' => true])
              ->addColumn('zone5', 'string', ['null' => true])
              ->addColumn('zone6', 'string', ['null' => true])
              ->addColumn('zone7', 'string', ['null' => true])
              ->addColumn('zone8', 'string', ['null' => true])
              ->addColumn('zone9', 'string', ['null' => true])
              ->addColumn('score_per', 'string', ['null' => true])
              ->addColumn('bid_per', 'string', ['null' => true])
              ->save();
    }
    
    public function down()
    {
        if (! $this->hasTable('contact')) return;

        $this->dropTable('contact');
    }
}
