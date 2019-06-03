<template>
  <v-flex xs12>
    <v-flex x12 class="text-left px-4 pt-4 pb-4 x12 x12 goPedidoDetalle-titulo">
      <h4 @click="gotoPedidosLista" class="head4 goPedidoDetalle__atras" ><i class="material-icons flechaback">keyboard_backspace</i> {{codigo_tracking_msk}}</h4>
    </v-flex>


    <v-flex xs12 class="goPedidoDetalle-tabla-w" v-if="tracking_loaded">
      <h3 class="head3 mb-3">DATOS DEL PEDIDO:</h3>
      <div >
        <p><strong>Fecha de Registro:</strong><span v-text="pedidoItem.created_at"></span></p>
        <p><strong>Estado:</strong> <span v-text="etiquetaEstados(pedidoItem.gobuy_estado)"></span></p>
        <p><strong>Tracking Code:</strong> <span v-text="pedidoItem.gobuy_codetracking"></span></p>
        <p><strong>Valor Declarado US$:</strong> <span v-text="pedidoItem.gobuy_valordeclarado"></span></p>
        <p><strong>Piezas:</strong> <span v-text="pedidoItem.gobuy_piezas==0?'':pedidoItem.gobuy_piezas"></span></p>
        <p><strong>Peso:</strong> <span v-text="pedidoItem.gobuy_peso"></span></p>
        <p><strong>Costo de envio:</strong> <span v-text="pedidoItem.gobuy_costoenvio"></span></p>
      </div>
    </v-flex>
  </v-flex>
</template>

<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  props:['pedidoid','transportista'],
  data() {
    return {
      pedidoItem:{
        created_at:'',
        gobuy_estado:'',
        gobuy_codetracking:'',
        gobuy_valordeclarado:'',
        gobuy_piezas:'',
        gobuy_peso:'',
        gobuy_costoenvio:''
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
    etiquetaEstados:function(estado){
      if(!estado||estado==0){
        return "Pendientes"
      }else if(estado==1){
        return "Entregado"
      }
    },
    gotoPedidosLista:function(){
      this.$router.push({ name: 'go-buy-admin', params: { panel: 'mis-pedidos', panel_id: ''}});
    },
    buscarPorTracking:function(){
      var vm = this;
      var token = this.getLocalUser().token;

      axios({
        url:apiRutas.gobuypedido_buscarportracking,
        method:'get',
        params: {
          token:token,
          tracking_code:vm.pedidoid
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
      if(this.pedidoid==0){
        return "Pedido";
      }else{
        return 'Tracking Code '+this.pedidoid;
      }
    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
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
    width: 450px;
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
