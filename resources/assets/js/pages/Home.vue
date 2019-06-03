<template>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhHome: isValid}" class="cover-height  bg-smoke">
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

              <slide style="height:100%;" v-if="!sliContenidos">
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
                <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree" :style="'background-image:url(/elements/banner/'+el.imagen+')'">
                  <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col" :class="'el_1532620865_'+ind">
                    <div class="coverThreeLeft">
                      <div class="container-left d-flex justify-center el_1532618613">
                        <div class="d-flex pl-2 px-5">

                          <div>
                            <p class="send mb-0 white--text title-general" v-html="el.titulo"></p>
                          </div>
                          <span class="mt-2 white--text" v-text="el.subtitulo"></span>
                        </div>
                        <div class="py-3 px-5" v-if="decode_esto(el.atributos,'btn_text')!==null">

                          <!-- <v-btn round large outline class="cover gi-16 " @click="gotoById(ind)" v-scroll-to="ind==0?'#infoCompany':false">Conocer <strong>más</strong></v-btn> -->
                          <div class="">
                            <!-- <v-btn v-if="es_url(el.url)" round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner gi-13 " v-scroll-to="'#infoCompany'"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn> -->
                            <v-btn round large color="bg-pink"  class="cover white--text elevation-0 btn-cover-banner el_1540395157 gi-13"  @click="gotoByUrl(el.url)"><span v-html="decode_esto(el.atributos,'btn_text')"></span></v-btn>
                          </div>

                          <!-- no-mobil
                          solo-mobil -->
                        </div>
                      </div>

                      <!-- <span v-if="isValid" class="dots-bottom">
                        <i v-for="i in 3" :key="i">
                          <img v-if="i==1" class="ml-2" :src="elipseActive.url" :alt="elipseActive.alt">
                          <img v-else class="ml-2" :src="elipseEmpty.url" :alt="elipseEmpty.alt">
                        </i>
                      </span> -->
                      <a href="#" v-scroll-to="'#infoCompany'" class="icon-position-center white--text">
                        <v-icon large class="white--text">keyboard_arrow_down</v-icon>
                      </a>
                    </div>
                  </v-flex>

                </v-layout>
              </v-container>
            </slide>

          </carousel>




        </div>
      </v-flex>
      <v-flex xs12 class="bg-smoke">
        <!-- <infoCompany id="infoCompany"></infoCompany>   -->
        <connection-high id="infoCompany"></connection-high>
      </v-flex>
      <v-flex xs12 class="pb-5">
        <infoService></infoService>
      </v-flex>
      <v-flex xs12 class="" id="ubicanos-section">
        <locate-us></locate-us>
      </v-flex>
      <v-flex xs12 class="bg-company-information">
        <grow-your-company></grow-your-company>
      </v-flex>
    </v-layout>

    <v-dialog
      v-model="openedModal"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login">
        <div
          class="px-5 pb-4 pt-5 gi-20 white login-style card"
          data-ripple="false" style="height: auto; transform-origin: center top 0px;">
          <div class="close" @click.stop="closeModal()">
            <i>
              <svg viewBox="0 0 24 24" style="width: 32px; height: 32px; fill: rgba(0, 0, 0, 0.4);">
                <path d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z"></path>
              </svg>
            </i>
          </div>
          <h4>¡Llámanos al <br />517 - 1600!</h4>
          <p>Atenderemos tus dudas y/o consultas a través de nuestro número de atención al cliente.</p>
          <p><strong>01 517 1600</strong></p>
          <p>Lunes a viernes de 8:30am a 6pm <br />
            Sábados de 9am a 1pm.</p>
          <p><strong>¡No dudes en comunicarte con nosotros!</strong></p>
          <p><span class="gi-21">Equipo Scharff</span></p>
        </div>
        <div class="back-modal-active" style="position:fixed;" @click.stop="closeModal()">_</div>
      </div>
    </v-dialog>

  </v-container>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel'
