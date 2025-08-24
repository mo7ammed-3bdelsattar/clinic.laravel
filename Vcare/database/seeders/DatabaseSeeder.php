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
            'phone'=>'01122216608',
            'password' =>Hash::make('123456789'),
            'type' =>1,
            'gender' =>1,
        ]);
        \App\Models\Admin::factory()->create([
            'user_id' => 1,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Mohammed',
            'email' => 'Mohammed@gmail.com',
            'phone'=>'01155666555',
            'password' =>Hash::make('123456789'),
            'type' =>4,
            'gender' =>1,
        ]);
        \App\Models\Patient::factory()->create([
            'user_id' => 2,
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
            // AdminSeeder::class,            
            // MajorSeeder::class,
            // UserSeeder::class,
            PermissionSeeder::class
        ]);
        ;
    }
}
