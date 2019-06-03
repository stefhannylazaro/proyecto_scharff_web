<?php

use Illuminate\Database\Seeder;

class ConfiguradorLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurador_links')->delete();
        DB::table('configurador_links')->insert(
            [
                [
                    'clave' => 'foot_facebook',
                    'vista' => 'HOME',
                    'titulo' => 'Facebook',
                    'link' => 'https://www.facebook.com/holascharff'
                ],
                [
                    'clave' => 'foot_instagran',
                    'vista' => 'HOME',
                    'titulo' => 'Instagram',
                    'link' => 'https://www.instagram.com/holascharff/'
                ],
                [
                    'clave' => 'foot_linkedin',
                    'vista' => 'HOME',
                    'titulo' => 'Linkedin',
                    'link' => 'https://www.linkedin.com/company/scharff/'
                ],
                [
                    'clave' => 'foot_terminos',
                    'vista' => 'HOME',
                    'titulo' => 'Términos y condiciones',
                    'link' => ''
                ],
                [
                    'clave' => 'foot_privacidad',
                    'vista' => 'HOME',
                    'titulo' => 'Politicas de Privacidad',
                    'link' => ''
                ]
            ]
        );
    }
}
