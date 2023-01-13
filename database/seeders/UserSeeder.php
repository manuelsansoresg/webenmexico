<?php

namespace Database\Seeders;

use App\Models\User;
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
        $data_user = array('name' => 'manuel',
        'email' => 'vichsoriano@gmail.com', 'password' => bcrypt('@Soriano2022'));
        $user = new User($data_user);
        $user->save();
    }
}