import connectionHigh from '../components/cConnectionHigh.vue'
import locateUs from '../components/cLocateUs.vue'
import growCompany from '../components/cGrowCompany.vue'
import coverPage from '../components/cCoverPage.vue'
import infoCompany from '../components/cInformationCompany.vue'
import infoService from '../components/cInformationService.vue'
import loginUser from '../components/cLoginUser'
export default {
  data () {
    return {
      peopleCover: {url:'./images/person.png', alt: 'people staff Scharff'},
      circleOne: {url:'./images/item_one.png', alt: 'right circle'},
      circleTwo: {url:'./images/item_two.png', alt: 'right circle'},
      circleThree: {url:'./images/item_three.png', alt: 'right circle'},
      windowHeight: null,
      windowWidth: null,
      isValid:false,
      isTrue: false,
      elipseEmpty: {url:'./images/elipse-empty.png', alt: 'elipse'},
      elipseActive: {url:'./images/elipse_active.png', alt: 'elipse'},
      coverResposive: false,
      openedModal: false,
      sliContenidos:null,
      ar:[]
    }
  },
  mounted () {
    var self = this;

    this.$parent.$on('ejecutar_modal', this.activeModal);
    this.$parent.$on('ejecutar_slider', this.activeSlider);


    //alert(this.$parent.getConfigHome);
    this.getWindowHeight();
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
    });
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
    activeSlider: function(value) {

      //console.log("HASTA AQUI LLEGA");

      var sliderAux = [];

      value.forEach(function(el){
        if(el.slug==='home'){
          sliderAux.push(el);

        }
      });
      //console.log(sliderAux);
      this.sliContenidos = sliderAux;

      /*if(value.constructor === Array){
         sliderAux = value.map(function(el){
           if (el.slug==='home'){
             console.log(el);
             return el;
           }
         });
      }*/

    },
    activeModal: function(value) {
      if(!document.getElementById('modal-open-login')){
            this.openedModal = true
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
    closeModal:function () {
      this.openedModal = false
    },
    gotoById: function(idBanner) {
      var paneName = '';
      if(idBanner===0){
        return "";
      }else if(idBanner===1){
        paneName = 'empresa'
      }else if(idBanner===2){
        paneName = 'para-ti'
      }

      if(paneName){
        this.$router.push(paneName);
        //this.$parent.$emit('loadDataAsincrono', 1);
        this.$scrollTo('#menu-home', 1000)
      }

    },
  },
  components: {
    coverPage,
    infoCompany,
    infoService,
    Carousel,
    Slide,
    'login-user': loginUser,
    'grow-your-company':growCompany,
    'locate-us': locateUs,
    'connection-high': connectionHigh
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.minSize{
  height: 30rem;
  width: 100%;
}
.gi-20 h4{
  font-size: 23px;
  margin-bottom: 23px;
    font-family: Carnas-Bold;
    font-weight: 500;
}
.gi-20 strong{
     font-family: Carnas-Bold;
     font-weight: 500;
}
.gi-20 span{
color:#ff535a;
}
.widthTen{
  width: 30rem;
}
@media screen and (max-width: 559px){
  .widthTen{
    width: 23rem!important
  }
}


.solo-mobil{
  display:none;
}
@media screen and (max-width: 600px){
  .no-mobil{
    display:none;
  }
  .solo-mobil{
    display:inline-flex;
  }
  .coverThreeLeft {
    padding-bottom: 100px;
  }
}

.hVhSections{
  min-height: calc(100vh - 21px);
}
.hVhHome{
  min-height: calc(100vh - 79px);
}

.bg-slotTree .cover-col{
  justify-content: flex-start;
  padding-left: 109px;
}
@media screen and (min-width: 1100px){
  .el_1532618613 .send {
    font-size: 4.3rem;
    line-height: 1;
  }
  .flex.lg6.el_1532620865_1 {
      flex-basis: 60%;
      max-width: 60%;
  }
}
@media screen and (max-width: 1100px){
  .bg-slotTree .cover-col {
      padding-left: 30px;
  }
  .bg-slotTree .cover-col p br{
    display: none;
  }
  .bg-slotTree .cover-col .send {
      font-size: 3.3rem;
  }
}
@media screen and (max-width: 900px){
  .bg-slotTree .cover-col {
      padding-left: 0;
  }
}
@media screen and (max-width: 800px){
  .bg-slotTree .cover-col .send {
      font-size: 2.7rem;
  }
}

</style>
