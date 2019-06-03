<template>
  <v-container fluid class="pb-0 py-0 container-direcciones" >
    <v-layout row wrap >
      <v-flex xs12 sm6 md6 class="">
        <div class="direcciones-left">
          <div class="tarifa-loading-screen" :class="{'tarifa-loading-screen-active':ajustandodir}">


            <v-progress-circular :size="50" indeterminate color="primary"></v-progress-circular>

          </div>
          <input type="hidden" id="testing-code" :value="detalleInfo">
          <p class="direcciones-line2">{{detalleNombre}}</p>
          <p class="direcciones-line1">{{detalleDireccion}}</p>
          <p class="direcciones-line3">{{detalleCiudad}}</p>
          <p class="mb-1">Tel: {{detalleTelefono}}</p>
          <div class="direcciones-copiar-block">
            <a class="direcciones-left-copiarsi" @click.stop.prevent="copyText()">
              <img src="/images/iteracion3/icon_copiar.png" alt="">
              <span>copiar</span>
            </a>
            <span class="direccion-left-icon_info">
              <img src="/images/iteracion3/icon_info.png" alt="">
            </span>
          </div>
          <em v-if="showMsgCopy" id="showMsgCopy">{{msgCopy}}</em>
        </div>

        <p class="direcciones-notas">
          *Utiliza esta dirección para enviar tus compras online en páginas de
EEUU y lo recibiremos por ti.
        </p>
        <h3 class="py-2">Ejemplo:</h3>
        <figure class="mb-3">
          <img src="/images/ejemploGobuy.png" alt="" style="width:100%;max-width: 480px;">
        </figure>
      </v-flex>
      <v-flex xs12 sm6 md6  class="">
        <div class="direcciones-right text-center">
          <table class="direcciones-table">
            <thead>
              <th>Fecha</th>
              <th>Descripción</th>
            </thead>
            <tbody>
              <tr v-for="item in listAlertas">
                <td>{{ item.alerta_fecha }}</td>
                <td v-html="item.alerta_descripcion"></td>
              </tr>
              <tr style="
                  vertical-align: top;
                  height: 228px;
              ">
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      detalleNombre: '',
      detalleDireccion: '',
      detalleCiudad: '',
      detalleTelefono: '',
      detalleInfo: '',
      peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'},
      ListItems:[
        {title:'1.Regístrate', img: './images/icon_register.png', alt: 'Icon register', description: 'Crea tu cuenta' },
        {title:'2.Reserva', img: './images/icon_reserva.png', alt: 'Icon reserva', description: 'Separa el E-locker donde dejarás tu paquete y recibe tu código de envío.' },
        {title:'3.Usa tu código', img: './images/icon_usecode.png', alt: 'Icon QR', description: 'Ingresa tu código para entregar ó recoger tu paquete.' }
      ],
      listAlertas:[],
      ajustandodir:true,
      showMsgCopy:false,
      msgCopy:''
    }
  },
  mounted(){
    var vm=this;
    // var csrf = document.head.querySelector('meta[name="csrf-token"]').content

    var pro = localStorage.getItem("user_p_info");
    pro = JSON.parse(pro);
    let usuario_id = pro.id;
    let usuario_id2 = pro.usuario2;

    axios.post('/ajax/get-info-gobuy', {
      usuario_id,
      usuario_id2
    })
    .then (function(response) {
      let res = response.data;
      console.log(res);
      if(res.status == 1){
        vm.detalleDireccion=res.data.direccion;
        vm.detalleCiudad=res.data.ciudad;
        vm.detalleNombre=res.data.nombre;
        vm.detalleTelefono=res.data.telefono;
        vm.detalleInfo=res.data.nombre +" "+res.data.direccion+" "+res.data.ciudad+" "+res.data.telefono;
      }
      vm.ajustandodir = false;
    }).catch(()=>this.ajustandodir = false)
    //

    vm.listarAlertasGobuy();
  },
  methods: {
    stateChangeRegister: function () {
      let topCero = window.scrollTo(0,0)
      this.$store.commit('setStateRegister', true)
    },
    listarAlertasGobuy: function() {
      var vm=this;
      axios.get('/ajax/list-alert-gobuy')
      .then (function(response) {
        let res = response.data;
        console.log("alertas::::::::::::::::::::::");
        console.log(res);
        if(res.status == 1){
          vm.listAlertas=res.data;
          console.log(vm.listAlertas);
        }
        vm.ajustandodir = false;
      }).catch(()=>this.ajustandodir = false)
    },

    copiarTexto: function() {
      var copyText = document.getElementsByClassName("direcciones-line2");
      copyText.select();
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    },
    copyText: function () {
      var vm=this;
      let copyText = document.querySelector('#testing-code');
      copyText.setAttribute('type', 'text');
      copyText.select();
      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'Texto copiado' : 'Falló al copiar';
        vm.msgCopy= msg;
        //console.log(vm.msgCopy);
        vm.showMsgCopy = true;
        setTimeout(function(){
          vm.showMsgCopy = false;
        },1500);

      } catch (err) {

      }
      copyText.setAttribute('type', 'hidden')
      window.getSelection().removeAllRanges()
    },

  }
}
</script>

