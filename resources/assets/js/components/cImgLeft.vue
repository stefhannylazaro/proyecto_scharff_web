<template>
  <v-container fluid class="pb-0 px-0">
    <v-layout row wrap class="wrapper-cover">
      <v-flex xs12 sm6 class="cover-col two img-zoom">
        <img style="width:100%;" class="" :src="peopleCover" alt="collage Scharff">
      </v-flex>
      <v-flex xs12 sm6 class="cover-col order-one">
        <div class="container-left d-flex justify-center ">
          <div class="px-5">
            <div class="d-flex pr-2">
              <slot name="title-section"></slot>
              <slot name="content-section"></slot>
            </div>
            <div class="py-3 btn-align-rigth">
              <v-btn round large color="black" class="cover white--text" href="#" v-scroll-to="'#formGrow'">Más información</v-btn>
            </div>
          </div>
        </div>
      </v-flex>
      
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: ['peopleCover'],
  data () {
    return {
      // peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'}
    }
  },
  methods: {
  
  }
}
</script>

<style>

</style>
