<?php

use Phinx\Migration\AbstractMigration;

class CreateProjectsTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('projects')) return;

        $table = $this->table('projects')
              ->addColumn('name', 'string', ['null' => true])
              ->addColumn('location', 'string', ['null' => true])
              ->addColumn('owner_name', 'string', ['null' => true])
              ->addColumn('owner_phone', 'string', ['null' => true])
              ->addColumn('super_id', 'integer', ['null' => true])
              ->addColumn('bidduedate', 'string', ['null' => true])
              ->addColumn('completedate', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('projects')) return;

        $this->dropTable('projects');
    }
}
