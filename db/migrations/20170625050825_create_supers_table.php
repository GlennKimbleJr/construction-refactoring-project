<?php

use Phinx\Migration\AbstractMigration;

class CreateSupersTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('supers')) return;

        $table = $this->table('supers');
        $table->addColumn('name', 'string', ['null' => true])
              ->addColumn('phone', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('supers')) return;

        $this->dropTable('supers');
    }
}
