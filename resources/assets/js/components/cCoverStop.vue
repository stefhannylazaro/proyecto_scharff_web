<template>
<carousel
      class="carousel-slider"
      :perPage="1"
      :autoplay="true"
      :autoplayTimeout="3000"
      :loop="true"
      :paginationEnabled="false">
  <!-- <slide>
    <v-container class="pb-0 px-0">
      <v-layout row wrap class="wrapper-cover">
        <v-flex xs12 sm6 lg6 xl7 class="cover-col orderTwo">
          <slot name="coverOneLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 lg5 xl4 class="cover-col orderOne">
          <slot name="coverOneRight"></slot>
        </v-flex>
      </v-layout>
    </v-container>
  </slide> -->
  <slide>
    <v-container class="pb-0 px-0">
      <v-layout row wrap class="wrapper-cover">
        <v-flex xs12 sm6 lg6 xl7 class="cover-col orderTwo">
          <slot name="coverTwoLeft"></slot>
        </v-flex>
        <v-flex xs12 sm6 lg5 xl4 class="cover-col orderOne">
          <slot name="coverTwoRight"></slot>
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

<style>

</style>
