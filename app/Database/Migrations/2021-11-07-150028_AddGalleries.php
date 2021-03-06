<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGalleries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'name'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
            ],
            'keywords'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
            ],
            'description'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
            ],
            'code'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
                    'unique' => true,
            ],
            'user_id'       => [
                    'type'       => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('galleries');
    }

    public function down()
    {
        $this->forge->dropTable('galleries');
    }
}
