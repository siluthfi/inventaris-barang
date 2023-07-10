<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alat;
use App\Models\Bahan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $ruangan1 = \App\Models\Ruangan::create([
            'nama_ruangan' => 'Lab RPL',
            'foto' => '',
            'gedung' => 'H',
            'user_id' => null,
        ])->fresh();

        $ruangan2 = \App\Models\Ruangan::create([
            'nama_ruangan' => 'Lab DKV',
            'foto' => '',
            'gedung' => 'H',
            'user_id' => null,
        ])->fresh();

        $user1 = \App\Models\User::create([
            'nama' => 'Kepala Lab 1',
            'username' => 'kepalalab1',
            'email' => 'kepalalab1@gmail.com',
            'password' => bcrypt('secret'),
            'foto' => '',
            'roles' => 'kepala_lab',
            'id_ruangan' => $ruangan1->id,
        ])->fresh();

        $user2 = \App\Models\User::create([
            'nama' => 'Kepala Lab 2',
            'username' => 'kepalalab2',
            'email' => 'kepalalab2@gmail.com',
            'password' => bcrypt('secret'),
            'foto' => '',
            'roles' => 'kepala_lab',
            'id_ruangan' => $ruangan2->id,
        ])->fresh();

        for ($i=3; $i < 20; $i++) { 
            \App\Models\User::create([
                'nama' => "Kepala Lab $i",
                'username' => "kepalalab$i",
                'email' => "kepalalab$i@gmail.com",
                'password' => bcrypt('secret'),
                'foto' => '',
                'roles' => 'kepala_lab',
                'id_ruangan' => null,
            ])->fresh();
        }

        \App\Models\User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'foto' => '',
            'roles' => 'admin',
        ])->fresh();

        \App\Models\User::create([
            'nama' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('secret'),
            'foto' => '',
            'roles' => 'superadmin',
            'id_ruangan' => null,
        ]);

        for ($i=0; $i < 20; $i++) { 
            $r = $ruangan1->id;
            if($i % 2 == 0) {
                $r = $ruangan2->id;
            }
            
            Bahan::create([
                "nama" => 'Bahan ' . $i + 1,
                "kode_bahan" => 'KODEBAHAN' . $i + 1,
                "foto" => '',
                "stok_jumlah" => rand(1, 100),
                "tanggal_masuk" => date("Y-m-d", mt_rand(20, time())),
                "id_ruangan" => $r,
            ]);

            Alat::create([
                "nama" => 'Alat ' . $i + 1,
                "kode_alat" => 'KODEALAT' . $i + 1,
                "foto" => '',
                "stok_jumlah" => rand(1, 100),
                "tanggal_masuk" => date("Y-m-d", mt_rand(20, time())),
                "id_ruangan" => $r,
            ]);
        }

        $ruangan1->user_id = $user1->id;
        $ruangan1->save();
        $ruangan2->user_id = $user2->id;
        $ruangan2->save();
    }
}
