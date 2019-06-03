<template>
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
  <!-- <slide>
    <v-container class="pb-0 px-0">
      <v-layout row wrap class="wrapper-cover">
        <v-flex xs12 sm6 lg6 xl7 class="cover-col">
          <slot name="coverOneLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 lg5 xl4 class="cover-col">
          <slot name="coverOneRight"></slot>
        </v-flex>
      </v-layout>
    </v-container>
  </slide> -->
  <slide style="height:100%;">
    <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
      <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree">
        <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
          <slot name="coverThreeLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 md6 lg6 xl5 style="min-height:40rem;" class="cover-col">
          <slot name="coverThreeRight"></slot>
        </v-flex>
      </v-layout>
    </v-container>
  </slide>


  <slide style="height:100%;">
    <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
      <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTwo">
        <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
          <slot name="coverTwoLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 md6 lg6 xl5 style="min-height:37rem;" class="cover-col">
          <slot name="coverTwoRight"></slot>
        </v-flex>
      </v-layout>
    </v-container>
  </slide>

  <slide style="height:100%;">
    <v-container style="height:100%;" fluid class="pb-0 px-0 ma-0">
      <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotOne">
        <v-flex xs12 sm6 md6 lg6 xl7 class="cover-col">
          <slot name="coverOneLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 md6 lg6 xl5 style="min-height:40rem;" class="cover-col">
          <slot name="coverOneRight"></slot>
        </v-flex>
      </v-layout>
    </v-container>

  </slide>

</carousel>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel'
export default {

  data () {
    return {
      peopleCover: {url:'./images/person.png', alt: 'people staff Scharff'}
    }
  },
  components: {
    Carousel,
    Slide
  }
}
</script>

<style lang="scss">
.VueCarousel-wrapper{
  height: 100%;
  .VueCarousel-inner{
    height: 100%;
    .VueCarousel-slide{
      height: 100%;

    }
  }
}


</style>
