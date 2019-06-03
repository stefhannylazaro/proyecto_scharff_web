<template>
  <v-app id="inspire">
    <v-navigation-drawer
      fixed
      clipped
      v-model="drawer"
      width="225"
      style="z-index:99999"
      app>
      <v-list dense>
        <!-- <v-list-tile avatar class="mb-5" to="/admin">
          <img style="width:100%" class="px-2" src="../../img/logo-admin-min.png" />
        </v-list-tile> width:15px;height:15px;margin-right:.5rem;margin-top:.15rem;-->
        <v-list-tile
          v-for="(el, i) in listMenu"
          :key="i" :class="[{ActiveItemAdmin: isActive(el.url), 'only_devel':el.devel,'ocultar-publico':ocultaRutaEnpublico(el.url)}]"

          @click="activeLink(el.url, i)"
          class="my-2 heigth-mod" >
          <v-list-tile-content class="veamoseste">
            <v-list-tile-title style="" class="pl-3" :class="el.subtitulo?'item-menu-nombre--subtitulado':''" >
              <span class="item-menu-icon-w"><img style="" :src="el.icon" :alt="el.alt"></span>
              <span class="item-menu-nombre" v-html="el.name"></span>
              <span class="item-menu-subtitulo" v-if="false">{{el.subtitulo}}</span>
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      style="z-index: 9999;"
      class="bg-admin elevation-0"
      dark
      fixed
      clipped-left
      app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <router-link class="container-logo" to="/" :class="{smallLogo: isSmallWidth}" >
        <img src="../../img/logo_scharff_blanco.png" class="" alt="Logotipo scharff">
        <!-- <img src="../../img/logo_scharff_blanco_@2x.png" class="" alt="Logotipo scharff"> -->
      </router-link>
      <v-spacer></v-spacer>
      <v-toolbar-items class="mr-0 hover-tr-p">
        <v-btn flat class="d-align-center icon-user-p0">
          <img class="a-user-img" :src="user.img" alt="">
          <div class="ml-2 admin-user-text hidden-xs-only">
            Hola
            <span v-if="ruta_publica" class="a-user-name">Invitado</span>
            <span v-else class="a-user-name">{{user.name}}</span>
          </div>
          <!--<v-icon class="ml-2 hidden-xs-only" dark>keyboard_arrow_down</v-icon>-->
        </v-btn>
        <v-btn class="icon-exit-p0"  @click=""flat>
          <v-icon  medium>keyboard_arrow_down</v-icon>
        </v-btn>

        <v-toolbar-items class="mr-0 hover-tr">
          <v-btn flat class="d-align-center" @click="drawerLeftCuenta=true">
            Mi cuenta
          </v-btn>
          <v-btn class=""  @click="prelogout" href="/logout" flat>
            Cerrar sesión
          </v-btn>
        </v-toolbar-items>
      </v-toolbar-items>

    </v-toolbar>

    <v-content style="overflow:scroll;" class=" bg-gray-one" :class="[{'admin-ruta_publica':ruta_publica}]">
      <v-navigation-drawer
        temporary
        v-model="drawerLeftCuenta"
        disable-route-watcher
        disable-resize-watcher
        hide-overlay
        stateless
        touchless
        left
        light
        fixed

        v-bind:width="widthCuentaPanel()"

        class="px-4 pb-3 drawer-admin-border d-flex  el-2-12a">

        <cuentaAdmin
          v-if="userLoadedLocal"
          :userData="userData"
            v-on:guardarPanelCuenta="loadUserData()"

        ></cuentaAdmin>
      </v-navigation-drawer>

      <div v-if="drawerLeftCuenta"
        class="back-modal-active-admin"
        style="position:fixed;"
        @click.stop="drawerLeftCuenta = false"
        >_</div>

      <v-navigation-drawer
        temporary
        v-model="drawerLeftMetodos"
        disable-route-watcher
        disable-resize-watcher
        hide-overlay
        stateless
        touchless
        left
        light
        fixed
        v-if="drawerLeftMetodos"
        v-bind:width="widthCuentaPanel()"
        class="pb-3 drawer-admin-border d-flex el-2-12a agregar-tarjeta-w">
        <metodosPago v-if="userLoadedLocal"  :propAdminPanel="'metodos'"></metodosPago>

      </v-navigation-drawer>
      <div v-if="drawerLeftMetodos" class="back-modal-active-admin" style="position:fixed;" @click.stop="drawerLeftMetodos = false">_</div>


      <v-container fluid class="pa-0 p_relative">
        <v-slide-x-reverse-transition>
          <router-view class="p_absolute"></router-view>
        </v-slide-x-reverse-transition>
      </v-container>
    </v-content>






    <div class="" style="padding-left:600px">
    </div>




    <v-footer class="bg-admin" app>
      <v-flex xs12 class="mt-0 pt-3 extralinks d-flex">
        <div style="position: relative;top: -3px;">
          <a id="foot_facebook" href="https://www.facebook.com/holascharff" target="_blank" class="pr-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path style="fill:rgba(255, 255, 255, 0.5);" d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" />
            </svg>
          </a>
          <a id="foot_instagran" href="https://www.instagram.com/holascharff/" target="_blank" class="pr-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path style="fill:rgba(255, 255, 255, 0.5);" d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
            </svg>
          </a>
          <a id="foot_linkedin" href="https://www.linkedin.com/company/24787975/" target="_blank" class="pr-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path style="fill:rgba(255, 255, 255, 0.5);" d="M21,21H17V14.25C17,13.19 15.81,12.31 14.75,12.31C13.69,12.31 13,13.19 13,14.25V21H9V9H13V11C13.66,9.93 15.36,9.24 16.5,9.24C19,9.24 21,11.28 21,13.75V21M7,21H3V9H7V21M5,3A2,2 0 0,1 7,5A2,2 0 0,1 5,7A2,2 0 0,1 3,5A2,2 0 0,1 5,3Z" />
            </svg>
          </a>
          <a id="foot_youtube" href="/" target="_blank" class="pr-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path style="fill:rgba(255, 255, 255, 0.5);" d="M10,16.5V7.5L16,12M20,4.4C19.4,4.2 15.7,4 12,4C8.3,4 4.6,4.19 4,4.38C2.44,4.9 2,8.4 2,12C2,15.59 2.44,19.1 4,19.61C4.6,19.81 8.3,20 12,20C15.7,20 19.4,19.81 20,19.61C21.56,19.1 22,15.59 22,12C22,8.4 21.56,4.91 20,4.4Z" />
            </svg>
          </a>
        </div>
        <div class="urls">
        <a v-for="el in extraUrls" :id="el.id" :key="el.name" @click.stop.prevent="openExtraUrls(el.url)" :href="el.url">{{el.name}}</a>
        </div>
      </v-flex>
    </v-footer>



    <v-dialog
      v-model="modalTerminos"
      v-if="modalTerminos"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login black--text terminos--admin">
        <terminos
          v-on:closeTerminosModal="function(){modalTerminos=false}"
        ></terminos>
        <div class="back-modal-active" style="position:fixed;" @click.stop="modalTerminos=false">_</div>

      </div>
    </v-dialog>












  </v-app>
