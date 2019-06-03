<template>
  <v-flex xs12>
    <v-flex x12 class="text-left px-4 pt-4 pb-4 x12 x12 goPedidoDetalle-titulo">
      <h4 @click="gotoPedidosLista" class="head4 goPedidoDetalle__atras" ><i class="material-icons flechaback">keyboard_backspace</i> {{codigo_tracking_msk}}</h4>
    </v-flex>


    <v-flex xs12 class="goPedidoDetalle-tabla-w" v-if="tracking_loaded">
      <h3 class="head3 mb-3 ">DATOS DEL ENVÍO REGULAR:</h3>
      <div class="el_1543338093">
        <p><strong>Altura:</strong><span v-text="pedidoItem.altura+'cm.'"></span></p>
        <p><strong>Ancho:</strong><span v-text="pedidoItem.ancho+'cm.'"></span></p>
        <p><strong>Profundidad:</strong><span v-text="pedidoItem.profundidad+'cm.'"></span></p>
        <p><strong>Peso:</strong><span v-text="pedidoItem.peso+'kg.'"></span></p>

        <p><strong>Costo total:</strong><span v-text="'S/.'+pedidoItem.costo_total"></span></p>
        <p><strong>Destino calle:</strong><span v-text="pedidoItem.destino_calle"></span></p>
        <p><strong>Destino celular:</strong><span v-text="pedidoItem.destino_celular"></span></p>
        <p><strong>Destino direccion_full:</strong><span v-text="pedidoItem.destino_direccion_full"></span></p>
        <p><strong>Destino interior:</strong><span v-text="pedidoItem.destino_interior"></span></p>
        <p><strong>Destino referencia:</strong><span v-text="pedidoItem.destino_referencia"></span></p>
        <p><strong>Destino remitente:</strong><span v-text="pedidoItem.destino_remitente"></span></p>
        <p><strong>Destino ubigeo:</strong><span v-text="pedidoItem.destino_ubigeo"></span></p>
        <p><strong>Origen calle:</strong><span v-text="pedidoItem.origen_calle"></span></p>
        <p><strong>Origen celular:</strong><span v-text="pedidoItem.origen_celular"></span></p>
        <p><strong>Origen direccion full:</strong><span v-text="pedidoItem.origen_direccion_full"></span></p>
        <p><strong>Origen interior:</strong><span v-text="pedidoItem.origen_interior"></span></p>
        <p><strong>Origen referencia:</strong><span v-text="pedidoItem.origen_referencia"></span></p>
        <p><strong>Origen remitente:</strong><span v-text="pedidoItem.origen_remitente"></span></p>
        <!-- <p><strong>Origen ubigeo:</strong><span v-text="pedidoItem.origen_ubigeo"></span></p> -->
        <p><strong>Regular codetracking:</strong><span v-text="pedidoItem.regular_codetracking"></span></p>
        <p><strong>Tiempo:</strong><span v-text="tiempo_envio(pedidoItem.tiempo)"></span></p>
        <p><strong>ID:</strong><span v-text="pedidoItem.id"></span></p>
        <p><strong>Registrado:</strong><span v-text="pedidoItem.created_at"></span></p>


      </div>
    </v-flex>
  </v-flex>
</template>

<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  props:['itemId','detalleDe'],
  data() {
    return {
      pedidoItem:{
        altura:'',
        ancho:'',
        costo_total:'',
        created_at:'',
        destino_calle:'',
        destino_celular:'',
        destino_direccion_full:'',
        destino_interior:'',
        destino_referencia:'',
        destino_remitente:'',
        destino_ubigeo:'',
        id:'',
        origen_calle:'',
        origen_celular:'',
        origen_direccion_full:'',
        origen_interior:'',
        origen_referencia:'',
        origen_remitente:'',
        origen_ubigeo:'',
        peso:'',
        profundidad:'',
        regular_codetracking:'',
        tiempo:''
      },
      tracking_loaded:false
    }
  },
  mounted() {
    console.log("MOUNTED SEGUIMIENTO");
    console.log(this.envioid);
    var vm = this;


      this.buscarPorTracking();


  },
  watch: {
  },
  methods: {
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
    etiquetaEstados:function(estado){
      if(!estado||estado==0){
        return "Pendientes"
      }else if(estado==1){
        return "Entregado"
      }
    },
    gotoPedidosLista:function(){
      if(this.detalleDe=='regular'){
        this.$router.push({ name: 'historial', params: { panel: 'regular', panel_id: ''}});
      }
    },
    buscarPorTracking:function(){
      var vm = this;
      var token = this.getLocalUser().token;

      axios({
        //url:apiRutas.regular_buscarportracking,
        url:apiRutas.regular_buscarporid,
        method:'get',
        params: {
          token:token,
          tracking_code:vm.itemId
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data;
        vm.pedidoItem = res.data;
        vm.tracking_loaded = true;
        if(res.data.length>0){
        }

      }).catch(function (error) {
        vm.tracking_loaded = true;
        console.log(error);
      });
    },
  },computed:{
    codigo_tracking_msk:function(){
      if(this.itemId==0){
        return "Pedido";
      }else{
        return 'Envío regular '+this.itemId;
      }
    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.el_1543338093 p{
  display: flex;
}
.el_1543338093 strong{
  flex: 0 0 177px;
}
.goPedidoDetalle-titulo {
    background: white;
}
h4.head4.goPedidoDetalle__atras {
    font-size: 25px;
}
.goPedidoDetalle-tabla-w {
    background: white;
    margin-top: 45px;
    border: 1px solid #ff535a;
    padding: 26px 28px 12px;
    width: 700px;
    margin-left: auto;
    margin-right: auto;
}
.goPedidoDetalle-tabla-w>p{
  display:flex;
  margin-bottom: 8px;
}
.goPedidoDetalle-tabla-w>p>strong{
  font-size: 15px;
}
.goPedidoDetalle-tabla-w>p>strong,
.goPedidoDetalle-tabla-w>p>span{
  width: 50%;
}
.goPedidoDetalle-tabla-w>p>span {
    font-size: 15px;
    font-family: Carnas-Regular;
}
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
