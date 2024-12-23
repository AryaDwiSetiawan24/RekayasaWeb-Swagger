<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'John Doe',
            'nim' => '123456789',
            'email' => 'johndoe@example.com',
            'jurusan' => 'Teknik Informatika',
        ]);

        Mahasiswa::create([
            'nama' => 'Jane Smith',
            'nim' => '987654321',
            'email' => 'janesmith@example.com',
            'jurusan' => 'Sistem Informasi',
        ]);
    }
}
