<?php

use Phinx\Migration\AbstractMigration;

class AddDivisions extends AbstractMigration
{
    public function change()
    {
        $names = [
            '01 — General Requirement',
            '02 — Site Construction',
            '03 — Concrete',
            '04 — Masonry',
            '05 — Metals',
            '06 — Wood and Plastics',
            '07 — Thermal and Moisture Protection',
            '08 — Doors and Windows',
            '09 — Finishes',
            '10 — Specialties',
            '11 — Equipment',
            '12 — Furnishings',
            '13 — Special Construction',
            '14 — Conveying Systems',
            '15 — Mechanical',
            '16 — Electrical',
            '17 — Plumbing',
        ];

        foreach ($names as $name) {
            $table = $this->table('categories');
            $table->insert(['name' => $name]);
            $table->saveData();
        }
    }
}
