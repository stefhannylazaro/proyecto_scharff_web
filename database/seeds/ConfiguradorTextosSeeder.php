<?php

use Illuminate\Database\Seeder;

class ConfiguradorTextosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurador_textos')->delete();
        DB::table('configurador_textos')->insert(
            [
                [
                    'clave' => 'ser_servicio',
                    'vista' => 'HOME',
                    'titulo' => 'Creamos conexiones de alto valor a través de la cadena logística',
                    'descripcion' => 'Creamos conexiones de alto valor <br />en la cadena logística'
                ],
                [
                    'clave' => 'tipser_tiposervicio',
                    'vista' => 'HOME',
                    'titulo' => 'Envía o recibe. ¡Nosotros nos encargamos de todo!',
                    'descripcion' => 'Envía o recibe. <br />¡Nosotros nos encargamos de todo!'
                ],
                [
                    'clave' => 'tipser_empresa',
                    'vista' => 'HOME',
                    'titulo' => 'Para empresas',
                    'descripcion' => 'Si necesitas transportar, importar o exportar tus productos, cuenta con nosotros'
                ],
                [
                    'clave' => 'tipser_cliente',
                    'vista' => 'HOME',
                    'titulo' => 'Para ti',
                    'descripcion' => 'Si estás en casa o en el trabajo y necesitas enviar o recoger algún paquete, tenemos la solución a tu dilema.'
                ],
                [
                    'clave' => 'ubi_ubicanos_v',
                    'vista' => 'HOME',
                    'titulo' => '',
                    'descripcion' => '<p class="font-bold mb-0">Call center: <span class="color-pink"><a href="tel: (+51) 01-517-1600" style="text-decoration: none; color: inherit;">(+51) 01-517-1600</a></span></p> <p class="font-bold">Whatsapp: <span class="color-pink"><a href="tel: 998 140 976" style="text-decoration: none; color: inherit;">998 140 976</a></span></p>'
                ],
                [

                    'clave' => 'ubi_ubicanos_h',
                    'vista' => 'HOME',
                    'titulo' => '',
                    'descripcion' => '<p class="font-bold mb-0">Call center: <span class="color-pink"><a href="tel: (+51) 01-517-1600" style="text-decoration: none; color: inherit;">(+51) 01-517-1600</a></span></p> <p class="font-bold">Whatsapp: <span class="color-pink"><a href="tel: 998 140 976" style="text-decoration: none; color: inherit;">998 140 976</a></span></p>'
                ],
                [
                'clave' => 'cont_contacto',
                'vista' => 'HOME',
                'titulo' => 'Haz crecer tu negocio, escríbenos',
                'descripcion' => 'Escríbenos o contáctanos al 517-1600'
                ],[
                    'clave' => 'popup_texto',
                    'vista' => 'HOME',
                    'titulo' => '',
                    'descripcion' => '<h4>¡Llámanos al <br/>517 - 1600!</h4> <p>Atenderemos tus dudas y/o consultas a través de nuestro número de atención al cliente.</p><p> <strong>01 517 1600</strong> </p><p>Lunes a viernes de 8:30am a 6pm <br/> Sábados de 9am a 1pm.</p><p> <strong>¡No dudes en comunicarte con nosotros!</strong> </p><p> <span>Equipo Scharff</span> </p>'
                ],
                [
                    'clave' => 'terminos',
                    'vista' => 'terminos',
                    'titulo' => 'TERMINOS Y CONDICIONES DEL SITIO WEB',
                    'descripcion' => '<ol type="I">
                    <li><strong><u>INTRODUCCIÓN</u></strong></li>
                    </ol>
                    <p>Las presentes condiciones generales de uso, regulan los términos y condiciones de acceso y uso del sitio web: <a>www.holascharff.com</a>, propiedad del Grupo Empresarial Scharff (en adelante, “Scharff”), que el Usuario del Portal (en adelante, el “Usuario”) deberá de leer y aceptar para usar todos los servicios e información que se facilitan desde el portal. El mero acceso y/o utilización del sitio web, de todos o parte de sus contenidos y/o servicios significa haber leído, comprendido y aceptado los Términos y Condiciones que a continuación se enlistan.</p>
                    <p>Por Scharff se entiende al Grupo Empresarial Scharff, el cual se encuentra conformado por la empresa Scharff Logística Integrada S.A. y Scharff International Courier & Cargo S.A., y a cualquier empresa que este directa o indirectamente controlada por, sea controlante de, o se encuentre bajo control común con cualquiera de ellas.</p>
                    <ol start="2" type="I">
                    <li><strong><u>TÉRMINOS Y CONDICIONES</u></strong><br><br><span>Los Términos y Condiciones se aplican para acceder en línea desde el portal a:</span></li>
                    </ol>
                    <p>
                    <span>(i) La información relacionada a servicios de Scharff.</span><br>
                    <span>(ii) Las transacciones y otro tipo de operaciones realizadas por el Usuario relacionadas a los servicios de Scharff<strong>.</strong></span> <br>
                    <span>(iii) La contratación de servicios de logística y otros del Usuario a Scharff.</span>
                    </p>
                    <ol start="1">
                    <li><strong><u>Registro</u></strong></li>
                    </ol>
                    <p>Es obligatorio completar el formulario de registro en todos sus campos con datos válidos para poder utilizar el servicio que brinda Scharff. El Usuario deberá completar el mencionado formulario con la información personal que le sea solicitada de manera exacta, precisa y verdadera (en adelante, los "Datos Personales") y asume el compromiso de actualizar los Datos Personales conforme resulte necesario. </p>
                    <p>El Usuario presta expresa conformidad con que Scharff utilice diversos medios para identificar sus datos personales, asumiendo el Usuario la obligación de revisarlos y mantenerlos actualizados. Scharff no se responsabiliza por la certeza de los Datos Personales de los Usuarios. Los Usuarios garantizan y responden, en cualquier caso, de la veracidad, exactitud, vigencia y autenticidad de sus Datos Personales.</p>
                    <ol start="2">
                    <li><strong><u>Cuenta: Usuario y Contraseña</u></strong></li>
                    </ol>
                    <p>El Usuario accederá a su cuenta personal (en adelante, la "Cuenta") mediante el ingreso de su Usuario y clave de seguridad personal elegida (en adelante, la "Clave de Seguridad"). El Usuario se obliga a mantener la confidencialidad de su Clave de Seguridad.</p>
                    <p>La Cuenta es personal, única e intransferible, y está prohibido que un mismo Usuario registre o posea más de una Cuenta. En caso que Scharff detecte distintas cuentas que contengan datos coincidentes o relacionados, podrá cancelarlas, suspenderlas o inhabilitarlas.</p>
                    <p>El Usuario será responsable por todas las operaciones efectuadas en su Cuenta, pues el acceso a la misma está restringido al ingreso y uso de su Clave de Seguridad, de conocimiento exclusivo del Usuario. El Usuario se compromete a notificar a Scharff en forma inmediata y por medio idóneo y fehaciente, cualquier uso no autorizado de su Cuenta, así como el ingreso por terceros no autorizados a la misma. Se aclara que está prohibida la venta, cesión o transferencia de la Cuenta (incluyendo la reputación y calificaciones) bajo ningún título, salvo expresa autorización de Scharff.</p>
                    <ol start="3">
                    <li><strong><u>Información Recibida</u></strong></li>
                    </ol>
                    <p>En el curso del uso que el Usuario haga del sitio web y/o de los servicios puestos a su disposición en o a través del sitio web, se le puede pedir que proporcione cierta información personalizada tales como nombre del destinatario y receptor, contacto, dirección electrónica, teléfono, entre otros, que se denomina como “Información Recibida”, la cual es relevante para éxito de la entrega, con el fin de poder brindar al Usuario un servicio de mayor eficacia, calidad y rapidez.</p>
                    <p>A menos que se solicite específicamente, Scharff no requiere ni desea recibir ninguna información confidencial, secreta o patrimonial, ni otro material del Usuario a través del Sitio Web, por correo electrónico o de cualquier otra manera.</p>
                    <ol>
                    <li start="4"><strong><u>Uso de datos del Usuario</u></strong></li>
                    </ol>
                    <p>Scharff se reserva la propiedad única, total y exclusiva de la información recibida por el Usuario; asimismo, se compromete a no compartir los Datos Personales del Usuario con terceros para una finalidad distinta a la que el Usuario ha consentido. </p>
                    <p>Scharff se reserva el derecho de solicitar algún comprobante y/o dato adicional a efectos de corroborar los Datos Personales, así como de suspender temporal o definitivamente al Usuario cuyos datos no hayan podido ser comprobados y/o confirmados. </p>
                    <p>Scharff se reserva el derecho de rechazar cualquier solicitud de registro o de cancelar una un registro previamente aceptado, sin que esté obligado a comunicar o exponer las razones de su decisión y sin que ello genere algún derecho a indemnización o resarcimiento.</p>
                    <ol start="5">
                    <li><strong><u>Órdenes de Productos y/o Servicios</u></strong></li>
                    </ol>
                    <p>Si el Usuario ordena cualquier producto y/o servicio, por el presente documento representa y garantiza a Scharff que tiene dieciocho (18) años de edad o más; asimismo, se obliga a pagar la totalidad de los precios de cualquier compra que haga incluido todos los gastos operativos que la gestión del producto y/o servicio demanden, ya sea con tarjeta de crédito y/o débito válida y concurrente con su orden en línea o por otro medio de pago aceptable para Scharff. </p>
                    <p>Adicionalmente, el Usuario se obliga a pagar todos los impuestos aplicables a los productos y/o servicios. Si el pago no es recibido por nosotros de parte del emisor de su tarjeta de crédito o débito o de sus agentes, el Usuario se obliga a pagar todas las cantidades debidas al momento de la reclamación por nuestra parte. Algunos productos y/o servicios que el Usuario compre y/o descargue en o a través del sitio web pueden estar sujetos a términos y condiciones adicionales que le serán presentados al momento de dicha compra o descarga.</p>
                    <ol start="6">
                    <li><strong><u>Artículos Restringidos o Prohibidos</u></strong></li>
                    </ol>
                    <p>Sólo podrán ser ingresados en las listas de productos y/o servicios, aquellos cuya venta no se encuentre tácita o expresamente prohibida o restringida por la ley vigente y en estos Términos y Condiciones. De manera general, se encuentra establecido que, a través del sitio web, Scharff no comercializa con bienes prohibidos o restringidos por la legislación aplicable y/o que puedan afectar el orden público y el bien de la comunidad; y, en cualquier caso, no se hace responsable por el contenido de los productos y/o servicios que el Usuario ponga a su disposición para la contratación de los servicios del sitio web. </p>
                    <p>Asimismo, por el presente documento, el Usuario se compromete a no utilizar el sitio web de Scharff, empresa a la que libera de responsabilidad, para la distribución de mercadería restringida o prohibida y/o peligrosa contemplada en la legislación aplicable en los que se incluye, pero no se limita a explosivos, líquidos inflamables, gases comprimidos y otros gases prohibidos, armas de fuego, pólvora, municiones, venenos, sustancias químicas prohibidas, drogas y/o estupefacientes, sustancias tóxicas, entre otros.</p>
                    <p>En caso sea necesario, por el tipo de producto y/o servicio que el Usuario contrate, tendrá un recordatorio de estas políticas de artículos restringidos o prohibidos de Scharff.</p>
                    <ol start="7">
                    <li><strong><u>Indemnidad</u></strong></li>
                    </ol>
                    <p>El Usuario se compromete a exonerar de responsabilidad, indemnizar y mantener indemne y libre de daños a Scharff y/o a sus directores, funcionarios, empleados, agentes y sociedades afiliadas frente a cualquier demanda, reclamo, denuncia, queja, multas, sanciones, costos y/o gastos, incluyendo honorarios razonables de los abogados, iniciados por terceros debido a o con origen en el contenido que el Usuario envíe, publique, coloque, transmita o ponga a disposición por medio del sitio web, los incumplimientos del Usuario a estos Términos y Condiciones, la afectación a derechos de terceros y/o a la violación de la legislación aplicable.</p>
                    <p>Scharff se reserva el derecho de asumir la defensa y control exclusivo de cualquier asunto de otra manera sujeto a indemnización por parte del Usuario, y en dicho caso, el Usuario se obliga a asumir estos gastos y pagarlos e indemnizar a Scharff en la defensa de dicho reclamo.</p>
                    <ol start="8">
                    <li><strong><u>Responsabilidad y Límite de Garantía</u></strong></li>
                    </ol>
                    <p>Scharff sólo brinda el producto y/o servicio de Courier, monitoreo del envío y/o recepción de la mercadería; en tal sentido, no asume responsabilidades sobre el contenido de la mercadería. <span>En ningún caso Scharff será responsable por daños, lucro cesante, o por cualquier otro perjuicio que haya podido sufrir el Usuario, como consecuencia de las operaciones realizadas o no realizadas por envío y/o recepción de mercadería a través de Scharff. Así como tampoco, es responsable sobre la información suministrada por el Usuario o los daños a terceros. </span></p>
                    <ol start="9">
                    <li><strong><u>Fallas en el Sistema o del Sitio Web</u></strong></li>
                    </ol>
                    <p>Scharff no se responsabiliza por cualquier daño, perjuicio o pérdida generada al Usuario por fallas en el sistema, en el servidor o en el Internet. Scharff tampoco será responsable por cualquier virus que pudiera infectar el equipo del Usuario como consecuencia del acceso, uso o examen del sitio web o a raíz de cualquier transferencia de datos, archivos, imágenes, textos, o audio contenidos en el mismo. El Usuario no podrán imputarle responsabilidad alguna ni exigir pago por lucro cesante, en virtud de perjuicios resultantes de dificultades técnicas o fallas en los sistemas o en Internet. </p>
                    <p>Scharff no garantiza el acceso y uso continuado o ininterrumpido de su sitio web. El sistema puede eventualmente no estar disponible debido a dificultades técnicas o fallas de Internet, o por cualquier otra circunstancia ajena a Scharff; en tales casos, se procurará restablecerlo con la mayor celeridad posible sin que por ello pueda imputársele algún tipo de responsabilidad. Scharff no será responsable por ningún error u omisión contenidos en su sitio web.</p>
                    <p>Asimismo, el Usuario comprende y conviene lo siguiente: (i) El uso del sitio web es bajo su propio riesgo, cuyo servicio es provisto tal cual es y según se encuentre disponible, por lo que Scharff no otorga garantía al Usuario de ningún tipo, ya sea expresa o implícita; (ii) Scharff no garantiza que el sitio web se ajuste a las necesidades del Usuario; y, (iii) Scharff no será responsable por el material descargado por el Usuario o que sea de cualquier otra forma obtenido por medio del uso del servicio, lo que es bajo propia discreción y riesgo del Usuario, quien será absolutamente responsable por cualquier daño al sistema de su computadora o perdida de datos que resulten de la descarga de cualquiera de estos materiales. </p>
                    <ol start="10">
                    <li><strong><u>Tarifas y Facturación</u></strong></li>
                    </ol>
                    <p>La inscripción en el sitio web de Scharff es gratuita. El Usuario deberá pagar a Scharff solo el costo por el producto y/o servicio recibido ya sea enviar y/o recibir la mercadería solicitada por el Usuario. Scharff se reserva el derecho de modificar, cambiar, agregar, o eliminar las tarifas vigentes, en cualquier momento.</p>
                    <p>Adicionalmente, Scharff podrá modificar temporalmente las tarifas por sus productos y/o servicios por razón de promociones, lanzamientos o campañas, siendo efectivas estas modificaciones cuando se haga pública la promoción o se realice el anuncio en el sitio web.</p>
                    <p>Scharff se reserva el derecho de tomar las medidas judiciales y extrajudiciales que estime pertinentes para obtener el pago del monto debido al Usuario.</p>
                    <p>En caso de haberse facturado cargos que no hubiesen correspondido y que no estén incluidos en estos Términos y Condiciones, el Usuario deberá comunicarse con el módulo de Atención al Cliente para resolver dicha cuestión y/o el Libro de Reclamaciones. </p>
                    <ol start="11">
                    <li><strong><u>Término</u></strong></li>
                    </ol>
                    <p>Scharff puede terminar, cambiar, suspender o descontinuar cualquier aspecto del sitio web o de los productos y/o servicios del mismo en cualquier momento. Scharff puede restringir, suspender o terminar el acceso al sitio web y/o a sus servicios si ante cualquier indicio o sospecha que el Usuario está en incumplimiento de los presentes Términos y Condiciones o de la ley aplicable, o por cualquier otra razón, sin necesidad de notificación o responsabilidad. Scharff mantiene una política que estipula la terminación, en circunstancias apropiadas, de los privilegios de uso del sitio web para usuarios que son violadores repetitivos de los derechos de propiedad intelectual.</p>
                    <ol start="12">
                    <li><strong><u>Cambios de Términos de Uso</u></strong></li>
                    </ol>
                    <p>Scharff se reserva el derecho, a su sola discreción, de cambiar, modificar, añadir o quitar cualquier porción de los Términos y Condiciones, toda o en parte, en cualquier momento. Los cambios en los Términos y Condiciones serán efectivos cuando se publiquen. La continuación del uso del sitio web y/o de los productos y/o servicios puestos a disposición en o a través del sitio web después de haber sido publicado cualquier cambio, será considerado como aceptación de esos cambios.</p>
                    <ol start="13">
                    <li><strong><u>Propiedad Intelectual</u></strong></li>
                    </ol>
                    <p>Todos los contenidos, marcas, logos, dibujos, documentación, programas informáticos o cualquier otro elemento susceptible de protección por la legislación de propiedad intelectual o industrial, que sean accesibles en el portal corresponden exclusivamente a Scharff y quedan expresamente reservados todos los derechos sobre los mismos. Queda expresamente prohibida la creación de enlaces de hipertexto (links) a cualquier elemento integrante del sitio web sin la autorización de Scharff, siempre que no sean a un sitio web que no requiera identificación o autenticación para su acceso, o el mismo esté restringido.</p>
                    <p>En cualquier caso, el portal se reserva todos los derechos sobre los contenidos, información datos y servicios que ostente sobre los mismos. El sitio web no concede ninguna licencia o autorización de uso al Usuario sobre sus contenidos, datos o servicios, distinta de la que expresamente se detalle en estos Términos y Condiciones.</p>
                    <ol start="14">
                    <li><strong><u>Datos Personales</u></strong></li>
                    </ol>
                    <p>Scharff tiene la calidad de “Encargado del Tratamiento”, conforme lo establecido en la Ley de Protección de Datos Personales – Ley No. 29733. En ese sentido, <strong>SCHARFF</strong> tendrá acceso a datos de los usuarios por lo que se obliga a protegerlos aplicando las exigencias y requerimientos previstos en la Ley de Protección de Datos Personales (Ley No. 29733), su reglamento aprobado por Decreto Supremo No. 003-2013-JUS y demás normas relacionadas que regulan la materia.</p>
                    <p>Asimismo<strong>, </strong>Scharff se compromete a cooperar la Autoridad Nacional de Protección de Datos Personales o de cualquier otra autoridad administrativa para satisfacer los requerimientos o exigencias de las mismas.</p>
                    <ol start="15">
                    <li><strong><u>Leyes Aplicables</u></strong></li>
                    </ol>
                    <p>Scharff opera el contenido del sitio web desde los países que se muestran disponibles en él, mas no representa a los materiales en el sitio web para su uso en otros lugares no especificados. Las personas que escojan acceder al sitio web desde otros lugares lo harán por su propia iniciativa y son responsables del cumplimiento de las leyes locales, al grado que dichas leyes sean aplicables. </p>
                    <p>Los Términos y Condiciones y la relación entre usted y nosotros, serán regidos por las leyes del país que el Usuario contrate los servicios de Scharff y que el sitio web de Scharff muestre disponible. En ese sentido, el Usuario se obliga a que cualquier causa de acción legal que resulte bajo los Términos y Condiciones será iniciada y conocida por los Juzgados de Lima, Perú. </p>'
                ],
            ]
        );
    }
}
