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
    >
    <template slot="items" slot-scope="props" >



      <td class="text-xs-center">{{ props.item.id }}</td>
      <td class="text-xs-center">{{ nameEstado(props.item.estado) }}</td>
      <td class="text-xs-center">{{ formatearFecha(props.item.created_at) }}</td>
      <td class="text-xs-center">{{ props.item.contacto }}</td>
      <td class="text-xs-center">{{ props.item.dni }}</td>
      <td class="text-xs-center">{{ props.item.correo }}</td>
      <td class="text-xs-center">{{ props.item.celular }}</td>
      <td class="text-xs-center">{{ formatearFecha(props.item.fecha_entrega) }}</td>
      <td class="text-xs-center">{{ props.item.fecha_recojo }}</td>
      <td class="text-xs-center"><span @click.prevent="verMasItem(props.item.codigo_recojo)">{{props.item.codigo_recojo!=null?props.item.codigo_recojo:'--'}}</span></td>
      <td class="text-xs-center">{{ props.item.total_pagado }}</td>
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
var config_axios = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  }
}

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
          { text: '#Reserva',align: 'left',value: 'id'},
          { text: 'Estado', value: 'estado' },
          { text: 'Fecha de solicitud', value: 'created_at' },

          { text: 'Nombre del contacto', value: 'contacto' },
          { text: 'DNI', value: 'dni' },
          { text: 'Correo electrónico', value: 'correo' },
          { text: 'Celular de contacto', value: 'celular' },
          { text: 'Fecha de entrega', value: 'entrega' },
          { text: 'Fecha de retiro', value: 'fecha_retiro' },
          { text: 'Código de retiro', value: 'codigo_retiro' },
          { text: 'Total pagado', value: 'total' },
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
      verMasItem:function(codigo){
        if(codigo==''||codigo==null){
          codigo = "No se ha asignado un código a esta reserva."
        }
        this.codigo_retiro = codigo;
        this.modalDetalles = true;
      },
      loadListaReservas:function(){
          var vm = this;
          var pro = localStorage.getItem("user_p_info");
          pro = JSON.parse(pro);
          var token = pro.token;


          var servicio_listaReservas = apiRutas.reserva_lista;

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

            vm.items = res.data;
            //console.log(res.data);
            vm.loading_table = false;
          });
      },
      loadListaReservasAux: function(){
        console.log('loadListaReservasAux');
         var querystring = require('querystring');
         var requestBody = querystring.stringify({
           'IDusuario':    '85'
         })
         var url = "http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/ListadoPorUsuario";
         var list = [];
         axios.post(url, requestBody, config_axios)
         .then((result) => {
           console.log("listado pedidos lockers");
           console.log(result);
           // let res = result.data;

         })
         .catch((err) => {
           // Do somthing
         })
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

      }
    }
  }
</script>

<style >
.loading-w{
  padding-top: 60px;
}
</style>
