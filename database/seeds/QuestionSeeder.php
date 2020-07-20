<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = \App\Question::create([
        'name' => 'super',
        'userName' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin@admin.com'),
      ]);

      $user->attachRole('admin');
    }
}
