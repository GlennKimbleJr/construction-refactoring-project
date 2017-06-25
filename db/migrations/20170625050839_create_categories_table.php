<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('type')) return;

        $table = $this->table('type');
        $table->addColumn('name', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('type')) return;

        $this->dropTable('type');
    }
}
