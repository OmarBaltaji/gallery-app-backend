<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InsertOauthClients extends Migration
{
    public function up()
    {
        $data = [
            'client_id' => getenv('OAUTH_CLIENT_ID'),
            'client_secret'    => getenv('OAUTH_CLIENT_SECRET'),
            'redirect_uri'    => NULL,
            'grant_types'    => 'password',
            'scope'    => 'app',
            'user_id'    => NULL,
        ];

        // Using Query Builder
        $this->db->table('oauth_clients')->insert($data);
    }

    public function down()
    {
        //
    }
}
