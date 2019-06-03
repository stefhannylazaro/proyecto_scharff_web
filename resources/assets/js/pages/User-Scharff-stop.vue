<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhStop: isValid}" class="cover-height  bg-smoke">
        <div style="position:inline-block; width:100%;max-width:1440px">
          <carousel
                style="height: 100%;"
                class="carousel-slider"
                :perPage="1"
                :paginationEnabled="true"
                :navigationEnabled="true"
                paginationActiveColor="#ff535a"
                paginationColor="#b2ebd1"
                aginationSize="50"
                :autoplay="true"
                :autoplayTimeout="5000"
                :loop="true">

                <slide style="height:100%;" v-if="!sliContenidos  && !sliderDefault">
                    <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
                      <div class="timeline-wrapper">
                        <div class="timeline-item">
                            <div class="animated-background">
                                <div class="tl-1"></div>
                                <div class="tl-2">
                                  <div class="tlir-2"></div>
                                </div>
                                <div class="tl-3">
                                  <div class="tlir-3"></div>
                                </div>
                                <div class="tl-4">
                                  <div class="tlir-4"></div>
                                </div>
                                <div class="tl-5">
                                  <div class="tlir-5"></div>
                                </div>
                                <div class="tl-6">
                                  <div class="tlir-6"></div>
                                </div>
                                <div class="tl-7">
                                  <div class="tlir-7"></div>
                                </div>
                                <div class="tl-8">
                                  <div class="tlir-8"></div>
                                </div>
                                <div class="tl-9">
                                  <div class="tlir-9"></div>
                                </div>
                                <div class="tl-10">
                                  <div class="tlir-10"></div>
                                </div>
                                <div class="tl-11">
                                  <div class="tlir-11"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </v-container>
              </slide>


                <slide style="height:100%;" v-if="sliContenidos" v-for="(el, ind) in sliContenidos" :key="ind">
                  <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
                    <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree"
                    :style="'background-image:url(/elements/banner/'+el.imagen+')'">
                      <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                        <div class="coverThreeLeft">
                          <div class="container-left d-flex justify-center ">
                            <div class="d-flex pl-2 px-5">

                              <div>
                                <p class="send mb-0 white--text title-general" v-html="el.titulo"></p>
                              </div>
                              <span class="mt-2 white--text subtitle-general" v-html="el.subtitulo"></span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click.stop.prevent="openLoginRm"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                          </div>
                          <!--reserva tu locker  -->
                          <a href="#" v-scroll-to="'#express-s-b'" class="icon-position-center">
                            <v-icon large>keyboard_arrow_down</v-icon>
                          </a>
                        </div>
                      </v-flex>

                    </v-layout>
                  </v-container>


                </slide>

                <slide style="height:100%;" v-if="sliderDefault">
              <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
                <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree"
                :style="'background-image: url(/images/inner-a/img_principal_stop.png);'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">Entregar es más <br>sencillo </p>
                          </div>
                          <span class="mt-2">Envía y recibe paquetes sin trámites <br>ni intermediarios 24/7</span>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="black"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click.stop.prevent="openLoginRm">Reserva tu locker</v-btn>
                        </div>
                      </div>
                      <a href="#" v-scroll-to="'#express-s-b'" class="icon-position-center">
                        <v-icon large>keyboard_arrow_down</v-icon>
                      </a>
                    </div>
                  </v-flex>

                </v-layout>
              </v-container>
            </slide>



          </carousel>

        </div>
      </v-flex>











      <v-flex xs12 class="white" id="express-s-b">

        <v-container class="pb-0 px-0">
          <v-layout row wrap class="wrapper-cover">
            <v-flex class="pt-5">
              <h3 class="color-pink text-center font-bold title-component">
                ¿Cómo funciona?
              </h3>
              <p class="text-center font-medium sub-title-component">
                Sigue estos pasos
              </p>
            </v-flex>
            <v-flex xs12 mb-5>
              <smartphone-stop></smartphone-stop>

            </v-flex>

          </v-layout>
        </v-container>



      </v-flex>


      <v-flex xs12 class="white">
        <locker-size></locker-size>
      </v-flex>





      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height" id="aduanas-s-b">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height "
          style="background-image:url('/images/inner-a/img_seguro.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 offset-sm6 sm6 class="d-column-justify-right text-left order-0 d-column-justify-center pr3 pl3">
                  <h3 class="title-pink aux font-bold"><img src="/images/arrow_r.png" alt="flecha derecha"> <img src="/images/arrow_r.png" alt="flecha derecha" class="mr-3">
                                    seguro
                                  </h3>
                      <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
        			        	Cuidamos tus envíos y recojos
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
                        Nuestros lockers cuentan con cámaras de vigilancia <br>24/7. Te acompañamos en todo momento <br>y te notificamos vía SMS o correo.
                      </p>
        			        <div class="py-3 d-justify-right">
                        <v-btn round large outline class="cover gi-16" @click="openLoginRm">Reserva tu locker</v-btn>
        			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>




      <v-flex xs12>
        <search-your-elocker></search-your-elocker>
      </v-flex>





    </v-layout>
  </v-container>
  </v-app>
