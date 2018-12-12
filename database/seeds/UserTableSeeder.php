<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();

        factory(Anodizado\User::class)->create([
            'name' => 'Sebastian Escalona',
            'email' => 'sebastianep6@gmail.com',
            'password' => bcrypt('secret')
        ]);

        factory(Anodizado\User::class)->create([
            'name' => 'Maria Ling Chong',
            'email' => 'marialingchongesc@gmail.com',
            'password' => bcrypt('adminLing')
        ]);

        factory(Anodizado\User::class)->create([
            'name'     => 'Jose Chong',
            'email'    => 'jchong@aluminiosdialca.com',
            'password' => bcrypt('Alum_Dialca2016')
        ]);
    }
}
