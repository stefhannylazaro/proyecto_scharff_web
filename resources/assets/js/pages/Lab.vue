<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhLab: isValid}" class="cover-height  bg-smoke">
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
                      <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                        <div class="coverThreeLeft">
                          <div class="container-left d-flex justify-center ">
                            <div class="d-flex pl-2 px-5">

                              <div>
                                <p class="send mb-0 black--text title-general" v-html="el.titulo"></p>
                              </div>
                              <span class="mt-2" v-html="el.subtitulo"></span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click="gotoByUrl(el.url)"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                          </div>
                          <a href="#" v-scroll-to="'#aduanas-s-b'" class="icon-position-center">
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
                    :style="'background-image:url(/images/inner-a/img_principallab.png)'">
                      <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                        <div class="coverThreeLeft">
                          <div class="container-left d-flex justify-center ">
                            <div class="d-flex pl-2 px-5">

                              <div>
                                <p class="send mb-0 black--text">Transformando la forma <br> de hacer logística </p>
                              </div>
                              <span class="mt-2">Creamos el primer laboratorio de innovación <br> logística en el Perú.</span>
                            </div>
                            <div class="py-3 px-5">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'">&nbsp;&nbsp;&nbsp;&nbsp;Conocer más&nbsp;&nbsp;&nbsp;&nbsp;</v-btn>
                            </div>
                          </div>
                          <a href="#" v-scroll-to="'#aduanas-s-b'" class="icon-position-center">
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


      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height" id="aduanas-s-b">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height "
          style="background-image:url('/images/inner-a/img_contenidolab.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 offset-sm6 sm6 class="d-column-justify-right text-right order-0 d-column-justify-center pr3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
        			        	Explora. Crea. Implementa
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
                        Usamos metodologías ágiles y de design thinking<br> para diseñar soluciones disruptivas basadas en el <br> usuario.
                      </p>
        			        <div class="py-3 d-justify-right">
                        <v-btn round large outline class="cover gi-16" v-scroll-to="'#formGrow'">Quiero idear</v-btn>
        			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>









      <v-flex  xs12 class="cover-height bg-smoke brands-section">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
        			        	Ya confían en nosotros
        			        </p>
        				</v-flex>
        			</v-layout>




              <carousel-clientes>
                <div slot="clientes">
                  <div class="carousel-mobil">
                    <div class="carouselCycle2 ">
                      <img src="/images/clientes/lab/bbva.jpg" alt="">
                      <img src="/images/clientes/lab/bcp.jpg" alt="">
                      <img src="/images/clientes/lab/claro.jpg" alt="">
                      <img src="/images/clientes/lab/creditex.jpg" alt="">
                      <img src="/images/clientes/lab/lapositiva.jpg" alt="">
                    </div>
                  </div>
                </div>
              </carousel-clientes>



              <carousel

                class="carousel-slider pb-5 carousel-pc"
                :perPage="4"


                :autoplayTimeout="3000"
                :loop="true"
                :paginationEnabled="false">
                <slide>
          				<v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/lab/bbva.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>


                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/lab/bcp.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/lab/claro.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>


                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/lab/creditex.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/lab/lapositiva.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

              </carousel>










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
import growCompany from '../components/cGrowCompany.vue'
// import infoService from '../components/cInformationService.vue'
import imgText from '../components/text-img/cImgText.vue'
import textImgFull from  '../components/text-img/cTextImgFull.vue'
import howtowork from '../components/cExpressHowToWork.vue'
import carouselClientes from '../components/cCarouselClientes.vue'
import { Carousel, Slide } from 'vue-carousel'

//import { jQuery } from 'jQuery'
export default {
  data () {
    return {

      // peopleCover: {url:'./images/person.png', alt: 'people staff Scharff'},
      // circleOne: {url:'./images/item_one.png', alt: 'right circle'},
      // circleTwo: {url:'./images/item_two.png', alt: 'right circle'},
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
        if(el.slug==='scharff_lab'){
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
    //jQuery,
    'grow-your-company':growCompany,
    'how-to-work': howtowork,
    'img-text': imgText,
    'text-img-full': textImgFull,
    'carousel-clientes': carouselClientes,
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
.hVhLab{
  min-height: calc(100vh - 95px);
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
    background: #fff;
    box-shadow: 0px 1px 11px rgba(128, 128, 128, 0.33);
    padding: 32px 20px;
    width: 233px;
    margin: auto;
    h5{
      font-size: 19px;
      margin-bottom: 9px;
    }
}

.circulo-borde-rojo {
  display: block;
  border: 4px solid $primary-color;
  width: 106px;
  height: 106px;
  border-radius: 113px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;
  margin-bottom: 18px;
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

  .layout.pb-5 {
      flex-direction: column;
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
