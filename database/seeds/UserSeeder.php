<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = DB::table('roles')->where('name', 'administrator')->first();
        $specialty = DB::table('specialties')->where('name', 'it department')->first();
        $generatedConfirmationString = Carbon::now()->timestamp . rand();
        $generatedConfirmationString = sha1($generatedConfirmationString);

        DB::table('users')->insert([
            'role_id' => $role->id,
            'specialty_id' => $specialty->id,
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@app.com',
            'confirmation_code' => $generatedConfirmationString,
            'is_verified' => 1,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make('Test123456'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
