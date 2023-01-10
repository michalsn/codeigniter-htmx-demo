<?php

namespace Michalsn\CodeIgniterHtmxDemo\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTasksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null'       => false,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'completed'],
                'null'       => false,
                'default'    => 'active'
            ],
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
