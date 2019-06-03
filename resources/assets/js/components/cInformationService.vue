<template>
  <v-container class="pb-0 px-0">
    <v-layout row wrap class="wrapper-cover">
      <v-flex xs12 class="text-center my-3">
        <h4 id="tipser_tiposervicio_descripcion" class="title-font-bold black--text">
          Envía o recibe.<br>
          ¡Nosotros nos encargamos de todo!
        </h4>
      </v-flex>
      <v-flex xs12 class="cover-col align-top">
        <carousel
          class="slider-container"
          style="width:100%;"
          :perPage="number"
          :autoplay="true"
          :autoplayTimeout="3000"
          :loop="true"
          :paginationEnabled="false">
          <slide>
            <div class="card-service gi-17">
              <img class="gi-1" :src="forBusinesses.url" :alt="forBusinesses.alt">
              <div class="card-service">
                <h3 id="tipser_empresa_titulo" class="title-font-bold black--text">Para empresas</h3>
                <p id="tipser_empresa_descripcion" class="text-litle text-center">
                  Si necesitas transportar, importar o exportar<br>
                  tus productos, cuenta con nosotros.<br>
                </p>
                <div class="btn-align-rigth">
                  <v-btn round large outline class="cover elevation-0" href=""  v-scroll-to="'#formGrow'">Solicitar información</v-btn>
                </div>
              </div>
            </div>
          </slide>
          <slide>
            <span class="gi-11"></span>
            <div class="card-service gi-17">
              <img class="" :src="forYou.url" :alt="forYou.alt">
              <div class="card-service">
                <h3 id="tipser_cliente_titulo" class="title-font-bold black--text">Para ti</h3>
                <p id="tipser_cliente_descripcion" class="text-litle text-center">
                  Si necesitas enviar, dejar, recibir o <br>simplemente sorprender, cuenta con nosotros. <br />
                </p>
                <div class="btn-align-rigth">
                  <v-btn round large class="cover btn-active elevation-0" href="" @click.stop.prevent="openLoginRm">Solicitar envío</v-btn>
                </div>
              </div>
            </div>
          </slide>
        </carousel>
      </v-flex>
      <!-- <v-flex xs12 class="controls" v-if="controlsMobile">
        <i class="circle ml-2" :class="{opacity: itemOne}" @click="responsiveItems(true, false)">
          <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path style="fill:#cdcdcd;" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
          </svg>
        </i>
        <i class="circle mr-2" :class="{opacity: itemTwo}" @click="responsiveItems(false, true)">
          <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path style="fill:#cdcdcd;" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
          </svg>
        </i>
      </v-flex> -->
    </v-layout>
  </v-container>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel'
import { EventBus } from '../config/ebus.js';

export default {
  data () {
    return {
      forYou: {url:'./images/img_parati.png', alt: 'para ti Scharff'},
      forBusinesses: {url:'./images/img_empresas.png', alt: 'para empresas Scharff'},
      windowWidth: null,
      // controlsMobile: false,
      // itemOne: true,
      // itemTwo: true,
      number:2
    }
  },
  mounted () {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      this.getWindowWidth()
    })
  },
  watch: {
    windowWidth: function (el) {
      if(el>599) {
        // this.controlsMobile = false
        // this.itemOne = true
        // this.itemTwo = true
        this.number = 2
      } else {
        this.number = 1
        // this.controlsMobile = true
        // this.responsiveItems(true,false)
      }
    }
  },
  methods: {
    // responsiveItems: function (one, two) {
    //   this.itemOne = one
    //   this.itemTwo = two
    // },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowWidth)
    },
    topage: function(topage) {
      this.$router.push(topage)
      //this.pathActual();
      //console.log(this.$route.name);
      //this.$parent.$emit('loadDataAsincrono', 1);
      this.$scrollTo('#menu-home', 1000)

      //this.mix_update_menu();
    },openLoginRm(){
      EventBus.$emit('openLoginRm','express');
    }
  },
  components: {
    Carousel,
    Slide
  }
}
</script>

<style scoped>
.card-service .btn--large {
  height: 48px;
  font-size: 17px;
}
</style>
