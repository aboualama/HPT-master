<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    $user = \App\User::create([
      'name' => 'super',
      'userName' => 'admin',
      'email' => 'admin@admin.com',
      'password' => bcrypt('admin@admin.com'),
    ]);

    $user->attachRole('admin');

  }

}