</template>

<script>
// import connectionHigh from '../components/cConnectionHigh.vue'
// import locateUs from '../components/cLocateUs.vue'
// import growCompany from '../components/cGrowCompany.vue'
// import howToWork from '../components/cInformationCompany.vue'
// import infoService from '../components/cInformationService.vue'
import { Carousel, Slide } from 'vue-carousel'
import imgText from '../components/text-img/cImgText.vue'
import textImgFull from  '../components/text-img/cTextImgFull.vue'
import howtowork from '../components/cExpressHowToWork.vue'
import growCompany from '../components/cGrowCompany.vue'
import smartphoneStop from '../components/cSmartphoneStop.vue'
import lockerSize from '../components/cLockerSize.vue'
import searchYourElocker from '../components/cSearchYourLocker.vue'
import { EventBus } from '../config/ebus.js';



export default {
  data () {
    return {


      windowHeight: null,
      windowWidth: null,
      isValid:false,
      coverResposive: false,



      sliContenidos:null,

      sliderDefault:false

    }
  },
  mounted () {
    this.getWindowHeight();
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
    activeSlider:function(value){

      var sliderAux = [];

      value.forEach(function(el){
        if(el.slug==='scharff_stop'){
          sliderAux.push(el);
        }
      });

      if(sliderAux.length>0){
        this.sliContenidos = sliderAux;
      }else{
        this.sliderDefault = true;
      }
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
    openLoginRm(){
      EventBus.$emit('openLoginRm','stop');
    }
  },
  components: {
    Carousel,
    Slide,
    'grow-your-company':growCompany,
    'how-to-work': howtowork,
    'img-text': imgText,
    'locker-size': lockerSize,
    'text-img-full': textImgFull,
    'smartphone-stop': smartphoneStop,
    'search-your-elocker':searchYourElocker
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.minSize{
  height: 30rem;
  width: 100%;
}

.widthTen{
  width: 30rem;
}
.express-img-height{
  height: 2.6rem;
}
@media screen and (max-width: 559px){
  .widthTen{
    width: 23rem!important
  }
  // .express-img-height{
  //   height: 2rem;
  // }
}
.btn-cover-banner{
  // color:red;
  padding: 1.8rem 4rem;
  font-size: 1.6rem;
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
.hVhStop{
  min-height: calc(100vh - 91px);
}



.cImg-text-height{
  max-height: 30rem
}
@media screen and (max-width:430px) {
  .cImg-text-height{
    max-height: 23rem;
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
.c-search-locker h3{
  font-size: 22px;
}
.c-search-locker .s-input img {
    width: 2.34rem;

    position: relative;
    top: 5px;
}
.c-search-locker .s-input input {
    font-size: 2.6rem;
    font-family: Carnas-light;
}
.control-item__active .content-title{
  font-family: Carnas-medium;
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
  .title-pink {
    font-size: 4rem;
  }
  .title-pink.aux img {
      width: 1.3rem;
  }
}
.mapaylista--out {
    padding-top: 24px;
}
</style>
