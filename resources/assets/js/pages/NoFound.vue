<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>



      <v-flex  xs12 class="cover-height bg-white">
        <div style="position:inline-block; width:100%;max-width:1440px" id="block-404">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout row wrap>
                <v-flex xs12 sm12 md6 lg6 class="text-left order-0 d-column-justify-center mt-3">
                    <h3 class="font-bold-m color-gray mb-2">Error 404</h3>
                    <h1 class="color-pink font-bold-m pb-3 cImg-text-subtitle  ma-0">¡Oops! Parece que no conoces a tu destinatario</h1>
        			      <p class="cImg-text-content mb-2">
        			          La página de destino que buscas no existe.
        			      </p>
                    <p class="font-bold">
                      <span @click="backToHome()" style="cursor:pointer" class="py-1">Regresar al home</span>
                    </p>

        				</v-flex>
                <v-flex xs12 sm12 md6 lg6 class="text-center order-0 d-column-justify-center mt-3">
        			       <figure>
                       <img src="/images/dron.png" alt="" class="img-404">
                     </figure>
        				</v-flex>
        			</v-layout>

        		</v-container>


        	</v-container>

        </div>

      </v-flex>

      <v-flex xs12 class="bg-company-information">
        <grow-your-company></grow-your-company>
      </v-flex>



    </v-layout>
  </v-container>
  </v-app>
</template>

<script>
// import connectionHigh from '../components/cConnectionHigh.vue'
// import locateUs from '../components/cLocateUs.vue'
// import growCompany from '../components/cGrowCompany.vue'
import coverPage from '../components/cCoverExpress.vue'
// import howToWork from '../components/cInformationCompany.vue'
// import infoService from '../components/cInformationService.vue'
import imgText from '../components/text-img/cImgText.vue'
import textImgFull from  '../components/text-img/cTextImgFull.vue'
import growCompany from '../components/cGrowCompany.vue'
import carouselClientes from '../components/cCarouselClientes.vue'
import { Carousel, Slide } from 'vue-carousel'
export default {
  props:['sesionIniciada','nombreUsuario'],
  data () {
    return {

      windowHeight: null,
      windowWidth: null,
      isValid:false,
      coverResposive: false,

      sliContenidos:null,

      sliderDefault:false//asd

    }
  },
  mounted () {
    this.getWindowHeight()
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
    });

    this.$parent.$on('ejecutar_slider', this.activeSlider);
  },
  watch: {
    // windowHeight: function (el) {
    //   if(el > 700){
    //     this.isValid = true
    //   } else {
    //     this.isValid = false
    //   }
    //   if(this.windowWidth< el){
    //     this.isValid = false
    //   }
    //   // if()
    // },
    windowWidth: function (el){
      if(el < 600){
        this.isValid = true
        this.coverResposive = true
        // this.isTrue = true
      } else {
        this.isValid = true
        this.coverResposive = false
        // this.isTrue = false
      }
    }
  },
  methods: {
    backToHome: function() {
      this.$router.push('/')
      this.pathActual();
      this.$scrollTo('#menu-home',1000);
      //this.$parent.$emit('loadDataAsincrono', 1);
    },
    activeSlider:function(value){

      var sliderAux = [];

      value.forEach(function(el){
        if(el.slug==='gobuy'){
          sliderAux.push(el);
        }
      });

      if(sliderAux.length>0){
        this.sliContenidos = sliderAux;
      }else{
        this.sliderDefault = true;
      }

      //this.sliderDefault = true;//asd
    },
    getWindowHeight(event) {
      // console.log(event)
      this.windowHeight = document.documentElement.clientHeight
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowHeight)
    },
    stateChangeLogin: function () {
      this.$store.commit('setStateLogin', true)
    },
    stateChangeRegister: function () {
      let topCero = window.scrollTo(0,0)
      this.$store.commit('setStateRegister', true)
    },
    gotoAdmin:function(){
      if(this.nombreUsuario==='Superadmin'){
        document.location ='/superadmin';
      }else{
        this.$router.push('/admin');
      }

      document.title='Scharff - Grupo Scharff'
    },
  },
  components: {
    coverPage,
    Carousel,
    Slide,
    'grow-your-company':growCompany,
    'img-text': imgText,
    'text-img-full': textImgFull,
    'carousel-clientes': carouselClientes,
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
#menu-home {
  background: white;
}
.img-404 {
  width: 100%;
  max-width: 688px;
}

.primary-color {
  color: $primary-color;
}
.pdd-section {
  padding: 9em 0 2em;
}
.search-url {
  margin-top: -4.5em;
}
.input-url {
  vertical-align: top;
  border: 3px solid #ff535a;
  padding: 16px;
  width: 70%;
  max-width: 900px;
  border-radius: 8px 0 0 8px;
  background: white;
  font-size: 16px;
  font-size: 16px;
  height: 62px;
  &:focus {
    outline: none;
  }
}

