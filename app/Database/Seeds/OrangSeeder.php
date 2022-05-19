<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        // menggunakan cara manual untuk mengisi data
        // $data = [
        //     [
        //         'nama'      => 'Ken',
        //         'alamat'    => 'Jl. H. Kamin 1 No.91',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama'      => 'Budi',
        //         'alamat'    => 'Jl. H. Kamin 2 No.92',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama'      => 'Siti',
        //         'alamat'    => 'Jl. H. Kamin 3 No.93',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama'      => 'Sri',
        //         'alamat'    => 'Jl. H. Kamin 4 No.94',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        // ];

        // menggunakan faker untuk mengisi data
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama'       => $faker->name,
                'alamat'     => $faker->address,

                // faker dateTime akan error karena dateTime bertipe objek dan tidak bisa diubah ke string, jadi harus diubah jadi unixTime(), lalu dikonversi ke dateTime nya Code Igniter 4 dengan menggunakan Time::createFromTimestamp()
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            // Insert Data
            $this->db->table('orang')->insert($data);
        }

        // commit2
        // Simple Queries

        // $this->db->query('INSERT INTO tablename (field db, field db) VALUES (placeholder1 di $data, placeholder2 di $data)', $data);

        // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder

        // Insert Satu Data
        // $this->db->table('orang')->insert($data);

        // Insert Beberapa Data
        //$this->db->table('orang')->insertBatch($data);
    }
}
