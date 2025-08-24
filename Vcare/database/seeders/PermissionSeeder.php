<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $permissionsByGuard = [
            'admin' => [

                'admins.manage',
                'users.view',
                'users.create',
                'users.update',
                'users.delete',
                'doctors.view',
                'doctors.create',
                'doctors.update',
                'doctors.delete',


                'appointments.view',
                'appointments.create',
                'appointments.update',
                'appointments.delete',
                'bookings.view',
                'bookings.create',
                'bookings.update',
                'bookings.delete',
                'patients.view',
                'patients.create',
                'patients.update',
                'patients.delete',


                'chat.access',
                'messages.view',
                'messages.create',
                'messages.delete',
                'reviews.view',
                'reviews.update',
                'reviews.create',
                'reviews.delete',
                'banners.view',
                'banners.create',
                'banners.update',
                'banners.delete',

            ],

            'web' => [

                'appointments.view',
                'bookings.view',
                'bookings.create',
                'bookings.update',
                'bookings.delete',
                'patients.view',
                'patients.create',
                'patients.update',
                'patients.delete',

                'chat.access',
                'messages.view',
                'messages.create',
                'messages.delete',
                'reviews.view',
                'reviews.create',
                'reviews.update',
                'banners.view',
            ],
        ];


        foreach ($permissionsByGuard as $guard => $names) {
            foreach ($names as $name) {
                Permission::findOrCreate($name, $guard);
            }
        }


        $adminRole       = Role::findOrCreate('admin', 'admin');
        $doctorRole      = Role::findOrCreate('doctor', 'web');
        $managerRole     = Role::findOrCreate('manager', 'admin');
        $patientRole     = Role::findOrCreate('patient', 'web');


        $adminRole->syncPermissions(
            Permission::where('guard_name', 'admin')->pluck('name')->toArray()
        );

        $doctorRole->syncPermissions([
            'appointments.view',
            'bookings.view',
            'bookings.update',
            'patients.view',
            'reviews.view',
        ]);

        $managerRole->syncPermissions([
            'appointments.view',
            'appointments.create',
            'appointments.update',
            'bookings.view',
            'bookings.create',
            'bookings.update',
            'patients.view',
            'patients.create',
            'patients.update',
            'chat.access',
            'messages.view',
            'messages.create',
            'reviews.view',
            'reviews.create',
            'banners.view',
            'banners.create',
            'banners.update',
            'users.view',
            'users.create',
            'users.update',
            'doctors.view',
            'doctors.create',
            'doctors.update',
        ]);

        $patientRole->syncPermissions([
            'appointments.view',
            'bookings.view',
            'chat.access',
            'messages.view',
            'reviews.view',
            'reviews.update',
            'reviews.create',
        ]);
    }
}
