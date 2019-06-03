<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhAlmacenes: isValid}" class="cover-height  bg-smoke">
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
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click="gotoByUrl(el.url)"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                          </div>

                          <a href="#" v-scroll-to="'#almacen-s-b'" class="icon-position-center">
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
                :style="'background-image:url(/images/inner-a/img_almacen.png)'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">El espacio que tu negocio <br>necesita para crecer</p>
                          </div>
                          <span class="mt-2">Contamos con múltiples almacenes <br> en el Perú</span>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'">&nbsp;&nbsp;&nbsp;&nbsp;Cotizar&nbsp;&nbsp;&nbsp;&nbsp;</v-btn>
                        </div>
                      </div>

                      <a href="#" v-scroll-to="'#almacen-s-b'" class="icon-position-center">
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

      <v-flex xs12 class="bg-smoke py-2">
        <div class="font-regular">
          <div class="d-align-center justify-center flex-row-wrap">
            <p class="ma-0 mr-2 text-center pa-2" style="font-size: 1.2rem;">¿Ya eres cliente Scharff? Mira el estado de tus envíos o importaciones</p>
            <div class="d-justify-center">
              <v-btn v-if="!sesionIniciada" round outline class="cover btn-mediano" @click="stateChangeLogin()">Iniciar sesión</v-btn>
              <v-btn v-if="sesionIniciada" round outline class="cover btn-mediano" @click="gotoAdmin()">Acceder</v-btn>
            </div>
          </div>
        </div>
      </v-flex>



      <v-flex  xs12 class="cover-height">
        <div style="position:inline-block; width:100%;max-width:1440px" id="almacen-s-b">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
        			        	Servicio de almacenaje
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
        			          Somos flexibles nos adaptamos a tus necesidades. <br>
                        <strong>Pensamos en ti.</strong>
        			        </p>

        				</v-flex>
        			</v-layout>



              <v-layout pb-5 class="al-cuadro-bordeado-w">
        				<v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="al-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_amedida.png" alt="">
                      </span>
                      <h5 class=" black--text">Simple</h5>
                      <p>Hangares y almacenes modernos acondicionados al acopio de mercadería de cualquier tipo.</p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="al-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_centro.png" alt="">
                      </span>
                      <h5 class=" black--text">Centro de distribución</h5>
                      <p>Ideal para comercios minoristas o ecommerce para distribución más eficiente, flexible y dinámica.</p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="al-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_dtca.png" alt="">
                      </span>
                      <h5 class=" black--text">DTCA</h5>
                      <p>Almacén temporal de carga aduanera. <br>Gestionamos tu mercadería en nuestro almacén. </p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="al-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_amedida.png" alt="">
                      </span>
                      <h5 class=" black--text">A medida</h5>
                      <p>Gestionamos y optimizamos tu almacén</p>
                     </div>

        				</v-flex>

        			</v-layout>


        		</v-container>


        	</v-container>

        </div>

      </v-flex>










      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height  ">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height "
          style="background-image:url('/images/inner-a/img_almacen_section2.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 offset-sm6 sm6 class="d-column-justify-right text-right order-0 d-column-justify-center pr3">
        			        <p class=" white--text font-bold pb-3 cImg-text-subtitle ma-0">
        			        	La mejor tecnología de <br>almacenes para tu negocio
        			        </p>
        			        <p class=" white--text font-light cImg-text-content ma-0">
        			          Todos nuestros almacenes son operados con un<br> Sistema de Gestión de Almacenes(WMS) para<br> darte la trazabilidad que necesitas
        			        </p>
        			        <div class="py-3 d-justify-right">
                         <v-btn round large color="black" class="cover white black--text elevator-0" href="#" v-scroll-to="'#formGrow'">
                            &nbsp;&nbsp;Cotizar&nbsp;&nbsp;
                          </v-btn>

        			        </div>
        				</v-flex>
        			</v-layout>
        		</v-container>


        	</v-container>

        </div>
      </v-flex>











      <v-flex  xs12 class="cover-height brands-section">
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
                      <img src="/images/clientes/aduanas/aceros_arequipa.jpg" alt="">
                      <img src="/images/clientes/aduanas/adm.jpg" alt="">
                      <img src="/images/clientes/aduanas/altamar_food.jpg" alt="">
                      <img src="/images/clientes/aduanas/ausa.jpg" alt="">
                      <img src="/images/clientes/aduanas/blue_star.jpg" alt="">
                      <img src="/images/clientes/aduanas/cargill.jpg" alt="">
                      <img src="/images/clientes/aduanas/kuehne.jpg" alt="">
                      <img src="/images/clientes/aduanas/limones_piuranos.jpg" alt="">
                      <img src="/images/clientes/aduanas/llamagas.jpg" alt="">
                      <img src="/images/clientes/aduanas/neptunia.jpg" alt="">
                      <img src="/images/clientes/aduanas/pronatur.jpg" alt="">
                      <img src="/images/clientes/aduanas/samsung.jpg" alt="">
                      <img src="/images/clientes/aduanas/sunshine.jpg" alt="">
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
                        <img src="/images/clientes/almacen/3m.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>


                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/bbva.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/cencosud.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/embajada_usa.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/entel.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/ipesa.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/ishop.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/klingspor.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>


                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/philips.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/samsung.jpg" alt="">
                      </span>
                     </div>
                   </v-flex>
                 </slide>

                <slide>
                  <v-flex class="d-column-justify-right text-center order-0 d-column-justify-center">
        			       <div class="confian-item">
                      <span class="">
                        <img src="/images/clientes/almacen/volvo.jpg" alt="">
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
// import howToWork from '../components/cInformationCompany.vue'
// import infoService from '../components/cInformationService.vue'
import imgText from '../components/text-img/cImgText.vue'
import textImgFull from  '../components/text-img/cTextImgFull.vue'
import howtowork from '../components/cExpressHowToWork.vue'
import carouselClientes from '../components/cCarouselClientes.vue'
import { Carousel, Slide } from 'vue-carousel'
export default {
  props:['sesionIniciada','nombreUsuario'],
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
      isTrue: false,
      elipseEmpty: {url:'./images/elipse-empty.png', alt: 'elipse'},
      elipseActive: {url:'./images/elipse_active.png', alt: 'elipse'},
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
        if(el.slug==='almacenes'){
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
      console.log(this.isValid);
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
    'how-to-work': howtowork,
    'grow-your-company':growCompany,
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
.hVhAlmacenes{
  min-height: calc(100vh - 163px);
}




.cImg-text-height{
  max-height: 30rem
}
@media screen and (max-width:800px) {
  .cImg-text-subtitle br,
  .cImg-text-content br{
    display: none;
  }
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

.al-cuadro-bordeado {
    background: #fafafa;
    box-shadow: 0px 1px 11px #fafafa;
    padding: 32px 20px;
    width: 300px;
    margin: auto;
    transition: all .2s;
    h5{
      font-size: 19px;
      margin-bottom: 9px;
      font-family: 'Carnas-Bold';
      font-weight: 500;
    }
    p{
      font-family: 'Carnas-Regular';
    }
}
.al-cuadro-bordeado:hover {
box-shadow: 0px 1px 11px rgba(128, 128, 128, 0.33);

}
.circulo-borde-rojo {
  display: block;
  border: 5px solid rgba(128, 128, 128, 0.33);
  width: 126px;
  height: 126px;
  border-radius: 113px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: auto;
  margin-bottom: 18px;
  transition: all .2s;
}
.al-cuadro-bordeado:hover .circulo-borde-rojo {
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

@media screen and (max-width: 1315px){
  .al-cuadro-bordeado{
    width: 237px;
  }

}
@media screen and (max-width: 1050px){
  .al-cuadro-bordeado{
    width: 325px;
    margin-bottom: 10px;
    max-width: 100%;
  }

  .al-cuadro-bordeado-w{
    flex-wrap: wrap;
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
