<?php

use Illuminate\Database\Seeder;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      // SucursalesPeruOne
      //
      // ciudad
      //
      //departamento
      // dirOne
      // dirTwo
      // tel
      // lat
      // lng
        DB::table('sucursals')->delete();
        DB::table('sucursals')->insert(
            [
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Miraflores',
                    'direccion' => json_encode([
                                      "departamento"=>"Lima",
                                      "dirOne"=> "Av. Santa Cruz 888,",
                                      "dirTwo"=> "Piso 7",
                                      "tel"=> "(+51) 732-12760"
                                    ]),
                    'latitud' => '-12.1119148',
                    'longitud' => '-77.0381604'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Miraflores',
                    'direccion' => json_encode([
                                      "departamento"=>"Lima",
                                      "dirOne"=> "Alcanfores 350",
                                      "dirTwo"=> "Counter FedEx",
                                      "tel"=> "994094580"
                                    ]),
                    'latitud' => '-12.12283231',
                    'longitud' => '-77.02786815'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Callao',
                    'direccion' => json_encode([
                                      "departamento"=>"Callao",
                                      "dirOne"=> "Calle Los Cedros 143",
                                      "dirTwo"=> "Urb. Las Fresas",
                                      "tel"=> "(+51) 517 1600"
                                    ]),
                    'latitud' => '-12.0046331',
                    'longitud' => '-77.1148438'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Paita',
                    'direccion' => json_encode([
                                      "departamento"=>"Piura",
                                      "dirOne"=> "Av. Meliton Carbajal Mz G,",
                                      "dirTwo"=> "Lt 15 Urb. Las Mercedes",
                                      "tel"=> "(+51) 732-12760"
                                    ]),
                    'latitud' => '-5.0902051',
                    'longitud' => '-81.1063744'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Pocollay',
                    'direccion' => json_encode([
                                      "departamento"=>"Tacna",
                                      "dirOne"=> "Ampliación Bolognesi Mz G,",
                                      "dirTwo"=> "Lt 12. Pocollay",
                                      "tel"=> "(052)227-534"
                                    ]),
                    'latitud' => '-17.994907',
                    'longitud' => '-70.219919'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Arequipa',
                    'direccion' => json_encode([
                                      "departamento"=>"Arequipa",
                                      "dirOne"=> "Av. Italia 105 Cerro",
                                      "dirTwo"=> "Colorado",
                                      "tel"=> "(051)054 443666"
                                    ]),
                    'latitud' => '-16.3541186',
                    'longitud' => '-71.5709578'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Desaguadero',
                    'direccion' => json_encode([
                                      "departamento"=>"Puno",
                                      "dirOne"=> "Av. Panamericana 357,  2do",
                                      "dirTwo"=> "piso. Desaguadero",
                                      "tel"=> "(051)505-150"
                                    ]),
                    'latitud' => '-16.562586',
                    'longitud' => '-69.0386916'
                ],

                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Trujillo',
                    'direccion' => json_encode([
                                      "departamento"=>"La Libertad",
                                      "dirOne"=> "Calle Libertad 270,",
                                      "dirTwo"=> "Salaverry",
                                      "tel"=> "(044)585-168"
                                    ]),
                    'latitud' => '-8.223254',
                    'longitud' => '-78.9765111'
                ],
                [

                    'pais' => 'PERÚ',
                    'ciudad' => 'Tumbes',
                    'direccion' => json_encode([
                                      "departamento"=>"Tumbes",
                                      "dirOne"=> "Av. 28 de Julio 507",
                                      "dirTwo"=> "Tumbes",
                                      "tel"=> "(072)561-204"
                                    ]),
                    'latitud' => '-3.5031864',
                    'longitud' => '-80.2752493'
                ],
                [

                    'pais' => 'BOLIVIA',
                    'ciudad' => 'La Paz',
                    'direccion' => json_encode([
                                      "departamento"=>"Bolivia",
                                      "dirOne"=> "Av. 20 de Octubre N. 2619",
                                      "dirTwo"=> "(entre Campos y Phila)",
                                      "tel"=> "591 2120000"
                                    ]),
                    'latitud' => '-16.5123062',
                    'longitud' => '-68.1243573'
                ],
                [

                    'pais' => 'BOLIVIA',
                    'ciudad' => 'Santa Cruz',
                    'direccion' => json_encode([
                                      "departamento"=>"Bolivia",
                                      "dirOne"=> "Calle Cochabamba 694",
                                      "dirTwo"=> "(esquina Saavedra)",
                                      "tel"=> "591 3116211"
                                    ]),
                    'latitud' => '-17.7897826',
                    'longitud' => '-63.1773985'
                ],



            ]
        );
    }
}
