<?php

use Phinx\Migration\AbstractMigration;

class CreateBidContractorsTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('bid_contactors')) return;

        $table = $this->table('bid_contactors');
        $table->addColumn('project_id', 'integer')
              ->addColumn('category', 'string', ['null' => true])
              ->addColumn('status', 'string', ['null' => true])
              ->addColumn('win', 'string', ['null' => true])
              ->addColumn('email', 'string', ['null' => true])
              ->addColumn('score', 'string', ['null' => true])
              ->addColumn('company', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('bid_contactors')) return;

        $this->dropTable('bid_contactors');
    }
}
