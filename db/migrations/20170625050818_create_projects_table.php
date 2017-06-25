<?php

use Phinx\Migration\AbstractMigration;

class CreateProjectsTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('project')) return;

        $table = $this->table('project');
        $table->addColumn('name', 'string', ['null' => true])
              ->addColumn('bidduedate', 'string', ['null' => true])
              ->addColumn('completedate', 'string', ['null' => true])
              ->addColumn('zone', 'string', ['null' => true])
              ->addColumn('plans', 'string', ['null' => true])
              ->addColumn('location', 'string', ['null' => true])
              ->addColumn('planuser', 'string', ['null' => true])
              ->addColumn('planpass', 'string', ['null' => true])
              ->addColumn('owner_name', 'string', ['null' => true])
              ->addColumn('owner_phone', 'string', ['null' => true])
              ->addColumn('super_name', 'string', ['null' => true])
              ->addColumn('super_phone', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('project')) return;

        $this->dropTable('project');
    }
}
