<template>
	<v-app>
		<v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVh: isValid}" class="cover-height  bg-smoke">
        <div style="position:inline-block; width:100%;max-width:1440px">
          <coverPage style="position:inline-block;">
            <div slot="coverOneLeft">
              <div class="container-left d-flex justify-center ">
                <div class="d-flex pl-2 mt-3 px-5">
                  <p class="send mb-0 black--text">El apoyo logístico que tu negocio necesita</p>
                  <!-- <span>Diseñando logística pensando en ti.</span> -->
                </div>
                <div class="py-3 px-5">
                  <!-- <v-btn round large class="btn-active cover elevation-0" @click="stateChangeRegister()">Crear una cuenta</v-btn> -->
                  <v-btn round large outline class="cover" v-scroll-to="'#formGrow'">Conocer más</v-btn>
                </div>
              </div>
              <!-- <span v-if="isValid" class="dots-bottom">
                <i v-for="i in 3" :key="i">
                  <img v-if="i==3" class="ml-2" :src="elipseActive.url" :alt="elipseActive.alt">
                  <img v-else class="ml-2" :src="elipseEmpty.url" :alt="elipseEmpty.alt">
                </i>
              </span> -->
              <a href="#" v-scroll-to="'#infoCompany'" class="icon-position-center">
                <!-- <v-icon large>keyboard_arrow_down</v-icon>lksjdlajsd -->
                <v-icon large>keyboard_arrow_down</v-icon>
              </a>
            </div>
            <div class="two" :class="{'company-slider-one': coverResposive}" slot="coverOneRight">
            </div>
            <div slot="coverTwoLeft">
              <div class="container-left d-flex justify-center ">
                <div class="d-flex pl-2 mt-3 px-5">
                  <p class="send mb-0 black--text">El apoyo logístico que tu negocio necesita</p>
                  <!-- <span>Más de 30 años diseñando logística</span> -->
                </div>
                <div class="py-3 px-5">
                  <v-btn round large outline class="cover" v-scroll-to="'#formGrow'">Conocer más</v-btn>
                </div>
              </div>
              <!-- <span v-if="isValid" class="dots-bottom">
                <i v-for="i in 3" :key="i">
                  <img v-if="i==2" class="ml-2" :src="elipseActive.url" :alt="elipseActive.alt">
                  <img v-else class="ml-2" :src="elipseEmpty.url" :alt="elipseEmpty.alt">
                </i>
              </span> -->
              <a href="#" v-scroll-to="'#infoCompany'" class="icon-position-center">
                <v-icon large>keyboard_arrow_down</v-icon>
              </a>
            </div>
            <div class="two" :class="{'company-slider-one': coverResposive}" slot="coverTwoRight">
            </div>
            <div slot="coverThreeLeft">
              <div class="container-left d-flex justify-center ">
              	<div class="d-flex pl-2 mt-3 px-5">
                  <p class="send mb-0 black--text">El apoyo logístico que tu negocio necesita</p>
                  <!-- <span>Más de 30 años diseñando logística</span> -->
                </div>
                <div class="py-3 px-5">
                  <v-btn round large outline class="cover" v-scroll-to="'#formGrow'">Conocer más</v-btn>
                </div>
              </div>
              <!-- <span v-if="isValid" class="dots-bottom">
                <i v-for="i in 3" :key="i">
                  <img v-if="i==1" class="ml-2" :src="elipseActive.url" :alt="elipseActive.alt">
                  <img v-else class="ml-2" :src="elipseEmpty.url" :alt="elipseEmpty.alt">
                </i>
              </span> -->
              <a href="#" v-scroll-to="'#infoCompany'" class="icon-position-center">
                <v-icon large>keyboard_arrow_down</v-icon>
              </a>
            </div>
            <div class="two" :class="{'company-slider-one': coverResposive}" slot="coverThreeRight">
            </div>
        </coverPage>
        </div>
      </v-flex>
      <v-flex xs12 class="pb-5">
        <imgLeft :peopleCover="containerImg">
        	<h3 slot="title-section" class="title-font-bold text-right black--text">
            Estamos presentes en tierra, mar y aire.
					</h3>
					<p slot="content-section" class="text-litle text-right pt-3 mb-0">
            Parte del alcance de nuestra propuesta de valor es cubrir todos los escenarios posibles que pueda necesitar tu mercadería a transportar.
          </p>
        </imgLeft>
      </v-flex>
      <v-flex xs12 class="pb-5">
        <imgRight :peopleCover="containerImg">
        	<h3 slot="title-section" class="title-font-bold text-left black--text">
            Exporta y compite en comercios extrangeros
					</h3>
					<p slot="title-section" class="text-litle text-left pt-3 mb-0">
            No importa si deseas exportar o importar a otros mercador, tenemos la experiencia y facilidades que tu empresa busca para desarrollarse en el comercio exterior.
          </p>
        </imgRight>
      </v-flex>
      <v-flex xs12 class="pb-5">
        <imgLeft :peopleCover="containerImg">
        	<h3 slot="title-section" class="title-font-bold text-right black--text">
            Te ayudamos a llegar a todo el Perú.
					</h3>
					<p slot="content-section" class="text-litle text-right pt-3 mb-0">
            Parte del alcance de nuestra propuesta valor es cubrir todos los escenarios posibles que pueda necesitar tu mercadería a transportar
          </p>
        </imgLeft>
      </v-flex>
      <v-flex xs12 class="pb-5">
      	Componente pendiente de creacion.
      </v-flex>
      <v-flex xs12 class="pb-5">
        <imgLeft :peopleCover="carsImg">
        	<h3 slot="title-section" class="title-font-bold text-right black--text">
            Somos la conexión que tu negocio necesita.
					</h3>
					<p slot="content-section" class="text-litle text-right pt-3 mb-0">
            Parte del alcance de nuestra propuesta valor es cubrir todos los escenarios posibles que pueda necesitar tu mercadería a transportar
          </p>
        </imgLeft>
      </v-flex>
      <v-flex xs12 class="pb-5">
      	Componente pendiente de creacion.
      </v-flex>
      <!-- <v-flex xs12 class="">
        <locate-us></locate-us>
      </v-flex> -->
     <!--  <v-flex xs12 class="bg-company-information">
        <grow-your-company></grow-your-company>
      </v-flex> -->
    </v-layout>
  </v-container>
	</v-app>
</template>
<script>
// import connectionHigh from '../components/cConnectionHigh.vue'
// import locateUs from '../components/cLocateUs.vue'
// import growCompany from '../components/cGrowCompany.vue'
import coverPage from '../components/cCoverPage.vue'
import imgLeft from '../components/cImgLeft.vue'
import imgRight from '../components/cImgRight.vue'
// import infoService from '../components/cInformationService.vue'
export default {
  data () {
    return {
    	// imagenes de las secciones
    	containerImg: './images/collage.png',
    	carsImg: './images/slider_1.png',



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
      coverResposive: false
    }
  },
  mounted () {
    this.getWindowHeight()
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
    })
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
        this.isValid = false
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
    imgLeft,
    imgRight,
    // infoService,
    // 'grow-your-company':growCompany,
    // 'locate-us': locateUs,
    // 'connection-high': connectionHigh
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
@media screen and (max-width: 559px){
  .widthTen{
    width: 23rem!important
  }
}
</style>
