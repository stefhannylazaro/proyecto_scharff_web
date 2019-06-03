<template>
  <v-layout row wrap style="overflow:hidden;position: relative;" :class="{'fixed-header-site':stateChangeHeaderFixed}">
    <v-flex xs12>
      <menuPage
        id="menu-home"
        :class="{'fixed-header':stateChangeHeaderFixed}"

        :sesionIniciada="sesionIniciada"
        :nombreUsuario="nombreUsuario"
      ></menuPage>
      <div v-if="stateChangeHeaderFixed" class="soporte-menu"></div>
    </v-flex>
    <v-flex xs12>
      <router-view
      :sesionIniciada="sesionIniciada"
      :nombreUsuario="nombreUsuario"
      ></router-view>
    </v-flex>
    <v-flex xs12>
      <footerPage
      v-bind:foter-data="footerData"
      :sesionIniciada="sesionIniciada"
      :nombreUsuario="nombreUsuario"
      ></footerPage>
    </v-flex>
  </v-layout>
</template>

<script>
  import axios from 'axios';
  import menuPage from '../components/cMenu.vue'
  import footerPage from '../components/cFooter.vue'
  import { EventBus } from '../config/ebus.js'
  export default {
    data () {
      return {
          getConfigHome: '/ajax/home-config',
          serviciosLis:[],
          bannerList: [],
          sucursalesList: [],
          footerData:null,
          textData:null,
          metasData:[],
          motivos:[],
          sesionIniciada:false,
          nombreUsuario:'',
          navfixed:false,
          sucursales:''
      }
    },
    mounted(){

        let vm = this;
        this.loadData(function (response) {

          let res = response.data;
          vm.footerData = res.links;
          vm.textData = res.textos;
          vm.bannerData = res.banner;
          vm.metasData = res.metas;
          vm.motivos = res.motivos;
          vm.sucursales = res.sucursales;


          vm.$store.commit('setStateSucursales', vm.sucursales);
          vm.$store.commit('setStateOpciones', res);



          if(res.opciones[0].valor&&res.opciones[0].valor==1){
            if(window.location.hash !== "#login"){
              vm.$emit('ejecutar_modal', 1);
            }
          }

          if(vm.bannerData && vm.bannerData.length>0){
            vm.$emit('ejecutar_slider', vm.bannerData);
          }
          EventBus.$emit('RestponseloadedForm',vm.motivos);
          console.log('vm.metasData');
          console.log(vm.metasData);
          console.log(vm.$route.name);
          if(vm.metasData[vm.$route.name]&&vm.metasData[vm.$route.name].titulo!=''){
            document.title = vm.metasData[vm.$route.name].titulo;
          }else{
            document.title = "Scharff - Grupo Scharff";
          }
        });
        //this.$on('loadDataAsincrono', this.loadDataAsincrono);
        //this.$on('update_menu_e', this.update_menu_m);


        EventBus.$on('loadedForm', function(){
          console.log("CARGADO FORM");
          setTimeout(function(){
            EventBus.$emit('RestponseloadedForm',vm.motivos);
          },100)

        });


        axios.get('/api/userinfo')
        .then(function(response){
          console.log(response);
          let res = response.data;
          if(res.id){
            console.log("esta logeado");
            if(res.rol === 'superadmin'){
              vm.sesionIniciada = true;
              vm.nombreUsuario = "Superadmin"
              console.log("esta logeado superadmin");
            }else{
              vm.sesionIniciada = true;
              vm.nombreUsuario = response.data.usuario_nombre;
            }
          }else if(res.logged == 0){
            console.log("no esta logeado");
            vm.sesionIniciada = false;
            localStorage.removeItem('user_p_info');
          }



        }).catch(function (error) {
          vm.sesionIniciada = false;
        });








        var lastScrollTop = 0;
        // element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
        window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
           var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
           //console.log("pos "+st);
           if (st > lastScrollTop||(st<80)){
             //console.log("paABAJO");
             vm.navfixed = false;
             vm.setStateHeaderFixed(false);
           } else {
              //console.log("paARRIBA");
              vm.navfixed = true;
              vm.setStateHeaderFixed(true);
           }
           lastScrollTop = st;
        }, false);



    },
    watch:{
      footerData: function (el) {
          el.map( function (element) {
            var ele = document.getElementById(element.clave);
            if(ele != null) {
              document.getElementById(element.clave).href = element.link;
            }
          });
      },

      textData: function (el) {
            let titulo;
            let descripcion;
          el.map( function (element) {
              titulo = document.getElementById(element.clave + '_titulo');
              if (titulo !== null){
                  titulo.innerHTML = '' + element.titulo;
              }
              descripcion = document.getElementById(element.clave + '_descripcion');
              if (descripcion !== null){
                  descripcion.innerHTML = '' + element.descripcion;
              }
              // document.getElementById(element.clave).href = element.link;
          });
      },
      '$route' (){
          //console.log("cambiado");
          //console.log(to.name);
          this.$emit('update_menu_t', 1);
          console.log("actualizando a");
          //console.log(to);
          try {
            if(to!=undefined){
              if(this.metasData[to.name].titulo!=''){
                document.title = this.metasData[to.name].titulo;
              }
            }
          } catch (e) {
            console.log("una aexcepcion")
          } 

          this.loadDataAsincrono();
      }

    },
    methods: {
        loadData: function (responseCallback) {
            let vm = this;
            axios.get(vm.getConfigHome)
                .then(responseCallback);
        },
        loadDataAsincrono:function(){
          var self = this;
          setTimeout(function(){
            self.$emit('ejecutar_slider', self.bannerData);
          },500);

        },update_menu_m:function(){
          this.$emit('update_menu_t', 1);
        },
        setStateHeaderFixed: function (state) {
          this.$store.commit('setStateHeaderFixed', state)
        },

    },
    computed:{
      stateChangeHeaderFixed: function () {
        return this.$store.getters.loadStateHeaderFixed&&(!this.$store.getters.loadStateRegister)
      },
      stateChangeRegister: function () {
        return this.$store.getters.loadStateRegister
      },
    },
    components: {
      menuPage,
      footerPage
    }
  }
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.VueCarousel-wrapper{
  height: 100%;
  .VueCarousel-inner{
    height: 100%;
    .VueCarousel-slide{
      height: 100%;

    }
  }
}
/* TIMELINE EFECTO */
.timeline-item {
  background: #f4f6f8;
  border-radius: 3px;
  padding: 152px 106px;
  padding-left: 181px;
  margin: 0 auto;
  min-height: 224px;
  padding-left: 12%;
}


@keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animated-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
background-size: 800px 104px;
  height: 300px;
  position: relative;
}



.background-masker {
    background: #fff;
    position: absolute;
}

/* Every thing below this is just positioning */

.animated-background>div{
  position: relative;
}
.animated-background .tl-1{
  position: absolute;
  width: 33%;
  right: 33%;
  height: 100%;
  top: 0;
  background: #f4f6f8;
}

.tl-2 {
  height: 0;
  padding-bottom: 19px;
}

.tl-3 {
  height: 13px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-4 {
  height: 13px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-5 {
  height: 32px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-6 {
  height: 13px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-7 {
  height: 13px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-8 {
  height: 114px;
  background: #f4f6f8;
  margin-bottom: 18px;
    margin-right: 37%;
}
.tl-9 {
  height: 11px;
  background: #f4f6f8;
  margin-bottom: 18px;
  margin-right: 37%;
}
.tlir-2 {
  position: absolute;
  right: 65%;
  background: #f4f6f8;
  height: 19px;
  width: 158px;
}
.tlir-3 {
  position: absolute;
  right: 46%;
  top:44px;
  background: #f4f6f8;
  height: 19px;
  width: 178px;
}
.tlir-3 {
  position: absolute;
  right: 46%;
  top:44px;
  background: #f4f6f8;
  height: 19px;
  width: 178px;
}
.tlir-4 {
  position: absolute;
  right: 46%;
  top: -19px;
  background: #f4f6f8;
  height: 19px;
  width: 78px;
}
.tlir-5 {
  position: absolute;
  right: 46%;
  top:32px;
  background: #f4f6f8;
  height: 19px;
  width: 106px;
}
.tlir-6 {
  position: absolute;
  right: 46%;
  top:13px;
  background: #f4f6f8;
  height: 19px;
  width: 71px;
}

.tlir-7 {
  position: absolute;
  right: 46%;
  top:13px;
  background: #f4f6f8;
  height: 19px;
  width: 0px;
}
.tlir-8 {
  position: absolute;
  right: 46%;
  top: 13px;
  background: #f4f6f8;
  height: 19px;
  width: 39px;
}


@media screen and (max-width: 956px){
  .timeline-item {

  padding-top: 123px;
  }
}

@media screen and (max-width: 913px){

  .timeline-item {
    padding-left: 5%;
    padding-right: 3%;
  }
}

@media screen and (max-width: 913px){
  .timeline-item {
    padding-top: 100px;
      padding-bottom: 75px;
  }
}
@media screen and (max-width: 774px){
  .animated-background .tl-1 {
    width: 24%;
    right: 37%;
  }
  .tlir-2 {
    right: 57%;
  }
  .tlir-3 {
    right: 29%;
  }
  .tlir-4 {
    right: 37%;
  }
  .tlir-5 {
    right: 38%;
  }
  .tlir-6 {
    right: 37%;
  }
  .tlir-7 {
    right: 36%;
    width: 93px;
  }
}
@media screen and (max-width: 600px){
.animated-background .tl-1 {
    width: 39%;
    right: 0;
  }
  .timeline-item {
    padding-top: 157px;
    padding-left: 23%;
      padding-bottom: 75px;
  }
  .tlir-2 {
    right: 29%;
      width: 33%;
  }
  .tlir-3 {
    right: -9%;
    width: 60%;
  }
  .tlir-4 {
  right: 3%;
    width: 29%;
  }
  .tlir-5 {
    right: -1%;
    width: 38%;
  }
  .tlir-6 {
    right: 3%;
      width: 26%;
  }
  .tlir-7 {
    right: 2%;
    width: 42%;
  }

}
@media screen and (max-width: 410px){
  .tlir-2{
    width:19%;
  }
  .tlir-4 {
    width: 4%;
  }
  .tlir-3 {
    width: 29%;
  }
  .tlir-5 {
    width: 16%;
  }
  .tlir-6 {
      width: 22%;
  }
  .tlir-7 {
    width: 2%;
  }
  .timeline-item {
    padding-top: 134px;
      padding-bottom: 75px;
  }
}
.brands-section{
  background: #f7f7f7;
}

.pr3 {
  padding-right: 110px;
}
.pl3 {
  padding-left: 110px;
}
@media screen and (max-width: 950px){
  .pr3 {
    padding-right: 25px;
  }
  .pl3 {
    padding-left: 25px;
  }
  .container>.container{
    padding-left:0;
    padding-right:0;
  }
}

@media screen and (max-width: 700px){
  .pr3 {
    padding-right: 0;
  }
  .pl3 {
    padding-left: 0;
  }
}

#menu-home{
  transition: top .2s;
}

#menu-home.fixed-header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
    animation: innav .3s 1;
    border-bottom: 1px solid rgba(51, 51, 51, 0.05);
    .menu-wrapper {
      padding-bottom: 3px;
      padding-top: 8px!important;
    }

}


.soporte-menu {
    height: 98px;
    background: #f6f6f6;
}



.fixed-header-site .overlay--active {
    display: none;
}

@media screen and (max-width: 960px){
  #menu-home.fixed-header .menu-wrapper {
    padding-bottom: 13px;
    padding-top: 12px !important;
  }


  .soporte-menu {
      height: 78px;
  }

}

@-webkit-keyframes innav {
  0% {
    //background: red;
    top:-80px;
  }
  100% {
    //background: green;
    top:0px;
  }
}
@keyframes innav {
  0% {
    //background: red;
    top:-80px;
  }
  100% {
    //background: green;
    top:0px;
  }
}
@-o-keyframes innav {
  0% {
    //background: red;
    top:-80px;
  }
  100% {
    //background: green;
    top:0px;
  }
}

@-moz-keyframes innav {
  0% {
    //background: red;
    top:-80px;
  }
  100% {
    //background: green;
    top:0px;
  }
}
.container-left div.d-flex span {
    font-family: Carnas-Regular;
}
.coverThreeLeft{
  padding-top: 40px;
    padding-bottom: 30px
}






</style>
