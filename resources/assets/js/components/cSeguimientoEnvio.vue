<template>
  <v-flex xs12>
    <v-flex x12 class="text-center px-4 pt-5 pb-3 x12 x12 titulo-seguimiento">
      <h4 @click="gotoEnvioLista" class="head4 titulo-seguimiento__atras" ><i class="material-icons flechaback">keyboard_backspace</i> VOLVER AL HISTORIAL</h4>
      <h3 class="head3">SEGUIMIENTO DEL PEDIDO:</h3>

    </v-flex>
    <v-flex xs12 class="pa-3 mapa-seguimiento-w" >
        <gmap-map
          v-if="showMapa"
          :center="elcentro"
          :zoom="14"
          map-type-id="roadmap"
          class="px-4 "
          style="width: 100%; height: 100%;min-height: 22rem;"
          ref="exampleb"
          >
          <gmap-marker
            :position="{lat:pedido_latituddesde,lng:pedido_longituddesde}"
            :clickable="true"
            :icon="mapicon_a"
            @click="mapinfo_a=!mapinfo_a">
            <gmap-info-window v-if="mapinfo_a">
              <strong>Origen envío</strong>
            </gmap-info-window>
          </gmap-marker>
          <gmap-marker
            :position="{lat:pedido_latitudhasta,lng:pedido_longitudhasta}"
            :clickable="true"
            :icon="mapicon_b"
            @click="mapinfo_b=!mapinfo_b">
            <gmap-info-window v-if="mapinfo_b">
              <strong>Destino envío</strong>
            </gmap-info-window>
          </gmap-marker>

          <gmap-marker
            :position="currentLocation"
            :clickable="true"
            :icon="mapicon_moto"
            @click="center=currentLocation"
            v-if="lat!=0"
            >
            <gmap-info-window>
              <strong>Scharffer</strong>
              <div class="">
                {{nombreTransportista}}
              </div>
            </gmap-info-window>
          </gmap-marker>
          <gmap-polyline
            v-bind:path.sync="path"
            v-bind:clickable="true"
            v-bind:options="{ strokeColor:'#ffb517'}"
            >
          </gmap-polyline>
        </gmap-map>
        <!-- <div class="tiempo-recojo-w">
          <div class="">
            <h4 class="head4">SEGUIMIENTO DEL PEDIDO:</h4>
          </div>
        </div> -->
        <div class="area-white text-center pt-4 pb-4 seguimiento-texto">

          <div class="" v-if="nombreTransportista">

            <div class="text-center pt-2"><span>{{textoEstado}}</span></div>
            <div class="text-center st-3-scharffer  pb-3" id="seguimiento_picker" >

              <img src="/images/icon-jm.png" alt="">
              <div>
                <strong >{{nombreTransportista}}</strong> <br>
                <span class="hide-enpublico">Celular: {{telefonotransportista}}</span>
              </div>

            </div>

          </div>

          <p v-if="seguimientoAlert">{{seguimientoMalTexto}}</p>
          <div class="text-center pb-3 seguimiento-texto__leyenda">
            *La ubicación del Scharffer en el mapa se actualiza cada 5 segundos
          </div>
        </div>




      </v-flex>
  </v-flex>
</template>

