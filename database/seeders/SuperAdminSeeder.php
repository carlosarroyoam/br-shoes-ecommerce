<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'is_super' => true
        ]);

        User::factory()->admin($admin->id)->create([
            'first_name' => 'Carlos Alberto',
            'last_name' => 'Arroyo Martínez',
            'email' => 'carlosarroyoam@gmail.com',
            'password' => '$2y$10$RuQR6w7eZ46cGvY8lvTOtOUjxHQtOmYmmDO7NqaFTgeDNK5RkjtD.', // secret
        ]);
    }
}
