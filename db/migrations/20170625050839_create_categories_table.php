<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('categories')) return;

        $table = $this->table('categories');
        $table->addColumn('name', 'string', ['null' => true])
              ->save();
    }

    public function down()
    {
        if (! $this->hasTable('categories')) return;

        $this->dropTable('categories');
    }
}
