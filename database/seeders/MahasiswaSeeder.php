<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '221011400961',
            'nama' => 'Adam Miftahul Falah',
            'email' => 'adam@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
