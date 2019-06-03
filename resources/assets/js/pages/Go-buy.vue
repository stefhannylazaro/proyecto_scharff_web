<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhDomestica: isValid}" class="cover-height  bg-smoke">
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
                      <v-flex xs12 sm8 md7 lg7 xl7 class="cover-col">
                        <div class="coverThreeLeft">
                          <div class="container-left d-flex justify-center ">
                            <div class="d-flex pl-2 px-5">

                              <div>
                                <p class="send mb-0 black--text" v-html="el.titulo">¡Traer tus compras online nunca fue tan fácil!</p>
                              </div>
                              <span class="mt-2" v-html="el.subtitulo">Envía tus compras a nuestro almacén y recíbelas en casa</span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                          </div>
                          <a href="#" v-scroll-to="'#steps-buy'" class="icon-position-center">
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
                :style="'background-image:url(/elements/banner/banner-demo/img_gobuy.png)'">
                  <v-flex xs12 sm8 md7 lg7 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">¡Traer tus compras online nunca fue tan fácil!</p>
                          </div>
                          <span class="mt-2">Envía tus compras a nuestro almacén y recíbelas en casa</span>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'">&nbsp;&nbsp;&nbsp;&nbsp;Registra tus compras aquí&nbsp;&nbsp;&nbsp;&nbsp;</v-btn>
                        </div>
                      </div>
                      <a href="#" v-scroll-to="'#steps-buy'" class="icon-position-center">
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
            <p class="ma-0 mr-2 text-center pa-2" style="font-size: 1.2rem;">¿Ya eres cliente Scharff? Inicia sesión para ver el estado de tus pedidos.</p>
            <div class="d-justify-center">
              <v-btn v-if="!sesionIniciada" round outline class="cover btn-mediano" @click="stateChangeLogin()">Iniciar sesión</v-btn>
              <v-btn v-if="sesionIniciada" round outline class="cover btn-mediano" @click="gotoAdmin()">Acceder</v-btn>
            </div>
          </div>
        </div>
      </v-flex>


      <v-flex  xs12 class="cover-height  bg-smoke" id="steps-buy">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
        			        	¿Cómo traer tus compras?
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
        			          Son 3 sencillos pasos.
        			        </p>

        				</v-flex>
        			</v-layout>

              <v-layout pb-5 class=" d-cuadro-bordeado-w">
        				<v-flex class="d-column-justify-right text-center order-0">
        			       <div class="d-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_paso2.png" alt="">
                      </span>

                      <h1 class="primary-color">01</h1>
                      <h5 class="my-2 black--text">¡Compra<br>Online!</h5>
                      <p>Te daremos una dirección<br>de entrega. ¡Ingrésala!</p>
                     </div>

        				</v-flex>

                <!-- <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="d-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_paso2.png" alt="">
                      </span>
                      <h1 class="primary-color">2</h1>
                      <h5 class=" black--text">Go&Buy</h5>
                      <p>Ingresa a Go&Buy, copia la dirección en Estado Unidos y usala para enviar tus compras.</p>
                     </div>

        				</v-flex> -->

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="d-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_paso3.png" alt="">
                      </span>
                      <h1 class="primary-color">02</h1>
                      <h5 class="my-2 black--text">¡Confirma<br>tu compra!</h5>
                      <p>Sube tu comprobante<br>de pago.</p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="d-cuadro-bordeado">
                      <span class="circulo-borde-rojo">
                        <img src="/images/inner-a/icon_paso4.png" alt="">
                      </span>
                      <h1 class="primary-color">03</h1>
                      <h5 class="my-2 black--text">¡Recibe tu<br>compra!</h5>
                      <p>¡Listo! Lo llevamos a tu casa.<br> Podrás ver el estado de tu<br>compra en tiempo real.</p>
                     </div>

        				</v-flex>
        			</v-layout>


        		</v-container>


        	</v-container>

        </div>

      </v-flex>

      <v-flex  xs12 class="cover-height bg-cotiza" style="">
        <div style="position:inline-block;">
          <v-container fluid class="bg-estandar-full d-align-center full-height bgr section-cotiza"
          style="">
        		<v-container>
        			<v-layout row wrap justify-center>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center mb-4">
    			        <p class="font-bold pb-3 cImg-text-subtitle ma-0" style="font-size: 2.8em;">
    			        	Cotiza aquí</p>
    			        <p class="font-regular cImg-text-content ">¡Coloca los datos de tu paquete!</p>
                  <br/>
        				</v-flex>
              </v-layout>
              <v-layout row wrap justify-center>
                <v-flex xs6 md3 sm3 mb-3 class="d-column-justify-right text-center px-4 block-input">
        			     <div class="" id="second-input">
                     <input class="input-c" type="number" min="1" v-model="peso_producto_c" name="" placeholder="¿Cuánto pesa?"><br>
                   </div>
                   <div px-1 class="text-input">
                     <span>Peso</span><strong>KG</strong>
                   </div>
        				</v-flex>
                <v-flex xs6 md3 sm3 mb-3 class="d-column-justify-right text-center px-4 block-input">
        			     <div class="">
                     <input class="input-c" type="number" min="1" v-model="valor_producto_c" name="" placeholder="¿Cuánto cuesta?"><br>
                   </div>
                   <div px-1 class="text-input">
                     <span>Precio</span><strong>USD $</strong>
                   </div>
        				</v-flex>
                <v-flex xs2 md1 sm1 hidden-xs-only class="d-column-justify-right text-center">
        			     <div class="i-result">=</div>
        				</v-flex>
                <v-flex md3 sm3 class="d-column-justify-right text-center px-4 block-input">
        			     <div class="">
                     <input class="input-c" type="number" name="" placeholder="0.00" v-model="costo_total_c"><br>
                   </div>
                   <div px-1 class="text-input">
                     <span>Total estimado</span><strong>USD $</strong>
                   </div>
        				</v-flex>

                <v-flex xs12 class="text-center">
                  <v-btn v-if="!sesionIniciada" color="bg-pink" class="cover btn--large white--text btn-cotiza"@click="stateChangeLogin()">Registra tu pedido</v-btn>
                  <v-btn v-if="sesionIniciada" color="bg-pink" class="cover btn--large white--text btn-cotiza" @click="gotoAdminGobuy()">Registra tu pedido</v-btn>

                </v-flex>
        			</v-layout>
              <v-layout row wrap justify-center>
                <v-flex xs12 class="text-center">
                  <p class="py-3">*Tarifa no incluye aranceles. Estos serán cobrados una vez realizado el desaduanaje.</p>
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

      sliderDefault:false,//asd
      peso_producto_c:'',
      valor_producto_c:''


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
  computed: {
    costo_total_c(){
      var costo_fijo_vp;
      if(this.valor_producto_c=="" || this.peso_producto_c=="")
        return 0;
      if(this.valor_producto_c<=200){
        costo_fijo_vp= 5;
      } else {
          if(this.valor_producto_c>200 && this.valor_producto_c<=2000){
            costo_fijo_vp= 8;
          } else {
            costo_fijo_vp= 75;
          }
      }
      var peso=parseFloat(this.peso_producto_c).toFixed(1);
      //var costo= (costo_fijo_vp + 5.5*peso) /0.7;
      var costo= ( ((costo_fijo_vp + 5.5*peso))+2.5 ) /0.7;
      costo= costo*1.18;//add
      return costo.toFixed(2);
    }
  },
  methods: {
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
    gotoAdminGobuy:function(){
      if(this.nombreUsuario==='Superadmin'){
        document.location ='/superadmin';
      }else{
        this.$router.push('/admin/go-buy/mis-pedidos');
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
.bg-cotiza{
  background: url(/images/inner-a/bg-icons.png) center center no-repeat;
  background: url(/images/inner-a/imageen.png) center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-position: top center;
  background-position-y: 115%;
  background-color: white !important;
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
.i-result {
  color: #ff5156;
  font-size: 40px;
}
.input-c {
  vertical-align: top;
  border: 3px solid #ff535a;
  padding: 16px;
  width: 100%;
  border-radius: 8px;
  background: white;
  font-size: 16px;
  font-size: 16px;
  height: 62px;
  &:focus {
    outline: none;
  }
}
.text-input {
  justify-content: space-between;
  display: flex;
  font-size: 16px;
  span {
    color: #b7b6b6;
    font-weight: bold;
  }
}
.btn-cotiza {
  border-radius: 5px;
  font-size: 1.3rem;
  font-family: Carnas-Black;
}
.section-cotiza {
  padding: 5.5em 0 4em;
  .btn-cotiza {
    margin-top: 4em;
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
    &:nth-child(3){
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
      line-height: 22px;
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
      width: 150%;
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
@media screen and (min-width: 1400px){
  .bg-cotiza{
    padding: 13em 0 3em 0;
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
  .bg-cotiza {
    background-position: top right;
  }
}
@media screen and (min-width: 960px){
  .section-cotiza .flex.md1 {
    -ms-flex-preferred-size: 5%;
    flex-basis: 5%;
    max-width: 5%;
  }

}
@media screen and (max-width: 824px){
  .block-input {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  .text-input {
    font-size: 14px;
  }
  .input-c {
    font-size: 14px;
    height: 60px;
    padding: 12px;
  }
}
@media screen and (max-width: 600px){
  .pdd-section {
    padding: 2em 0 0em;
  }
  .search-url {
    margin-top: -5em;
  }
  .container > .container {
    padding: 0 16px;
  }
}
</style>
