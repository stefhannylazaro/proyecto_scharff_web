<template>
  <v-container fluid class="pb-0 py-0 container-mispedidos" >
    <v-layout row wrap justify-center>
      <v-flex xs12 sm12 md10 class="mispedidos-box-w" >
        <div class="mispedidos-info">
          <v-layout row wrap >
            <v-flex xs12 sm12 md12 lg7 px-3>
              <div class="mispedidos-notice mispedidos-block">
                <v-layout row wrap >
                  <v-flex xs12 sm12 md12 text-center mb-4 mt-2>
                    <h2 class="color-pink">¿Cómo comprar?</h2>
                  </v-flex>
                  <v-flex xs12 sm12 md4 px-2 text-center class="block-info">
                    <img src="/images/inner-a/icon_paso2.png" alt="goandbuy">
                    <h3 class="color-pink py-2">01</h3>
                    <h4 class="black--text px-3">¡Compra<br>online!</h4>
                    <p class="p-text mt-2">Te daremos una dirección de entrega.<br>¡Ingrésala!</p>
                  </v-flex>
                  <v-flex xs12 sm12 md4 px-2 text-center class="block-info">
                    <img src="/images/inner-a/icon_paso3.png" alt="goandbuy">
                    <h3 class="color-pink py-2">02</h3>
                    <h4 class="black--text px-3">¡Confirma<br>tu compra!</h4>
                    <p class="p-text mt-2">Sube tu comprobante de pago</p>
                  </v-flex>
                  <v-flex xs12 sm12 md4 px-2 text-center class="block-info">
                    <img src="/images/inner-a/icon_paso4.png" alt="goandbuy">
                    <h3 class="color-pink py-2">03</h3>
                    <h4 class="black--text px-3">¡Recibe tu compra!</h4>
                    <p class="p-text mt-2">¡Listo! Lo llevamos a tu casa.<br>Podrás ver el estado de tu compra en tiempo real.</p>
                  </v-flex>
                </v-layout>
              </div>
            </v-flex>
            <v-flex xs12 sm12 md12 lg5 px-3>
              <div class="mispedidos-notice mispedidos-block">
                <v-layout row wrap align-center>
                  <v-flex xs12 sm12 md12 text-center mb-4 mt-2>
                    <h2 class="color-pink">Cotiza aquí</h2>
                    <p class="color-pink mt-4 size-m">Coloca los datos de tu paquete</p>
                  </v-flex>
                  <v-flex xs12 sm12 md4 text-center pl-2 mb-3 class="el_1543951255">
                    <div class="size-m">USD$ <span>{{costo_total_c}}</span></div>
                  </v-flex>
                  <v-flex xs12 sm12 md4 text-center pr-2 pl-1 mb-3 class="block-info-m">
                    <div class="border-all"><input type="number" placeholder="" min="1" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)" v-model="peso_producto_c"></div>
                    <h4 class="black--text">Peso <br>(Kg)</h4>
                  </v-flex>
                  <v-flex xs12 sm12 md4 text-center px-2 mb-3 class="block-info-m">
                    <div class="border-all"><input type="number" placeholder="" min="1" v-model="valor_producto_c"></div>
                    <h4 class="black--text">Valor <br>(USD $)</h4>
                  </v-flex>
                  <v-flex xs12 sm12 md4 text-center pl-2 mb-3  class="el_1543951256">
                    <div class="size-m"><span>USD$ {{costo_total_c}} </span></div>
                  </v-flex>
                </v-layout>
                <v-layout row wrap align-center>
                  <v-flex xs12 sm12 md12>
                    <p class="mispedidos-notice-line2">*Tarifa no incluye aranceles. Estos serán cobrados una vez realizado el desaduanaje.</p>
                  </v-flex>
                </v-layout>
              </div>
            </v-flex>
          </v-layout>
        </div>
      </v-flex>
      <v-flex xs12 sm12 md12 class="">

        <div class="mispedidos-notice" style="display:flex">
          <div class="mispedidos-left">
            <p class="mispedidos-notice-line1">Si ya compraste, ¡envíanos una constancia para registrar tu pedido!</p>
            <p class="mispedidos-notice-line2">
              <img src="/images/iteracion3/icon_info.png" alt="">
              Puedes cargar el mensaje de confirmacion o tu boleta.
            </p>
          </div>
          <!-- <div class="mispedidos-right">
            <v-btn
              flat
              class="btn-carga-confirmacion"
              @click="uploadgobuypedido">
              <img src="/images/iteracion3/icon_subir_archivo.png" alt=""> CARGA TU CONFIRMACIÓN DE COMPRA <span>(.pdf o jpg)</span>
            </v-btn>
            <input style="display:none" type="file" name="filenamegobuypedido" id="filenamegobuypedido" @change="onFileChange">
          </div> -->
          <div class="">
            <v-btn round outline class="btn-send-next" @click.native="drawerRight =!drawerRight">Registrar compra</v-btn>
          </div>

        </div>

        <div class="mispedidos-filterblock">
          <div class="mispedidos-filterblock-left">
            <p>
              Mis pedidos.
            </p>
          </div>
          <div class="mispedidos-filterblock-right">
            <input type="text" name="" class="mispedidos-filterblock-right-input-text" value="">
            <img src="/images/iteracion3/icon_search.png" alt="">
          </div>
        </div>





        <v-data-table
            v-bind:headers="headers"
            :items="items"
            hide-actions
            class="elevation-1"
            v-bind:pagination.sync="pagination"
            disable-initial-sort
            v-if="!loading_table"
            no-data-text=""
          >
          <template slot="items" slot-scope="props" >
            <td class="text-xs-center">{{ props.item.created_at }}</td>
            <td class="text-xs-center">{{ etiquetaEstados(props.item.gobuy_estado)}}</td>
            <td class="text-xs-center">{{ (props.item.gobuy_codetracking) }}</td>
            <td class="text-xs-center">{{ props.item.gobuy_valordeclarado }}</td>
            <td class="text-xs-center">{{ props.item.gobuy_piezas==0?'':props.item.gobuy_piezas }}</td>
            <td class="text-xs-center">{{ props.item.gobuy_peso }}</td>
            <td class="text-xs-center">{{ props.item.gobuy_costoenvio }}</td>
            <td class="text-xs-center">{{ props.item.gobuy_montoextra }}</td>
            <td class="text-xs-center"><span class="misPedidos-verDetalles" @click.prevent="verMasItem(props.item)">Ver detalles</span></td>
          </template>

        </v-data-table>
        <div class="text-center loading-w"  v-if="loading_table">
          <v-progress-circular indeterminate color="primary"></v-progress-circular>
        </div>
        <div class="text-xs-right pt-2"  v-if="!loading_table">
          <v-pagination class="select-item-style" v-model="pagination.page" :length="pages"></v-pagination>
        </div>







      </v-flex>

      <v-dialog
        v-model="modalPedidoDetail"
        fullscreen
        transition="dialog-bottom-transition">
        <div class="modal-open-login">
          <v-card class="wrapper-info-detalle wrapper-mipedido-detalle">
            <v-layout row wrap>
              <v-flex xs12 class="font-light  section-one-stepper">
              </v-flex>

              <v-flex xs12 class="goPedidoDetalle-tabla-w" v-if="itemPendiente!=null">
                <h3 class="head3 mb-3">DATOS DEL PEDIDO:</h3>
                <p><strong>Fecha de Registro:</strong><span v-text="itemPendiente.created_at"></span></p>
                <p><strong>Estado:</strong> <span>Pendiente</span></p>
                <p><strong>Tracking Code:</strong> <span v-text="itemPendiente.gobuy_codetracking">1203123LR</span></p>
                <p><strong>Valor Declarado US$:</strong> <span v-text="itemPendiente.gobuy_valordeclarado">3000</span></p>
                <p><strong>Piezas:</strong> <span v-text="itemPendiente.gobuy_piezas==0?'':itemPendiente.gobuy_piezas">01</span></p>
                <p><strong>Peso:</strong> <span v-text="itemPendiente.gobuy_peso">1.5KG</span></p>
                <p><strong>Costo de envio:</strong> <span v-text="itemPendiente.gobuy_costoenvio">4000</span></p>
              </v-flex>
              <div class="text-center" style="width: 100%" v-if="subidaresultado!=0">
                <span v-if="subidaresultado == 1">La constancia se ha enviado exitosamente</span>
              </div>
              <v-flex xs12 class="d-justify-center py-3">
                <v-btn v-if="subidaresultado != 1" round outline class="btn-send-next"  :loading="enviarConstanciaLoading" @click.native="cierraModalDetail">Cerrar</v-btn>
              </v-flex>
            </v-layout>
          </v-card>

          <div class="back-modal-active" @click.stop="cierraModalDetail()">_</div>
        </div>
      </v-dialog>

      <v-dialog
        v-model="modalComplete"
        fullscreen
        transition="dialog-bottom-transition">
        <div class="modal-open-login">
          <v-card class="wrapper-info-finish">
            <div class="font-regular">
              <img class="icon-close-modal" src="../../img/close_icon.png" alt="">
              <h3 class="font-bold pb-2">Gracias por registrar tu pedido</h3>
              <img src="../../img/qrmail.png" alt="">
              <p class="mt-2">La constancia se ha enviado exitosamente.</p>
            </div>
          </v-card>
          <div class="back-modal-active" @click.stop="cierraModalComplete()">_</div>
        </div>
      </v-dialog>


      <v-dialog
        v-model="modalContanciaLoaded"
        fullscreen
        transition="dialog-bottom-transition">
        <div class="modal-open-login">
          <v-card class="wrapper-info-detalle wrapper-mipedido-detalle">
            <v-layout row wrap>
              <v-flex xs12 class="font-light text-center section-one-stepper">
                <h2 class="font-medium pb-3">Documento cargado.</h2>
              </v-flex>
              <div class="text-center" style="width: 100%" v-if="subidaresultado!=0">
                <!-- <span v-if="subidaresultado == 1">La constancia se ha enviado exitosamente</span> -->
              </div>
              <v-flex xs12 class="d-justify-center py-3">
                <v-btn v-if="subidaresultado != 1" round outline class="btn-send-next" :disabled="enviarConstanciaLoading || enviarConstanciaCompletado" :loading="enviarConstanciaLoading" @click.native="enviarConstancia">Enviar constancia</v-btn>
              </v-flex>
            </v-layout>
          </v-card>

          <div class="back-modal-active" @click.stop="cierraModalConstancia()">_</div>
        </div>
      </v-dialog>

      <!-- // -->

      <v-navigation-drawer
        temporary
        v-model="drawerRight"
        disable-route-watcher
        disable-resize-watcher
        hide-overlay
        stateless
        touchless
        right
        light
        fixed
        class=" pb-3 drawer-admin-border d-flex justify-center" style="padding-top:83px;">

        <div class="text-center font-regular px-3">
          <div class="closeBar text-left" style="cursor:pointer" v-if="drawerRight" @click="drawerRight=false" ><i class="material-icons flechaback">keyboard_backspace</i></div>
          <template>
              <p class="px-4 mt-4 text-gray">Necesitamos los siguientes datos sobre tu pedido.</p>
              <div class="block-contenido px-2">
                <div class="border-b" :class="{'input-invalid': error_peso_producto}">
                  <input type="number" v-model="peso_producto" placeholder="¿Cuanto pesa?" min="1" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)"><span style="position: absolute;">Kg.</span>
                </div>
                <div class="border-b" :class="{'input-invalid': error_valor_producto}">
                  <input type="number" v-model="valor_producto" placeholder="Valor del producto"><span style="position: absolute;">USD $</span>
                </div>
                <div class="border-b" :class="{'input-invalid': error_direccion_producto}">
                  <input type="text" v-model="direccion_producto" placeholder="Dirección destino"><span style="position: absolute;"></span>
                </div>
                <div class="mispedidos-right">
                  <v-btn
                    flat
                    class="btn-carga-confirmacion"
                    @click="uploadgobuypedido">
                    <img src="/images/iteracion3/icon_subir_archivo.png" alt="">
                    <div class="">
                      ADJUNTAR COMPRA
                      <br><span>(.pdf o jpg)</span>
                    </div>
                  </v-btn>
                  <input style="display:none" type="file" name="filenamegobuypedido" id="filenamegobuypedido" @change="onFileChange">
                  <input style="display:none" type="file" ref="fileupload" name="filenamegobuypedido" id="filenamegobuypedido" @change="onFileChange">
                </div>
                <span class="error-msg" style="">{{msgErrorFile}}</span>
                <em class="info-load-img">{{file_uploaded_message}}</em>
                <div class="mt-5">
                  <h2 class="">Total: </h2>
                  <h1 class="text--red text-total">USD$ <span>{{costo_total}}</span></h1>
                </div>
                <span v-if="enviarConstanciaLoading">subiendo archivo ...</span>
                <div class="mt-3">
                  <v-btn v-if="subidaresultado != 1" round outline class="btn-send-next" :disabled="enviarConstanciaLoading || enviarConstanciaCompletado" :loading="enviarConstanciaLoading" @click.native="enviarConstancia">PAGAR Y ENVIAR</v-btn>
                  <!-- <v-btn round outline class="btn-send-next" :disabled="pagarBtnLoading" :loading="pagarBtnLoading">Siguiente</v-btn> -->
                </div>
                <div class="text-center" style="width: 100%" v-if="subidaresultado!=0">
                  <span v-if="subidaresultado == 1"></span>
                </div>
                <div class="text-center text--red mt-2" style="width: 100%" v-if="errorPago == 1">
                  <span>{{errorPagoMsg}}</span>
                </div>
                <div class="text-center text--red mt-2" style="width: 100%" v-if="errorTarjeta">
                  <span>Aun no ha registrado una tarjeta.</span>
                </div>
              </div>
          </template>
        </div>

      </v-navigation-drawer>
      <!-- // -->

    </v-layout>
  </v-container>
