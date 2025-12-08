<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run() :void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole('admin');
        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
        ]);
        $manager->assignRole('manager');
    }
}