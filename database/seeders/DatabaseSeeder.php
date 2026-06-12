<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun admin BEM-FT default jika belum ada
        User::updateOrCreate(
            ['email' => 'adminRK@gmail.com'], // Gunakan format email
            [
                'name' => 'Admin Utama BEM-FT',
                'password' => Hash::make('BemFTRK26'),
                'is_admin' => true,
            ]
        );

        $this->call([
            ProdiSeeder::class,
        ]);
    }
}
