<?php

use Phinx\Migration\AbstractMigration;

class CreateZonesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('zone')) return;

        $table = $this->table('zone');
        $table->addColumn('name', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('zone')) return;

        $this->dropTable('zone');
    }
}
