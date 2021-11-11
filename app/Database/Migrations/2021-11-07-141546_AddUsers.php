<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
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
            'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ],
            'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
            ],
            'oauth_provider' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
            ],
            'oauth_uid' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}