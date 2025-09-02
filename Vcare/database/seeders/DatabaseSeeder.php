<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PermissionSeeder;

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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'phone' => '01122216608',
            'password' => Hash::make('123456789'),
            'type' => 1,
            'gender' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin = \App\Models\Admin::factory()->create([
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $patient = \App\Models\User::factory()->create([
            'name' => 'Mohammed',
            'email' => 'Mohammed@gmail.com',
            'phone' => '01155666555',
            'password' => Hash::make('123456789'),
            'type' => 4,
            'gender' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Patient::factory()->create([
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'Manager@gmail.com',
            'phone' => '01155766555',
            'password' => Hash::make('123456789'),
            'type' => 2,
            'gender' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager = \App\Models\Admin::factory()->create([
            'user_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Major::factory()->create([
            'title' => 'Internal Medicine (الباطنة)',
            'description' => 'Internal Medicine (الباطنة)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $doctor = \App\Models\User::factory()->create([
            'name' => 'Doctor',
            'email' => 'Doctor@gmail.com',
            'phone' => '01155666558',
            'password' => Hash::make('123456789'),
            'type' => 3,
            'gender' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Doctor::factory()->create([
            'user_id' => 4,
            'price' => 400,
            'address' => '123 Doctor St, City',
            'major_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Banner::create([
            'title' => 'Welcome to Vcare Clinic',
            'description' => 'Your health is our priority. Visit us for the best care.',
            'name' => 'home',
        ]);
        \App\Models\Banner::create([
            'title' => 'About Us',
            'description' => 'Your health is our priority. Visit us for the best care.',
            'name' => 'footer',
        ]);
        $this->call([
            PermissionSeeder::class
        ]);
        $admin->assignRole('admin');
        $manager->assignRole('manager');
        $doctor->assignRole('doctor');
        $patient->assignRole('patient');
    }
}
