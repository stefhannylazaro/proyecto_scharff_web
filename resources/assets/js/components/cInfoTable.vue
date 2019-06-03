<template>
<div>
  <v-card-title class="pt-0">

      <v-spacer></v-spacer>
      <v-text-field
        v-model="search_codigo"
        append-icon="search"
        label="Código de pedido"
        single-line
        hide-details
        class="search_codigo"



      ></v-text-field>
    </v-card-title>
  <v-data-table
      v-bind:headers="headers"
      :items="filteredItems"
      hide-actions
      class="elevation-1"
      disable-initial-sort
      v-bind:pagination.sync="pagination"
      v-if="!loading_table"
      no-data-text="No hay datos para mostrar."
      :search="search_codigo"
    >


    <template slot="items" slot-scope="props">
      <td>{{ props.item.pedido_id }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ procesaEstado(props.item.pedido_estado) }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_calledesde }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_callehasta }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_personacontactoreceptor }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_fechacreacion }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_fechallegada?props.item.pedido_fechallegada:'--' }}</td>
      <td class="text-center" @click="verMasItem(props.item)">{{ props.item.pedido_cuantopaga }}</td>
      <td class="text-center text-underlined" @click="verMasItem(props.item)">
        {{props.item.pedido_estado==4?'Ver mas':'Seguimiento'}}
      </td>
      <td class="text-center" :class="{'text-underlined':props.item.pedido_estado==4}" @click="calificar(props.item)">
        {{props.item.pedido_estado==4?'Calificar':'--'}}
      </td>

      <td class="hidden-td">
        {{props.item.pedido_codigo}}
      </td>
    </template>
    <v-alert slot="no-results" :value="true" color="error" icon="warning">
        No se encontró ningun pedido con el código "{{ search_codigo }}".
    </v-alert>
  </v-data-table>
  <div class="text-center loading-w"  v-if="loading_table">
    <v-progress-circular indeterminate color="primary"></v-progress-circular>
  </div>
  <div class="text-xs-right pt-2"  v-if="!loading_table">
    <v-pagination class="select-item-style" v-model="pagination.page" :length="pages"></v-pagination>
  </div>

  <v-dialog
      v-model="modalCalificar"
      v-if="modalCalificar"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login modal-calificar">

        <v-card class="wrapper-info-detalle">
          <img class="icon-close-modal" src="../../img/close_icon.png" alt="" @click="modalCalificar=false">
            <h3 v-if="item_picker.pedido_calificacion=='0.00'">Califica a nuestro Scharffer:</h3>
            <h3 v-else>Ya calificaste este envío</h3>

            <div class="text-center st-3-scharffer pb-4" v-if="item_picker">
              <img src="/images/icon-jm.png" alt="" > <strong>{{item_picker.pedido_transportista}}</strong>

            </div>

            <div class="calificar__estrellas">
              <span class="calificar_img" :class="{'calificar_img_this':calificacion_cvalue>0||parseInt(item_picker.pedido_calificacion)>0}" @click="calificar_con(1)"></span>
              <span class="calificar_img" :class="{'calificar_img_this':calificacion_cvalue>1||parseInt(item_picker.pedido_calificacion)>1}" @click="calificar_con(2)"></span>
              <span class="calificar_img" :class="{'calificar_img_this':calificacion_cvalue>2||parseInt(item_picker.pedido_calificacion)>2}" @click="calificar_con(3)"></span>
              <span class="calificar_img" :class="{'calificar_img_this':calificacion_cvalue>3||parseInt(item_picker.pedido_calificacion)>3}" @click="calificar_con(4)"></span>
              <span class="calificar_img" :class="{'calificar_img_this':calificacion_cvalue>4||parseInt(item_picker.pedido_calificacion)>4}" @click="calificar_con(5)"></span>
            </div>
            <div class="calificar__btn-aceptar" style="padding-top: 8px;margin-bottom: -24px;">
              <v-flex xs12 class="d-justify-center" v-if="item_picker.pedido_calificacion=='0.00'">
                <v-btn round outline :disabled="!calificacion_puedeir || calificarAceptarBtnLoading" v-if="calificacion_aceptada_bol==0" :loading="calificarAceptarBtnLoading"class="btn-send-next" @click="efecto_aceptar_calificacion">Aceptar</v-btn>

              </v-flex>
              <small v-if="calificacion_aceptada_bol==3">Calificación exitosa</small>
            </div>
        </v-card>
        <div class="back-modal-active" @click.stop="closeModalCalificar()">_</div>
      </div>
    </v-dialog>


  <v-dialog
    v-model="modalDetalles"
    fullscreen
    transition="dialog-bottom-transition">
    <div class="modal-open-login">
      <v-card class="wrapper-info-detalle">
        <v-layout row wrap>
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium pb-3">Detalle de envío</h2>
          </v-flex>
          <v-flex xs12 white>
            <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
              <div class="text-left">
                <h4 class="red--text">Origen</h4>
                <p class="small-text">
                  {{detailUserAddress}}<br>{{detailUserNumber}}

                </p>
              </div>
              <div class="info-time-delivery d-align-between">
                <img :src="iconTimerOrange.url" :alt="iconTimerOrange.alt">
                <p class="text-end pr-3">
                  TIEMPO APROX. DE RECOJO {{tiempoEstimado}}
                </p>
              </div>
            </v-card>
            <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
              <div class="text-left">
                <h4 class="green--text">Destino</h4>
                <p class="small-text">
                  {{detailClientAddress}}<br>{{detailClientNumber}}
                </p>
              </div>
              <div class="info-time-delivery d-align-between">
                <img :src="iconTimer.url" :alt="iconTimer.alt">
                <p class="text-end pr-3">
                  TIEMPO APROX. DE RECOJO {{tiempoEstimado}}
                </p>
              </div>
            </v-card>
            <v-card class="elevation-0 d-align-between ma-3 ">
              <div>

              </div>
              <div class="info-time-delivery d-align-between" v-if="!usuario_corporativo">
                <img :src="iconMoney.url" :alt="iconMoney.alt">
                <div style="width:10rem" class="align-elements-end pr-3">
                  <span>
                    Monto a cancelar
                  </span>
                  <span>
                    <strong>
                      S/.{{formatearAmount(detailAmountPayable)}}
                    </strong>
                  </span>
                </div>
              </div>
            </v-card>
          </v-flex>
          <v-flex xs12 class="d-justify-center py-3">
            <v-btn round outline class="btn-send-next" @click.native="modalDetalles=false">cerrar</v-btn>
          </v-flex>
        </v-layout>
      </v-card>

      <div class="back-modal-active" @click.stop="cierraModalDetail()">_</div>
    </div>
  </v-dialog>




