<?php

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('faqs')->delete();
      DB::table('faqs')->insert(
          [
              [
                  'categoria' => 1,
                  'pregunta' => 'Dónde estan ubicadas sus oficinas en Lima o a nivel nacional?',
                  'respuesta' => 'Tenemos oficinas en Lima, Arequipa, Tacna, Trujillo, Tumbes, Piura y Puno. En qué ciudad te interesa?',
              ],
              [
                  'categoria' => 1,
                  'pregunta' => 'Dónde podría ir a para poder hacer envíos Nacionales o Internacionales?',
                  'respuesta' => 'Tenemos oficinas en Lima, Arequipa, Tacna, Trujillo, Tumbes, Piura y Puno. En qué ciudad te interesa?',
              ],
              [
                  'categoria' => 1,
                  'pregunta' => 'Quisiera trabajar con Uds., cómo puedo postular?',
                  'respuesta' => 'Puedes llamarnos al  al 517-1650  anexo 1628 o 2039 o enviarnos un email a selección@holascharff.com',
              ],

              [
                  'categoria' => 1,
                  'pregunta' => 'Dónde puedo dejar mi CV para poder trabajar con Uds?',
                  'respuesta' => 'Puedes llamarnos al  al 517-1650  anexo 1628 o 2039 o enviarnos un email a selección@holascharff.com',
              ],

              [
                  'categoria' => 2,
                  'pregunta' => 'Deseo saber si debo pagar impuestos si es que hago una importacion a Perú ?',
                  'respuesta' => "Para las importaciones a Perú tenemos los siguientes costos:
                   Paquetes con valor menor a $200 usd: Costos del tramite de liberación o gastos Operativos.
                   Paquetes con valor mayor a $200 usd: Pago de impuestos a Aduana y Costos del tramite de liberación o gastos Operativos.",
              ],

              [
                  'categoria' => 2,
                  'pregunta' => 'Quisiera saber cuánto debo pagar de impuestos o que costos hay si traigo una importación?',
                  'respuesta' => "Paquetes con valor menor a $200 usd: Costos del tramite de liberación o gastos Operativos.
 Paquetes con valor mayor a $200 usd: Pago de impuestos a Aduana y Costos del tramite de liberación o gastos Operativos.
 Puede ver nuestras tarifas de desaduanaje SIN IGV en el siguiente link: http://images.fedex.com/lacpdf/informacion_de_cargos_aduaneros-PE.pdf",
              ],

              [
                  'categoria' => 2,
                  'pregunta' => 'Me quieren enviar un paquete del extranjero quisiera saber si hay costo de impuestos?',
                  'respuesta' => "Paquetes con valor menor a $200 usd: Costos del tramite de liberación o gastos Operativos.
 Paquetes con valor mayor a $200 usd: Pago de impuestos a Aduana y Costos del tramite de liberación o gastos Operativos.
 Puede ver nuestras tarifas de desaduanaje SIN IGV en el siguiente link: http://images.fedex.com/lacpdf/informacion_de_cargos_aduaneros-PE.pdf",
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Porque debo pagar impuestos?',
                  'respuesta' => "Todos los envíos que no sean documentos y que se reciben del exterior con valor superior a $200 usd deben pagar impuestos para poder ser liberados de Aduana.",
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Quisiera saber qué tengo que pagar para poder retirar mis documentos y hacer el trámite con mi propio agente de Aduana?',
                  'respuesta' => "Para retirar los documentos deben cancelar el Handling de $50 usd + IGV. Si el costo de transporte esta cargado a Peru debe cancelar el Costo de transporte para continuar con el trámite de importación.",
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Cómo se calcula el monto del almacenaje?',
                  'respuesta' => "Los gastos de almacenaje se calculan desde el dia que llegó su paquete a Lima hasta la fecha de retiro con confirmación de levante y considerando el valor CIF de la liberación. Nos puedes dar el número de tu guía paa que podamos contactarte y darte los montos aproximados.",
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Me ha llegado una notificación por email / sms sobre un pago que debo realizar para liberar mi envío de Aduana, de qué se trata?',
                  'respuesta' => "Los mensajes de pago hacen referencia a los gastos operativos por el servicio de liberación y/o impuestos cobrados por la Sunat - Aduana

 En las importaciones a Perú tenemos los siguientes costos para poder tener disponibles los envíos:
 Paquetes con valor menor a $200 usd: Costos del tramite de liberación o gastos Operativos.
 Paquetes con valor mayor a $200 usd: Pago de impuestos a Aduana y Costos del tramite de liberación o gastos Operativos. Puede ver nuestras tarifas de desaduanaje SIN IGV en el siguiente link: http://images.fedex.com/lacpdf/informacion_de_cargos_aduaneros-PE.pdf",
              ],
              [
                  'categoria' => 3,
                  'pregunta' => 'TNT ahora le pertenece a FEDEX?',
                  'respuesta' => "Desde Octubre 2017, FedEx se ha hecho cargo de las Operaciones de TNT para importación y Exportación.",
              ],
              [
                  'categoria' => 3,
                  'pregunta' => 'Tengo un envio con guía TNT, cómo puedo saber el status?',
                  'respuesta' => "Las consultas sobre envíos se hacen a través de todas las plataformas de consulta de FedEX. Pueden llamarnos al 5171600, contactarnos via whatsapp 998140976 al y/o encuentranos en facebook como facebook.com/holascharff",
              ],
              [
                  'categoria' => 3,
                  'pregunta' => 'Yo era cliente de TNT y tenia una cuenta para hacer envios con crédito, quiero saber si aún la mantengo.',
                  'respuesta' => "Si Ud. Aun no ha generado una cuenta FedEx para poder hacer y/o recibir envíos dejenos sus datos para poder hacerle llegar los requisitos para la apertura de su cuenta con FedEx y una posible linea de crédito.",
              ],
              [
                  'categoria' => 3,
                  'pregunta' => 'Quiero saber si mi cuenta TNT es la misma con FedEx?',
                  'respuesta' => "Las cuentas TNT ya no se pueden usar para envíos. Se debe generar una cuenta FedEx localmente
 Si Ud. Aun no ha generado una cuenta FedEx para poder hacer y/o recibir envíos dejenos sus datos para poder hacerle llegar los requisitos para la apertura de su cuenta con FedEx y una posible linea de crédito.",
              ],
              [
                  'categoria' => 4,
                  'pregunta' => 'Tengo un reclamo con Uds y quisiera saber el status y el tiempo estimado de resolución.',
                  'respuesta' => "Hola,  estas consultas requieren la atención de un agente especializado En unos momentos se comunicarán directamente con usted. Por favor indíquenos un correo eléctrónico y teléfono de contacto, Adicionalmente puedes comunicarte a nuestro whatsapp 998140976 o al correo atenciónalcliente@holascharff.com para brindarle mayor información",
              ],
              [
                  'categoria' => 5,
                  'pregunta' => 'Tengo una guía que he trabajado con Uds y quisiera saber el status o cuándo va poder ser entregado?',
                  'respuesta' => "Hola, se han tomado sus datos y pronto un agente de servicio al  cliente estara contactandose con usted para apoyarlo con su consulta. Adicionalmente puedes comunicarte con nuestra central 517-1600 , escribirnos a nuestro whatsapp 998140976 o al correo atenciónalcliente@holascharff.com",
              ],
              [
                  'categoria' => 6,
                  'pregunta' => 'Tengo un producto que quiero enviar al extranjero pero quisiera saber que requisitos necesito',
                  'respuesta' => "Debe comunicarse con la central 517-1600 para poder brindarle mayor información sobre los requisitos de envío",
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Hice un pago mayor al que me correspondía o hice un pago por error a sus cuentas que debo hacer para que me devuelvan',
                  'respuesta' => "Debe enviar un correo a atencionalcliente@holascharff.com con el número de guía aérea y los comprobantes de pago que dejan constancia del deposito que nos hizo",
              ],
              [
                  'categoria' => 7,
                  'pregunta' => 'Quiero tener una cuenta con ustedes como debe hacer',
                  'respuesta' => "Debe escribir un correo a nuestro personal del área comercial practicante.comercial@holascharff.com",
              ],
              [
                  'categoria' => 8,
                  'pregunta' => 'A que central debo comunicarme si deseo comunicarme con áreas administrativas',
                  'respuesta' => "Debe comunicarse a nuestra central 517-1650, nuestras recepcionista contestará su llamada.",
              ],
              [
                  'categoria' => 7,
                  'pregunta' => 'Con quien debo comunicarme para entablar una relación comercial con su empresa y sus servicios',
                  'respuesta' => "Contactos por definir de cada área.",
              ],



              [
                  'categoria' => 9,
                  'pregunta' => 'Ya descargue pero nunca me pasaron mi cuenta pese a que me reguistre mas de 10 veces',
                  'respuesta' => "Por favor envíanos tu número de DNI al Facebook o al whatssapp 998140976",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Yo me inscribi hace tiempo. Pero no me acuerdo mi contraseña',
                  'respuesta' => "Por favor envíanos tu número de DNI al Facebook o al whatssapp 998140976",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Ya me había registrado hace tiempo pero cuando cambie de celular lo volví a instalar y olvide mi clave',
                  'respuesta' => "Por favor envíanos tu número de DNI al Facebook o al whatssapp 998140976",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿La aplicación está funcionando?',
                  'respuesta' => 'Puedes descargar la útima actualización del app como ""Quiero Ser Picker"" del Google Store.
                El enlace es https://play.google.com/store/apps/details?id=pe.pickapp.pickapp',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Debo tener el gps prendido o no es necesario?',
                  'respuesta' => 'Debe estar activo el GPS siempre.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Me aparece un mensaje de que tengo problemas con el certificado de seguridad de este sitio?',
                  'respuesta' => 'Se recomienda realizar la postulación desde una PC.',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => '	Deseo saber el precio de un servicio delivery en moto urbano?',
                  'respuesta' => '	Contactar a Maria Portocarrero al email maria.portocarrero@holascharff.com',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => '	Quisiera tener mas informacion de como puedo pertenecer a la empresa y el tipo de trabajo y  Horarios	Quisiera tener mas informacion de como puedo pertenecer a la empresa y el tipo de trabajo y  Horarios	Quisiera tener mas informacion de como puedo pertenecer a la empresa y el tipo de trabajo y  Horarios',
                  'respuesta' => 'Link preguntas frecuentes https://www.pickapp.pe/preguntas',
              ],

              [
                  'categoria' => 10,
                  'pregunta' => 'Buenas como hago para ser picker',
                  'respuesta' => 'Puedes postular en este enlace https://www.pickapp.pe/picker',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => 'Una consulta para poder trabajar en pickapp',
                  'respuesta' => 'Puedes postular en este enlace https://www.pickapp.pe/picker',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => 'Buenas, como hago para ser picker',
                  'respuesta' => 'Puedes postular en este enlace https://www.pickapp.pe/picker',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => ' Ya postule. Cual es el procedimiento',
                  'respuesta' => 'Dentro de 24 ó 48 horas debe estar recibiendo un email con el resultado. Saludos!',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => ' Me mandaron un correo sobre picker. Estoy interesado en trabajar con usted',
                  'respuesta' => "¡Hola! Gracias por contactarte.

Pickapp es un App que permite realizar envíos a través de una
red de transporte urbano, conformada por Pickers. Si cuentas con una moto,
bicicleta o si incluso te trasladas a pie, puedes convertirte en Picker.

Te comparto el enlace de preguntas frecuentes donde puedes verificar información al respecto
https://www.pickapp.pe/preguntas

Para tu postulación ingresa en este enlace https://www.pickapp.pe/picker, se recomienda realizarlo desde una PC.",
              ],


              [
                  'categoria' => 10,
                  'pregunta' => ' Buenas quiero aplicar para ser hacer los pedidos tengo movilidad propia y podría hacerlo en mía tiempos libres',
                  'respuesta' => "Puedes postular en este enlace https://www.pickapp.pe/picker",
              ],
              [
                  'categoria' => 10,
                  'pregunta' => ' Quisiera trabajar con mí bici.Cómo puedo hacer?',
                  'respuesta' => "Puedes postular en enlace: https://www.pickapp.pe/picker",
              ],
              [
                  'categoria' => 10,
                  'pregunta' => '¿ya estan haciendo entregas ?',
                  'respuesta' => "	Sí correcto. Durante este mes de Marzo estamos haciendo el envío de alertas masivas.",
              ],
              [
                  'categoria' => 10,
                  'pregunta' => 'Ok ya ingrese. Ya estoy apto para trabajar entonces',
                  'respuesta' => "Sí correcto.
                Durante este mes de Marzo estamos haciendo el envío de alertas masivas.
                Ten activo siempre tu GPS. Estamos en contacto. Saludos!",
              ],
              [
                  'categoria' => 10,
                  'pregunta' => 'He postulado para ser un picker a pie,pero no me dan respuestas ni nada.
    Queria saber si aun estan en busca de colaboradores',
                  'respuesta' => "Sí claro.
    Indicame tu DNI para verificar en el sistema.
    Dentro de 24 ó 48 horas debe estar recibiendo un email con el resultado.
    Saludos!",
              ],
              [
                  'categoria' => 10,
                  'pregunta' => '¿Aceptan moto Scooter?',
                  'respuesta' => "Sí correcto. Puedes realizar el transporte en cualquier tipo de moto, auto, bicicleta ó a pie.",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Qué hacer si no recibo respuesta al momento de recoger el pedido?',
                  'respuesta' => "Debo esperar 15 minutos, tiempo en el cual tengo que intentar contactarme con el cliente que recibirá el pedido, por msj o una llamada; en caso no se tenga respuesta llamar al cliente quien realizó el pedido.

                  Si el cliente que realizó el recojo no llega a coordinar la entrega con la persona de destino; se debe proceder a tomar una fotografía a la fachada de la casa y colocar en las opciones de incidencia; de esta manera el pedido será cancelado.

                  Se debe devolver el pedido al cliente que lo solicitó, el pago de todos los recorridos incluyendo la devolución será pagado en función de los km recorridos",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Qué hacer si no recibo respuesta al momento de recoger el pedido?',
                  'respuesta' => "Se debe comunicar inmediatamente con el cliente para comunicarle que se va a producir un retraso, indicándole la hora aproximada de llegada",
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Qué hacer si me roban el pedido?',
                  'respuesta' => 'Inmediatamente debo comunicarme al teléfono ""998140976"", si no recibo una respuesta debo enviar un whatsapp con el detalle del pedido y lo sucedido.
                                Luego debo realizar la denuncia policial del robo
                                Un miembro de nuestro equipo se pondrá en contacto para confirmar la seguridad del Scharffer y para recopilar cualquier otra información que se requiera',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Qué pasa si tengo un accidente?',
                  'respuesta' => 'Compruebe que todo los involucrados estén a salvo
                  Si es necesario, avisa a la policía y a los paramédicos.
                  Comunica a tu cliente el retraso o no entrega de su pedido
                  Contactanos por whatsapp o comunicate a la central de Scharff Express ""998140976""; indicando el Nº de pedido y detallando lo sucedido',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿Se debo hader si dañó el producto?',
                  'respuesta' => 'Informar inmediatamente al whatsapp o la central de Scharff Express ""998140976"" indicando el Nº de pedido y detallando lo sucedido
                  Nuestro personal se comunicará con el cliente que solicitó el pedido y con el cliente que espera el pedido comunicandole lo sucedido y ofreciendole las disculpas del caso.
                  Entregar el pedido y disculparse con el cliente por el daño al producto
                  Informarle que ya ha sido notificado a la empresa Scharff, quienes asumiran la responsabilidad por lo ocurrido',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿No puedo concretar mi entrega?',
                  'respuesta' => 'Comunicar al cliente que no vas a poder concretar la entrega, coordinando la hora y lugar de devolución
                  En las opciones de entrega, colocar “Rechazar pedido” colocando los motivos de Rechazo (Confirmar Kiara: si esta habilitado esta opción)
                  Enviar un Whatsapp al número ""998140976"", indicando el Número de pedido, motivo “Entrega no concretada” y el detalle de la no entrega',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'El cliente tiene un reclamo, qué debo decirle?',
                  'respuesta' => '
                  Si el cliente tiene un reclamo por el servicio prestado indicarle que estos serán atendidos por nuestra central telefónica. Indicandole el número telefónico de contacto ""998140976""',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => '¿El cliente no quiere recibir ?',
                  'respuesta' => 'Si el cliente no quiere recibir el pedido y este no se encuentra dañado:

                Comunicarse inmediatamente con el cliente quien realizó el pedido y comentarle lo sucedido
                Coordinar con el cliente la fecha y hora de retorno del producto
                En las opciones de entrega colocar “Rechazo de producto”
                Colocar la nueva dirección de devolución
                El pago se dará en función de los kilómetros recorridos (Entrega + Retorno)',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Cancelé accidentalmente el pedido, qué debo hacer?',
                  'respuesta' => 'Si finalizaste el viaje en la app accidentalmente y ahora no sabes la dirección de entrega, llama a la línea local de soporte de Scharff Express inmediatamente ""998140976""',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Por qué no estoy recibiendo pedidos ?',
                  'respuesta' => 'Si no estás recibiendo muchos pedidos de viaje cuando inicias sesión, tenemos algunas recomendaciones:

               -Verificar que cuentas con la última versión de Scharff Express, consultando en el appstore
               - Trasladarse a un área de mayor demanda (San Borja/ San Isidro/ Miraflores/ Barranco)

               Si estas acciones no solucionan tu problema, comunicate con el área de soporte de Scharff Express',
              ],

              [
                  'categoria' => 9,
                  'pregunta' => 'El viaje no aparece en mi historial de pagos. cómo lo puedo resolver?',
                  'respuesta' => 'Asegurate que tu pedido no figure en la lista de pendientes, de ser el caso revisar si completaste todos los estados de entrega.
                Si tu pedido no figura en el historial de pagos ni pendientes comunicate con el centro de Ayuda de Scharff Express ""998140976"", inicandole lo sucedido
                Personal de Scharff Express se comunicará con usted con una respuesta a su inconveniente',
              ],


















              [
                  'categoria' => 11,
                  'pregunta' => '¿Qué es Scharff Express?',
                  'respuesta' => 'Es un servicio de Scharff a demanda para recoger y hacer envíos urbanos a través de
    nuestra red de Scharffers en menos de 3 horas',
              ],


              [
                  'categoria' => 11,
                  'pregunta' => '¿Cuál es la cobertura de servicio?',
                  'respuesta' => 'Actualmente brindamos el servicio en cuatro distritos: Miraflores, Surco, San Borja y San Isidro.',
              ],

              [
                  'categoria' => 11,
                  'pregunta' => '¿Qué articulos puedo envíar por scharff expres?',
                  'respuesta' => 'Puedes enviar toda clase de articulos que cumplan con estas características:
                - Valor menor a S/. 500
                - Su peso no supero los 6 Kg.
                - Sus medias sean aproximadamente: 40 x 40 x 40 cm.',
              ],

              [
                  'categoria' => 11,
                  'pregunta' => 'Tiempos de recojo y entrega',
                  'respuesta' => 'Los tiempos estimados son:
                - 1 hora para el recojo
                - 1 hora para la entrega
                OBS: estos tiempos solo aplican para envíos dentro de Miraflores, San Borja, San Isidro y Surco.',
              ],
              [
                  'categoria' => 11,
                  'pregunta' => 'Olvidé mi contraseña',
                  'respuesta' => 'Debes darle click en la opción""Olvidé mi contraseña"", introducir tu dirección de email y en pocos minutos te llegará un  correo. En este correo encontrarás un enlace para restablecer tu contraseña.
                  Por razones de seguridad, el enlace caducará pasados # minutos. Abre el enlace de inmediato o no lo solicites hasta que no estés listo para continuar con el proceso de restablecimiento de la contraseña.
                  Si el enlace no funciona, dale click nuevamente a #Olvidé mi contraseñ"". Comprueba que tu dirección de correo sea la correcta.',
              ],
              [
                  'categoria' => 11,
                  'pregunta' => 'El enlace para reestablecer la contraseña no funciona',
                  'respuesta' => 'Debes darle click en la opción""Olvidé mi contraseña"", introducir tu dirección de email y en pocos minutos te llegará un  correo. En este correo encontrarás un enlace para restablecer tu contraseña.
                  Por razones de seguridad, el enlace caducará pasados # minutos. Abre el enlace de inmediato o no lo solicites hasta que no estés listo para continuar con el proceso de restablecimiento de la contraseña.
                  Si el enlace no funciona, dale click nuevamente a #Olvidé mi contraseña"". Comprueba que tu dirección de correo sea la correcta',
              ],
              [
                  'categoria' => 11,
                  'pregunta' => 'No puedo iniciar sesión con mi cuenta',
                  'respuesta' => 'Si no puedes iniciar sesión en tu cuenta porque has olvidado tu contraseña, haz clic en ""Olvidé mi contraseña"" para restablecerla.',
              ],
              [
                  'categoria' => 11,
                  'pregunta' => 'No puedo solicitar un envío',
                  'respuesta' => 'Si no consigues solicitar un envío, puede deberse a estas razones:
                -Tienes un pago pendiente.
                -Tu forma de pago se ha rechazado en un envío anterior.
                -Scharff Express no está disponible actualmente en tu ubicación.
                -No hay ningún scharffer en este momento en tu zona. Espera y vuelve a intentarlo.',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Cuáles son los  métodos de pago al momento de mi recojo o entrega?',
                  'respuesta' => 'Por el momento solo acepatamos pagamos en línea con tarjetas de crédito o débito de cualquier banco.',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => '¿Cuál es el costo del uso de sus servicios?',
                  'respuesta' => 'Nuestras tarifas se calculan en base a los kilómetros recorridos.
    Primeros 4 km: S/. 1.75 x KM
    KM adicional: S/. 1.2
    Siendo la tarifa mínima S/. 7',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => '¿Por qué se ha rechazado mi pago?',
                  'respuesta' => 'Si se ha rechazado tu pago, puede deberse a estas razones:
                - Has introducido incorrectamente el número de tarjeta de crédito o débito, deberás corregirlo en la opción ""Métodos de pago"" de la aplicación.
                - El saldo de tu cuenta es insuficiente, deberás transferir fondos. También puedes añadir o seleccionar otra forma de pago.
                - Has superado el límite disponible de tu cuenta, contacta con el banco para solicitar una ampliación. También puedes añadir o seleccionar otra forma de pago.
                - Puede que tu banco haya rechazado el cargo de Scharff debido a una sospecha de uso fraudulento. Deberás actualizar tu forma de pago o contactar con el banco para obtener más información.
                - Si has comunicado previamente la pérdida o el robo de tu tarjeta de crédito, puede que el banco rechace todas las transacciones. Contacta con el servicio de atención al cliente de la entidad para notificar que has recuperado la tarjeta.
                - Si la tarjeta de crédito o débito ha caducado, deberás eliminarla de la cuenta y sustituirla por una válida.',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Actualizar una forma de pago en mi cuenta',
                  'respuesta' => 'Ingresa a la opción ""Métodos de pago"" del app
                - Click en ""Añadir tarjeta bancaria""
                - Digita tu número de tarjeta, feha de caducidad, código de seguridad y correo.
                - Click en ""Guardar""',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => 'Cómo puedo realizar envíos a través de esta aplicación?',
                  'respuesta' => 'Descarga la app, registrate y estarás listo para hacer envíos.',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => '¿Cómo funciona la aplicación?',
                  'respuesta' => '1° Descarga el app en play store como ""Scharff Express""
                 2° Crea una cuenta
                3° Ingresa los datos de recojo y entrega. Podrás ver la tarifa antes de solicitar un envío. Paga
                4° Envía: verás los datos del scharffer que realiza tu envío y darle seguimiento.',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => '¿Cómo puedo cancelar un pedido?',
                  'respuesta' => 'Debes darle click en la opción ""Cancelar pedido"".
                  Al cancelar un pedido se cobrará el monto total del mismo.',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => 'Cómo puedo hacer seguimiento a un envío realizado?',
                  'respuesta' => 'Cuando un scharffer acepte tu pedido, te llegará un 1° correo en donde te aparecerá un botón "Rastrear pedido". Solo dale click y listo.',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => 'Seleccionar una opción de vehículoSeleccionar una opción de vehículo',
                  'respuesta' => 'Ten en cuanta que el scharffer puede no contestar al teléfono si está conduciendo.',
              ],
              [
                  'categoria' => 12,
                  'pregunta' => '¿Cómo identifico a la persona que realizará mi envío?',
                  'respuesta' => 'Cuando solicitas un envío, tu aplicación envía una solicitud a los scharffers más cercanos. Cuando un scharffer acepte realizar tu envío, te llegará un correo donde podrás ver la información del scharffer y rastrear tu envío.',
              ],

              [
                  'categoria' => 12,
                  'pregunta' => 'Valorar a un scharffer',
                  'respuesta' => '	Al final de cada envío, podrás valorar al scharffer que lo realizó con una puntuación de una a cinco estrellas desde la aplicación o en la parte inferior del recibo que te enviaremos por email. También podrás incluir comentarios sobre el envío o el scharffer.',
              ],










              [
                  'categoria' => 10,
                  'pregunta' => 'Con quién debo comunicarme para tener sus servicios?',
                  'respuesta' => 'En el caso de que cuentes con una empresa y desees información sobre Scharff Stop, puedes escribir al email
                de Manuel Velásquez (manuel.velasquez@holascharff.com) para que pueda ayudarte con la información para nuevos servicios empresas.',
              ],
              [
                  'categoria' => 10,
                  'pregunta' => 'Con qué empresas trabajan ya este servicio?',
                  'respuesta' => 'Con qué empresas trabajan ya este servicio?	"Actualmente Saga Falabella tiene este servicio de entrega y muy pronto también Telefónica.
Al realizar una compra online en Saga Falabella,tienes la opción de recoger el envío en unos de nuestros lockers que se encuentran ubicados en los grifos repsol.
Te invito a visitar nuestra web en el link http://www.holascharff.com/scharff-stop para mayor información.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Qué hago si tengo un problema para abrir el locker',
                  'respuesta' => 'Comunícate con nosotros al  5171600 ó vía WhatsApp al número 998140976 para poder ayudarte.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Qué pasa sino me llega el codigo para abrir el locker',
                  'respuesta' => 'Comunícate con nosotros al 5171600 ó vía WhatsApp al número 998140976 para poder ayudarte.',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Cuánto cuesta utilizar un  locker?',
                  'respuesta' => '	La tarifa es S/.9.50',
              ],
              [
                  'categoria' => 2,
                  'pregunta' => 'Hay un cargo adicional si me demoro en recogerlo',
                  'respuesta' => 'No. Solo considerar que tienes 3 días para realizar el recojo. Posterior a dicha fecha el envío será retornado a Saga Falabella.0',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'El servicio tiene algún tipo de seguro?',
                  'respuesta' => 'Si requieres un tipo de seguro particular para tu compra ó envío lo puedes solicitar al momento de adquirir el
                servicio de recojo mediante uno de nuestros lockers de Scharff.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Puedo enviar otra persona a recoger mi pedido, como lo puedo hacer',
                  'respuesta' => 'Cualquier persona que cuente con el código QR de recojo ó el código alfanumérico puede hacer el recojo.
                Solo tener en cuenta que dicha información es personal y debe tomar la precauciones del caso.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Por cuánto tiempo puede estar mi pedido en el locker	Por 3 días para su recojo como máximo.',
                  'respuesta' => 'Por 3 días para su recojo como máximo.',
              ],

              [
                  'categoria' => 9,
                  'pregunta' => 'Puedo recoger varios pedido al mismo tiempo.',
                  'respuesta' => 'Por supuesto. Solo considerar que debe tener un código por producto y por locker a utilizar para el recojo.',
              ],
              [
                  'categoria' => 9,
                  'pregunta' => 'Necesito usar un locker.',
                  'respuesta' => 'Actualmente Saga Falabella tiene este servicio de entrega y muy pronto también Telefónica.
                Al realizar una compra online en Saga Falabella,tienes la opción de recoger el envío en unos de nuestros
                lockers que se encuentran ubicados en los grifos repsol. Contamos con 5 lockers: Repsol Frutales (La Molina), Repsol Chacarilla (Surco), Repsol Galvez Barrenechea (Surquillo), Repsol La Marina (San Miguel) y Estación Central del Metropolitano (Cercado de Lima).
                En el caso de que cuentes con una empresa y desees información sobre nuestros lockers de Scharff puedes escribir al email
                de Manuel Velásquez (manuel.velasquez@holascharff.com) para que pueda ayudarte con la información para nuevos servicios empresas.',
              ],







          ]
      );




      DB::table('catfaqs')->delete();
      DB::table('catfaqs')->insert(
          [
            [   'id'=>1,
                'categoria' => 'Contactanos',
                'icono' => '/images/icon-faq1.png',
            ],
            [   'id'=>2,
                'categoria' => 'Pagos y Tarifas',
                'icono' => '/images/icon-faq2.png',
            ],
            [   'id'=>3,
                'categoria' => 'TNT',
                'icono' => '/images/icon-faq3.png',
            ],
            [   'id'=>4,
                'categoria' => 'Reclamo',
                'icono' => '/images/icon-faq1.png',
            ],
            [   'id'=>5,
                'categoria' => 'Status de envíos',
                'icono' => '/images/icon-faq2.png',
            ],
            [   'id'=>6,
                'categoria' => 'Requerimientos del Exterior',
                'icono' => '/images/icon-faq3.png',
            ],
            [   'id'=>7,
                'categoria' => 'Comercial',
                'icono' => '/images/icon-faq1.png',
            ],
            [   'id'=>8,
                'categoria' => 'Otros Servicios',
                'icono' => '/images/icon-faq2.png',
            ],
            [   'id'=>9,
                'categoria' => 'Soporte',
                'icono' => '/images/icon-faq3.png',
            ],
            [   'id'=>10,
                'categoria' => 'Postulaciones',
                'icono' => '/images/icon-faq1.png',
            ],
            [   'id'=>11,
                'categoria' => 'Servicio',
                'icono' => '/images/icon-faq2.png',
            ],
            [   'id'=>12,
                'categoria' => 'App y envíos',
                'icono' => '/images/icon-faq3.png',
            ],

          ]
      );


    }
}