.btn-url{
  padding: 7px 36px;
  background: #ff535a;
  color: white;
  border-radius: 0 8px 8px 0;
  border: 2px solid #ff535a;
  font-size: 24px;
  font-weight: bold;
  vertical-align: top;
  height: 62px;
}
.bg-clients {
  background: #fbfbfb;
}
.minSize{
  height: 30rem;
  width: 100%;
}
.line {
  background: #ff535a;
  height: 4px;
  position: absolute;
  top: 86px;
  width: 103%;
  left: 72%;
  z-index: 9;
}
.widthTen{
  width: 30rem;
}
.express-img-height{
  height: 2.6rem;
}
.carousel-slider .VueCarousel-inner {
  align-items: center;
}
@media screen and (max-width: 559px){
  .d-cuadro-bordeado-w {
    >div{
      width: 100% !important;
    }
  }
  .widthTen{
    width: 23rem!important
  }
  // .express-img-height{
  //   height: 2rem;
  // }
}
.btn-cover-banner{
  // color:red;
  padding: 2rem;
  font-size: 1.3rem;
  font-family: Carnas-Regular;
  div.btn__content{
    line-height: .3rem;

  }
  &.gi-13 div.btn__content{
    padding: 0;
    line-height: .2rem;
  }

}
.hVhSections{
  min-height: calc(100vh - 21px);
}
.hVhDomestica{
  min-height: calc(100vh - 163px);
}




.cImg-text-height{
  max-height: 30rem
}
@media screen and (max-width:430px) {
  .cImg-text-height{
    max-height: 23rem;
  }
  .input-url {
    width: 60%;
  }
  #block-404 {
    margin: 0 !important;
  }
}
@media screen and (max-width:430px) {
  .cImg-text-height{
    max-height: 20rem;
}
}
.cImg-text-title{
  font-size: 4rem;
}
.cImg-text-subtitle{
  font-size: 2.5rem;
}
.cImg-text-content{
  font-size: 1.3rem;
}

.full-height{
  height: 100%;
}
.d-cuadro-bordeado-w {
  div{
    &:nth-child(4){
      .d-cuadro-bordeado::before {
        width: 0;
      }
    }
  }
}
.d-cuadro-bordeado {
    background: #f6f6f6;
    box-shadow: 0px 1px 11px #f6f6f6;
    padding: 32px 20px;
    width: 233px;
    margin: auto;
    transition: all .2s;
    position: relative;
    h5{
      font-size: 19px;
      margin-bottom: 9px;
      font-family: 'Carnas-Bold';
      font-weight: 500;
    }
    p{
      font-family: 'Carnas-Regular';
    }
    &::before {
      content: '';
      color: $primary-color;
      background: #ff535a;
      height: 4px;
      position: absolute;
      top: 86px;
      width: 103%;
      left: 72%;
      z-index: 1;
    }
}
.d-cuadro-bordeado:hover {
//box-shadow: 0px 1px 11px rgba(128, 128, 128, 0.33);
//background: #fafafa;
}
.circulo-borde-rojo {
  background: white;
  display: block;
  border: 5px solid $primary-color;
  width: 120px;
  height: 120px;
  border-radius: 113px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;
  margin-bottom: 18px;
  transition: all .2s;
  z-index: 1;
  position: relative;
  img {
    transform: scale(.9);
  }
}
.d-cuadro-bordeado:hover .circulo-borde-rojo {
  border: 5px solid $primary-color;
}
.btn-mediano{
    height: 47px;
    font-family: Carnas-medium;
    font-size: 17px;
}
.btn-mediano .btn__content{
  padding: 0 29px;
}

@media screen and (max-width: 879px){
  .layout.pb-5>div {
    padding-bottom: 22px;
  }


}
@media screen and (max-width: 1280px){
  .d-cuadro-bordeado{
        width: 206px;
  }
}
@media screen and (max-width: 1110px){
  .d-cuadro-bordeado{
        width: 197px;
  }
}
@media screen and (max-width: 1080px){
  .d-cuadro-bordeado{
        width: 250px;
        margin-bottom: 10px;
        padding: 24px 20px;
  }
  .d-cuadro-bordeado-w{
    flex-wrap: wrap;
  }
}
@media screen and (max-width: 1065px){
  .d-cuadro-bordeado-w {
    >div{
      width: 50%;
      .d-cuadro-bordeado::before {
        width: 0;
      }
    }
  }
}
.bg-slotTree .cover-col{
  justify-content: flex-start;
  padding-left: 109px;
}
@media screen and (max-width: 1100px){
  .bg-slotTree .cover-col {
      padding-left: 30px;
  }
  .bg-slotTree .cover-col .send {
      font-size: 2.4rem;
  }
}
@media screen and (max-width: 900px){
  .bg-slotTree .cover-col {
      padding-left: 0;
  }
  .pdd-section {
    padding: 6em 0 1em;
  }

}
@media screen and (max-width: 960px){
  .img-404 {
    max-width: 500px;
  }
  #block-404 {
    margin: 0 35px;
  }
}
@media screen and (max-width: 600px){
  .pdd-section {
    padding: 2em 0 0em;
  }
  .search-url {
    margin-top: -5em;
  }
  .cImg-text-subtitle {
    font-size: 2rem;
  }
}
</style>
