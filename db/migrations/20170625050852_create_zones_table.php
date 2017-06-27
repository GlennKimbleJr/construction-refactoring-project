<?php

use Phinx\Migration\AbstractMigration;

class CreateZonesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('zones')) return;

        $table = $this->table('zones');
        $table->addColumn('name', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('zones')) return;

        $this->dropTable('zones');
    }
}