<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  props:['envioid','transportista'],
  data() {
    return {
      currentLocation: {lat: -12.111062, lng: -77.0315913},
      currentLocationClient: {lat: -12.111062, lng: -77.0315913},
      nombreTransportista:'',
      tiempoRecojo:'60 - 120min',
      lat:'',
      lnt:'',
      showMapa:false,
      codigo_pedido:'',
      timer:null,
      mapicon_a:'http://maps.google.com/mapfiles/markerA.png',
      mapicon_b:'http://maps.google.com/mapfiles/markerB.png',
      path:[],
      pedido_latituddesde:null,
      pedido_longituddesde:null,
      pedido_latitudhasta:null,
      pedido_longitudhasta:null,
      fakemarks:null,
      mapinfo_a:false,
      mapinfo_b:false,
      transportistaId:null,
      transportistaFoto:'',
      telefonotransportista:'',
      //mapicon_moto:'/images/moto3-minil.png'
      mapicon_moto:'/images/motopin.png',
      seguimientoAlert:false,
      elcentro:'',
      textoEstado:'',
      seguimientoMalTexto:'El pedido no puede ser rastreado'



    }
  },
  mounted() {
    console.log("MOUNTED SEGUIMIENTO");
    console.log(this.envioid);
    var vm = this;

    var servicio_getPedido = apiRutas.pickapp_getSeguimiento+'/'+this.envioid;
    // var pro = localStorage.getItem("user_p_info");
    // pro = JSON.parse(pro);
    // var token = pro.token;

    //https://beta.pickapp.pe/pickapp/m/rest/pedido/getSeguimiento/1480?token=6c2ce248885b7441db50cff36f5a82d4

    //https://beta.pickapp.pe/pickapp/m/rest/pedido/getSeguimiento/?token=6c2ce248885b7441db50cff36f5a82d4

    axios.get(servicio_getPedido, {
      params: {
        //token:token
      }
    })
    .then(function(response){
      let res = response.data;
      var va_interval = true;
      if(res.tipo==1){
        console.log('loadPedidosDetailMas');
        vm.nombreTransportista = res.data.pedido_picker;

        vm.telefonotransportista = res.data.pedido_pickermovil;
        vm.codigo_pedido = res.data.pedido_codigo;
        vm.lat = parseFloat(res.data.pedido_pickerlatitud);
        vm.lnt = parseFloat(res.data.pedido_pickerlongitud);
        vm.elcentro={lat: vm.lat, lng:vm.lnt}

        // vm.pedido_latituddesde = parseFloat(res.data.pedido_latituddesde);
        // vm.pedido_longituddesde = parseFloat(res.data.pedido_longituddesde);
        // vm.pedido_latitudhasta = parseFloat(res.data.pedido_latitudhasta);
        // vm.pedido_longitudhasta = parseFloat(res.data.pedido_longitudhasta);
        //vm.pedido_latituddesde = parseFloat(res.data.pedido_latitudtransportista);
        //vm.pedido_longituddesde = parseFloat(res.data.pedido_longitudtransportista);


        //vm.pedido_latitudhasta = parseFloat(res.data.pedido_pickerlatitud);
        //vm.pedido_longitudhasta = parseFloat(res.data.pedido_pickerlongitud);
        vm.pedido_latituddesde = parseFloat(res.data.pedido_latituddesde);
        vm.pedido_longituddesde = parseFloat(res.data.pedido_longituddesde);
        vm.pedido_latitudhasta = parseFloat(res.data.pedido_latitudhasta);
        vm.pedido_longitudhasta = parseFloat(res.data.pedido_longitudhasta);

        vm.currentLocation = {
          lat: vm.lat, lng: vm.lnt
        };
        vm.showMapa = true;
        vm.transportistaId = res.data.pedido_transportistaid;

        vm.verSteps();
        //vm.cargarFoto();

      }else if(res.tipo==3){
        va_interval = false;
        vm.seguimientoMalTexto = res.mensajes[0];
        vm.seguimientoAlert = true;
      }else{
        vm.seguimientoAlert = true;
      }

      if(va_interval){
        vm.initInterval();
      }
    }).catch(function (error) {
      console.log(error);
      vm.seguimientoAlert = true;
    });




  },
  watch: {
    elestado:function(el){

    }

  },
  methods: {
    cargaBounds:function(){
      var vm = this;
      console.log("CARGA BOUNDS");
      let x = [];
      this.path.forEach(function(item) {
        x.push({position: {lat:item.lat, lng:item.lng}, data: item});
      });vm.lat

      x.push({position: {lat:vm.lat, lng:vm.lnt}, data: {lat:vm.lat, lng:vm.lnt}});
      vm.fakemarks = x;
      vm.$refs.exampleb.$mapCreated.then((map) => {
        const bounds = new google.maps.LatLngBounds()
        for (let m of vm.fakemarks) {
          bounds.extend(m.position)
        }
        vm.elcentro = bounds.getCenter();
        console.log(vm.elcentro);
        map.fitBounds(bounds);
      });
    },
    initInterval:function(){
      var vm = this;
        this.timer = setInterval(function(){
          vm.seguimiento();
        }, 5000);

    },
    gotoEnvioLista:function(){
      this.$emit('verHistorial', 'express');
      this.$router.push({ name: 'historial', params: { panel: 'express', panel_id: ''}});

    },
    seguimiento:function(){
      console.log('seguimiento');

      if(!document.getElementById('seguimiento_picker')){
          console.log('SALE seguimiento');
          clearInterval(this.timer);
      }

      var vm = this;

      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      //var token = pro.token;

      axios.get(apiRutas.pickapp_getSeguimiento+'/'+vm.envioid, {
        params: {
          //token:token
        }
      })
      .then(function(response){
        let res = response.data;

        if(res.tipo==1){
          //console.log('seguimiento');



          vm.lat = parseFloat(res.data.pedido_pickerlatitud);
          vm.lnt = parseFloat(res.data.pedido_pickerlongitud);

          vm.currentLocation = {
            lat: vm.lat, lng: vm.lnt
          }
          vm.elcentro = {
            lat: vm.lat, lng: vm.lnt
          };
          console.log(vm.elcentro);

          let elestado = res.data.pedido_estado;
          if(elestado=='1'){
            res = "Scharffer en camino:";
          }else if(elestado=='2'){
            res = "Scharffer en camino:";
          }else if(elestado=='3'){
            res = "El Scharffer esta llevando el envío.";
          }else if(elestado=='4'){
            res = "El Scharffer ha entregado el envío.";
          }else{
            res = "Scharffer en camino:";
          }

          vm.textoEstado = res;

        }else if(res.tipo==3){
          vm.textoEstado = res.mensajes[0];
          vm.seguimientoMalTexto = res.mensajes[0];

        }


      }).catch(function (error) {
        console.log(error);
      });






    },
    verSteps:function(){
      var vm = this;
      vm.calculandoDetalles = true;


      var directionsService = new google.maps.DirectionsService;
      directionsService.route({
        origin:vm.pedido_latituddesde+','+vm.pedido_longituddesde,
        destination:vm.pedido_latitudhasta+','+vm.pedido_longitudhasta,
               travelMode: 'DRIVING'
       },function(response, status) {
           if (status === 'OK') {
               console.log(response);
               let res = response;
               res.routes[0].legs[0].steps.forEach(function(step){
                 let lati=step.start_location.lat();
                 let lngi=step.start_location.lng();
                 let a = {lat:lati,lng:lngi};
                 vm.path.push(a);
               })
               var destino_aux = {
                 lat: vm.pedido_latitudhasta, lng: vm.pedido_longitudhasta
               }
               vm.path.push(destino_aux);
               vm.cargaBounds();

           }
       });
    },



  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.flechaback{
vertical-align: middle;
position: relative;
top: -2px;
}
.tiempo-recojo-w{
  text-align: center;
  margin-top: -33px;
  position: relative;
  &>div{
    background: #fff;
    padding: 6px 20px;
    display:inline-block;
  }
}
.mapa-seguimiento-w{

  max-width: 100%;
  margin-left:auto;
  margin-right:auto;
}
.area-white{
  background: #fff;
}
.titulo-seguimiento{
  position: relative;
}
.titulo-seguimiento__atras{
  position: absolute;
  left: 14px;
  top: 44px;
  width: auto;
  display: block;
  white-space: nowrap;
}
@media only screen and (max-width: 1120px) {
  .seguimiento-texto__leyenda {
      background: transparent ;
      position: static;
      bottom: -12px;
      padding-top: 21px;
      top: auto;
      right: 26px;
      font-family: Carnas-Regular;
  }
  .titulo-seguimiento__atras {
    left: 14px;
    top: 6px;
  }
}
</style>
