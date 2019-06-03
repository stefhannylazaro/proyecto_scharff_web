<template>
  <v-container fluid class="pb-0 px-0">
    <v-layout row wrap class="wrapper-cover">
      <v-flex xs12 sm6 class="cover-col two img-zoom">
        <img style="width:100%;" class="" :src="peopleCover.url" :alt="peopleCover.alt">
      </v-flex>
      <v-flex xs12 sm6 class="cover-col order-one">
        <div class="container-left d-flex justify-center ">
          <div>
            <div class="d-flex pr-2">
              <h3 class="title-font-bold text-right black--text">Creamos conexiones <br>
                de alto valor
              </h3>
              <!-- <p class="send mb-0">envía</p> -->
              <p class="text-litle text-right pt-3 mb-0">
                Tenemos soluciones pensadas para los diferentes<br>
                públicos. Contamos con el Primer Laboratorio de<br>
                Innovación Logística en el Perú, <strong>Scharff Lab</strong>, en donde<br>
                diseñamos y ejecutamos soluciones estratégicas<br>
                para nuestros clientes.
              </p>
            </div>
            <div class="py-3 btn-align-rigth">
              <v-btn round large outline class="cover" href="#" v-scroll-to="'#formGrow'">conocer más</v-btn>
            </div>
          </div>
        </div>
      </v-flex>
      
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data () {
    return {
      peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'}
    }
  },
  methods: {
  
  }
}
</script>

<style>

</style>
