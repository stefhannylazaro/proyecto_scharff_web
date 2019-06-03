<template>
  <v-container fluid class="pa-0">
    <!-- <h1><pre>{{ruta_raw}}</pre></h1> -->
    <router-view :key="ruta_raw"></router-view>
  </v-container>
</template>

<script>

import vue from 'vue'
import { EventBus } from './config/ebus.js'



export default {
  data () {
    return {
      rutakey:'/'
    }
  },
  computed: {

    ruta_raw:function(){

      var _rutasinhash = this.$route.fullPath;
      if(_rutasinhash.indexOf("#") !== -1){
        console.log("window.location.hash.substring(1)");
        let afterhas = window.location.hash.substring(1);

        if(afterhas=='login'||afterhas=='empresa'||afterhas.indexOf('tracking_')!==-1){
          afterhas = '';
        }else{
          afterhas = '_'+afterhas;
        }
        return _rutasinhash.substr(0, _rutasinhash.indexOf('#'))+afterhas;
        //_rutasinhash = _rutasinhash.substr(0, _rutasinhash.indexOf('#')) + '_' + afterhas;
      }
      return _rutasinhash;
    }

  },
  watch:{
    ruta_raw:function(el){
      var _rutasinhash = this.$route.fullPath;
      if(_rutasinhash.indexOf("#") !== -1){
        console.log("window.location.hash.substring(1)");
        let afterhas = window.location.hash.substring(1);







        _rutasinhash = _rutasinhash.substr(0, _rutasinhash.indexOf('#')) + '_' + afterhas;
      }
      console.log("rutakey===·=$=·=·=$%==·=%=====&=$=·=·=");
      console.log(_rutasinhash);
      this.rutakey = _rutasinhash;


    }
  },
  components: {
  }

}
</script>

<style>

</style>