<style lang="scss">

    .container-direcciones{
      width: 1175px;
      padding-left: 30px;
      padding-right:30px;
    }
    .direcciones-left {
    border: 1px solid #ff535a;
    padding: 22px 30px 17px;
    padding-right: 104px;
    position: relative;
    background: #fff;
        margin-bottom: 20px;
            min-height: 117px;
}
.direcciones-left .tarifa-loading-screen-active.tarifa-loading-screen {
    z-index: 1;
}
p.direcciones-line1 {
    font-size: 17px;
    margin-bottom: 1px;
}

p.direcciones-line2 {
    font-size: 19px;
    font-family: Carnas-Bold;
    margin-bottom: -2px;
    text-transform: capitalize;
    word-break: break-word;
}

p.direcciones-line3 {
    font-size: 16px;
    margin-bottom: 0;
}

.direcciones-copiar-block {
    position: absolute;
    right: 20px;
    top: 23px;
}

a.direcciones-left-copiarsi {
    display: block;
    padding-bottom: 26px;
}

a.direcciones-left-copiarsi span {
    color: #333;
    text-decoration: underline;
    padding-left: 2px;
}
.direcciones-notas {
    padding-left: 21px;
    font-family: Carnas-Regular;
    font-size: 13px;
    padding-right: 20px;
}


.direcciones-right {
    padding-left: 28px;
}

table.direcciones-table {
    background: #fff;
    width: 100%;
    border: 1px solid #797979;
    border-collapse:  collapse;
}

table.direcciones-table th {
    font-family: Carnas-Medium;
    font-weight: 100;
    padding: 11px;
}

table.direcciones-table td {
    font-family: Carnas-Regular;
    font-weight: 100;
    padding: 9px;
    font-size: 13px;
    p{
      margin-bottom: 0px;
    }
}
table.direcciones-table td:first-child {
    font-size: 12px;
}
table.direcciones-table th:first-child,
table.direcciones-table td:first-child {
    border-right: 1px solid #e2e2e2;
    width: 82px;
}
table.direcciones-table tr:nth-child(2n+2) {
    background:#fafafa;
}
span.direccion-left-icon_info {
    display: block;
    text-align: right;
}
#showMsgCopy {
  font-family: Carnas-Regular;
  font-size: 12px;
  position: absolute;
  right: 16px;
  bottom: 5px;
  transition: all 2s ease-out;
}
@media screen and (max-width: 600px){
  .direcciones-right {
      padding-left: 0;
  }
}
@media screen and (max-width: 780px){
  .container-direcciones >div >.flex.sm6{
    max-width: 100%;
    flex-basis: 100%;
    /* > .direcciones-right {
        padding-left: 0;
    } */
  }
  .direcciones-right {
    padding-left: 0;
  }
  .p.direcciones-line2{
    font-size: 17px;
  }
  .p.direcciones-line1, p.direcciones-line3{
    font-size: 15px;
  }
}
@media screen and (max-width: 1200px){
  .container-direcciones{
    padding-left: 0;
    padding-right: 0;
  }
}
</style>
