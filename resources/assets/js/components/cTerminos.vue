<template>
  <v-slide-x-transition>

  <v-card class="px-5 pb-4 pt-5 white terminos-style login-style">
    <div class="close">
      <i @click.stop="closeModal">
        <svg style="width:32px;height:32px;fill: rgba(0, 0, 0, 0.4);" viewBox="0 0 24 24">
            <path d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
        </svg>
      </i>
    </div>
    <div>
      <div class="header pb-3">
        <h4 class="pb-2" v-text="terminos_titulo"></h4>
        <div class="terminos_terminos" v-html="terminos_terminos">

        </div>
      </div>

      <v-btn round large class="cover elevation-0 bg-pink white--text" @click.stop="$emit('closeTerminosModal')">Aceptar</v-btn>
    </div>
  </v-card>
  </v-slide-x-transition>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      terminos_titulo:'',
      terminos_terminos:''
    }
  },
  mounted(){
    this.get_terminos();
  },
  methods: {
    closeModal: function (){
      this.$emit('closeTerminosModal')
    },
    get_terminos:function(){

      var vm = this;
      vm.modalTerminos = true;
      axios({
        method:'get',
        url:'/ajax/terminos',
        params: {
        }
      })
  		.then(function(response){
        let res = response.data;
        console.log(res);
        vm.terminos_titulo = res[0].titulo;
        vm.terminos_terminos = res[0].descripcion;

  		}).catch(function (error) {
        console.log(error);
      });

    },

  }

}
</script>

<style lang="css">

</style>
