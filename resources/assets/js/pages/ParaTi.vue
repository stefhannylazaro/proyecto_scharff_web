<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhParaTi: isValid}" class="cover-height  bg-smoke">
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
                              <span class="mt-2 white--text subtitle-general" v-if="el.subtitulo" v-html="el.subtitulo"></span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click="gotoByUrl(el.url)"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                            <!-- Solicitar envio -->
                          </div>
                          <a href="#" v-scroll-to="'#parati-s-b'" class="icon-position-center">
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
                :style="'background-image:url(/images/inner-a/img_principal.png)'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">Haz tus envíos de <br>la manera más fácil </p>
                          </div>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'">Solicitar envío</v-btn>
                        </div>
                      </div>
                      <a href="#" v-scroll-to="'#parati-s-b'" class="icon-position-center">
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

      <v-flex xs12 class=" py-2">
        <div class="font-regular">
          <div class="d-align-center justify-center flex-row-wrap">
            <p class="ma-0 mr-2 text-center pa-2" style="font-size: 1.2rem;">¿Quieres ver el estado de tu pedido? nosotros te ayudamos</p>
            <div class="d-justify-center">
              <v-btn round outline class="cover btn-mediano" @click="$store.commit('setStateTracking', true)">tracking online</v-btn>
            </div>
          </div>
        </div>
      </v-flex>


      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height bg-smoke " id="parati-s-b">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height "
          style="background-image:url('/images/inner-a/img_scharff_express.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm6 offset-sm6 class="d-column-justify-right text-right order-0 d-column-justify-center pr3">
    			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
    			        	Entregamos por ti.
    			        </p>
    			        <p class="  font-light cImg-text-content ">
    			          Accede a una red colaborativa de entrega <br>express. Haz un envío desde tu oficina o de la <br>comodidad de tu casa.
    			        </p>
    			        <div class="py-3 d-justify-right">
                    <v-btn round large outline class="cover gi-16" v-scroll-to="'#formGrow'">Conocer más</v-btn>
    			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>






      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height  ">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height bgr"
          style="background-image:url('/images/inner-a/img_scharff_stop.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12  sm6 class="d-column-justify-right text-left order-0 d-column-justify-center pl3">
    			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
    			        	Entregar es más sencillo</p>
    			        <p class="  font-light cImg-text-content ma-0">
    			          Haz tus envíos y recibe paquetes sin <br>trámites ni intermediarios. <br> <strong>Todo es posible.</strong></p>
    			        <div class="py-3 d-justify-right">
                    <v-btn round large outline class="cover gi-16" v-scroll-to="'#formGrow'">Conocer más</v-btn>
    			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>







      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height bg-smoke ">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height "
          style="background-image:url('/images/inner-a/img_fedex.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm6 offset-sm6 class="d-column-justify-right text-right order-0 d-column-justify-center pr3">
    			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
    			        	Llega a dónde menos <br>te lo imaginas.
    			        </p>
    			        <p class="  font-light cImg-text-content ma-0">
    			          Haz tus pedidos y envíos a Estados Unidos u<br> otros países. Somos representantes<br> de FEDEX en Perú y Bolivia.
    			        </p>
    			        <div class="py-3 d-justify-right">
                    <v-btn round large outline class="cover gi-16" v-scroll-to="'#formGrow'">Solicitar envío</v-btn>
    			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>




      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height  ">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full  full-height bgc"
          style="background-image:url('/images/inner-a/img_calculador.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
                  <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
                    Calcula y envía
                  </p>
                  <p class="  font-light cImg-text-content ma-0">

                    <strong>Olvídate de las complicaciones.</strong> <br>
                    solo piensa lo que quieres enviar y a dónde, <br>nosotros hacemos el resto.
                  </p>
                  <br>
                  <br>
                  <div class="py-3 d-justify-right">
                    <v-btn round large color="black" class="cover white black--text elevator-0" href="#" v-scroll-to="'#formGrow'">
                            Solicitar envío
                          </v-btn>
                  </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
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
import howtowork from '../components/cExpressHowToWork.vue'
import { Carousel, Slide } from 'vue-carousel'
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
        if(el.slug==='paraTi'){
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
    }
  },
  components: {
    coverPage,
    Carousel,
    Slide,
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
.hVhParaTi{
  min-height: calc(100vh - 163px);
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

.cuadro-bordeado {
    background: #f6f6f6;
    box-shadow: 0px 1px 11px #f6f6f6;
    padding: 32px 20px;
    width: 233px;
    margin: auto;
    transition: all .2s;
    h5{
      font-size: 19px;
      margin-bottom: 9px;
    }
}
.cuadro-bordeado:hover {
  box-shadow: 0px 1px 11px rgba(128, 128, 128, 0.33);
  background: #fafafa;
}
.circulo-borde-rojo {
  display: block;
  border: 4px solid rgba(128, 128, 128, 0.33);
  width: 106px;
  height: 106px;
  border-radius: 113px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;
  margin-bottom: 18px;
  transition: all .2s;
}
.cuadro-bordeado:hover .circulo-borde-rojo {
  border: 4px solid $primary-color;
}
.btn-mediano{
    height: 47px;
    font-family: Carnas-medium;
    font-size: 17px;
}
.btn-mediano .btn__content{
  padding: 0 29px;
}

@media screen and (max-width: 1100px){
  .bg-slotTree .cover-col .send {
      font-size: 2.4rem;
  }
}

@media screen and (max-width: 879px){
  .layout.pb-5>div {
    padding-bottom: 22px;
  }

  .layout.pb-5 {
      flex-direction: column;
  }
}
</style>