</template>


<script>
import metodosPago from '../components/cMetodosPagos.vue'
import cuentaAdmin from '../components/cCuentaAdmin.vue'
import terminos from '../components/cTerminos'
import { EventBus } from '../config/ebus.js'
import * as apiRutas from '../config/apiRutas';


import axios from 'axios'
import Vue from 'vue'


window.culqi = function (token) {
	if(Culqi.token) {
        var tokenResp = Culqi.token;
        console.log("Ejecutandose funcion AAAA");
        //vm.this.saveCardInApi(tokenResp);
        EventBus.$emit('tarjeta_tokenizada',tokenResp);
        // EventBus.$emit('tokenizarb',tokenResp);


    }else{
        console.log('Culqi.error');
        console.log("Ejecutandose funcion bbbbb");
        EventBus.$emit('tarjeta_tokenizada',Culqi.error);
        //EventBus.$emit('tokenizar_tarjeta',Culqi.error);
        //console.log(Culqi.error);
    }
}






  export default {
    data: () => ({
      drawer: null,
      itemActive: null,
      user:{name: '', img: '/images/icon_login.png'},
      isSmallWidth: false,
      isMobileWidth: false,
      listMenu: [
        { name: 'Inicio', icon: '/images/icon_home.png', alt: 'icon locker', url:'admin' },
        { devel:'1', name: 'Go & Buy', icon: '/images/iteracion3/icon_go_buy.png', alt: 'icon goandbuy', url:'go-buy-admin' },
        { name: 'Reserva tu locker', icon: '/images/square-check-min.png', alt: 'icon locker', url:'locker' },
        { name: 'Envío Express <span>Menos de 3 hrs</span>', icon: '/images/icon_expressa.png', alt: 'icon motorcyrcle', url:'package', subtitulo:true},
        { name: 'Envío Regular <span>De 24 a 72 hrs</span>', icon: '/images/icon_distribucion_admin.png', alt: 'icon envio', url:'envio-regular',subtitulo:true },
        { name: 'Métodos de pago', icon: '/images/icon_card.png', alt: 'icon metodos', url:'metodos' },
        { name: 'Mi historial', icon: '/images/historial_icon.png', alt: 'icon historial', url:'historial' },
        { name: 'Mi cuenta', icon: '/images/icon_cuenta.png', alt: 'icon mi-cuenta', url:'cuenta' },
        { name: 'Volver a la web', icon: '/images/icon_back.png', alt: 'icon home', url:'home' }
      ],
      windowWidth: null,
      drawerLeftCuenta: false,
      drawerLeftMetodos: false,
      e1: 0,
      userLoadedLocal:false,
      userData:null,
      extraUrls: [
        {name: 'Términos de servicio. Políticas de Privacidad. Scharff Copyright 2018.', id:'foot_terminos', url: 'terminos'},
      ],
      modalTerminos:false,
      addedCards:[],
      userEmailAccount:'',
      ruta_publica:false



    }),
    props: {
      source: String
    },
    mounted () {

      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);

      if(this.$route.params.panel=='express' && this.$route.params.item_id&&pro==null){
        this.ruta_publica = true;
      };

      //alert(this.ruta_publica);
      this.$nextTick(function() {
        window.addEventListener('resize', this.getWindowWidth);
      })
      this.getWindowWidth();

      this.loadUserData();
      if(pro==null){
        return;
      }
      this.geolocate();


      this.loadTarjetas();


      this.userEmailAccount = pro.usuario_email;




      EventBus.$on('tarjeta_tokenizada',this.saveCardInApi);


    },
    watch: {
      windowWidth: function (el) {
        // if(el>=1189 || el<960 && el>425){
        //   this.logoSec = true
        // } else {
        //   this.logoSec = false
        // }
        if(el < 377){
          this.isSmallWidth = true
        } else {
          this.isSmallWidth = false
        }

        if(el < 700){
          this.isMobileWidth = true
        } else {
          this.isMobileWidth = false
        }
      },
    },
    methods:{

      ocultaRutaEnpublico: function(url){
        if(this.ruta_publica){
          if(url=='go-buy-admin'||
            url=='locker'||
            url=='envio-regular'||
            url=='metodos'||
            url=='historial'||
            url=='cuenta'
          ){
            return true;
          }
        }
        return false
      },
      geolocate: function () {
        var vm = this;
        if ("geolocation" in navigator) {
          /* geolocation is available */
          console.log('geocodera');
          navigator.geolocation.getCurrentPosition((position) => {
            var currentLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            }
            vm.$store.commit('setStatefLatLng', currentLocation);
            console.log('geocoderb');
          })
          console.log('geocoderc');
        }
        //console.log('aqui!')

      },
      widthCuentaPanel:function(){
        if(this.isMobileWidth){
          return 240;
        }else{
          return 300;
        }
      },
      activeLink: function (url, index) {
        if(this.isMobileWidth){
          this.drawer =false
        };
        if(url=='cuenta'){
          this.loadUserData();
          this.drawerLeftMetodos = false;
          this.drawerLeftCuenta = true;
          return;
        }
        if(url=='metodos'){
          this.drawerLeftCuenta = false;
          this.drawerLeftMetodos = true;
          return;
        }
        this.drawerLeftCuenta = false;
        this.drawerLeftMetodos = false;
        this.itemActive = index;
        if(url=='historial'){
          this.$router.push({name: url,params: { panel: 'reservas', panel_id: ''}});
        }else if(url=='go-buy-admin'){
          this.$router.push({name: url,params: { panel: 'mi-direccion', panel_id: ''}});
        }else{
          this.$router.push({name: url});
        }

      },
      isActive: function (url) {

        let pathActive = this.$route.name;
        if(this.drawerLeftCuenta){
          pathActive = 'cuenta';
        }
        if(this.drawerLeftMetodos){
          pathActive = 'metodos';
        }
        return url == pathActive;
      },
      getWindowWidth(event) {
        this.windowWidth = document.documentElement.clientWidth
      },
      loadUserData:function(){
        var vm = this;

        var user_info = localStorage.getItem("user_p_info");
        console.log('user_info');
        //console.log(user_info);
        if(user_info===null){
          if(!vm.ruta_publica){
          localStorage.removeItem('user_p_info');
          window.location.href = '/logout#login';
          }

        }
        user_info = JSON.parse(user_info);
        if(user_info==null){
          return;
        }
        var nombre_info = user_info.usuario_nombre;

        vm.user.name = nombre_info;


        axios.get('/api/userinfo')
    		.then(function(response){

          if(response.logged==0){
            localStorage.removeItem('user_p_info');

            if(!vm.ruta_publica){
                window.location.href = '/logout#login';
            }
          }
          if(response.data.logged==0){
            localStorage.removeItem('user_p_info');
            if(!vm.ruta_publica){
              window.location.href = '/logout#login';
            }
          }
    			vm.userData = response.data;
          vm.user.name = vm.userData.usuario_nombre;
          user_info.id = vm.userData.id;
          localStorage.setItem("user_p_info", JSON.stringify(user_info));

          vm.userLoadedLocal = true;
          vm.loadPromociones();
    		}).catch(function (error) {
          localStorage.removeItem('user_p_info');
        });

      },
      prelogout:function(){
        localStorage.removeItem('user_p_info');
      },
      openExtraUrls:function(url){
        if(url=='terminos'){
          this.open_terminos();
        }
      },

      open_terminos:function(){
        this.modalTerminos = true;
      },
      loadTarjetas(src){
        var vm = this;
        var servicio_tarjetas = apiRutas.getTarjetaList+'/1/5';
        //var p_token = localStorage.getItem("p_token");

        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        if(pro==null){
          return;
        }
        var token = pro.token;

        axios({
          url:servicio_tarjetas,
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
          console.log('tarjetas');
          console.log(res);
          if(res.tipo == 1){
            vm.addedCards = res.data
            let idCardSelected = -1;
            vm.addedCards.forEach(function(el){
              el.semi_seleccionada=0;
              el.usable=true;
              if(el.tarjeta_predeterminada==1){
                idCardSelected = el.tarjeta_id;
              }

            });
            vm.$store.commit('setStateTarjetaPredeterminada',idCardSelected);
            vm.$store.commit('setStateAddedCards',vm.addedCards);
          }

        }).catch(function (error) {
          console.log(error);
        });


      },
      saveCardInApi:function(dataCard){
        var vm = this;
        if(dataCard.object=='error'){
          vm.$store.commit('setStateAddCardBtnLoading',false);
          vm.$store.commit('setStateAddCardQueFue',['error',dataCard.user_message]);
          vm.reportarLog('registrar_tarjeta',dataCard.user_message);
          return false;
        }

        console.log("dataCard lo que sea");
        console.log(dataCard);
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;
        var servicio_addcard = apiRutas.crearTarjeta+'?token='+token;

        var q_token = dataCard.id;


        



        axios({
          url:servicio_addcard,
          method:'post',
          data: {
            token_culqui:q_token
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        })
        .then(function(response){
          //vm.addCardBtnLoading = false;
          let res = response.data;
          console.log(res);
          if(res.tipo==1){
            //vm.addedCards.push({
            //  tarjeta_numero:dataCard.last_four,
            //  tarjeta_marca:dataCard.iin.card_brand,
            //  tarjeta_cardid:q_token,
            //  tarjeta_id:q_token,
            //  tarjeta_predeterminada:1
            //});
            console.log(res.datosLista);

            vm.addedCards = res.datosLista
            let idCardSelected = -1;
            vm.addedCards.forEach(function(el){
              el.semi_seleccionada=0;
              el.usable=true;
              if(el.tarjeta_predeterminada==1){
                idCardSelected = el.tarjeta_id;
              }

            });
            vm.$store.commit('setStateTarjetaPredeterminada',idCardSelected);
            vm.$store.commit('setStateAddedCards',vm.addedCards);
            vm.$store.commit('setStateAddCardBtnLoading',false);
            vm.$store.commit('setStateShowCardForm',false);

            vm.$store.commit('setStateAddCardQueFue',['success','Se ha ingresado la tarjeta']);


            setTimeout(function(){
              vm.$store.commit('setStateAddCardQueFue',['','']);
            },5000);
            // vm.showCardForm = 0;
            // vm.cardSelected=q_token;
            // vm.cardClickeada='';

            // vm.cardOpMessage = 'Se ha ingresado la tarjeta';
            // vm.tarjeta_numero= '';
            // vm.monthCard= '';
            // vm.yearCard= '';
            // vm.cvvCard= '';


          }else if(res.tipo==3){

            if(res.mensajes[0]){
              //vm.errorAddCard = res.mensajes[0];
              vm.$store.commit('setStateAddCardQueFue',['error',res.mensajes[0]]);
              vm.reportarLog('registrar_tarjeta',res.mensajes[0]);
            }else{
              vm.$store.commit('setStateAddCardQueFue',['error','Ha ocurrido un error.']);
              vm.reportarLog('registrar_tarjeta','Error en servidor');
            }

            //vm.addCardResult.result = 'error';
            //vm.addCardResult.message = res.mensajes[0];
            //console.log(res.mensajes[0]);
            vm.$store.commit('setStateAddCardBtnLoading',false);
          }else{
            //console.log("Error ingresando tarjeta");
            vm.$store.commit('setStateAddCardQueFue',['error',res.mensajes[0]]);
            vm.reportarLog('registrar_tarjeta',res.mensajes[0]);
            //vm.errorAddCard = res.mensajes[0];
            vm.$store.commit('setStateAddCardBtnLoading',false);
            //vm.addCardResult.result = 'error';
            //vm.addCardResult.message = res.mensajes[0];
            //console.log(res.mensajes[0]);
          }

        }).catch(function (error) {
          console.log(error);
          vm.$store.commit('setStateAddCardQueFue',['error',"Error ingresando la tarjeta"]);
          //vm.errorAddCard = "Error ingresando la tarjeta";
          vm.reportarLog('registrar_tarjeta','Error conección API');
          vm.$store.commit('setStateAddCardBtnLoading',false);
        });

      },
      loadPromociones:function(){
        var vm = this;
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);

        let usuario_id = pro.id;
        let usuario_id2 = pro.usuario2;
        axios({
          url:'/ajax/admin-config',
          method:'get',
          params: {
            usuario_id,
            usuario_id2
          }
        })
    		.then(function(response){

          if(response.logged==0){
            localStorage.removeItem('user_p_info');
            if(!vm.ruta_publica){
              window.location.href = '/logout#login';
            }
          }
          if(response.data.logged==0){
            localStorage.removeItem('user_p_info');
            if(!vm.ruta_publica){
              window.location.href = '/logout#login';
            }
          }
          //console.log('setStatePromociones');
          // let servicios = {};
          // response.data.promocion.promo_cuantos_usos_van.forEach((el)=>{
          //   servicios[el.descuento_tipo_servicio] = el.descuento_tipo_servicio_n;
          // })
          // response.data.promocion.promo_cuantos_usos_van = servicios;
          vm.$store.commit('setStatePromociones', response.data.promocion);

    		}).catch(function (error) {

        });
      }
    },
    components: {
      metodosPago,
      cuentaAdmin,
      terminos
    }
  }



















