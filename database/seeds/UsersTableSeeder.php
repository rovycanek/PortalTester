<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('ciphersperprotocol')->truncate();
        DB::table('failed_jobs')->truncate();
        DB::table('handshakesimulation')->truncate();
        DB::table('i_p_s')->truncate();
        DB::table('jobs')->truncate();
        DB::table('loginlog')->truncate();
        DB::table('offeredprotocols')->truncate();
        DB::table('securitybreaches')->truncate();
        DB::table('serverhello')->truncate();
        DB::table('test')->truncate();
        DB::table('securityheaders')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();
        $newuserRole = Role::where('name','new user')->first();
    
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
        ]);
        $newuser = User::create([
            'name' => 'New user',
            'email' => 'newuser@newuser.com',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        $newuser->roles()->attach($newuserRole);
    }
}
