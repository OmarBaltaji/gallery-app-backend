<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPictures extends Migration
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
            'filename'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
            ],
            'gallery_id'       => [
                    'type'       => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('gallery_id','galleries','id','CASCADE','CASCADE');
        $this->forge->createTable('pictures');
    }

    public function down()
    {
        $this->forge->dropTable('pictures');
    }
}
