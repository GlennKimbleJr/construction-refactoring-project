<?php

use Phinx\Migration\AbstractMigration;

class CreateBiddersTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('bidders')) return;

        $table = $this->table('bidders')
              ->addColumn('project_id', 'integer')
              ->addColumn('contact_id', 'integer')
              ->addColumn('category', 'string', ['null' => true])
              ->addColumn('status', 'string', ['null' => true])
              ->addColumn('win', 'string', ['null' => true])
              ->addColumn('email', 'string', ['null' => true])
              ->addColumn('score', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('bidders')) return;

        $this->dropTable('bidders');
    }
}
