<?php

use Illuminate\Database\Seeder;

class ConfiguradorTextosSeederAT extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('configurador_textos')->delete();


      DB::table('configurador_textos')
            ->where('clave', 'terminos')
            ->delete();
            //->update(['titulo' => 'FUNCIONA Creamos conexiones de alto valor a través de la cadena logística']);






      DB::table('configurador_textos')->insert(
          [
              [
                  'clave' => 'terminos',
                  'vista' => 'terminos',
                  'titulo' => 'TERMINOS Y CONDICIONES DEL SITIO WEB',
                  'descripcion' => '

                  <p>
                      <strong>I. </strong>
                      <strong><u>INTRODUCCIÓN</u></strong>
                  </p>

                  <p>
                      Las presentes condiciones generales de uso, regulan los términos y
                  condiciones de acceso y uso del sitio web:    <a href="http://www.holascharff.com">www.holascharff.com</a>, propiedad del
                      Grupo Empresarial Scharff (en adelante, “Scharff”), que el Usuario del
                      Portal (en adelante, el “Usuario”) deberá de leer y aceptar para usar todos
                      los servicios e información que se facilitan desde el portal. El mero
                      acceso y/o utilización del sitio web, de todos o parte de sus contenidos
                      y/o servicios significa haber leído, comprendido y aceptado los Términos y
                      Condiciones que a continuación se enlistan.
                  </p>
                  <p>
                      Por Scharff<strong> </strong>se entiende al Grupo Empresarial Scharff, el
                      cual se encuentra conformado por la empresa Scharff Logística Integrada
                      S.A. y Scharff International Courier &amp; Cargo S.A., y a cualquier
                      empresa que este directa o indirectamente controlada por, sea controlante
                      de, o se encuentre bajo control común con cualquiera de ellas.
                  </p>

                  <p>
                      <strong>II. </strong>
                      <strong><u>TÉRMINOS Y CONDICIONES GENERALES</u></strong>
                      <br/>
                      <br/>
                      Los Términos y Condiciones se aplican para acceder en línea desde el portal
                      a:<strong><u></u></strong>
                  </p>
                  <p>
                      (i) La información relacionada a servicios de Scharff.
                  </p>
                  <p>
                      (ii) Las transacciones y otro tipo de operaciones realizadas por el Usuario
                      relacionadas a los servicios de Scharff<strong>.</strong>
                  </p>
                  <p>
                      (iii) La contratación de servicios de logística y otros del Usuario a
                      Scharff.
                  </p>
                  <p>
                      <strong>1. </strong>
                      <strong><u>Registro</u></strong>
                  </p>
                  <p>
                      Es obligatorio completar el formulario de registro en todos sus campos con
                      datos válidos para poder utilizar el servicio que brinda Scharff. El
                      Usuario deberá completar el mencionado formulario con la información
                      personal que le sea solicitada de manera exacta, precisa y verdadera (en
                      adelante, los "Datos Personales") y asume el compromiso de actualizar los
                      Datos Personales conforme resulte necesario.
                  </p>
                  <p>
                      El Usuario presta expresa conformidad con que Scharff utilice diversos
                      medios para identificar sus datos personales, asumiendo el Usuario la
                      obligación de revisarlos y mantenerlos actualizados. Scharff no se
                      responsabiliza por la certeza de los Datos Personales de los Usuarios. Los
                      Usuarios garantizan y responden, en cualquier caso, de la veracidad,
                      exactitud, vigencia y autenticidad de sus Datos Personales.
                  </p>
                  <p>
                      <strong>2. </strong>
                      <strong><u>Cuenta: Usuario y Contraseña</u></strong>
                  </p>
                  <p>
                      El Usuario accederá a su cuenta personal (en adelante, la "Cuenta")
                      mediante el ingreso de su Usuario y clave de seguridad personal elegida (en
                      adelante, la "Clave de Seguridad"). El Usuario se obliga a mantener la
                      confidencialidad de su Clave de Seguridad.
                  </p>
                  <p>
                      La Cuenta es personal, única e intransferible, y está prohibido que un
                      mismo Usuario registre o posea más de una Cuenta. En caso que Scharff
                      detecte distintas cuentas que contengan datos coincidentes o relacionados,
                      podrá cancelarlas, suspenderlas o inhabilitarlas.
                  </p>
                  <p>
                      El Usuario será responsable por todas las operaciones efectuadas en su
                      Cuenta, pues el acceso a la misma está restringido al ingreso y uso de su
                      Clave de Seguridad, de conocimiento exclusivo del Usuario. El Usuario se
                      compromete a notificar a Scharff en forma inmediata y por medio idóneo y
                      fehaciente, cualquier uso no autorizado de su Cuenta, así como el ingreso
                      por terceros no autorizados a la misma. Se aclara que está prohibida la
                      venta, cesión o transferencia de la Cuenta (incluyendo la reputación y
                      calificaciones) bajo ningún título, salvo expresa autorización de Scharff.
                  </p>
                  <p>
                      <strong>3. </strong>
                      <strong><u>Información Recibida</u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      En el curso del uso que el Usuario haga del sitio web y/o de los servicios
                      puestos a su disposición en o a través del sitio web, se le puede pedir que
                      proporcione cierta información personalizada tales como nombre del
                      destinatario y receptor, contacto, dirección electrónica, teléfono, entre
                      otros, que se denomina como “Información Recibida”, la cual es relevante
                      para éxito de la entrega, con el fin de poder brindar al Usuario un
                      servicio de mayor eficacia, calidad y rapidez.
                  </p>
                  <p>
                      A menos que se solicite específicamente, Scharff no requiere ni desea
                      recibir ninguna información confidencial, secreta o patrimonial, ni otro
                      material del Usuario a través del Sitio Web, por correo electrónico o de
                      cualquier otra manera.
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong>4. </strong>
                      <strong><u>Uso de datos del Usuario</u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      Scharff se reserva la propiedad única, total y exclusiva de la información
                      recibida por el Usuario; asimismo, se compromete a no compartir los Datos
                      Personales del Usuario con terceros para una finalidad distinta a la que el
                      Usuario ha consentido.
                  </p>
                  <p>
                      Scharff se reserva el derecho de solicitar algún comprobante y/o dato
                      adicional a efectos de corroborar los Datos Personales, así como de
                      suspender temporal o definitivamente al Usuario cuyos datos no hayan podido
                      ser comprobados y/o confirmados.
                  </p>
                  <p>
                      Scharff se reserva el derecho de rechazar cualquier solicitud de registro o
                      de cancelar una un registro previamente aceptado, sin que esté obligado a
                      comunicar o exponer las razones de su decisión y sin que ello genere algún
                      derecho a indemnización o resarcimiento.
                  </p>
                  <p>
                      <strong>5. </strong>
                      <strong><u>Órdenes de Productos y/o Servicios</u></strong>
                  </p>
                  <p>
                      Si el Usuario ordena cualquier producto y/o servicio, por el presente
                      documento representa y garantiza a Scharff que tiene dieciocho (18) años de
                      edad o más; asimismo, se obliga a pagar la totalidad de los precios de
                      cualquier compra que haga incluido todos los gastos operativos que la
                      gestión del producto y/o servicio demanden, ya sea con tarjeta de crédito
                      y/o débito válida y concurrente con su orden en línea o por otro medio de
                      pago aceptable para Scharff.
                  </p>
                  <p>
                      Adicionalmente, el Usuario se obliga a pagar todos los impuestos aplicables
                      a los productos y/o servicios. Si el pago no es recibido por nosotros de
                      parte del emisor de su tarjeta de crédito o débito o de sus agentes, el
                      Usuario se obliga a pagar todas las cantidades debidas al momento de la
                      reclamación por nuestra parte. Algunos productos y/o servicios que el
                      Usuario compre y/o descargue en o a través del sitio web pueden estar
                      sujetos a términos y condiciones adicionales que le serán presentados al
                      momento de dicha compra o descarga.
                  </p>
                  <p>
                      <strong>6. </strong>
                      <strong><u>Artículos Restringidos o Prohibidos</u></strong>
                  </p>
                  <p>
                      Sólo podrán ser ingresados en las listas de productos y/o servicios,
                      aquellos cuya venta no se encuentre tácita o expresamente prohibida o
                      restringida por la ley vigente y en estos Términos y Condiciones. De manera
                      general, se encuentra establecido que, a través del sitio web, Scharff no
                      comercializa con bienes prohibidos o restringidos por la legislación
                      aplicable y/o que puedan afectar el orden público y el bien de la
                      comunidad; y, en cualquier caso, no se hace responsable por el contenido de
                      los productos y/o servicios que el Usuario ponga a su disposición para la
                      contratación de los servicios del sitio web.
                  </p>
                  <p>
                      Asimismo, por el presente documento, el Usuario se compromete a no utilizar
                      el sitio web de Scharff, empresa a la que libera de responsabilidad, para
                      la distribución de mercadería restringida o prohibida y/o peligrosa
                      contemplada en la legislación aplicable en los que se incluye, pero no se
                      limita a explosivos, líquidos inflamables, gases comprimidos y otros gases
                      prohibidos, armas de fuego, pólvora, municiones, venenos, sustancias
                      químicas prohibidas, drogas y/o estupefacientes, sustancias tóxicas, entre
                      otros.
                  </p>
                  <p>
                      En caso sea necesario, por el tipo de producto y/o servicio que el Usuario
                      contrate, tendrá un recordatorio de estas políticas de artículos
                      restringidos o prohibidos de Scharff.
                  </p>
                  <p>
                      <strong>7. </strong>
                      <strong><u>Indemnidad</u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      El Usuario se compromete a exonerar de responsabilidad, indemnizar y
                      mantener indemne y libre de daños a Scharff y/o a sus directores,
                      funcionarios, empleados, agentes y sociedades afiliadas frente a cualquier
                      demanda, reclamo, denuncia, queja, multas, sanciones, costos y/o gastos,
                      incluyendo honorarios razonables de los abogados, iniciados por terceros
                      debido a o con origen en el contenido que el Usuario envíe, publique,
                      coloque, transmita o ponga a disposición por medio del sitio web, los
                      incumplimientos del Usuario a estos Términos y Condiciones, la afectación a
                      derechos de terceros y/o a la violación de la legislación aplicable.
                  </p>
                  <p>
                      Scharff se reserva el derecho de asumir la defensa y control exclusivo de
                      cualquier asunto de otra manera sujeto a indemnización por parte del
                      Usuario, y en dicho caso, el Usuario se obliga a asumir estos gastos y
                      pagarlos e indemnizar a Scharff en la defensa de dicho reclamo.
                  </p>
                  <p>
                      <strong>8. </strong>
                      <strong><u>Responsabilidad y Límite de Garantía</u></strong>
                  </p>
                  <p>
                      Scharff sólo brinda el producto y/o servicio de Courier, monitoreo del
                      envío y/o recepción de la mercadería; en tal sentido, no asume
                      responsabilidades sobre el contenido de la mercadería. En ningún caso
                      Scharff será responsable por daños, lucro cesante, o por cualquier otro
                      perjuicio que haya podido sufrir el Usuario, como consecuencia de las
                      operaciones realizadas o no realizadas por envío y/o recepción de
                      mercadería a través de Scharff. Así como tampoco, es responsable sobre la
                      información suministrada por el Usuario o los daños a terceros.
                  </p>
                  <p>
                      <strong>9. </strong>
                      <strong><u>Fallas en el Sistema o del Sitio Web</u></strong>
                  </p>

                  <p>
                      Scharff no se responsabiliza por cualquier daño, perjuicio o pérdida
                      generada al Usuario por fallas en el sistema, en el servidor o en el
                      Internet. Scharff tampoco será responsable por cualquier virus que pudiera
                      infectar el equipo del Usuario como consecuencia del acceso, uso o examen
                      del sitio web o a raíz de cualquier transferencia de datos, archivos,
                      imágenes, textos, o audio contenidos en el mismo. El Usuario no podrán
                      imputarle responsabilidad alguna ni exigir pago por lucro cesante, en
                      virtud de perjuicios resultantes de dificultades técnicas o fallas en los
                      sistemas o en Internet.
                  </p>
                  <p>
                      Scharff no garantiza el acceso y uso continuado o ininterrumpido de su
                      sitio web. El sistema puede eventualmente no estar disponible debido a
                      dificultades técnicas o fallas de Internet, o por cualquier otra
                      circunstancia ajena a Scharff; en tales casos, se procurará restablecerlo
                      con la mayor celeridad posible sin que por ello pueda imputársele algún
                      tipo de responsabilidad. Scharff no será responsable por ningún error u
                      omisión contenidos en su sitio web.
                  </p>
                  <p>
                      Asimismo, el Usuario comprende y conviene lo siguiente: (i) El uso del
                      sitio web es bajo su propio riesgo, cuyo servicio es provisto tal cual es y
                      según se encuentre disponible, por lo que Scharff no otorga garantía al
                      Usuario de ningún tipo, ya sea expresa o implícita; (ii) Scharff no
                      garantiza que el sitio web se ajuste a las necesidades del Usuario; y,
                      (iii) Scharff no será responsable por el material descargado por el Usuario
                      o que sea de cualquier otra forma obtenido por medio del uso del servicio,
                      lo que es bajo propia discreción y riesgo del Usuario, quien será
                      absolutamente responsable por cualquier daño al sistema de su computadora o
                      perdida de datos que resulten de la descarga de cualquiera de estos
                      materiales.
                  </p>
                  <h2>
                      10. <u>Tarifas y Facturación</u>
                  </h2>
                  <p>
                      La inscripción en el sitio web de Scharff es gratuita. El Usuario deberá
                      pagar a Scharff solo el costo por el producto y/o servicio recibido ya sea
                      enviar y/o recibir la mercadería solicitada por el Usuario. Scharff se
                      reserva el derecho de modificar, cambiar, agregar, o eliminar las tarifas
                      vigentes, en cualquier momento.
                  </p>
                  <p>
                      Adicionalmente, Scharff podrá modificar temporalmente las tarifas por sus
                      productos y/o servicios por razón de promociones, lanzamientos o campañas,
                      siendo efectivas estas modificaciones cuando se haga pública la promoción o
                      se realice el anuncio en el sitio web.
                  </p>
                  <p>
                      Scharff se reserva el derecho de tomar las medidas judiciales y
                      extrajudiciales que estime pertinentes para obtener el pago del monto
                      debido al Usuario.
                  </p>
                  <p>
                      En caso de haberse facturado cargos que no hubiesen correspondido y que no
                      estén incluidos en estos Términos y Condiciones, el Usuario deberá
                      comunicarse con el módulo de Atención al Cliente para resolver dicha
                      cuestión y/o el Libro de Reclamaciones.
                  </p>
                  <p>
                      <strong>11. </strong>
                      <strong><u>Término</u></strong>
                  </p>
                  <p>
                      <u></u>
                  </p>
                  <p>
                      Scharff puede terminar, cambiar, suspender o descontinuar cualquier aspecto
                      del sitio web o de los productos y/o servicios del mismo en cualquier
                      momento. Scharff puede restringir, suspender o terminar el acceso al sitio
                      web y/o a sus servicios si ante cualquier indicio o sospecha que el Usuario
                      está en incumplimiento de los presentes Términos y Condiciones o de la ley
                      aplicable, o por cualquier otra razón, sin necesidad de notificación o
                      responsabilidad. Scharff mantiene una política que estipula la terminación,
                      en circunstancias apropiadas, de los privilegios de uso del sitio web para
                      usuarios que son violadores repetitivos de los derechos de propiedad
                      intelectual.
                  </p>
                  <p>
                      <strong>12. </strong>
                      <strong><u>Cambios de Términos de Uso</u></strong>
                      <u></u>
                  </p>
                  <p>
                      Scharff se reserva el derecho, a su sola discreción, de actualizar,
                      cambiar, modificar, añadir o quitar cualquier porción de los Términos y
                      Condiciones Generales y/o Especiales (aplicadas a los servicios
                      específicos), toda o en parte, en cualquier momento. Los cambios en los
                      Términos y Condiciones Generales y/o Especiales serán efectivos cuando se
                      publiquen. La continuación del uso del sitio web y/o de los productos y/o
                      servicios puestos a disposición en o a través del sitio web después de
                      haber sido publicado cualquier cambio, será considerado como aceptación de
                      esos cambios.
                  </p>
                  <p>
                      En caso que el Usuario no esté de acuerdo con los términos y condiciones
                      que conlleven cualquier actualización del Software, deberá abstenerse de
                      utilizar el Sitio Web, aplicaciones y sus actualizaciones, toda vez que la
                      utilización de éstos implica una manifestación de voluntad expresa del
                      Usuario con todos los términos y condiciones vigentes.
                  </p>
                  <p>
                      <strong>13. </strong>
                      <strong><u>Propiedad Intelectual</u></strong>
                  </p>
                  <p>
                      Todos los contenidos, marcas, logos, dibujos, documentación, programas
                      informáticos o cualquier otro elemento susceptible de protección por la
                      legislación de propiedad intelectual o industrial, que sean accesibles en
                      el portal corresponden exclusivamente a Scharff y quedan expresamente
                      reservados todos los derechos sobre los mismos. Queda expresamente
                      prohibida la creación de enlaces de hipertexto (links) a cualquier elemento
                      integrante del sitio web sin la autorización de Scharff, siempre que no
                      sean a un sitio web que no requiera identificación o autenticación para su
                      acceso, o el mismo esté restringido.
                  </p>
                  <p>
                      En cualquier caso, el portal se reserva todos los derechos sobre los
                      contenidos, información datos y servicios que ostente sobre los mismos. El
                      sitio web no concede ninguna licencia o autorización de uso al Usuario
                      sobre sus contenidos, datos o servicios, distinta de la que expresamente se
                      detalle en estos Términos y Condiciones.
                  </p>
                  <p>
                      <strong>14. </strong>
                      <strong><u>Datos Personales</u></strong>
                  </p>

                  <p>
                      Scharff tiene la calidad de “Encargado del Tratamiento”, conforme lo
                      establecido en la Ley de Protección de Datos Personales – Ley No. 29733. En
                      ese sentido, <strong>SCHARFF</strong> tendrá acceso a datos de los usuarios
                      por lo que se obliga a protegerlos aplicando las exigencias y
                      requerimientos previstos en la Ley de Protección de Datos Personales (Ley
                      No. 29733), su reglamento aprobado por Decreto Supremo No. 003-2013-JUS y
                      demás normas relacionadas que regulan la materia.
                  </p>
                  <p>
                      Asimismo<strong>, </strong>Scharff se compromete a cooperar la Autoridad
                      Nacional de Protección de Datos Personales o de cualquier otra autoridad
                      administrativa para satisfacer los requerimientos o exigencias de las
                      mismas.
                  </p>
                  <p>
                      <strong>15. </strong>
                      <strong><u>Leyes Aplicables</u></strong>
                  </p>
                  <p>
                      Scharff opera el contenido del sitio web desde los países que se muestran
                      disponibles en él, mas no representa a los materiales en el sitio web para
                      su uso en otros lugares no especificados. Las personas que escojan acceder
                      al sitio web desde otros lugares lo harán por su propia iniciativa y son
                      responsables del cumplimiento de las leyes locales, al grado que dichas
                      leyes sean aplicables.
                  </p>
                  <p>
                      Los Términos y Condiciones y la relación entre usted y nosotros, serán
                      regidos por las leyes del país que el Usuario contrate los servicios de
                      Scharff y que el sitio web de Scharff muestre disponible. En ese sentido,
                      el Usuario se obliga a que cualquier causa de acción legal que resulte bajo
                      los Términos y Condiciones será iniciada y conocida por los Juzgados de
                      Lima, Perú.
                  </p>
                  <p>
                      <strong>III. </strong>
                      <strong>
                          <u>TERMINOS Y CONDICIONES DE LOS SERVICIOS ESPECÍFICOS </u>
                      </strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong>A. </strong>
                      <strong>SCHARFF STOP</strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong>1. </strong>
                      <strong><u>Definición y objeto</u></strong>
                  </p>
                  <p>
                      El Servicio <strong>Scharff Stop</strong> está dirigido al comercio
                      electrónico mediante uso de casilleros electrónicos para la entrega de un
                      producto o mercadería (en adelante, la “Mercadería”). Por la suscripción
                      del presente Contrato, el Usuario tendrá el derecho no exclusivo, gratuito,
                      revocable e intransferible de utilizar el servicio a través del sitio web
                      de Grupo Scharff o la aplicación que ésta última implemente, que le
                      permitirá, mediante su propio teléfono inteligente, tableta o computadora,
                      elegir un Casillero Electrónico o E-Locker (en adelante, “E-Locker (s)”) de
                      los ofrecidos en distintos puntos geográficos previamente establecidos por
                      Grupo Scharff para que: (i) el Usuario entregue y coloque la Mercadería en
                      el E-Locker de su elección ofrecido por Grupo Scharff; y (ii) recoja y
                      reciba la Mercadería ya sea en favor del Usuario mismo o de un tercero (en
                      adelante, el “Usuario Final”) en el E-Locker de Grupo Scharff, funciones
                      que se desarrollarán previa disponibilidad de los E-Lockers en lugar y
                      espacio, previo pago del servicio elegido por el Usuario y dentro de los
                      plazos establecidos en este documento. Todo lo anterior se define como el
                      Servicio o Scharff Stop.
                  </p>

                  <p>
                      <strong>2. </strong>
                      <strong><u>Código QR</u></strong>
                      <strong><u></u></strong>
                  </p>

                  <p>
                      El Usuario y/o el Usuario Final recibirán códigos QR y códigos
                      alfanuméricos proporcionados por Scharff, los cuales tienen carácter
                      confidencial e intransferible y que serán usando para el desarrollo de
                      Scharff Stop y les permitirá abrir y cerrar el casillero electrónico
                      determinado para Servicio elegido.
                  </p>
                  <p>
                      <strong>3. </strong>
                      <strong><u>Mercadería </u></strong>
                      <strong><u></u></strong>
                  </p>

                  <p>
                      La Mercadería ingresada en los E-Lockers es de propiedad del Usuario y sólo
                      podrá ser aquella que se encuentre permitida por la ley aplicable y que
                      cumpla con lo señalado en el numeral 6 de los Términos y Condiciones
                      Generales. Por ningún motivo podrá el Usuario ingresar bienes prohibidos o
                      restringidos por la legislación aplicable y/o que puedan afectar el orden
                      público y el bien de la comunidad, incluyendo en la lista de productos a,
                      pero sin limitar, explosivos, líquidos inflamables, gases comprimidos y
                      otros gases prohibidos, armas de fuego, pólvora, municiones, venenos,
                      sustancias químicas prohibidas, drogas y/o estupefacientes, sustancias
                      tóxicas, entre otros. En cualquier caso, Grupo Scharff no se hace
                      responsable por el contenido de los productos y/o servicios que el Usuario
                      ponga a su disposición para la contratación del Servicio. Cabe indicar que,
                      la Mercadería que el Usuario ponga a disposición para el Servicio deberá
                      cumplir con las especificaciones de tamaño y espacio requeridos por el
                      Servicio en virtud del E-Locker elegido.
                  </p>
                  <p>
                      <strong>4. </strong>
                      <strong><u>Condiciones Técnicas del Servicio </u></strong>
                  </p>

                  <p>
                      El Servicio estará disponible las veinticuatro (24) horas para reservas del
                      Servicio, para lo cual se enviará al Usuario un correo electrónico o
                      comunicación similar de registro del pedido del Servicio.
                  </p>
                  <p>
                      - La confirmación del Servicio se realizará mediante comunicación en los
                      horarios de 10:00 am y 5:00 pm posteriores a la gestión de la reserva del
                      pedido del Servicio, solamente durante los días lunes a viernes. No se
                      confirmará la reserva en fines de semana, días festivos o feriados
                      oficiales y/u no laborables. Para estos casos, la confirmación del Servicio
                      se realizará en el primer día hábil de la semana en los horarios
                      establecidos.
                  </p>
                  <p>
                      - Los pagos por el Servicio se procesarán si se confirma la reserva del
                      Servicio. De lo contrario, se efectuará la cancelación del Servicio con el
                      medio de pago utilizado por el Usuario a través del sitio web de Scharff o
                      de la aplicación que la misma disponga para el Servicio de resultar
                      aplicable.
                  </p>
                  <p>
                      - Con la reserva, Grupo Scharff enviará al Usuario mediante correo
                      electrónico y mensaje de texto, el código QR y código alfanumérico de
                      entrega de la mercadería (en adelante, el “Código de Entrega”). Desde la
                      recepción del Código de Entrega, el Usuario tiene un plazo de veinticuatro
                      (24) horas para dejar la mercadería en el espacio del E-Locker reservado
                      con el Código de Entrega. Cabe señalar que, si la entrega por parte del
                      Usuario no se realiza en el plazo indicado, Scharff cobrará el monto
                      correspondiente al Usuario por reservación de espacio de E-Locker, sin
                      perjuicio de la realización del Servicio que corresponda.
                  </p>
                  <p>
                      - Una vez almacenada la Mercadería en el espacio del E-Locker reservado el
                      Usuario Final proporcionado por el Usuario recibirá el código QR y código
                      alfanumérico de retiro de la mercadería (en adelante, el “Código de
                      Retiro”) por correo electrónico y mensaje de texto, de acuerdo a la
                      información brindada por el Usuario.
                  </p>
                  <p>
                      - La mercadería se podrá almacenar en los E-Lockers por un plazo máximo de
                      veinte y cuatro (24) horas y en dicho periodo, la mercadería deberá ser
                      recogida por el Usuario Final y/o por el Usuario; de lo contrario, Grupo
                      Scharff retirará el paquete y coordinará la devolución del mismo con el
                      Usuario, previo pago del concepto de retorno de la Mercadería y/o lo que
                      corresponda.
                  </p>
                  <p>
                      <strong>5. </strong>
                      <strong><u>Responsabilidad</u></strong>
                      <strong><u></u></strong>
                  </p>
                  <p>
                      El Código QR y alfanumérico son confidenciales, únicos e intransferibles y
                      cualquier retiro de la mercadería se entenderá que ha sido efectuada por el
                      Usuario, por lo que no podrá el Usuario imputar responsabilidad a Scharff
                      por la pérdida de la mercadería en caso sufra pérdida, suplantación, hurto,
                      robo y similares causados por la falta de cuidado de los Códigos por parte
                      del Usuario y/o el Usuario Final.
                  </p>
                  <p>
                      <strong>6. </strong>
                      <strong><u>Cambios en Términos de Uso</u></strong>
                  </p>

                  <p>
                      Scharff puede terminar, cambiar, suspender o descontinuar cualquier aspecto
                      del Servicio y de estos Términos y Condiciones Especiales en cualquier
                      momento. Los cambios serán efectivos cuando se publiquen y el Usuario haya
                      aceptado o continúe utilizando el Servicio bajo las nuevas modificaciones.
                  </p>
                  <p>
                      Los presentes Términos y Condiciones Especiales no sustituyen, reemplazan
                      y/o eliminan a los Términos y Condiciones del sitio web de Grupo Scharff,
                      los cuales se aplican de forma complementaria.
                  </p>
                  <p>
                      <strong>B. </strong>
                      <strong>SCHARFF EXPRESS</strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong>1. </strong>
                      <strong><u>Definición y objeto</u></strong>
                  </p>

                  <p>
                      El Servicio <strong>Scharff Express</strong> está dirigido al comercio
                      electrónico que ofrece, a través de una plataforma electrónica sea el Sitio
                      Web de Grupo Scharff o la aplicación que ésta implemente para uso –
                      programa informático que es de propiedad de la empresa Wayra Distribution
                      S.A. (en adelante, “Wayra”)-, el recojo y entrega de un producto o
                      mercadería (en adelante, la “Mercadería”) mediante un conductor
                      independiente o “Scharffer” que recogerá la Mercadería desde un lugar de
                      recepción a un lugar de destino, ambos seleccionados por el Usuario, en los
                      plazos establecidos. Todo este proceso en adelante se definirá como el
                      Servicio o Scharff Express.
                  </p>
                  <p>
                      Para efectos de este contrato, se deberá entender como:
                  </p>
                  <p>
                      - “<strong>Usuario</strong>” a aquella persona que, a través del Sitio Web
                      o aplicación, solicita el servicio de recojo y entrega de Mercadería; y,
                  </p>
                  <p>
                      - “<strong>Scharffer</strong>” o los “<strong>Scharffers</strong>” a
                      aquellos conductores profesionales quienes realizan el Servicio Scharff
                      Express de envío de productos (la Mercadería) por requerimiento del
                      Usuario, quien utilizará a su modo la aplicación “Quiero Ser Scharffer”
                      para el registro como Scharffer previa evaluación y la realización del
                      servicio.
                  </p>
                  <p>
                      - “<strong>Wayra</strong>” es la empresa titular de los derechos de
                      propiedad intelectual del servicio “Scharff Express”, de las aplicaciones
                      que se generen en virtud de la misma yo de “Quiero Ser Scharffer”.
                  </p>
                  <p>
                      - “<strong>Quiero Ser Scharffer</strong>”, aplicación de uso exclusivo de
                      los conductores profesionales o Scharffers que se utilizará para el
                      desarrollo de Scharff Express.
                  </p>
                  <p>
                      <strong>2. </strong>
                      <strong><u>Mercadería </u></strong>
                  </p>
                  <p>
                      Por medio de Scharff Express, el Usuario podrá solicitar servicios de
                      reparto de la Mercadería, cuyas características deberán ser las siguientes:
                      i) Peso: Menor a 6 kgs; ii) Dimensiones: Menor a 40 x 40 x 40 cm3; iii)
                      Valor de la Mercadería: igual o menor a US$ 100.00 (Cien con 00/100
                      Dólares); iv) Productos que no sean frágiles, animales, productos
                      inflamables, explosivos, insumos químicos, combustibles, alimentos o
                      productos perecibles, bienes de procedencia ilícita o cuya tenencia y/o
                      transferencia sea ilícita, entre otros que pudiera poner en riesgo la
                      seguridad del vehículo o cuyas condiciones no puedan ser garantizadas
                      durante trayecto; v) Contar con empaque apropiado para el reparto; y, que
                      cumplan con las especificaciones, restricciones y/o prohibiciones del
                      numeral 6 de los Términos y Condiciones Generales de esta página.
                  </p>

                  <p>
                      <strong>3. </strong>
                      <strong><u>Condiciones Técnicas del Servicio</u></strong>
                  </p>

                  <p>
                      3.1 La Mercadería será recogida en un plazo máximo de 60 (sesenta) minutos
                      por el Scharffer en el lugar indicado por el Usuario. En caso que no sea
                      posible recoger la Mercadería en el lugar de origen, se deja expresa
                      constancia que el Usuario de igual forma asumirá el costo del Servicio por
                      la mínima distancia (4 kilómetros).
                  </p>
                  <p>
                      3.2 La Mercadería será entregada por el Scharffer en el lugar y a la
                      persona indicada por el Usuario en un plazo no mayor a cuatro (4) horas
                      desde su recojo en el lugar de origen. En caso que no sea posible entregar
                      la Mercadería en el lugar de destino señalado por el Usuario, se le cobrará
                      al Usuario los costos por reprogramación de entrega de Mercadería y/o
                      retorno al lugar de origen, según el criterio o selección del Usuario o de
                      Wayra a falta de respuesta de éste último.
                  </p>
                  <p>
                      <strong>4. </strong>
                      <strong><u>Especificaciones para Usuarios</u></strong>
                  </p>

                  <p>
                      <strong>A. </strong>
                      <strong><u>Del uso de Scharff Express</u></strong>
                  </p>

                  <p>
                      - El Usuario tendrá el derecho no exclusivo, gratuito, revocable e
                      intransferible de utilizar Scharff Express mediante su propio teléfono
                      inteligente o tableta, en el Sitio Web o la aplicación y por el cual podrá
                      solicitar, bajo los términos de las cláusulas precedentes de la presente
                      sección el recojo de la Mercadería, desde el lugar de recepción indicado
                      por el Usuario para que sea entregado en las mismas condiciones de
                      recepción en el lugar de destino indicado por el Usuario.
                  </p>
                  <p>
                      - El uso del servicio, conforme a lo establecido en este Contrato, será
                      totalmente gratuito para el Usuario. Sin perjuicio de ello, el Usuario será
                      responsable del costo del servicio de reparto de la Mercadería, la cual
                      será cancelada a través del Sitio Web o de la aplicación de Wayra que Grupo
                      Scharff ponga a disposición del Usuario, salvo que se establezca un
                      mecanismo distinto. Asimismo, El Usuario será responsable de su servicio
                      telefónico y de Internet, conforme a los plantes de voz y datos que hubiese
                      contratado con las empresas de telecomunicaciones respectivas.
                  </p>

                  <p>
                      <strong>B. </strong>
                      <strong><u>Registro y uso de datos personales</u></strong>
                  </p>

                  <p>
                      - El Usuario entrega a Wayra datos personales como consecuencia de la
                      contratación del servicio Scharff Express, que son los siguientes: i)
                      Nombre completo del Usuario; ii) Domicilio de contacto; iii) Edad, lugar y
                      fecha de nacimiento; iv) Fecha en la que se afilió al Sitio Web y/o
                      descargó la aplicación y fecha de registro; v) teléfono y/o teléfono
                      celular; iv) Correo electrónico; vii) Modelo, marca y características del
                      teléfono inteligente o tableta de El Usuario; viii) Dirección física, fecha
                      y hora en el que el Usuario solicita un servicio de reparto de Mercadería a
                      través de Scharff Express; ix) Características de la Mercadería entregada;
                      x) Datos de la persona de contacto que recibirá la Mercadería; xi)
                      Dirección física, fecha y hora en la que el Usuario entrega la Mercadería
                      respecto a un servicio solicitado a través de Scharff Express, así como el
                      destino al cual se dirige dicha Mercadería para ser entrega por el
                      Scharffer; xii) Búsquedas y solicitudes de servicios de reparto de
                      Mercadería que el Usuario haya realizado a través de Scharff Express; xiii)
                      Servicios solicitados y servicios completados a través de Scharff Express;
                      xiv) Ubicación del teléfono móvil, celular o tableta en tiempo real lo que
                      puede revelar la ubicación del Usuario en tiempo real, y; xv)
                      Calificaciones, opiniones o comentarios que el Usuario haga de los
                      Scharffers, de Grupo Scharff o terceros.
                  </p>
                  <p>
                      - El Usuario no proporcionará datos sensibles. En dicho caso, si el Usuario
                      publica o postea cualquier dato sensible a través de Scharff Express sea en
                      el Sitio Web o la aplicación de Wayra, será bajo su absoluta
                      responsabilidad y Wayra se reserva el derecho de suprimirlo.
                  </p>
                  <p>
                      - Wayra obtiene los datos personales directamente del Usuario, de terceros,
                      de Scharffers, de fuentes públicas o en forma automática a través de
                      Scharff Express y cookies, web beacons u otras funcionalidades que permiten
                      ubicarlo en el espacio.
                  </p>
                  <p>
                      - Los datos personales del Usuario se administrarán y se tratarán para las
                      siguientes finalidades que son estrictamente necesarias para el
                      cumplimiento de la relación jurídico-comercial que el Usuario mantiene para
                      el uso de Scharff Express, de acuerdo a sus funcionalidades: i) Medir la
                      calidad de los servicios de reparto que el Usuario haya contratado y
                      canalizar adecuadamente sus solicitudes de servicio reparto de la
                      Mercadería; ii) Analizar y evaluar sus características y cumplimiento como
                      Usuario; iii) Monitorear el debido cumplimiento contractual; iv) Atender
                      cualquier queja, pregunta o comentario del Usuario; v) Solicitar y
                      compartir sus opiniones, comentarios y calificaciones de Scharffers con
                      otros usuarios que tengan autorización de uso de Scharff Express; vi)
                      Compartir su ubicación e información con Scharffers y usuarios que cuenten
                      con Scharff Express o con la aplicación de los Scharffers y que éstos
                      puedan evaluarlo y contactarlo cuando el Usuario envíe solicitudes de
                      servicios a través de Scharff Express; vii) Compartir las evaluaciones,
                      calificaciones, comentarios u opiniones que terceros hagan respecto del
                      Usuario con los usuarios que cuenten con Scharff Express a través de Sitio
                      Web o aplicación; viii) Fines estadísticos; ix) Mejorar la calidad de
                      Scharff Express; y, x) Enviar notificaciones relacionadas con las
                      modificaciones que se realicen a los términos y condiciones y avisos de
                      privacidad.
                  </p>
                  <p>
                      - En adición a lo anterior, sus datos de contacto podrán ser utilizados
                      para enviar notificaciones, avisos, propaganda o publicidad sobre productos
                      y/o servicios de Grupo Scharff o de terceros y para envío de información,
                      revistas y noticias o de temas que Wayra considere que pueden interesarle,
                      así como noticias, comunicaciones o publicidad de Grupo Scharff o sus
                      empresas relacionadas.
                  </p>
                  <p>
                      - El Usuario reconoce que la información personal que reciba de los
                      Scharffers es considerada como Datos Personales, por lo que a su vez se
                      constituye como único responsable del manejo de la misma y se compromete a
                      utilizarla exclusivamente a efectos de solicitar el servicio.
                  </p>
                  <p>
                      - El Usuario podrá calificar el servicio de reparto de los Scharffers así
                      como revisar las calificaciones de los Scharffers que han otorgado otros
                      usuarios de Scharff Express. En consecuencia, El Usuario se obliga a que la
                      información: i) no será falsa, engañosa, calumniosa, injuriosa,
                      difamatoria, obscena, pornográfica, amenazante o fraudulenta; ii) no
                      violará los derechos de propiedad intelectual de terceros, y; iii) no será
                      propaganda o anuncios políticos, comerciales, religiosos ni incluirá
                      mailings masivos o spams.
                  </p>
                  <p>
                      - Wayra se reserva el derecho de bloquear el acceso o remover en forma
                      parcial o total, toda información, comunicación o material, incluyendo
                      opiniones, comentarios o calificaciones que el Usuario de Scharff Express
                      publique, que a su exclusivo juicio pueda resultar: i) abusivo, difamatorio
                      u obsceno; ii) fraudulento, artificioso o engañoso; iii) violatorio de
                      derechos de autor, marcas, confidencialidad, secretos industriales o
                      cualquier derecho de propiedad intelectual de un tercero; iv) ofensivo,
                      y/o; v) de cualquier forma contravenga lo establecido en este Contrato y
                      las leyes peruanas.
                  </p>
                  <p>
                      <strong>C. </strong>
                      <strong><u>Seguridad de la Información</u></strong>
                  </p>
                  <p>
                      - Los datos personales que se recaben, formarán parte de una base de datos
                      que permanecerá vigente durante el periodo que Wayra considere necesario
                      para cumplir la finalidad específica para la que los datos fueron
                      recabados. Una vez concluido éste, sus datos se cancelarán y bloquearán,
                      para su posterior supresión de conformidad con la Ley de Protección de
                      Datos Personales, Ley No. 29758.
                  </p>
                  <p>
                      - Wayra adoptará todas y cada una de las medidas de seguridad
                      administrativas, físicas y técnicas que establezca la ley aplicable para
                      salvaguardar su información personal, por lo que de igual manera y en caso
                      de que un tercero necesite conocer de dicha información, Wayra obligará a
                      dichos terceros a cumplir y adoptar las medidas de seguridad
                      administrativas, físicas y técnicas establecidas en el la ley aplicable, a
                      fin de proteger sus datos personales de cualquier daño, perdida,
                      alteración, destrucción o el uso, acceso o tratamiento no autorizado.
                  </p>
                  <p>
                      - Sin perjuicio de lo anterior, si bien Wayra maneja un sistema de base de
                      datos que cumple con la diligencia y cuidado debido de seguridad, el
                      Usuario reconoce que las comunicaciones electrónicas no son absolutamente
                      seguras y que cualquier sistema informático, por más que se encuentre
                      protegido con una debida diligencia, se encuentra expuesto a eventuales
                      vulneraciones que pudiesen afectar su funcionamiento o seguridad. En
                      consecuencia, Wayra no garantiza que no se produzcan daños, pérdidas,
                      destrucciones, extravíos, alteraciones o tratamientos no autorizados
                      producto de las referidas vulneraciones.
                  </p>
                  <p>
                      - Wayra podrá contar con un perfil, ya sea de la empresa o de sus
                      productos, en las principales redes sociales tales como Facebook, Twitter,
                      LinkedIn, Pinterest, etc. (en adelante, las “Redes Sociales”). Las Redes
                      Sociales, servirán única y exclusivamente como un canal de comunicación
                      inmediato con los seguidores de la empresa o sus productos, así como un
                      medio electrónico de información y marketing de nuevos productos ofertas y
                      promociones que sean realizadas por la empresa exclusivamente en su perfil
                      y que será accesible a través del mismo a sus seguidores. Wayra únicamente
                      podrá conocer los datos personales que así lo permitan las Redes Sociales y
                      en ningún caso extraerá los datos personales que pueda conocer de sus
                      seguidores sin su consentimiento previo. Hacemos de su conocimiento que
                      tanto las Redes Sociales serán los titulares de las bases de datos que a
                      éstos les corresponda, por lo que Grupo Scharff le solicita leer las
                      políticas de privacidad y condiciones de uso de las mismas.
                  </p>
                  <p>
                      <strong>D. </strong>
                      <strong><u>Responsabilidad</u></strong>
                  </p>

                  <p>
                      - El Usuario por este documento declara que conoce los alcances y
                      especificaciones del Servicio y que la Mercadería que contrata para Scharff
                      Express cumple con las especificaciones de la cláusula segunda del presente
                      contrato. En tal sentido, cualquier Mercadería que exceda los límites allí
                      señalados será de su exclusiva responsabilidad.
                  </p>
                  <p>
                      - El Usuario comprende y señala que quien realiza el servicio de Scharff
                      Express es un conductor independiente y no contratado por Wayra ni Grupo
                      Scharff; por lo que, tiene conocimiento que la responsabilidad de Wayra
                      alcanza el límite de lo pactado en este contrato y en caso de ocurrir una
                      pérdida, daño o destrucción de la Mercadería de la Mercadería entregada a
                      un Scharffer en cumplimiento de las estipulaciones del presente Contrato
                      mediante el Sitio Web o la aplicación, Wayra compensará al Usuario por un
                      monto equivalente al valor de la Mercadería o por un monto total máximo de
                  US$100.00 (Cien y 00/100 Dólares Americanos), el que resulte menor.    <strong><u></u></strong>
                  </p>
                  <p>
                      - Mediante el presente Contrato, el Usuario declara que Wayra no será
                      responsable por la entrega de Mercaderías cuyo valor supere el indicado en
                      estos términos y condiciones, sobre cuya diferencia ni Grupo Scharff ni
                      Wayra asumirán ninguna responsabilidad.<strong><u></u></strong>
                  </p>
                  <p>
                      - Wayra no es una empresa de taxi o Courier, ni realiza directamente el
                      servicio de reparto de Mercaderías. El objeto del presente contrato es
                      exclusivamente el de autorizar al Usuario el uso de Scharff Express
                      conforme a lo señalado en las cláusulas precedentes y posteriores del
                      presente Contrato. <strong><u></u></strong>
                  </p>
                  <p>
                      - El Scharffer únicamente es un repartidor autorizado por Wayra, previa
                      evaluación; y, en consecuencia, puede aceptar o rechazar de modo libre y
                      autónomo una solicitud de servicio, no encontrándose obligado y siendo
                      única y exclusivamente responsable por la aceptación o rechazo de una
                      solicitud de Servicio. <strong><u></u></strong>
                  </p>


                  <p>
                      <strong>5. </strong>
                      <strong><u>Especificaciones para Scharffers</u></strong>
                  </p>

                  <p>
                      <strong>A. </strong>
                      <strong><u>Del App “Quiero Ser Scharffer”</u></strong>
                  </p>

                  <p>
                      - Los Scharffers de manera adicional utilizarán el programa informático o
                  aplicación de propiedad de Wayra Distribution S.A. denominado “    <strong>Quiero Ser Scharffer</strong>” que<strong> </strong>es un programa
                      informático o aplicación de propiedad exclusiva de Wayra Distribution S.A
                      (Wayra) que ofrece una plataforma tecnológica exclusiva para los
                      conductores o Scharffers para que puedan conectarse a una red sincronizada
                      con el programa informático o aplicación de desarrollo de Scharff Express,
                      a través del cual el Usuario de esta última requiera los servicios de los
                      Scharffers para que transporten la Mercadería.
                  </p>
                  <p>
                      - En ese sentido, el Scharffer tendrá el derecho no exclusivo, gratuito,
                      revocable e intransferible de utilizar el programa informático o aplicación
                      llamado “Quiero Ser Scharffer”, que le permitirá, mediante su propio
                      teléfono inteligente o tableta, a solicitud exclusiva del Usuario del Sitio
                      Web o aplicación, realizar el recojo y entrega de la Mercadería desde el
                      lugar de recepción al lugar de destino en las mismas condiciones de
                      recepción, según las instrucciones del Usuario y bajo los términos
                      establecidos en el presente Contrato. <strong><u></u></strong>
                  </p>
                  <p>
                      - El Scharffer deberá aceptar todos los Términos y Condiciones Especiales
                      detallados para el uso de “Quiero Ser Scharffer”, los cuales serán
                      aplicables para cualquier actualización presente y futura de dicha
                      aplicación. <strong><u></u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong>B. </strong>
                      <strong>
                          <u>Del Registro y uso de datos personales en “Quiero Ser Scharffer”</u>
                      </strong>
                  </p>

                  <p>
                      - El Scharffer, conforme las instrucciones establecidas, seleccionará una
                      contraseña que le permitirá el acceso a “Quiero Ser Scharffer”, la cual es
                      confidencial, intransferible y no deberá ser compartida con terceros, bajo
                      entera responsabilidad del Scharffer.
                  </p>
                  <p>
                      - Para hacer uso del Servicio “Quiero Ser Scharffer” mediante el programa
                      informático/aplicación requiere estar conectada a Internet para su
                      funcionamiento. Cuando se trata del aplicativo, este posee la capacidad y
                      función de hacer que el teléfono inteligente o tableta se conecte
                      automáticamente a Internet para notificar al Scharffer que “Quiero Ser
                      Scharffer” se ha instalado correctamente y que se encuentra en adelante
                      habilitada para utilizar sus funciones, así como realizar solicitudes de
                      servicios.
                  </p>
                  <p>
                      - El Scharffer será responsable de contar con un teléfono inteligente o
                      tableta que cumpla con las características y requerimientos técnicos para
                      acceder y utilizar “Quiero Ser Scharffer”, incluyendo, a su entero costo,
                      la conexión a Internet y el uso de planes de voz y datos. Las
                      características y requerimientos técnicos referidos serán notificados al
                      Usuario por parte de “Quiero Ser Scharffer” antes de la descarga de dicha
                      aplicación o de cualquiera de sus actualizaciones.
                  </p>
                  <p>
                      - El Scharffer se obliga a no modificar, reproducir, copiar, realizar
                      ingeniería inversa, revertir la ingeniería, rediseñar, descompilar,
                      adaptar, traducir, preparar trabajos derivados de “Quiero Ser Scharffer” o
                      usar dicha aplicación para desarrollar cualquier software u otros
                      materiales basados en el mismo. De igual forma, se obliga a utilizar
                      “Quiero Ser Scharffer” únicamente en la forma permitida en este contrato y
                      para los fines contratados.
                  </p>
                  <p>
                      - Wayra podrá libremente, no siendo ello una obligación, poner a
                      disposición del Scharffer actualizaciones de “Quiero Ser Scharffer” para su
                      descarga. Queda establecido que la descarga de alguna de las
                      actualizaciones implica que el Scharffer renuncia voluntariamente a su
                      derecho de utilizar cualquier versión anterior de “Quiero Ser Scharffer”.
                      La programación establecida para “Quiero Ser Scharffer” permite que la
                      aplicación se conecte de forma automática a Internet y busque
                      actualizaciones disponibles, las mismas que pueden ser descargadas de forma
                      automática.
                  </p>
                  <p>
                      - Wayra se reserva el derecho de suprimir y/o modificar el contenido de
                      “Quiero Ser Scharffer”, cuando así lo considere necesario, a efectos de
                      cumplir con los estándares comerciales de Wayra, y con las disposiciones
                      legales que fuesen aplicables. Asimismo, “Quiero Ser Scharffer” se reserva
                      el derecho a bloquear la aplicación sobre cualquier dispositivo o el
                      Scharffer que haga uso indebido de la misma o sea contrario a normativa
                      vigente.
                  </p>
                  <p>
                      - El Scharffer entrega a Wayra datos personales como consecuencia de la
                      contratación del servicio Scharff Express, que son los siguientes: i)
                      Nombre completo; ii) Domicilio real; iii) Edad, lugar y fecha de
                      nacimiento; iv) Fecha en la que descargó “Quiero Ser Scharffer” y fecha de
                      registro; v) teléfono y/o teléfono celular; iv) Correo electrónico; vii)
                      Modelo, marca y características del teléfono inteligente o tableta del
                      Scharffer; viii) Dirección física, fecha y hora de los servicios brindados;
                      ix) Ubicación del teléfono móvil, celular o tableta en tiempo real lo que
                      puede revelar la ubicación del Scharffer y el Usuario en tiempo real, x)
                      Modelo, placa y características del vehículo del Scharffer; xi)
                      antecedentes y récord del vehículo del Scharffer; xii) verificación de
                      antecedentes del Scharffer; y, xiii) Calificaciones, opiniones o
                      comentarios que el Usuario haga de los Scharffers o terceros.
                  </p>
                  <p>
                      - El Scharffer acepta que mediante “Quiero Ser Scharffer” el Usuario podrá
                      calificar el servicio brindado, así como que Wayra revisará periódicamente
                      las calificaciones que se efectúen a fin de calificar su permanencia en
                      “Quiero Ser Scharffer”. En consecuencia, el Scharffer se obliga a que la
                      información que brinde a Wayra y al Usuario: i) no será falsa, engañosa,
                      calumniosa, injuriosa, difamatoria, obscena, pornográfica, amenazante o
                      fraudulenta; ii) no violará los derechos de propiedad intelectual de
                      terceros, y; iii) no será propaganda o anuncios políticos, comerciales,
                      religiosos ni incluirá mailings masivos o spams.
                  </p>
                  <p>
                      - El Scharffer no proporcionará datos sensibles. En dicho caso, si el
                      Scharffer publica o postea cualquier dato sensible a través de Scharff
                      Express sea en el Sitio Web o la aplicación de Wayra, será bajo su absoluta
                      responsabilidad y Wayra se reserva el derecho de suprimirlo.
                  </p>
                  <p>
                      <strong>C. </strong>
                      <strong><u>Del Servicio Scharff Express</u></strong>
                  </p>
                  <p>
                      Por medio de “Quiero Ser Scharffer”, el Scharffer podrá aceptar servicios
                      de reparto de la Mercadería, cuyas características se circunscriben a lo
                      señalado en los términos y condiciones de Scharff Express.
                  </p>
                  <p>
                      - El Scharffer podrá recoger la Mercadería en un plazo máximo de 60
                      (sesenta) minutos por el Scharffer en el lugar indicado por el Usuario
                      mediante el uso de “Quiero Ser Scharffer”. El Scharffer deberá comunicarse
                      con el Usuario en caso se demore más de 30 (treinta) minutos para recoger
                      la Mercadería en el lugar de origen señalado por el Usuario.
                  </p>
                  <p>
                      - La Mercadería será entregada en el lugar y a la persona indicada por el
                      Usuario en un plazo no mayor a cuatro (4) horas desde su recojo. El
                      Scharffer en caso no encuentre al destinatario en dicho lugar de destino
                      seleccionado por el Usuario, entonces deberá intentar contactarse con éste
                      en un plazo de 10 (diez) minutos mediante llamada telefónica o mensaje de
                      texto con el siguiente tenor: “
                      <em>
                          Hola soy [Nombre y Apellido] del servicio Scharff Express y vengo a
                          entregar tu pedido de [Contacto Remitente (Usuario)]"
                      </em>
                      . En caso no se tenga respuesta, entonces el Scharffer deberá llamar al
                      Usuario a fin de que éste se comunique con el destinatario indicado.
                  </p>
                  <p>
                      - De lo contrario, si ni el Scharffer ni el Usuario se comunican con el
                      destinario, entonces el Scharffer deberá enviar el siguiente mensaje de
                      texto al destinatario del Usuario: “
                      <em>
                          Hola! Lamentablemente no te encontré. El pedido regresará a la persona
                          que lo envío
                      </em>
                      ” y seleccionar las siguientes opciones en la aplicación “Quiero Ser
                      Scharffer”: No se entregó, indicar motivo ► seleccionar motivo ausente ►
                      tomar una fotografía a la fachada de la casa ► colocar comentario
                      detallando el incidente ► y finalmente llamar a los teléfonos de contacto
                      de Grupo Scharff para coordinar la devolución de la Mercadería con el
                      Usuario y ► Seleccionar opción retorno a lugar/punto de origen.
                  </p>
                  <p>
                      <strong>D. </strong>
                      <strong><u>Responsabilidad</u></strong>
                  </p>
                  <p>
                      - El Scharffer asume entera responsabilidad si, habiendo sido transportada
                      la Mercadería al lugar de destino indicada por el Usuario, ésta no es
                      recibida por el destinatario y/o si no fue devuelta al lugar de origen en
                      caso de falla o imposibilidad de entrega toda vez que, en este último caso,
                      el Scharffer está obligado a seguir las instrucciones y devolver la
                      Mercadería al punto o lugar de origen.
                  </p>
                  <p>
                      - El Scharffer asume la responsabilidad en caso de ocurrir una pérdida,
                      daño o destrucción de la Mercadería entregada en cumplimiento de las
                      estipulaciones del presente Contrato. Cabe señalar que, frente a cualquiera
                      de estos eventos, el Scharffer deberá comunicarlo de inmediato a los
                      números de contacto que se le brindó, así como al Usuario y el destinatario
                      de éstos ofreciéndoles las disculpas del caso y se podrán aplicar
                      penalidades al Scharffer por estos eventos.
                  </p>
                  <p>
                      - El Scharffer mantendrá indemne a Wayra frente a cualquier reclamo que
                      pueda ser presentado por algún Usuario, debiendo asumir todos los costos
                      que Wayra deba incurrir en dicho supuesto. Mediante el presente Contrato,
                      el Scharffer declara y reconoce que Wayra no es responsable por la entrega
                      de Mercaderías.
                  </p>
                  <p>
                      - En caso de cualquier ocurrencia durante el desarrollo del servicio
                      Scharff Express incluido, robo, sustracción, pérdida, daño y/u similares,
                      el Scharffer deberá prestar su colaboración inmediata para el
                      esclarecimiento de los hechos, lo cual no lo exime de responsabilidad salvo
                      que alguna autoridad pruebe fehacientemente lo contrario.
                  </p>
                  <p>
                      - El Scharffer reconoce que cualquier infracción cometida, sea de tránsito
                      y/o administrativa como conductor y/o que sean imputables a su conducta, es
                      de su entera y exclusiva responsabilidad y no puede reclamar nada ni a
                      Wayra ni a Grupo Scharff.
                  </p>
                  <p>
                      <strong>E. </strong>
                      <strong><u>Pago por Servicios</u></strong>
                      <strong><u></u></strong>
                  </p>

                  <p>
                      - El Scharffer recibirá una contraprestación por los servicios que brinde
                      cuyo monto es variable dependiendo de los servicios que realice, la
                      frecuencia, cantidad y lugares seleccionados por el Usuario. El tarifario
                      por Grupo Scharff.
                  </p>
                  <p>
                      - Se deja expresa constancia que, en los casos de cancelación del Servicio,
                      se pagará de la siguiente manera: Cancelación voluntaria del Usuario ► Pago
                      de tarifa mínima al Scharffer; Retraso o cancelación por parte del
                      Scharffer ► No se le paga tarifa alguna; Otro motivo ► se le paga la tarifa
                      mínima al Scharffer salvo que luego de una evaluación se haya concluido que
                      la cancelación del servicio fue un error del Scharffer y no se le pagará
                      por el servicio no prestado.
                  </p>
                  <p>
                      - En los casos de retorno por selección del Usuario, el Scharffer recibirá:
                      si retorna al punto de origen ► el doble de la tarifa seleccionada
                      (kilómetros recorridos); si retorna a otro punto de destino o lugar de
                      entrega seleccionada por el Usuario, la tarifa por la distancia hacia dicho
                      punto de entrega.
                  </p>
                  <p>
                      - Cabe señalar que, en caso de mercadería dañada, se le podrán aplicar
                      penalidades a la tarifa que reciba como contraprestación por los servicios
                      prestados, en tanto asume responsabilidad por la integridad de la
                      Mercadería que es recibida de los Usuarios.
                  </p>

                  <p>
                      <strong>F. </strong>
                      <strong><u>Declaraciones y Obligaciones del Scharffer</u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      - El Scharffer únicamente es un repartidor autorizado por Wayra, previa
                      evaluación, a utilizar “Quiero Ser Scharffer” y, en consecuencia, puede
                      aceptar o rechazar de modo libre y autónomo una solicitud de servicio, no
                      encontrándose obligado y siendo única y exclusivamente responsable por la
                      aceptación o rechazo de una solicitud de servicio, sin perjuicio de la
                      responsabilidad asumida en virtud de lo establecido en la cláusula 5
                      numeral D) de esta sección de especificaciones para Scharffers.
                  </p>
                  <p>
                      - El Scharffer declara que no existe relación laboral ni mantiene relación
                      de subordinación con Wayra ni Grupo Scharff y que se encuentra en libertad
                      de decidir la forma, tiempo y modo de cumplimiento del servicio, siendo
                      responsable únicamente del cumplimiento diligente y oportuno del mismo.
                      Asimismo, el Scharffer se compromete a entregar el documento tributario y
                      contable o recibo por honorarios respectivo en función del encargo
                      realizado. Se deja constancia expresa que el Scharffer no puede ser
                      trabajador de Wayra ni de Grupo Scharff o cualquiera de las empresas que
                      formen parte de éste último. En caso no comunique este hecho a “Quiero Ser
                      Scharffer” y se registre como Scharffer, Wayra tiene el derecho de resolver
                      el contrato y excluirlo como Scharffer.
                  </p>
                  <p>
                      - Wayra se reserva el derecho de bloquear el acceso o remover en forma
                      parcial o total, toda información, comunicación o material, incluyendo
                      opiniones, comentarios o calificaciones respecto del Scharffer que a su
                      exclusivo juicio pueda resultar: i) abusivo, difamatorio u obsceno; ii)
                      fraudulento, artificioso o engañoso; iii) violatorio de derechos de autor,
                      marcas, confidencialidad, secretos industriales o cualquier derecho de
                      propiedad intelectual de un tercero; iv) ofensivo, y/o; v) de cualquier
                      forma contravenga lo establecido en este Contrato y las leyes peruanas.
                  </p>

                  <p>
                      <strong>G. </strong>
                      <strong><u>Plazo y Terminación </u></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      - El contrato permanecerá vigente por tiempo indefinido. El Scharffer o
                      Wayra podrán darlo por terminado en cualquier momento, mediante simple
                      notificación por correo electrónico, aviso a través de su aplicación o por
                      escrito entregada a la otra parte con al menos 24 (veinticuatro) horas de
                      anticipación a la terminación. La resolución del Contrato implicará que el
                      derecho y autorización del Scharffer para prestar servicios a través de
                      “Quiero Ser Scharffer” quedará sin efecto, por lo que este se compromete a
                      eliminar “Quiero Ser Scharffer” de su teléfono inteligente o tableta en el
                      momento en que el Contrato fuese resuelto.
                  </p>
                  <p>
                      - En caso el Scharffer se encuentre inactivo en “Quiero Ser Scharffer” por
                      un periodo continuo o intermitente de tres (3) meses, Wayra se reserva el
                      derecho de inhabilitar automáticamente su acceso a “Quiero Ser Scharffer” y
                      eliminarlo del registro y base de datos de los Scharffer.
                  </p>
                  <p>
                      <strong>H. </strong>
                      <strong><u>Renuncia de Garantías </u></strong>
                  </p>
                  <p>
                      - Wayra autoriza al Scharffer a utilizar “Quiero Ser Scharffer” e
                      inscribirse bajo las condiciones establecidas por dicho aplicativo, sin que
                      ello implique o incluya una garantía por parte de Wayra sobre el
                      funcionamiento de la aplicación.
                  </p>
                  <p>
                      - El Scharffer reconoce que asume el riesgo y responsabilidad respecto de
                      cualquier tipo de demora o retraso que pudiese sufrir como consecuencia de
                      cualquier hecho, acto u omisión de los servicios solicitados a través de
                      “Quiero Ser Scharffer”. Esta disposición se debe fundamentalmente a que la
                      relación entre el Scharffer y el Usuario es completamente independiente de
                      Wayra, no existiendo relación laboral ni de subordinación entre el
                      Scharffer y/o Usuario con Wayra.
                  </p>
                  <p>
                      - Wayra no otorga garantía alguna sobre el contenido de “Quiero Ser
                      Scharffer” ni la veracidad, integridad o exhaustividad de la información
                      contenida en “Quiero Ser Scharffer” o la información que proporcionen otros
                      Scharffers clientes o usuarios, incluyendo información respecto a la
                      honorabilidad, ubicación e identidad de algún Scharffer. La información,
                      consejos, conceptos, calificaciones, evaluaciones y opiniones publicadas en
                      “Quiero Ser Scharffer”. no necesariamente reflejan la posición de Wayra, ni
                      de sus empleados, oficiales, directores, accionistas, licenciatarios,
                      licenciantes, proveedores y afiliadas. Por esta razón, Wayra no se hace
                      responsable por la información, consejos, opiniones y conceptos que se
                      emitan o publiquen en “Quiero Ser Scharffer”.
                  </p>
                  <p>
                      - Sin limitar la generalidad de lo anterior, Wayra no garantiza: i) La
                      disponibilidad de “Quiero Ser Scharffer” por problemas técnicos imputables
                      a sistemas de comunicación y conexión a Internet; y/o ii) La ausencia de
                      virus, errores, desactivadores o materiales contaminantes o con funciones
                      destructivas en “Quiero Ser Scharffer”.
                  </p>
                  <p>
                      <strong>
                          EL SUSCRITO, EL USUARIO Y/O EL SCHARFFER, OTORGAN SU ACEPTACIÓN Y
                          CONSENTIMIENTO A ESTE CONTRATO Y SUS TÉRMINOS Y CONDICIONES GENERALES Y
                          ESPECIALES AL PRESIONAR “CLICK” EN EL BOTÓN ACEPTAR DESDE ESTE SITIO
                          WEB O APLICACIÓN.
                      </strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>
                  <p>
                      <strong></strong>
                  </p>'
              ],
          ]
      );
    }
}
