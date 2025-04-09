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

        $this->call([
            // AdminSeeder::class,            
            // MajorSeeder::class,
            // UserSeeder::class,
            ])
        ;
    }
}