</script>
<style lang="scss">
@import "../../scss/vars.scss";
.application{
  font-family: 'Carnas-Medium';
}
.application strong{
  font-family: 'Carnas-Bold';
  font-weight: 500;
}
table.table tbody td {
  font-weight: 400;
  font-size: 12px;
  color: #464646;
}
.heigth-mod{
  .list__tile.list__tile--link{
    height: 50px!important;
  }
}

.el-2-12a{
  padding-top: 103px;
}
.navigation-drawer--is-mobile.navigation-drawer--close ~ .content--wrap .navigation-drawer--open.el-2-12a{
  left: 0;
}
.navigation-drawer--open.el-2-12a{
  left: 222px;
}
.navigation-drawer--close~.content--wrap .navigation-drawer--open.el-2-12a{
  left: 0;
}
.drawer-admin-border>div{
  max-width: 100%;
}
.toolbar__items.mr-0.hover-tr {
  position: absolute;
  right: 0;
  top: 62px;
  background: #393939;
  flex-direction: column;
  width: 206px;
      height: auto;
}
.item-menu-icon-w {
  width: 41px;
  text-align: center;
}
.list__tile__title span {
  display: inline-block;
  text-transform: initial;
  font-size: 14px;
}
.ActiveItemAdmin .list__tile__title{

}
#inspire .list--dense>li img{
  max-width: 27px;
  vertical-align: middle;
  position: relative;
  top: -2px;
}
 #inspire .list__tile__title{
   overflow: visible;
 }
 .icon-user-p0 {
    padding-right: 13px;
}
.hover-tr .btn__content {
  text-align: left;
     -webkit-box-pack: end;
     -ms-flex-pack: end;
     justify-content: flex-end;
     padding-right: 18px;
     text-transform: initial;
     font-size: 15px;

}
.hover-tr{
  display: none;
}
.hover-tr-p:hover .hover-tr{
  display: block;
}
.hover-tr.toolbar__items>.btn{
  height: 40px;
  width: 100%;
}
.list__tile--link:hover {
    background: rgba(0, 0, 0, 0.07);
}
.ActiveItemAdmin .list__tile--link{
  background: rgba(0,0,0,.12);
}
.list--dense>li:nth-child(2) img{
  width: 18px;
}
.list--dense>li:nth-child(3) img{
  width: 19px;
}
.btn-send-next{
    min-width: 110px;
    padding-left: 0.2rem;
    padding-right: 0.2rem;
}
.btn-next-small .btn__content {
    padding: 0.6rem 1.3rem;
}
.navigation-drawer>.list .list__tile {
    padding-left: 11px;
}
.heigth-mod {
    border-left: solid 0.4rem transparent;
}
.ActiveItemAdmin.heigth-mod {
    border-left: solid 0.4rem #ff535a;
}
.extralinks{
  background: rgba(43, 43, 43, 1);
}
.footer.bg-admin{
  background: #2b2b2b !important;
}
.terminos--admin .terminos_terminos {
    height: calc(100vh - 336px);
}
@media screen and (max-width: 760px){
  .extralinks>div:first-child{
    display: none;
  }
  .extralinks .urls {
      padding-bottom: 10px;
  }
}