</div>
</template>
<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
  export default {
    data () {
      return {
        // searchAddressInput: ''
        iconMoney: {url: '/images/icon_money.svg', alt: 'icon money' },
        iconTimer: {url: '/images/icon_time_green.svg', alt: 'icon time green' },
        iconTimerOrange: {url: '/images/icon_time_orange.svg', alt: 'icon time orange' },
        pagination: {
          rowsPerPage: 6,
          sortBy: 'id', descending: true,
        },
        headers: [










          { text: '#Pedido',align: 'left',value: 'pedido_id',},
          { text: 'Estado', value: 'pedido_estado' },
          { text: 'Origen del pedido', value: 'pedido_calledesde' },
          { text: 'Destino del pedido', value: 'pedido_callehasta' },
          { text: 'Contacto de entrega', value: 'pedido_personacontactoreceptor' },
          { text: 'Fecha y hora de pedido', value: 'pedido_fechacreacion' },
          { text: 'Fecha y hora de entrega', value: 'pedido_fechallegada' },
          { text: 'Total pagado', value: 'pedido_cuantopaga' },
          { text: 'Detalle', value: 'detalle', sortable: false },
          { text: 'Acción', value: 'calificar', sortable: false},
          { text: 'Codigo', value: 'pedido_codigo', class:"hidden-header" },
        ],
        items: [
        ],
        modalDetalles : false,
        detailUserAddress:'',
        detailUserNumber:'',
        detailClientAddress:'',
        detailClientNumber:'',
        detailAmountPayable:'',
        tiempoEstimado:'60 - 120min',
        loading_table:true,
        modalCalificar:false,
        item_picker:null,
        calificacion_cvalue:0,
        calificacion_puedeir:false,
        calificacion_aceptada_bol:0,
        usuario_corporativo:false,
        search_codigo:'',
        calificarAceptarBtnLoading:false
      }
    },mounted(){
      this.loadPedidosList();



      var p_token = localStorage.getItem("p_token");
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      if(pro==null){
        return;
      }
      if(pro.usuario_escorporativo){
        this.usuario_corporativo = true;
      }
      console.log("MOUNTED infotable");
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
      }
    },
    methods:{
      formatearAmount:function(monto){
        var twoPlacedFloat = parseFloat(monto).toFixed(2)

        return twoPlacedFloat;
      },
      procesaEstado:function(estado){
        if(estado==2){
          return "Aceptado";
        }else if(estado==3){
          return "Recogido";
        }else if(estado==4){
          return "Entregado";
        }else if(estado==5){
          return "No recogido";
        }else if(estado==6){
          return "No entregado";
        }else{
          return estado;
        }
      },
      verMasItem:function(n_item){
        var vm = this;
        if(n_item.pedido_estado==1||n_item.pedido_estado==2||n_item.pedido_estado==3){
          vm.$emit('verSeguimiento', n_item.pedido_codigo);
          //this.openModalDetail();
          return;
        }else if(n_item.pedido_estado==4){
          this.openModalDetail();
          //vm.$emit('verSeguimiento', n_item.pedido_id);
        }


        var servicio_getPedido = apiRutas.pickapp_getPedidoRecibir+'/'+n_item.pedido_id;
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;


        axios.get(servicio_getPedido, {
          params: {
            token:token
          }
        })
        .then(function(response){
          let res = response.data;

          if(res.tipo==1){
            console.log('loadPedidosDetail');
            vm.detailUserAddress = res.data.pedido_calledesde;
            vm.detailUserNumber = res.data.pedido_numeroemisor;
            vm.detailClientAddress = res.data.pedido_callehasta;
            vm.detailClientNumber = res.data.pedido_numeroreceptor;
            vm.detailAmountPayable = res.data.pedido_cuantopaga+parseFloat(res.data.pedido_comision);
            //vm.detailAmountPayable = 213123.123123123123123213213;

          }

        }).catch(function (error) {
          console.log(error);
        });


      },
      openModalDetail(){
        this.modalDetalles = true;
      },
      cierraModalDetail(code){
        //this.$emit('openModalDetail', code)
        this.modalDetalles = false;
      },openModalCalificar(code){
        //this.$emit('openModalDetail', code)
        this.modalCalificar = true;
      },closeModalCalificar(code){
        //this.$emit('openModalDetail', code)
        this.modalCalificar = false;
      },loadPedidosList:function(){
        var vm = this;

        var servicio_pedidosList = apiRutas.pickapp_getMisPedidos+'/1/10';
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        if(pro==null){
          return;
        }
        var token = pro.token;

        axios.get(servicio_pedidosList, {
          params: {
            token:token
          }
        })
        .then(function(response){
          let res = response.data;
          //console.log('loadPedidosList');
          //console.log(res.data);
          if(res.tipo==1){
          vm.items = res.data;
          console.log('ocurre?');
          console.log(vm.items);
          }
          vm.loading_table = false;
          //console.log(vm.items);

        }).catch(function (error) {
          console.log(error);
          vm.loading_table = false;
        });

      },
      calificar(item_picker){
        console.log(item_picker);

        this.calificacion_aceptada_bol = 0;
        if(item_picker.pedido_estado!=4){
          this.verMasItem(item_picker);
          return false;
        }
        this.modalCalificar = true;
        this.item_picker = item_picker;
        this.calificacion_cvalue = 0;
      },
      calificar_con:function(calificacion){
        this.seVaCalificarCon = calificacion;

        if(this.item_picker.pedido_calificacion!='0.00'){
          return false;
        }
        this.calificacion_cvalue=calificacion;
        this.calificacion_puedeir = true;


      },
      efecto_aceptar_calificacion:function(){
        this.calificarAceptarBtnLoading =  true;
        var vm = this;
        var pedido_id = vm.item_picker.pedido_id;
        var seVaCalificarCon = vm.seVaCalificarCon;

        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;

        var servicio_calificar_pedido = apiRutas.pickapp_calificar+'/'+pedido_id+'/'+seVaCalificarCon+'?token='+token;
        axios.post(servicio_calificar_pedido)
        .then(function(response){
          let res = response.data;
          console.log('servicio_calificar_pedido');
          vm.calificacion_aceptada_bol = 3;
          vm.item_picker.pedido_calificacion = seVaCalificarCon;
          vm.calificarAceptarBtnLoading =  false;
          setTimeout(function(){
           vm.modalCalificar = false;
         },3500);

        }).catch(function (error) {
          console.log(error);
          vm.calificarAceptarBtnLoading =  false;
        });


      }

    }
  }
</script>

<style media="screen">

.modal-calificar h3 {
  font-weight: 500;
  font-family: Carnas-Bold;
}

.calificar__estrellas {
    width: 223px;
    display: flex;
    flex-direction: row;
    position: relative;
    margin: auto;
    margin-bottom: 10px;
        margin-top: 5px;
    justify-content: space-between;
}
.calificar__estrellas i {
    width: 20%;
    color: #ff535a;
    cursor:pointer;
}
.calificar__estrellas i.calificar__estrellas--limite~i{
  color:#000;
}
.wrapper-info-detalle h4{
  font-weight: 400;
  font-family: Carnas-Bold;
}
.calificar_img{
  height: 37px;
  width: 38px;
  display: block;
  background:url('/images/estrella0.png')
}
.calificar_img.calificar_img_this{
  background:url('/images/estrella.png')
}
.modal-calificar .wrapper-info-detalle {
    width: 28rem;
    padding: 3.5rem 3rem;
}
.st-3-scharffer strong {
    font-size: 17px;
}
.modal-calificar h3 {
    font-size: 20px;
}
.search_codigo{
flex: initial;
width: 251px;
display: block;
}
.hidden-header,.hidden-td{
  display: none;
}
</style>
