<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        helper('password');

        $data = [
            [
                'name'    => 'Dystian En Yusgiantoro',
                'email'   => 'tian@gmail.com',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
