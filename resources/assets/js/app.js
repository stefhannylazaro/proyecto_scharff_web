import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueScrollTo from 'vue-scrollto'
import Vuetify from 'vuetify/dist/vuetify.min.js'
import {store} from './store'
import VeeValidate from 'vee-validate'
import firebase from 'firebase'
import axios from 'axios'
import analytics from './analytics.js'
import { EventBus } from './config/ebus.js'


import FBSignInButton from 'vue-facebook-signin-button'





import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
  load: {
    //key: 'AIzaSyBIQwFXHN7EHIeXA2g_qkeuv2v5dF7D3nQ',
    key: env_map_key,
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
    resize(){
        console.log('resize')
        google.maps.event.trigger(this.$refs.map.$mapObject, 'resize');
    }
  }
})

Vue.use(VeeValidate)
Vue.use(VueScrollTo)
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease",
  offset: 0,
  cancelable: true,
  onDone: false,
  onCancel: false,
  x: false,
  y: true
})

Vue.use(Vuetify)

Vue.mixin({
  methods:{
    reportarLog:function(accion,respuesta){

      var vm = this;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var user_id = pro.id;

      axios.post('/api/log/create',{
        customer_id:user_id,
        tipo_accion:accion,
        trama_respuesta_culqi:respuesta
      }).then(function(response){
        console.log(response);
      }).catch(function(error){
        console.log(error);
      });
    },
    decode_esto:function(ar,attr){
      if(ar){
        try {
          var l_arr  = JSON.parse(ar);
          console.log("aqui");
          console.log(l_arr[attr]);
          return l_arr[attr];
        } catch (e) {
            return '';
        }
        return '';
      }else{
        return "";
      }

    },
    es_url:function(url){
      var pattern = new RegExp('^(https?:\/\/)?'); // protocol
      // '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
      // '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
      // '(\:\d+)?(\/[-a-z\d%_.~+]*)*'+ // port and path
      // '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
      // '(\#[-a-z\d_]*)?$','i'); // fragment locater
      if(pattern.test(url)) {
        return true;
      } else {
        return false;
      }
    },
    gotoByUrl: function(url){
      var pattern_url = new RegExp('^(https?:\/\/)'); // protocol
      var pattern_hash = new RegExp('^\#[-a-z\d_]'); // protocol
      console.log(url);
      if(pattern_url.test(url)) {
        window.open(url, '_blank');
      } else if(pattern_hash.test(url)){
        this.$scrollTo(url, 1000)
      }else {
        this.$router.push(url);
        this.$scrollTo('#menu-home', 300)
      }
    },
    formatoCostoMoneda:function(valor_raw){
      if(valor_raw=='--'){
        return '--';
      }

      var twoPlacedFloat = parseFloat(valor_raw).toFixed(2);
      return 's/. ' + twoPlacedFloat;
    },
    formatoCosto:function(valor_raw){
      if(valor_raw=='--'){
        return '--';
      }

      var twoPlacedFloat = parseFloat(valor_raw).toFixed(2);
      return twoPlacedFloat;
    },
    formatoCostoRedondo:function(valor_raw){
      if(valor_raw=='--'){
        return '--';
      }

      var twoPlacedFloat = parseFloat(valor_raw).toFixed(1);
      return twoPlacedFloat;
    },
    getLocalUser:function(){
      var pro = localStorage.getItem("user_p_info");
      return JSON.parse(pro);
    },
    setLocalUser:function(pro){
      localStorage.setItem('user_p_info',JSON.stringify(pro));
    },
    procesaXml:function(xmlstring){
    var parser = new DOMParser();
    var xmlres = parser.parseFromString(xmlstring,"text/xml");
    return xmlres;
    }


  }
});


//COCKEDEN IÇÇÇ
//var VueCookie = require('vue-cookie');
// Tell Vue to use the plugin
//Vue.use(VueCookie);


new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})




// Initialize Firebase
var config = {
  apiKey: "AIzaSyA4soAMjFo8X_D7yGAVeb4C68T-otDsmuE",
  authDomain: "nimble-radio-175703.firebaseapp.com",
  databaseURL: "https://nimble-radio-175703.firebaseio.com",
  projectId: "nimble-radio-175703",
  storageBucket: "nimble-radio-175703.appspot.com",
  messagingSenderId: "64393659193"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.requestPermission()
.then(function(){
  console.log("permisos otorgados nuevo");
  //console.log(messaging.getToken());
  return messaging.getToken();
}).then(function(token){
  console.log("token generado");
  console.log(token);
}).catch(function(err){
  console.log("error permisos notificaciones");
  console.log(err);
});

messaging.onMessage(function(payload){
  console.log('onMessage',payload);
  EventBus.$emit('payload', payload);
  console.log('NOTIFICACION RECIBIDA');
});






















Vue.use(FBSignInButton);


// inject a handler for `myOption` custom option


/*
const HelloJs = require('hellojs/dist/hello.all.min.js');
const VueHello = require('vue-hellojs');

HelloJs.init({
  facebook: 2001153770200290
}, {
  //redirect_uri: 'authcallback/'
});
Vue.use(VueHello, HelloJs);*/
