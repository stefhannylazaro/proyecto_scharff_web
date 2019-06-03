<template>
  <div>




   <div id="bienvenido-admin-w">
   	<div class="bienvenido-admin">
   	<h2>Bienvenido a Scharff</h2>
   	<p>
   		Ahora enviar es más fácil de lo que imaginas
   	</p>



<v-container grid-list-md text-xs-center>
    <v-layout row wrap>
      <template v-if="case_devel">
          <v-flex xs4>
            <div class="col-in" @click="$router.push({name: 'locker'})">
              <img src="/images/icon_locker-1.png" alt="">
            	<strong>Reserva tu locker</strong>
            	<p>Envía y recibe paquetes sin trámites ni intermediarios 24/7.</p>
            </div>

          </v-flex>

          <v-flex xs4>
            <div class="col-in" @click="$router.push({name: 'package'})">
            	<img src="/images/icon_express-1.png" alt="">
            	<strong>Envío express</strong>
            	<p>Realiza envíos inmediatos en Lima.</p>
            </div>
          </v-flex>

          <v-flex xs4>
            <div class="col-in" @click="$router.push({name: 'envio-regular'})">
            	<img src="/images/icon_regular-1.png" alt="">
            	<strong>Envío Regular</strong>
            	<p>Programa envíos en Lima y provincias con 24 a 72 horas de entrega.</p>
            </div>
          </v-flex>
      </template>
      <template v-else>
        <v-flex xs6>
          <div class="col-in" @click="$router.push({name: 'locker'})">
            <img src="/images/icon_locker-1.png" alt="">
          	<strong>Reserva tu locker</strong>
          	<p>Envía y recibe paquetes sin trámites ni intermediarios 24/7.</p>
          </div>

        </v-flex>

        <v-flex xs6>
          <div class="col-in" @click="$router.push({name: 'package'})">
          	<img class="icon_express-1-png" src="/images/icon_express-1.png" alt="">
          	<strong>Envío express</strong>
          	<p>Realiza tus envíos en Lima en menos de 3 horas.</p>
          </div>
        </v-flex>
      </template>
      <!--  -->




    </v-layout>
</v-container>

</div><!-- /.bienvenido-admin -->

   </div><!-- /#bienvenido-w -->
  </div>
</template>

<script>
// import card from 'card/dist/card.js'
export default {
  data () {
    return {
      case_devel:true
    }
  },mounted(){
    if(env==='production'){
      this.case_devel = true;
    }
    // window.$ = window.jQuery = require('jquery');
    //require('card');

    // $(document).ready(function(){
    //
    //
    //   new Card({
    //     form: document.querySelector('form'),
    //     container: '.card-wrapper'
    //   });
    // })


  },
  methods: {
    createReservation: function () {
      // console.log(this.$route)
      this.$emit('createReservation', 'newEnvio')
    }
  },

}

</script>

<style lang="scss">
@import "../../scss/vars.scss";
.el-row{
	display: flex;
}
div#bienvenido-admin-w {
  padding: 80px;
  font-family: 'Carnas-Regular';
}

.bienvenido-admin {
  background: #fff;
  padding: 48px 53px 66px;
  text-align: center;
}
.bienvenido-admin h2{
  color: $primary-color;
  font-size: 26px;
  font-family: 'Carnas-Bold';
  font-weight: 400;
}
.bienvenido-admin h2+p{
font-size: 18px;
margin-bottom: 60px;
font-family: 'Carnas-Regular';
}
.bienvenido-admin i{
  display: block;
  font-size: 63px;
  margin-bottom: 19px;
  }
  .bienvenido-admin img{
margin-bottom: 19px;

  }
.bienvenido-admin .xs4 strong,
.bienvenido-admin .xs6 strong{
  font-size: 18px;
  margin-bottom: 7px;
  display: block;
  font-family: 'Carnas-Medium';
  font-weight: 400;
}
@media screen and (max-width: 992px){
  .bienvenido-admin .xs4,
  .bienvenido-admin .xs6{
    width: 100%;
    max-width: 100%;
    flex-basis: 100%;
    margin-bottom: 20px;
  }
  .bienvenido-admin {
    padding: 48px 18px 66px;
  }

}

@media screen and (max-width: 760px){

  .bienvenido-admin img {
    margin-bottom: 6px;
  }

}



@media screen and (max-width: 500px){
  div#bienvenido-admin-w {
      padding: 50px 15px;
  }
}

.bienvenido-admin .row .col-in{
  width: 225px;
  margin: auto;
  cursor: pointer;
}
.bienvenido-admin .row .col-in strong{
  display: block;
  font-family: 'Carnas-Medium';
  font-size: 18px;
  margin-bottom: 5px;
}
.bienvenido-admin .row .col-in p{
  font-family: 'Carnas-Light';
  font-size: 14px;
}
.icon-user-p0>.btn__content:before{
  content: none
}
.icon_express-1-png{
      padding-top: 10px;
}
</style>
