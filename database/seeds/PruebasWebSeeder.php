<?php

use Illuminate\Database\Seeder;

class PruebasWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = \DB::table('users')->select('users.id','users.email')->get()->toArray();
      //print_r($users);

      foreach($users as $user){
        if(!empty($user->email)){
          \DB::connection('pickapp_api')->table('usuario')
            ->where('usuario_email', $user->email)
            ->update(['usuario_webid' => $user->id]);
        }
      }
    }
}
