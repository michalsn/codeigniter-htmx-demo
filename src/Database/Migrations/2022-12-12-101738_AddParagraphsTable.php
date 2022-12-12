<?php

namespace Michalsn\CodeIgniterDemoHtmx\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParagraphsTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null'       => false,
            ],
            'body' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'sort' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => '0'
            ],
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('paragraphs');
    }

    public function down()
    {
        $this->forge->dropTable('paragraphs');
    }
}
