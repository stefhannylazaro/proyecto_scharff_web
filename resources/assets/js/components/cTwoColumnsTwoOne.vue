<template>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 sm7 md7 class="py-5 d-flex justify-center align-center black white--text font-light">
        <div class="py-5 info-register">
          <p class="title-register">
            Haz tus envíos de forma<br>rápida y sencilla.
          </p>
          <p class="font-regular more-info"><strong>REGÍSTRATE, ES GRATIS.</strong></p>
        </div>
      </v-flex>
      <v-flex xs12 sm5 md5 class="py-5 bg-pink d-flex justify-center white--text">
        <div class="form-inputs py-5 font-regular" >
          <input v-model="email" class="input white--text" type="email" placeholder="Correo electrónico">
          <input v-model="password" class="input white--text" type="password" placeholder="Contraseña">
          <v-btn class="black btn-crear white--text elevation-0">CREAR CUENTA</v-btn>
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  }

}
</script>

<style>

</style>