</template>






<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  data () {
    return {
      peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'},
      pagination: {
        rowsPerPage: 6,
        sortBy: 'gobuy_id', descending: true,
      },
      headers: [
        { text: 'Fecha',align: 'left',value: 'fecha'},
        { text: 'Estado', value: 'estado' },
        { text: 'Código de tracking', value: 'created_at' },

        { text: 'Valor declarado USD$', value: 'valordeclarado' },
        { text: 'Piezas', value: 'piezas' },
        { text: 'Peso Kg', value: 'peso' },
        { text: 'Costos de envío USD$', value: 'costo' },
        { text: 'Monto extra USD$', value: 'extra' },
        { text: 'Acciones', value: 'fecha_entrega' },
      ],
      itemPendiente:{
        created_at:'',
        gobuy_estado:'Pendiente',
        gobuy_codetracking:'',
        gobuy_valordeclarado:'',
        gobuy_piezas:'',
        gobuy_peso:'',
        gobuy_costoenvio:''
      },
      items: [
        // {
        //   // created_at:'28-07-2018',
        //   // gobuy_estado:'Pendiente',
        //   // gobuy_codetracking:'1203123LR',
        //   // gobuy_valordeclarado:'US$3000.00',
        //   // gobuy_piezas:'01',
        //   // gobuy_peso:'1.5KM',
        //   // gobuy_costoenvio:'S/.100.00'
        // }
      ],
      loading_table:true,
      modalContanciaLoaded:false,
      codigo_tracking:'',


      filenamegobuypedido:'',
      image:'',
      file_uploaded_message:'',
      loadFile:false,
      enviarConstanciaLoading:false,
      subidaresultado:0,
      enviarConstanciaCompletado:false,
      modalPedidoDetail:false,
      pagarBtnLoading:false,
      drawerRight: false,
      valor_producto:"",
      peso_producto:"",
      direccion_producto:"",
      valor_producto_c:"",
      peso_producto_c:"",
      error_valor_producto:false,
      error_peso_producto:false,
      error_direccion_producto:false,
      error_load_file:false,
      msgErrorFile:'',
      modalComplete: false,
      errorPago:0,
      errorPagoMsg:'',
      errorTarjeta: false
    }
  },
  mounted(){
    if(!this.$route.params.item_id){
      this.listarPedidosGobuy();
    }
  },
  methods: {
    etiquetaEstados:function(estado){
      if(estado==0){
        return "Registrado"
      }else if(estado==1){
        return "Recibido en Miami"
      }else if(estado==2){
        return "En tránsito"
      }else if(estado==3){
        return "En almacén Scharff (Lima)"
      }else if(estado==4){
        return "Entregado"
      }
    },
    listarPedidosGobuy:function(){
      var vm = this;
      var token = this.getLocalUser().token;

      axios({
        url:apiRutas.gobuypedido_lista,
        method:'get',
        params: {
          token:token
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data;
        vm.items = res.data;
        if(res.data.length>0){
        }
        vm.loading_table = false;
      }).catch(function (error) {
        console.log(error);
      });

    },
    enviarConstancia:function(){
        this.error_valor_producto=false;
        this.error_peso_producto=false;
        this.error_load_file = false;

        if(this.valor_producto==''){
          this.error_valor_producto = true;
        }
        if(this.peso_producto==''){
          this.error_peso_producto = true;
        }
        if(this.loadFile==false){
          this.error_load_file = true;
        }
        if(this.error_load_file){
          this.msgErrorFile="No se cargó ningun archivo.";
          return;
        } else {
          this.msgErrorFile='';
        }

        var tarjeta_id = this.$store.getters.loadStateTarjetaPredeterminada;
        if(tarjeta_id == -1) {
          this.errorTarjeta=true;
          return;
        }
        if(this.error_valor_producto || this.error_peso_producto || this.error_load_file) {
          return;
        }
        this.enviarConstanciaLoading = true;
        var token = this.getLocalUser().token;
        var usuario_id = this.getLocalUser().usuario2;

        var vm = this;


        var token = this.getLocalUser().token;
        var usuario_email = this.getLocalUser().usuario_email;
        axios({
          method:'post',
          url:apiRutas.gobuypedido_crear+'?token='+token,
          data: {
            //'usuario_id':usuario_id,
            'usuario_email':usuario_email,
            'gobuy_valordeclarado':vm.valor_producto,
            'gobuy_peso':vm.peso_producto,
            'gobuy_direccion_destino':vm.direccion_producto,
            'gobuy_costoenvio':vm.costo_total,
            tarjeta_id,
          },
          auth: {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        }).then(function(response){
          //alert(response.data.data.gobuy_id);
          let res = response.data;
          console.log(res);
          if(res.tipo == 1){
            vm.enviarConstanciaPaso2(response.data.data.gobuy_id);
          } else {
            //console.log('error pago');
            vm.errorPago=1;
            vm.enviarConstanciaLoading = false;
            vm.errorPagoMsg=res.mensajes[0];
          }

        }).catch(function(error){
          console.log(error);
          vm.subidaresultado = 2;
          vm.enviarConstanciaLoading = false;
          document.getElementById('filenamegobuypedido').value = '';
        });


        //

    },
    enviarConstanciaPaso2:function(gobuy_id){

      var vm = this;
      var csrf = document.head.querySelector('meta[name="csrf-token"]').content
      axios.post('/ajax/registro-constancia', {
        "imagen_name": vm.image,
        'gobuy_id':gobuy_id,
      },
      {headers: {
        'X-CSRF-Token': csrf,
      }})
      .then (function(response) {
        vm.enviarConstanciaLoading = false;
        let res = response.data;
        if(res.tipo == 1){
          vm.subidaresultado = 1;
          vm.enviarConstanciaCompletado = true;
          //vm.drawerRight=false;
          vm.modalComplete = true;
          document.getElementById('filenamegobuypedido').value = '';
          setTimeout(function(){
            vm.subidaresultado = 0;
            vm.modalContanciaLoaded = false;
            vm.enviarConstanciaCompletado = false;
            vm.image = "";
            const input = vm.$refs.fileupload;
            input.type = 'text';
            input.type = 'file';
            vm.file_uploaded_message="";
            vm.valor_producto = "";
            vm.peso_producto = "";
            vm.direccion_producto = "";
            vm.listarPedidosGobuy();
          },5000);
        }
      })
      .catch(function(err) {
        console.log(error);
        vm.subidaresultado = 2;
        vm.enviarConstanciaLoading = false;
        document.getElementById('filenamegobuypedido').value = '';
      })
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.file_uploaded_message = "Archivo seleccionado: "+files[0].name;
      this.createImage(files[0]);
      this.loadFile=true;
      this.msgErrorFile='';
    },

    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    uploadgobuypedido:function(){
      document.getElementById('filenamegobuypedido').click();
    },
    stateChangeRegister: function () {
      let topCero = window.scrollTo(0,0)
      this.$store.commit('setStateRegister', true)
    },
    verMasItem:function(item){
      var codigo = item.gobuy_codetracking;
      if(codigo==''||codigo==null){
        //codigo = "No se ha asignado un código a este pedido."
        this.modalPedidoDetail = true;
        this.itemPendiente = item;
      }else{
        this.$router.push({ name: 'go-buy-admin', params: { panel: 'mis-pedidos' ,item_id:codigo}});
      }

      // this.codigo_tracking = codigo;
      // this.modalContanciaLoaded = true;
    },

    cierraModalDetail(code){
      //this.$emit('openModalDetail', code)
      //document.getElementById('filenamegobuypedido').value = '';
      this.modalPedidoDetail = false;
    },
    cierraModalConstancia(code){
      //this.$emit('openModalDetail', code)
      document.getElementById('filenamegobuypedido').value = '';
      this.modalContanciaLoaded = false;
    },
    cierraModalComplete(){
      this.drawerRight=false
      this.modalComplete = false;
    },
    calculoCostoTotal(valor_producto,peso_producto) {
      var coto_fijo_vp;
      if(valor_producto=="" || peso_producto=="")
        return 0;
      if(valor_producto<=200){
        coto_fijo_vp= 5;
      } else {
          if(valor_producto>200 && valor_producto<=2000){
            coto_fijo_vp= 8;
          } else {
            coto_fijo_vp= 75;
          }
      }
      var peso=parseFloat(peso_producto).toFixed(1);//MONTO_A_COBRAR = [( COSTO_FIJO_VP + 5.5*PESO )]/0.7
      var costo= ( ((coto_fijo_vp + 5.5*peso))+2.5 ) /0.7;
      costo= costo*1.18;//add

      return costo.toFixed(1);
    }
  },
  computed: {
    pages () {
      if(this.items){
        return this.pagination.rowsPerPage ? Math.ceil(this.items.length / this.pagination.rowsPerPage) : 0
      }
    },
    filteredItems() {
      return this.items.filter((i) => {
        return !this.search_codigo || (i.pedido_codigo.indexOf(this.search_codigo) >= 0);
      })
    },
    costo_total(){
      //{16.15 + 7.25 x (PESO DEL PAQUETE) + 1.25 x (SI(PRECIO>200, (PRECIO/100 (redondeado para abajo)), 0)}     / (0.90)
      //Cotizador
      //16,15 + 7,25*KG + SI(PRECIO>200; (REDONDEAR.MENOS(PRECIO/100;1)) ;0 )

      /*Calculo anterior*/
      // var aux_monto;
      // if(this.valor_producto=="" || this.peso_producto=="")
      //   return 0;
      // if(this.valor_producto>200){
      //   aux_monto= Math.floor( (parseFloat(this.valor_producto)/100) *10)/10;
      // } else {
      //   aux_monto= 0;
      // }
      // var costo=  16.15 + 7.25*parseFloat(this.peso_producto) + aux_monto ;
      // return costo.toFixed(2);
      /*fin*/

      return this.calculoCostoTotal(this.valor_producto, this.peso_producto);
    },
    costo_total_c(){
      return this.calculoCostoTotal(this.valor_producto_c, this.peso_producto_c);
    }
  },
}
</script>


<style lang="scss">
    .container-mispedidos{
        width: 1175px;
        padding-left: 30px;
        padding-right:30px;
    }
    .input-invalid {
      border-bottom: 1px solid red !important;
    }
    .error-msg {
      font-size: 0.8rem;
      color: #ff535a;
    }
    .size-m {
      font-size: 19px;
      font-family: 'Carnas-Regular';
    }
    .block-info {
      position: relative;
      .p-text {
        font-family: 'Carnas-Regular';
        line-height: 16px;
        font-size: 13px;
      }
      img {
        height: 42px;
      }
      h4 {
        position: relative;
      }
    }

    .block-info h4::after {
      content: url(/images/arrow-small.png);
      position: absolute;
      z-index: 1;
      font-size: 20px;
      transform: scale(.4);
      left: 70px;
      top: -8px;
    }
    .block-info:nth-child(4) h4::after {
      content: '';
    }
    .mispedidos-notice {
      border: 1px solid #ff535a;
      padding: 12px 30px 11px;
      /* padding-right: 358px; */
      position: relative;
      background: #fff;
      display: block;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }
    .mispedidos-block {
      height: 323px;
    }
.text--red {
    color: #ff5e65;
}
.text-total {
  font-size: 25px;
  font-weight: 800;
}
.info-load-img {
  font-size: 11px;
  display: block;
  margin-top: 5px;
}
.block-contenido {
  max-width: 205px;
  margin: auto;
  margin-top: 2.5em;
}
.block-info-m {
  padding-top: 5px;
  border-right: 1px solid #c1bebe;
}

.border-all {
  border: 1px solid;
  border-radius: 8px;
  padding: 8px 4px;
  margin-bottom: 10px;
  input {
    width: 100%;
    text-align: center;
    outline: none;
  }
}
.border-b {
  border-bottom: 1px solid;
  margin-bottom: 30px;
  input {
    width: 100%;
    text-align: center;
    outline: none;
  }
}

p.mispedidos-notice-line1 {
    margin-bottom: 7px;
}

p.mispedidos-notice-line2 {
    font-family: Carnas-Regular;
    font-size: 13px;
    font-style: italic;
    margin-bottom: 2px;
    margin-top: 8px;
    line-height: 16px;
}
p.mispedidos-notice-line2 img{
  vertical-align: middle;
  top: -2px;
  position: relative;
}

button.btn-carga-confirmacion.btn.btn--flat {
    border: 1px solid #797979;
    padding-top: 3px;
    height: 45px;
    font-family: Carnas-Regular;
    font-size: 12px;
    margin: 0;
    width: 100%;
    border-radius: 3px;
}
button.btn-carga-confirmacion>div>div {
  text-align: left;
}
button.btn-carga-confirmacion span {
    color: #717171;
    text-transform: lowercase;
}
button.btn-carga-confirmacion img {
  padding-right: 8px;
  position: relative;
  top: -1px;
  padding-left: 5px;
  border-radius: 4px;
}
.text-gray {
  color: #555;
}
.mispedidos-filterblock{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}
.mispedidos-filterblock-left>p {
    font-size: 18px;
}
.mispedidos-filterblock-left>p {
    font-size: 18px;
}
input.mispedidos-filterblock-right-input-text {
    border: 1px solid #797979;
    border-radius: 4px;
    height: 39px;
    width: 301px;
    padding-left: 10px;
    max-width: 100%
}
.mispedidos-filterblock-right {
    position: relative;
}
.mispedidos-filterblock-right>img {
    position: absolute;
    right: 9px;
    top: 12px;
}
.wrapper-mipedido-detalle strong{
  width: 50%;
  display: inline-block;
}
.wrapper-mipedido-detalle p{
    margin-bottom: 5px;
}
.misPedidos-verDetalles {
    border-bottom: 1px solid #afafaf;
}
@media screen and (max-width: 1480px){
  .mispedidos-box-w.flex.md10{
    width: 100%;
    flex-basis: 100%;
    max-width: 100%;
  }
  .block-info h4::after {

    left: 92px;
  }

}
@media screen and (max-width: 960px) {
  .block-info h4:after {
    content: '';
  }
  .block-info {
    margin-bottom: 2em;
  }
  .block-info-m {
    border-right: 0;
  }
  .mispedidos-block {
    height: initial;
  }
}
@media screen and (max-width: 900px){
  .mispedidos-notice{
    flex-direction: column;
  }
  .mispedidos-right {
    margin-top: 8px;
  }
}
@media screen and (max-width: 900px){
  button.btn-carga-confirmacion.btn.btn--flat {
      font-size: 11px;
  }
  button.btn-carga-confirmacion.btn.btn--flat .btn__content {
      padding: 0 11px;
  }
}
@media screen and (max-width: 540px){
  .mispedidos-filterblock {
    flex-direction: column;
  }
}
@media screen and (max-width: 590px){
  button.btn-carga-confirmacion.btn.btn--flat {
      word-break: break-word;
  }
  button.btn-carga-confirmacion.btn.btn--flat .btn__content{
    padding: 0 11px;
    white-space: initial;
    word-wrap: break-word;
    word-break: break-word;
    display: inline-block;
    word-break: break-word;
    max-width: 100%;
  }
  button.btn-carga-confirmacion.btn.btn--flat {
      word-break: break-word;
      white-space: initial;
      word-wrap: break-word;
      word-break: break-word;
          height: auto;
  }
  .mispedidos-filterblock-right {
      max-width: 100%;
  }
}

@media screen and (max-width: 1200px){
  .container-mispedidos{
    padding-left: 0;
    padding-right: 0;
  }
}
@media screen and (max-width: 1264px){
  .block-info h4:after {
    right: -190px;
      top: -8px;
  }
}
@media screen and (max-width: 1360px){
  .block-info h4:after {
    -webkit-transform: scale(.3);
    transform: scale(.3);
    left: 85px;
  }
}
@media screen and (max-width: 1340px){
  .block-info h4:after {
    left: 78px;
  }
}
@media screen and (max-width: 1060px){
  .block-info h4:after {
    left: 56px !important;
  }
}
@media screen and (max-width: 1015px) {
  .block-info h4:after {
      left: 47px !important;
  }
}

.preview-uploadpedido img{
max-width: 100%;
padding: 17px 100px;
}
.mensaje-uploadpedido {
    padding: 34px 20px 40px;
}
.goPedidoDetalle-tabla-w {
  text-align: left;
}
.el_1543951255{
  display: none;
}
@media screen and (max-width: 960px) {
  .el_1543951256{
    display: none;
  }
  .el_1543951255{
    display: block;
  }
}
</style>
