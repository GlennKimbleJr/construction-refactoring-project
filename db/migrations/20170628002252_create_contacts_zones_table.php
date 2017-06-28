<?php

use Phinx\Migration\AbstractMigration;

class CreateContactsZonesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('contacts_zones')) return;

        $this->table('contacts_zones')
            ->addColumn('contact_id', 'integer')
            ->addColumn('zone_id', 'integer')
            ->addIndex(array('contact_id', 'zone_id'), array('unique' => true))
            ->addForeignKey('contact_id', 'contacts', 'id', array('delete'=> 'CASCADE'))
            ->addForeignKey('zone_id', 'zones', 'id', array('delete'=> 'CASCADE'))
            ->save();
    }

    public function down()
    {
        if (! $this->hasTable('contacts_zones')) return;

        $this->dropTable('contacts_zones');
    }
}
