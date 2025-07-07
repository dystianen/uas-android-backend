<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BooksSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'published_date' => '2008-08-01',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt',
                'published_date' => '1999-10-30',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
