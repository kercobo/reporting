<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         DB::table('users')->insert([
            'email' => 'demo1@demo.com' ,
            'username' => 'demo1',
            'password' => Hash::make( 'asdasd' ) ,
            'name' => 'demo' ,
        ] );
        

        Model::reguard();
    }

}
