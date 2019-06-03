<template>
<div>
  <v-data-table
      v-bind:headers="headers"
      :items="items"
      hide-actions
      class="elevation-1"
      v-bind:pagination.sync="pagination"
      disable-initial-sort
      v-if="!loading_table"
      no-data-text=""
      id="historial-regular-table"
    >
    <template slot="items" slot-scope="props" >

      <td class="text-xs-center" @click="verMasItem(props.item)">Ver mas</td>
      <td class="text-xs-center">{{ props.item.id }}</td>
      <td class="text-xs-center">
        <a v-if="props.item.regular_codetracking"
        :href="mask_tracking(props.item.regular_codetracking)" target="_blank">
          {{ props.item.regular_codetracking }}
        </a>
      </td>
      <td class="text-xs-center">{{ props.item.origen_direccion_full }}</td>
      <td class="text-xs-center">{{ direccion_origen_resumen(props.item)}}</td>
      <!-- <td class="text-xs-center">{{ props.item.origen_ubigeo}}</td> -->
      <td class="text-xs-center">{{ props.item.origen_referencia}}</td>
      <td class="text-xs-center">{{ props.item.origen_remitente}}</td>
      <td class="text-xs-center">{{ props.item.origen_celular}}</td>

      <td class="text-xs-center">{{ props.item.destino_direccion_full }}</td>
      <td class="text-xs-center">{{ direccion_destino_resumen(props.item)}}</td>
      <!-- <td class="text-xs-center">{{ props.item.destino_ubigeo}}</td>
      <td class="text-xs-center">{{ props.item.destino_interior}}</td> -->
      <td class="text-xs-center">{{ props.item.destino_referencia}}</td>
      <td class="text-xs-center">{{ props.item.destino_remitente}}</td>
      <td class="text-xs-center">{{ props.item.destino_celular}}</td>
      <td class="text-xs-center">{{ dimensiones_envio(props.item)}}</td>
      <!-- <td class="text-xs-center">{{ props.item.ancho}}</td>
      <td class="text-xs-center">{{ props.item.altura}}</td>
      <td class="text-xs-center">{{ props.item.profundidad}}</td> -->
      <td class="text-xs-center">{{ props.item.peso+'kg.'}}</td>
      <td class="text-xs-center">{{ tiempo_envio(props.item.tiempo)}}</td>
      <td class="text-xs-center">{{ 's/.'+props.item.costo_total}}</td>
      <td class="text-xs-center">{{ props.item.created_at}}</td>

    </template>

  </v-data-table>
  <div class="text-center loading-w"  v-if="loading_table">
    <v-progress-circular indeterminate color="primary"></v-progress-circular>
  </div>
  <div class="text-xs-right pt-2"  v-if="!loading_table">
    <v-pagination class="select-item-style" v-model="pagination.page" :length="pages"></v-pagination>
  </div>



  <v-dialog
    v-model="modalDetalles"
    fullscreen
    transition="dialog-bottom-transition">
    <div class="modal-open-login">
      <v-card class="wrapper-info-detalle">
        <v-layout row wrap>
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium pb-3">Código de retiro</h2>
          </v-flex>
          <v-flex xs12 white>
            <v-card class="elevation-0 ma-3 border-bottom-list">
              <div xs12 class="text-center">
                <p>{{codigo_retiro}}</p>

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

          { text: 'Acción',align: 'left',value: 'id'},
          { text: '#Envio',align: 'left',value: 'id'},
          { text: '#Rastreo',align: 'left',value: 'regular_codetracking'},
          { text: 'Ubicación remitente',align: 'left',value: 'origen_direccion_full'},
          { text: 'Calle remitente',align: 'left',value: 'origen_calle'},
          { text: 'Referencia origen', value: 'origen_referencia' },
          { text: 'Nombre del remitente', value: 'origen_remitente' },
          { text: 'Celular remitente', value: 'origen_celular' },

          { text: 'Ubicación destino', value: 'destino_direccion_full' },
          { text: 'Calle destino', value: 'destino_calle' },
          { text: 'Referencia destino', value: 'destino_referencia' },
          { text: 'Nombre del destinatario', value: 'destino_remitente' },
          { text: 'Celular destinatario', value: 'destino_celular' },
          { text: 'Dimensiones del envío', value: 'dimensiones_envio' },
          { text: 'Peso del envío', value: 'peso' },
          { text: 'Tiempo de envío', value: 'tiempo' },
          { text: 'Costo', value: 'costo_total' },
          { text: 'Fecha de envío', value: 'created_at' }

        ],
        items: [],
        modalDetalles : false,
        detailUserAddress:'Estadio Nacional, Calle Jose Diaz, Cercado de Lima, Peru <br/> Numero - 123456789',
        detailClientAddress:'Estadio Nacional, Calle Jose Diaz, Cercado de Lima, Peru <br/> Numero - 123456789 ',
        detailAmountPayable:'8',
        user_id:'',
        codigo_retiro:'',
        loading_table:true,
      }
    },
    computed: {
      pages () {
        return this.pagination.rowsPerPage ? Math.ceil(this.items.length / this.pagination.rowsPerPage) : 0
      }
    }, mounted(){

      var vm = this;
      var user_info = localStorage.getItem("user_p_info");
      user_info = JSON.parse(user_info);
      vm.user_id = user_info.id;
      vm.loadListaReservas();



    },methods:{
      // biddingTRclicks:function(){
      //
      //   var table = document.getElementById("historial-regular-table").firstChild;
      //   var rows = table.getElementsByTagName("tr");
      //   for (let i = 0; i < rows.length; i++) {
      //     var currentRow = table.rows[i];
      //     var createClickHandler = function(row) {
      //       return function() {
      //         var cell = row.getElementsByTagName("td")[0];
      //         var id = cell.innerHTML;
      //         alert("id:" + id);
      //       };
      //     };
      //     currentRow.onclick = createClickHandler(currentRow);
      //   }
      // },
      mask_tracking:function(a){
        if(window.location.href.indexOf("localhost") > -1) {
          return 'http://localhost:8000/#tracking_'+a;
        }else if(window.location.href.indexOf("holascharff") > -1){
          return 'https://holascharff/#tracking_'+a;
        }else {
          return 'http://sw-dev.janaq.pro/#tracking_'+a;
        }
      },
      verMasItem:function(item){
        //let item_id = item.regular_codetracking;
        let item_id = item.id;
        if(item_id==''||item_id==null){
          //codigo = "No se ha asignado un código a este pedido."
        }else{
          this.$router.push({ name: 'historial', params: { panel: 'regular' ,item_id:item_id}});
        }

        // this.codigo_tracking = codigo;
        // this.modalContanciaLoaded = true;
      },
      loadListaReservas:function(){

          var vm = this;
          var pro = localStorage.getItem("user_p_info");
          pro = JSON.parse(pro);
          var token = pro.token;


          var servicio_listaReservas = apiRutas.regular_lista;

          axios({
            url:servicio_listaReservas,
            method:'get',
            params: {
              token:token
            },
            auth : {
              username: 'admin@pickapp.com',
              password: 'PickJanaq18'
            }
          }).then(function(response){
            let res = response.data;
            if(res.status==1){
              vm.items = res.data;
              // setTimeout(function(){
              //   vm.$nextTick(function() {
              //       vm.biddingTRclicks();
              //   });
              // },1000)

            }
            vm.loading_table = false;
          });
      },
      openModalDetail(code){
        //this.$emit('openModalDetail', code)
        this.modalDetalles = true;
      },
      cierraModalDetail(code){
        //this.$emit('openModalDetail', code)
        this.modalDetalles = false;
      },
      nameEstado(code){
        if(code==1){
          return "Reserva en Proceso";
        }else if(code==2){
          return "Reservado";
        }else if(code==3){
          return "Entregado";
        }else if(code==4){
          return "Retirado";
        }
      },
      formatearFecha(fecharaw){

        console.log(fecharaw);
        if(fecharaw!=null){

          var fechaAr = fecharaw.split(" ");
          //fechaAr = fecharaw[0];
          if(fechaAr[0]){
            var fechaA = fechaAr[0].split('-').reverse().join('/');
            return fechaA + ' '+fechaAr[1];
          }else{
            return '--';
          }
        }else{

          return '--';
        }

      },
      direccion_origen_resumen:function(item){
        let direccion = item.origen_calle;
         if(item.origen_interior!=''){
           direccion = direccion + ', '+item.origen_interior;
         }
         return direccion;
      },
      direccion_destino_resumen:function(item){
        let direccion = item.destino_calle;
         if(item.destino_interior!=''){
           direccion = direccion + ', '+item.destino_interior;
         }
         return direccion;
      },
      dimensiones_envio:function(item){
        let dimenciones = item.ancho + 'cm x ' +item.altura+ 'cm x ' +item.profundidad+'cm';
        return dimenciones;
      },
      tiempo_envio:function(tiempo_code){
        if(tiempo_code==0){
          return "24h";
        }else {
          if(tiempo_code==1){
            return "72h";
          } else {
            return "+72h";
          }
        }
      },
    }
  }
</script>

<style >
.loading-w{
  padding-top: 60px;
}
</style>
