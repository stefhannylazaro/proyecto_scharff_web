<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhExpress: isValid}" class="cover-height  bg-smoke">
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


                <slide style="height:100%;" v-if="!sliContenidos && !sliderDefault">
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
                      <v-flex xs12 sm6 md7 lg7 xl7 class="cover-col">
                        <div class="coverThreeLeft">
                          <div class="container-left d-flex justify-center ">
                            <div class="d-flex pl-2 px-5">

                              <div>
                                <p class="send mb-0 white--text title-general" v-html="el.titulo"></p>
                              </div>
                              <span class="mt-2 white--text subtitle-general" v-html="el.subtitulo"></span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13"  @click.stop.prevent="openLoginRm"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
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

                <slide style="height:100%;" v-if="sliderDefault">
              <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
                <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree"
                :style="'background-image: url(/images/slider_express.png);'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">Entregamos por ti</p>
                          </div>
                          <span class="mt-2">Moviliza tus paquetes rápidamente con <br> nuestra red de delivery express.</span>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click.stop.prevent="openLoginRm">Solicitar envío</v-btn>
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
      <!-- <v-flex xs12 class="bg-smoke py-2">
        <div class="font-regular">
          <div class="d-align-center justify-center flex-row-wrap">
            <p class="ma-0 mr-2 text-center pa-2" style="font-size: 1.2rem;">Descarga nuestra app para tener toda la información de tus pedidos</p>
            <div class="d-justify-center">
              <img class="mx-1 express-img-height"  v-for="el in storeIcons" :src="el.url">
            </div>
          </div>
        </div>
      </v-flex> -->
      <v-flex xs12 class="white" id="express-s-b">
        <how-to-work id="howToWork"></how-to-work>
      </v-flex>
      <v-flex xs12>
        <img-text
          :bgIsSmoke="bgIsSmokeScharffer"
          :imgBase="motoExpress"
          :showTitle="showTitleScharffer"
          :title="titleScharffer"
          :subTitle="subTitleScharffer"
          :content="contentScharffer"
          >
            <v-btn
              slot="btnComponent"
              round large outline
              color="black"
              class="cover elevation-0"
              @click="gotoUnirse"
              v-scroll-to="'#formGrow'">
                Quiero ser Scharffer!
            </v-btn>
          </img-text>
      </v-flex>
      <v-flex class="bg-smoke">
        <text-img-full
            v-on:login_attemp="openLoginRm"

        ></text-img-full>
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
// import howToWork from '../components/cInformationCompany.vue'
// import infoService from '../components/cInformationService.vue'
import { Carousel, Slide } from 'vue-carousel'
import imgText from '../components/text-img/cImgText.vue'
import textImgFull from  '../components/text-img/cTextImgFull.vue'
import howtowork from '../components/cExpressHowToWork.vue'
import growCompany from '../components/cGrowCompany.vue'
import { EventBus } from '../config/ebus.js';

export default {
  data () {
    return {
      storeIcons: [
        {url:'./images/app-store.svg', alt: 'app store'},
        {url:'./images/play-store.svg', alt: 'play store'},
      ],

      motoExpress: {url:'./images/moto_express.png', alt: 'moto scharff'},

      // peopleCover: {url:'./images/person.png', alt: 'people staff Scharff'},
      // circleOne: {url:'./images/item_one.png', alt: 'right circle'},
      // circleTwo: {url:'./images/item_two.png', alt: 'right circle'},
      circleThree: {url:'./images/item_three.png', alt: 'right circle'},
      windowHeight: null,
      windowWidth: null,
      isValid:false,
      elipseEmpty: {url:'./images/elipse-empty.png', alt: 'elipse'},
      elipseActive: {url:'./images/elipse_active.png', alt: 'elipse'},
      coverResposive: false,

      titleScharffer:'¡Únete a nuestro equipo de Scharffers!',
      subTitleScharffer: '¡Únete a nuestro equipo de Scharffers!',
      contentScharffer: '¿Te gusta montar bicicleta o pasear en moto? Sácale provecho a tu tiempo libre y gana dinero en tus recorridos diarios.',
      showTitleScharffer: false,
      bgIsSmokeScharffer: false,


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
    gotoUnirse:function(){
      this.$router.push('unirse-scharffer');
      var vm = this;
      setTimeout(function(){
        vm.$scrollTo('#menu-home', 300);
      },800);

    },
    activeSlider:function(value){

      var sliderAux = [];

      value.forEach(function(el){
        if(el.slug==='scharff_express'){
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
    },openLoginRm(){
      EventBus.$emit('openLoginRm','express');
    }
  },
  components: {
    Carousel,
    Slide,
    'grow-your-company':growCompany,
    'how-to-work': howtowork,
    'img-text': imgText,
    'text-img-full': textImgFull,
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
.hVhExpress{
  // min-height: calc(100vh - 148px);
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
}
</style>
