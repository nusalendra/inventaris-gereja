<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(30)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'nusa',
            'username' => 'nusalendra',
            'email' => 'nusalendraa@gmail.com',
            'password' => Hash::make('nusalendra'),
            'nomor_telephone' => '089677888764',
            'role' => 'Admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'username' => 'budisetyo',
            'email' => 'estergloryas@gmail.com',
            'password' => Hash::make('password'),
            'nomor_telephone' => '089677888764',
            'role' => 'Peminjam'
        ]);
    }
}
