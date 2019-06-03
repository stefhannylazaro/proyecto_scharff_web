<template>
  <v-container>
    <v-layout row wrap>
      <v-flex class="pt-5">
        <div class="locker-container font-medium">
          <h3 class="color-pink">El tamaño importa</h3>
          <p>Contamos con tres diferentes espacios para tus paquetes!</p>
          <a href="" @click.prevent.stop="abrirDims">¿Cuáles son las dimensiones por tamaño?</a>
        </div>
      </v-flex>
      <v-flex v-if="!mobile" xs12>
        <div  class="locker-img-container mt-5 mb-5">
          <div class="lockers">
            <div class="items" style="width: 830px;">
              <div class="relative-box" style="position:relative;" @mouseover="textOne=true;textTwo=false;textTree=false" @mouseleave="textOne=false">
                <strong class="font-medium">Pequeño/S</strong>
                <img v-if="textOne" class="text-absolute" :src="textSmall.img" :alt="textSmall.alt">
                <img @mouseover="textOne=true" class="more-icon " :src="more.img" :alt="more.alt">
                <img class="img" :src="small.img" :alt="small.alt">
              </div>
              <div class="relative-box" @mouseover="textTwo=true;textOne=false;textTree=false" @mouseleave="textTwo=false">
                <strong>Mediano/M</strong>
                <img v-if="textTwo" class="text-absolute two" :src="textMedium.img" :alt="textMedium.alt">
                <img @mouseover="textTwo=true" class="more-icon two" :src="more.img" :alt="more.alt">
                <img class="img center" :src="medium.img" :alt="medium.alt">
              </div>
              <div class="relative-box" @mouseover="textTree=true;textTwo=false;textOne=false" @mouseleave="textTree=false" >
                <strong>Grande/L</strong>
                <img v-if="textTree" class="text-absolute rigtht" :src="textLarge.img" :alt="textLarge.alt">
                <img @mouseover="textTree=true" class="more-icon tree" :src="more.img" :alt="more.alt">
                <img class="img" :src="large.img" :alt="large.alt">
              </div>
            </div>
            <img class="img-base" :src="base.img" :alt="base.alt">
          </div>
        </div>
      </v-flex>
      <v-flex xs12 v-else>
        <carousel

          class="carousel-slider"
          :perPage="1"

          :autoplayTimeout="3000"
          :loop="true"
          :paginationEnabled="false">
          <slide>
            <div class="lockers-responsive">
              <div class="relative-box" style="position:relative;">
                <strong class="font-medium">Pequeño/S</strong>
                <img v-if="textOne" @mouseover="textOne=true" @mouseleave="textOne=false" class="text-absolute" :src="textSmall.img" :alt="textSmall.alt">
                <img @mouseover="textOne=true" @mouseleave="textOne=false" class="more-icon " :src="more.img" :alt="more.alt">
                <img class="img" :src="small.img" :alt="small.alt">
              </div>
            </div>
          </slide>
          <slide>
            <div class="lockers-responsive">
              <div class="relative-box" style="position:relative;"  >
                <strong>Mediano/M</strong>
                <img v-if="textTwo" @mouseover="textTwo=true" @mouseleave="textTwo=false" class="text-absolute" :src="textMedium.img" :alt="textMedium.alt">
                <img class="more-icon two" @mouseover="textTwo=true" @mouseleave="textTwo=false" :src="more.img" :alt="more.alt">
                <img class="img center" :src="medium.img" :alt="medium.alt">
              </div>
            </div>
          </slide>
          <slide>
            <div class="lockers-responsive">
              <div class="relative-box" style="position:relative;">
                <strong>Grande/L</strong>
                <img v-if="textTree" @mouseover="textTree=true" @mouseleave="textTree=false" class="text-absolute tree" :src="textLarge.img" :alt="textLarge.alt">
                <img @mouseover="textTree=true" @mouseleave="textTree=false" class="more-icon tree" :src="more.img" :alt="more.alt">
                <img class="img center" :src="large.img" :alt="large.alt">
              </div>
            </div>
          </slide>
        </carousel>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel'
export default {
  data () {
    return {
      base: {img: './images/base_paquetes.png', alt: 'Base lockers'},
      small: {img: './images/inner-a/locker small.png', alt: 'small locker'},
      medium: {img: './images/medium.png', alt: 'medium locker'},
      large: {img: './images/big.png', alt: 'large locker'},
      more: {img: './images/more.png', alt: 'more icon'},
      textSmall: {img: './images/text_small.png', alt: 'text small'},
      textMedium: {img: './images/text_medium.png', alt: 'text medium'},
      textLarge: {img: './images/text_large.png', alt: 'text large'},
      textOne: false,
      textTwo: false,
      textTree: false,
      windowWidth: null,
      mobile: false
    }
  },
  mounted () {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      this.getWindowWidth()
    })
  },
   watch:{
    windowWidth: function (el) {
      if(el<850){
        this.mobile = true
      } else {
        this.mobile = false
      }
    }
  },
  methods: {
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
    },
    abrirDims:function(){
      if(this.textOne == true){
        this.textOne = false;
        this.textTwo = false;
        this.textTree = false;
      }else{
        this.textOne = true;
        this.textTwo = true;
        this.textTree = true;
      }
    }
  },
  components: {
    Carousel,
    Slide
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.locker-container a{
  color:#464646;
}
.locker-container p {
    font-size: 1.8rem;
    margin-bottom: 11px;
}
.locker-container h3 {
    margin-bottom: 11px;
}
.relative-box strong {
    font-weight: bolder;
    display: block;
    text-align: center;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 33px;
    font-family: Carnas-Medium;
}
.locker-img-container .lockers {
    margin: auto;
}
</style>
