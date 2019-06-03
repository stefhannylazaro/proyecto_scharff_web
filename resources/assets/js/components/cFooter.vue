<template>
  <v-footer class=" wrapper-footer white--text">
    <v-container fluid class="ma-0 px-4">
    <v-layout v-if="menuOne" row wrap>
      <v-flex md4 class="white--text footer-logo d-flex">
        <!-- <div class="wrapper-images-footer">
          <img src="../../img/footer-logo-min.png" alt="Logotipo scharff">
          <img class="hidden-xs-and-down" v-if="logoSec" src="../../img/footer-text-min.png" alt="">
          <!-- <img src="../../img/logo_white.png" alt="Logotipo scharff"> -->
          <!-- <img class="" src="../../img/text-logistic.png" alt="">
        </div> -->
          <div style="cursor:pointer;height:0;" class=" d-align-start pt-2" @click="goTopPage()">
            <img src="../../img/footer-logo-min.png" alt="Logotipo scharff">
            <img class="hidden-xs-and-down pt-2" v-if="true" src="../../img/footer-text-min.png" alt="">
          </div>

        <div>

          <v-btn round outline class="cover btn-login-menu px-3 btn-line" @click="goTopComplaints()">
            <img class="mr-2" style="width:1rem;" src="../../img/reclamaciones-min.png" alt="icon reclamaciones">
            Libro de reclamaciones
          </v-btn>

        </div>
      </v-flex>
      <v-flex transition="slide-y-transition" md8>
        <div slot="activator" class="footer-lists">
          <div  class="list px-2" v-for="el in linksMenu" :key="el.name">
            <span>{{el.name}}</span>
            <!-- <v-scale-transition> -->
            <ul style="cursor:pointer;" class="pt-2">
              <li class="pl-2 py-1 element-list" v-for="item in el.items" :key="item.name" @click="sendUrlRoute(item)">
                <a :class="{boldText: isBold(item.name)}" class="style-link">
                  {{item.name}}
                </a>
                <!-- <router-link v-else :class="{boldText: isBold(item.name)}" class="style-link" :to="item.url">
                  {{item.name}}
                </router-link> -->
                <!-- <span :class="{boldText: isBold(item.name)}">{{item.name}}</span> -->
              </li>
            </ul>
            <!-- </v-scale-transition> -->
          </div>
          <div class="pa-2 btn-footer">
            <!-- <button class="pb-2">Crear una Cuenta</button> -->
            <button v-if="!sesionIniciada" @click="stateChangeLogin()">Iniciar sesión</button>
            <button v-if="!sesionIniciada" @click="stateChangeRegister()">Regístrate</button>
            <button v-if="sesionIniciada" @click="gotoAdmin()">PANEL DE USUARIO</button>
            <button @click="openExtraUrls('portalsn')">PORTAL PROVEEDORES</button>


          </div>
        </div>
      </v-flex>
      <v-flex xs12 class="mt-3 pt-3 extralinks d-flex">
        <div>
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
          <a id="foot_youtube" href="https://www.youtube.com/channel/UCq2TT7jiV-k5Qpt_78COIqg/videos" target="_blank" class="pr-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path style="fill:rgba(255, 255, 255, 0.5);" d="M10,16.5V7.5L16,12M20,4.4C19.4,4.2 15.7,4 12,4C8.3,4 4.6,4.19 4,4.38C2.44,4.9 2,8.4 2,12C2,15.59 2.44,19.1 4,19.61C4.6,19.81 8.3,20 12,20C15.7,20 19.4,19.81 20,19.61C21.56,19.1 22,15.59 22,12C22,8.4 21.56,4.91 20,4.4Z" />
            </svg>
          </a>
        </div>
        <div class="urls">
        <a v-for="el in extraUrls" :id="el.id" :key="el.name" @click.stop.prevent="openExtraUrls(el.url)" :href="el.url">{{el.name}}</a>
        </div>
      </v-flex>
    </v-layout>
    <v-layout v-if="!menuOne" row wrap>
      <v-flex xs12 >
        <v-list>
          <v-list-group v-for="item in linksMenu" :value="item.isActive" v-bind:key="item.name">
            <v-list-tile slot="item" @click="">
              <v-list-tile-content>
                <v-list-tile-title>{{ item.name }}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action v-if="item.isFather">
                <v-icon>keyboard_arrow_down</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-list-tile v-for="subItem in item.items" v-bind:key="subItem.title" @click="sendUrlRoute(subItem)">
              <v-list-tile-content>
                <v-list-tile-title>{{ subItem.name }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
        </v-list>
      </v-flex>
      <v-flex xs12 class="pt-2 copyright">
        <span>
          Scharff Copyright ©{{ new Date().getFullYear() }}
        </span>
      </v-flex>
    </v-layout>
    </v-container>
    <v-dialog
      v-model="modalTerminos"
      v-if="modalTerminos"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login black--text">
        <terminos
          v-on:closeTerminosModal="closeTerminosModal"
        ></terminos>
        <div class="back-modal-active" style="position:fixed;" @click.stop="closeTerminosModal()">_</div>

      </div>
    </v-dialog>
  </v-footer>
</template>

<script>
import terminos from './cTerminos'
export default {
  props:['sesionIniciada','nombreUsuario'],
  data() {
    return {
      linksMenu: [
        { name: 'PARA EMPRESAS', url: '', isFather: true, isActive: false, items: [
          {name: 'Envíos Internacional', url: 'fedex', icon: '', alt: '', isUrl: true },
          {name: 'Carga Internacional', url: 'cargainternacional', icon: '', alt: '', isUrl: true },
          {name: 'Carga doméstica', url: 'cargadomestica', icon: '', alt: '', isUrl: true },
          {name: 'Aduanas', url: 'aduanas', icon: '', alt: '', isUrl: true },
          {name: 'Distribución Nacional', url: 'distribucion', icon: '', alt: '', isUrl: true},
          {name: 'Distribución Urbana', url: 'distribucion', icon: '', alt: '', isUrl: true},
          {name: 'Almacenes', url: 'almacen', icon: '', alt: '', isUrl: true},
          {name: 'Cotizador', url: '', icon: '', alt: '', isUrl: true},

          {name: 'Tracking Online', url: 'goToTracking', icon: '', alt: '', isUrl: true},
          {name: 'Scharff Net', url: 'http://196.10.10.123/scharffnet/', icon: '', alt: '', isUrl: true, isExt:true},
          {name: 'Intranet Empresas', url: 'http://200.37.50.50/Intranet/login.asp', icon: '', alt: '', isUrl: true, last:true, isExt:true},
        ]},
        { name: 'PARA TI', url: 'para-ti', isFather: true, isActive: false, items: [
          {name: 'Envíos regulares', url: 'distribucion', icon: '', alt: '', isUrl: true},
          {name: 'Envíos Express', url: 'express', icon: '', alt: '', isUrl: true},
          {name: 'Lockers', url: 'scharff-stop', icon: '', alt: '', isUrl: true},
        ]},
        { name: '¿NECESITAS AYUDA?', url: '', isFather: true, isActive: false, items: [
          {name: 'Preguntas Frecuentes', url: '', icon: '', alt: '', isUrl: true },
          {name: 'Sobre scharff', url: '', icon: '', alt: '', isUrl: true },
          {name: 'Ubícanos', url:'', scroll_a: '#ubicanos-section', icon: '', alt: '', isUrl: false },
          {name: 'Tracking Online', url: 'goToTracking', icon: '', alt: '', isUrl: true},
        ]},
        { name: 'SCHARFF LAB', url: '', isFather: true, isActive: false, items: [
          {name: 'Casos de estudio', url: '', icon: '', alt: '', isUrl: true },
          {name: 'Blog', url: '', icon: '', alt: '', isUrl: true }
        ]},
      ],
      windowWidth: null,
      menuOne: true,
      extraUrls: [
        {name: 'Términos y condiciones.', id:'foot_terminos', url: 'terminos'},
        {name: ' Políticas de privacidad.', id:'foot_privacidad' , url: '#'},
        {name: ' Scharff Copyright', id:'', url: '#'},
      ],
      showList: false,
      logoSec: true,
      modalTerminos:false,
    }
  },
  mounted () {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      this.getWindowWidth()
    })
  },
  watch:{
    windowWidth: function (el) {
      if(el>=960){
        this.menuOne = true
      } else {
        this.menuOne = false
      }
      if(el<1264){
        this.logoSec = false
      } else {
        this.logoSec = true
      }
    }
  },
  methods: {

    sendUrlRoute: function (item) {

      if(item.url != ''){

        if(item.name==='Scharff Net'||
          item.name==='Intranet Empresas'||
          item.name==='Tu Intranet'
          ){
          window.open(item.url, '_blank')
        }else if(item.name==='Tracking Online'){
          this.stateChangeTracking(true)
        }else if(item.name==='Envíos Internacional'){
          window.open('https://www.fedex.com/pe/', '_blank');
          return false;
        }else{

          this.$router.push(item.url);
          this.$scrollTo('#menu-home', 1000)

        }

        console.log("arriba");
      } else {
        if(item.scroll_a!=''){
          this.$router.push('/')
          var vm = this;
          setTimeout(function(){
            vm.$scrollTo(item.scroll_a,1000);
          },500);

        }else{
          this.$scrollTo('#formGrow')
        }
        console.log("abajo");



      }
    },
    goTopPage: function () {
      this.$scrollTo('#menu-home', 1000)
      // window.scrollTo(0, 0)
      this.$router.push('/')
    },gotoPage: function(pagename) {
      if(pagename==='fedex'){
        window.open('https://www.fedex.com/pe/', '_blank');
        return false;
      }

      this.$router.push(pagename);
      this.$scrollTo('#menu-home', 1000)
    },
    goTopComplaints: function () {
      console.log('hola')
      // window.scrollTo(0, 0)
      this.$router.push('/libro-reclamaciones')
      this.$scrollTo('#menu-home', 1000)
      console.log('se ejecut')
    },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
    },
    isBold: function (name) {
      if(name == 'Tu Intranet' || name == 'Intranet Empresas') {
        return true
      } else {return false}
    },
    stateChangeLogin: function () {

      this.$store.commit('setStateLogin', true)
    },
    stateChangeRegister: function () {
      this.$store.commit('setStateRegister', true)
    },
    stateChangeTracking: function () {
      this.$store.commit('setStateTracking', true)
    },
    openExtraUrls:function(url){
      if(url=='terminos'){
        //this.open_terminos();
        this.$router.push('/terminos-y-condiciones');
        this.$scrollTo('#menu-home', 1000)
      }
      if(url=='portalsn'){
        window.open('http://www.portalsn.com/', '_blank');
        return false;
      }
    },

    open_terminos:function(){
      this.modalTerminos = true;
    },
    closeTerminosModal:function(){
      this.modalTerminos = false;
    },
    gotoAdmin:function(){
      console.log('trata');
      if(this.nombreUsuario==='Superadmin'){
        document.location ='/superadmin';
      }else{
        this.$router.push('/admin');
      }

      document.title='Scharff - Grupo Scharff'
    },
  },



  components: {
    'terminos': terminos,
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.btn-line{
      font-family: Carnas-light;
}
.btn-footer button{
      margin-bottom: 10px;
}
.btn-footer button:focus{
  box-shadow: none;
  outline:none;
}
</style>
