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
        $this->call(UserSeeder::class);
        $this->call(UbigeoSeeder::class);
        $this->call(ConfiguradorTextosSeeder::class);
        $this->call(ConfiguradorLinksSeeder::class);
        $this->call(MotivosTableSeeder::class);
        $this->call(EstablecerOptionesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(PerfilTableSeeder::class);
        $this->call(AccionTableSeeder::class);



        //otras iteraciones:
        // php artisan db:seed --class=BannersTableSeederV2
        // php artisan db:seed --class=SucursalesTableSeeder
        // php artisan db:seed --class=EstablecerOptionesTableSeeder


        // php artisan db:seed --class=EstablecerOptionesTableSeeder
    }
}
