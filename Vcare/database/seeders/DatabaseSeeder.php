<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' =>Hash::make('123456789'),
            'type' =>'admin'
        ]);
        \App\Models\Admin::factory()->create([
            'name' => 'Manager',
            'email' => 'Manager@gmail.com',
            'password' =>Hash::make('123456789'),
            'type' =>'manager'
        ]);

        $this->call([
            AdminSeeder::class,            
            MajorSeeder::class,
            UserSeeder::class,
            ])
        ;
    }
}
