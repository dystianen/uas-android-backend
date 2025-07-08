<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BooksSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Python untuk Programmer Pemula',
                'author' => 'Jubilee',
                'published_date' => '2024-08-01',
                'cover' => '1751967026_e2642308a69a6332e074.bin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Semua Bisa Menjadi Programmer Laravel Basic',
                'author' => 'Jhon Cena',
                'published_date' => '2024-10-30',
                'cover' => '1751967089_54a96f40fbe9d57729eb.bin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
