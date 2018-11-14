<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('ConnectRelationshipsSeeder');
         $user = factory(App\User::class)->create([
             'username' => 'admin',
             'email' => 'admin@gmail.com',
             'password' => bcrypt('admin'),
             'lastname' => 'Mr',
             'firstname' => 'admin'
         ]);

         $user = factory(App\User::class)->create([
             'username' => 'satriya',
             'email' => 'satriyawardhana@gmail.co,',
             'password' => bcrypt('05021995'),
             'lastname' => 'Mr',
             'firstname' => 'satriya'
         ]);
    }
}
