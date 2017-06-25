<?php

use Phinx\Migration\AbstractMigration;

class CreateSupersTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('super')) return;

        $table = $this->table('super');
        $table->addColumn('name', 'string', ['null' => true])
              ->addColumn('phone', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('super')) return;

        $this->dropTable('super');
    }
}