@media screen and (max-width: 600px){
  .min-width-step-two {
    padding: 4rem 2rem 0;
  }
  .more-info-send-package+br{
    display: none;
  }
}
.item-menu-nombre span {
  display: block;
  font-size: 12px;
  line-height: 8px;
  color: #777;
}
.list__tile__title.item-menu-nombre--subtitulado {
    height: 38px;
}
#inspire .list--dense > li .item-menu-nombre--subtitulado img {
    top: -8px;
}
.holascharff_body .only_devel{
  display: none;
}
.jp-card {
    min-width: auto;
    max-width: 100%;
}
.jp-card .jp-card-front .jp-card-lower .jp-card-number {
    margin-bottom: 9px;
    font-size: 15px;
}
.jp-card .jp-card-front .jp-card-lower .jp-card-name{
  display: none;
}
.jp-card .jp-card-front .jp-card-lower {
    width: 90%;
    left: 5%;
}
.container-pay-icons {
    display: none;
}
.jp-card-container {
    height: 141px;
    margin-bottom: 19px;
}
@media screen and (max-width: 715px){
  .stepper-add-card {
    padding: 33px 9px 24px;
  }
  .navigation-drawer > .list .list__tile {
    padding-left: 0px;
  }
}










.agregar-tarjeta img{
  vertical-align: middle;
  position: relative;
  top: -1px;
  padding-right: 10px;
}
.agregar-tarjeta {
  text-align: left;
  padding: 21px 0 20px;
  cursor: pointer;
  background: #fff;
}
.agregar-tarjeta-w .stepper__header{
  display: none;
}
.agregar-tarjeta-form.stepper {
  -webkit-box-shadow: none;
  box-shadow: none;
}
.stepper-add-card{
  padding: 33px 32px 24px;
  background: #f4f3f4;
}
@media screen and (max-width: 715px){
  .stepper-add-card {
    padding: 33px 9px 24px;
  }
}
.tarjeta-agregada {
  position: relative;
  transition: all .2s;
  padding: 10px 0;
  cursor: pointer;
  background: #fcfbfc;
    min-height: 60px;
}
.tarjeta-agregada .tarjeta-agregada-icon-left {
  position: absolute;
  left: 17px;
  top: 12px;
  font-size: 33px;
}
.tarjeta-agregada p {
  text-align: left;
  padding-left: 59px;
  font-size: 16px;
  margin-bottom: 0;
  line-height: 1.3;
}
.tarjeta-agregada strong{
  display: block;
}
.tarjeta-agregada:hover{
  background: #ffd5d8;
}
.tarjeta-agregada.tarjeta-seleccionada{
  background: #feeaeb;
}
.agregar-tarjeta-w{
  background: #fcfbfc !important;
}
.selected-card {
  position: absolute;
  right: 17px;
  top: 13px;
}
.selected-card i{
  font-size: 30px;
}
.tarjetas-seleccionadas-opciones{
  display: flex;
}
.tarjetas-seleccionadas-opciones a{
  display: block;
}
.tarjetas-seleccionadas-opciones span:first-child{
  background: #fc7178;
  color:#fff;
}
.tarjetas-seleccionadas-opciones span:last-child{
  background: #f3f2f3;
}
.tarjetas-seleccionadas-opciones>span{
  flex: 1;
  text-align: center;
  padding: 14px 0 10px;
  text-transform: uppercase;
  font-size: 12px;
  cursor: pointer;
}
.tarjetas-seleccionadas-opciones>span i{
  vertical-align: middle;
  position: relative;
  top: -1px;
  border: 1px solid #fff;
  border-radius: 100px;
  font-size: 16px;
  padding: 3px;
}
.tarjetas-seleccionadas-opciones>span:last-child i{
  border-color: inherit;
}
.tarjetas-seleccionadas-opciones > span.loading{
  background: #ececec;
  color: gray;
  pointer-events: none;
}
.tarjetas-seleccionadas-opciones span.loading:first-child{
  background: #f98f94;
  color: #fff;
  pointer-events: none;
}
.tarjetas-seleccionadas-opciones > span.loading i{
  border: 2px solid #f3f3f3;
  border-top: 2px solid #676767;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  animation: spin_a001 1s linear infinite;
  font-size: 22px;
  padding: 0px;
  display: inline-block;
}
.tarjetas-seleccionadas-opciones span.loading:first-child i{
      border-top: 2px solid #ff9f9f;
}
.semiseleccionada{
  background: #ffd5d8;
}
.card-op-message{
  text-align:center;
  padding-top:10px;
}


@keyframes spin_a001 {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.jp-card .jp-card-front .jp-card-lower .jp-card-expiry {
    width: 29%;
}

.cupon-input-w {
    display: inline-block;
    position: relative;
    i{
      position: absolute;
      right: 15px;
      top: 2px;
      font-size: 15px;
      cursor: pointer;
    }
}
.ocultar-publico{
  display: none;
}
.admin-ruta_publica .hide-enpublico{
  display: none;
}
</style>
