<template>
  <v-container :fluid="fluid"  class=" pb-0 px-0">
    <v-layout v-if="type == 1" row wrap class="wrapper-cover">
      <v-flex xs12 sm6 class="justify-baseline image-base orderTwo">
          <slot name="left"></slot>
      </v-flex>
      <v-flex xs12 sm6 class="cover-col orderOne">
          <slot name="right"></slot>
      </v-flex>
    </v-layout>
    <v-layout v-if="type == 2" row wrap class="wrapper-cover">
      <v-flex xs12 sm7 class="d-flex justify-center align-center">
          <slot name="left"></slot>
      </v-flex>
      <v-flex xs12 sm5 class="imagen-secure justify-center align-center px-3 py-5">
          <slot name="right"></slot>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props:['type', 'fluid'],
  data () {
    return {
      peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'}
    }
  }

}
</script>

<style>

</style>
