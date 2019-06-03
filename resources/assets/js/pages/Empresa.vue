<template>
  <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhEmpresa: isValid}" class="cover-height  bg-smoke">
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
                              <span class="mt-2" v-if="el.subtitulo" v-html="el.subtitulo"></span>
                            </div>
                            <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">
                              <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" @click="gotoByUrl(el.url)"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                            </div>
                          </div>

                          <a href="#" v-scroll-to="'#empresa-s-b'" class="icon-position-center">
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
                :style="'background-image:url(/images/inner-a/img_principal_empresa.png)'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center ">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 black--text">El socio logístico que <br>tu negocio necesita</p>
                          </div>
                        </div>
                        <div class="py-3 px-5">
                          <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13" v-scroll-to="'#formGrow'">Conocer más</v-btn>
                        </div>
                      </div>

                      <a href="#" v-scroll-to="'#empresa-s-b'" class="icon-position-center">
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
            <p class="ma-0 mr-2 text-center pa-2" style="font-size: 1.2rem;">¿Ya eres cliente Scharff? Mira el estado de tus envíos o importaciones</p>
            <div class="d-justify-center">
              <v-btn v-if="!sesionIniciada" round outline class="cover btn-mediano" @click="stateChangeLogin()">Iniciar sesión</v-btn>
              <v-btn v-if="sesionIniciada" round outline class="cover btn-mediano" @click="gotoAdmin()">Acceder</v-btn>
            </div>
          </div>
        </div>
      </v-flex>





      <v-flex  xs12 class="cover-height  bg-smoke" id="empresa-s-b">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
        			        	Experiencias Internacionales
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
        			          Te ayudamos a llegar a todo el mundo, por <br>tierra, mar o aire. Tú decides.
        			        </p>

        				</v-flex>
        			</v-layout>



              <v-layout pb-5>
        				<v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-carga.png" alt="">
                      </span>
                      <h5 class=" black--text">CARGA INTERNACIONAL</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('carga')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-aduanas.png" alt="">
                      </span>
                      <h5 class=" black--text">ADUANAS</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('aduanas')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-fedex.png" alt="">
                      </span>
                      <h5 class=" black--text">ENVÍO INTERNACIONAL</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('fedex')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

        			</v-layout>


        		</v-container>


        	</v-container>

        </div>

      </v-flex>



      <v-flex  xs12 class="cover-height bg-light">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 sm12 class="d-column-justify-right text-center order-0 d-column-justify-center my-3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle  ma-0">
        			        	Experiencias Nacionales
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
        			          Te ayudamos a llegar a todo el Perú
        			        </p>

        				</v-flex>
        			</v-layout>



              <v-layout pb-5 class="empresa-c-cuadros-w">
        				<v-flex class="d-column-justify-right text-center order-0">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-domestica.png" alt="">
                      </span>
                      <h5 class=" black--text">CARGA DOMÉSTICA</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('domestica')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-distribucion.png" alt="">
                      </span>
                      <h5 class=" black--text">DISTRIBUCIÓN</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('distribucion')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-b-cuadro">
                      <span class="">
                        <img src="/images/inner-a/servicio-almacen.png" alt="">
                      </span>
                      <h5 class=" black--text">ALMACÉN</h5>
                      <p><v-btn round outline class="cover gi-16" @click="gotoPage('almacenes')">Conocer más</v-btn></p>
                     </div>

        				</v-flex>

        			</v-layout>


        		</v-container>


        	</v-container>

        </div>

      </v-flex>







      <v-flex  xs12 :class="{hVhSections: isValid}" class="cover-height  bg-light">
        <div style="position:inline-block; width:100%;max-width:1440px">


          <v-container fluid class="bg-estandar-full d-align-center full-height ">
        		<v-container style="max-width:1440px">




              <v-layout pb-5 class="empresa-c-cuadros-w">
                <v-flex class="d-column-justify-right text-left order-0 d-column-justify-center">
        			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
        			        	Transformamos la <br>manera de enviar
        			        </p>
        			        <p class="  font-light cImg-text-content ma-0">
                        Parte de nuestra experiencia <br>
                        y propuesta es innovar e <br>implementar nuevas formas <br>
                        de hacer logística.
                      </p>
        				</v-flex>

                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-d-cuadro">
                       <div class="empresa-d-cuadro-in">
                         <span class="">
                           <img src="/images/inner-a/servicio-express.png" alt="">
                         </span>

                         <p>
                           <img src="/images/inner-a/logo_express.png" alt="">
                           <v-btn round large color="black" class="cover white black--text elevator-0" href="" @click="gotoPage('express')">
           			        		Conocer más
           			        	</v-btn>
                         </p>
                       </div>
                     </div>

        				</v-flex>


                <v-flex class="d-column-justify-right text-center order-0 ">
        			       <div class="empresa-d-cuadro">
                       <div class="empresa-d-cuadro-in">
                         <span class="">
                           <img src="/images/inner-a/servicio-stop.png" alt="">
                         </span>

                         <p>
                           <img src="/images/inner-a/logo-stop.png" alt="">
                           <v-btn round large color="black" class="cover white black--text elevator-0" href="" @click="gotoPage('scharff-stop')">
           			        		Conocer más
           			        	</v-btn>
                         </p>
                       </div>
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
          style="background-image:url('/images/inner-a/img_scharff-lab.png')">
        		<v-container style="max-width:1440px">
        			<v-layout>
        				<v-flex xs12 offset-sm6 sm6 class="d-column-justify-right text-right order-0 d-column-justify-center pr3">
        			        <p class="  font-bold pb-3 cImg-text-subtitle ma-0">
        			        	Creamos el primer laboratorio<br>de innovación logística en el Perú
        			        </p>
        			        <p class="  font-light cImg-text-content">
        			          Utilizamos metodologías ágiles y Design Thinking<br> para entender mejor a nuestros clientes y diseñar <br />soluciones basadas en el usuario.
                      </p>
                      <br />
        			        <div class="py-3 d-justify-right">
                        <v-btn round large color="black" class="cover white--text" href="#" v-scroll-to="'#formGrow'">Idea con nosotros</v-btn>
        			        </div>
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
        if(el.slug==='empresa'){
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
    },gotoPage: function(pagename) {
      if(pagename==='fedex'){
        window.open('https://www.fedex.com/pe/', '_blank');
        return false;
      }

      this.$router.push(pagename);
      this.$scrollTo('#menu-home', 1000);
      //this.mix_update_menu();
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
.hVhEmpresa{
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
.empresa-b-cuadro {
  background: #fcfcfc;
      padding: 36px 35px 22px;
      width: 351px;
      margin: auto;
}
.empresa-b-cuadro>span {
    height: 200px;
    display: block;
    display: flex;
    align-items: center;
    justify-content: center;
}
.empresa-b-cuadro h5{
  font-size: 1.2em;
  margin-bottom: 11px;
  font-weight: 400;
      font-family: Carnas-Bold;
}
.empresa-b-cuadro .btn{
    height: 46px;
}
.empresa-b-cuadro .btn{
    height: 46px;
}
.empresa-b-cuadro .btn__content{
    padding: 0 27px;
}

.empresa-c-cuadros-w .empresa-b-cuadro{
  background:#f6f6f6;
}
.empresa-d-cuadro .empresa-d-cuadro-in{
  display: inline-block;
  position: relative;
}
.empresa-d-cuadro-in:before{
  content: '';
  position: absolute;
  height: 100%;
  width:100%;
  top: 0;
  left: 0;
  background:#000;
  opacity: 0;
  transition: all .2s;
}
.empresa-d-cuadro-in:hover:before{
  opacity: .1;
}
.empresa-d-cuadro-in p{
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
}
.empresa-d-cuadro-in p img{
    margin-bottom: 14px;
}
.btn-mediano{
    height: 47px;
    font-family: Carnas-medium;
    font-size: 17px;
}
.btn-mediano .btn__content{
  padding: 0 29px;
}

.bg-light{
    background: #fcfcfc;
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
