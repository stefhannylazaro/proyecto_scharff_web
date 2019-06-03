<?php

use Illuminate\Database\Seeder;

class AccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accion')->delete();
        DB::table('accion')->insert(
            [
                [
                    'id' => 1,
                    'nombre' => 'Dashboard',
                    'base_ruta' => 'dashboard'
                ],
                [
                    'id' => 2,
                    'nombre' => 'Banners',
                    'base_ruta' => 'banner'
                ],
                [
                    'id' => 3,
                    'nombre' => 'Servicios',
                    'base_ruta' => 'servicio'
                ],
                [
                    'id' => 4,
                    'nombre' => 'Sucursales',
                    'base_ruta' => 'sucursal'
                ],
                [
                    'id' => 5,
                    'nombre' => 'Contactos',
                    'base_ruta' => 'contacto'
                ],
                [
                    'id' => 6,
                    'nombre' => 'Motivos de contacto',
                    'base_ruta' => 'motivo'
                ],
                [
                    'id' => 7,
                    'nombre' => 'Lockers',
                    'base_ruta' => 'locker'
                ],
                [
                    'id' => 8,
                    'nombre' => 'Reserva de lockers',
                    'base_ruta' => 'reserva'
                ],
                [
                    'id' => 9,
                    'nombre' => 'Libro de Reclamaciones',
                    'base_ruta' => 'reclamo'
                ],
                [
                    'id' => 10,
                    'nombre' => 'Opciones',
                    'base_ruta' => 'opciones'
                ],
                [
                    'id' => 11,
                    'nombre' => 'Configurador de textos',
                    'base_ruta' => 'config-texto'
                ],
                [
                    'id' => 12,
                    'nombre' => 'Configurador de links',
                    'base_ruta' => 'config-link'
                ],
                [
                    'id' => 13,
                    'nombre' => 'Administradores',
                    'base_ruta' => 'admin'
                ],
                [
                    'id' => 14,
                    'nombre' => 'Perfiles',
                    'base_ruta' => 'perfil'
                ],
                [
                    'id' => 15,
                    'nombre' => 'Postulantes',
                    'base_ruta' => 'postulantes'
                ],
                [
                    'id' => 16,
                    'nombre' => 'Envios regulares',
                    'base_ruta' => 'regular'
                ],
                [
                    'id' => 17,
                    'nombre' => 'Log de transacciones',
                    'base_ruta' => 'log'
                ],
                [
                    'id' => 18,
                    'nombre' => 'faqs',
                    'base_ruta' => 'faq'
                ],
                [
                    'id' => 19,
                    'nombre' => 'users',
                    'base_ruta' => 'user'
                ],
                [
                    'id' => 20,
                    'nombre' => 'Referencia',
                    'base_ruta' => 'referencia'
                ]

            ]
        );


        // Establecer todas las Acciones al primer perfil creado

        $perfil = \App\Models\Perfil::where('estado', 1)->first();

        if ($perfil) {
            $acciones = \App\Models\Accion::where('estado', 1)->get();
            foreach ($acciones as $ac){
                \App\Models\PerfilAccion::create(['accion_id' => $ac->id, 'perfil_id' => $perfil->id]);
            }

            $usuario = \App\Models\User::where('rol', 'superadmin')->first();

            if ($usuario){
                $usuario->administrator->perfil_id = $perfil->id;
                $usuario->administrator->save();
            }
        }

    }
}
//php artisan db:seed --class=EstablecerOptionesTableSeeder
//php artisan db:seed --class=AccionTableSeeder
