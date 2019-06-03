<template>
  <v-slide-x-transition>
  <v-card class="px-5 pb-4 pt-5 white login-style tr-size">
    <div class="close">
      <i @click.stop="closeModal">
        <svg style="width:32px;height:32px;fill: rgba(0, 0, 0, 0.4);" viewBox="0 0 24 24">
            <path d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
        </svg>
      </i>
    </div>
    <div>
      <div class="header pb-3">
        <h4 class="pb-2">¿Dónde está mi pedido?</h4>
        <span>Ingresa tu número de rastreo,<br>selecciona el país y el tipo de servicio</span>
      </div>
      <div class="input-tracking">
        <vue-select class="pb-4 z-indexTwo" :firstItem="true" nameTitle="País" :listData="servicePais" :selected="pais.name" v-on:selectValue="selectPais"></vue-select>
        <vue-select class="pb-4" nameTitle="Servicio" :firstItem="false" :listData="arrService" :selected="servicio.name" v-on:selectValue="selectService"></vue-select>
      </div>
      <div>
        <textarea class="t-text-area" v-model="NroRastreo" placeholder="Nro. de Rastreo"></textarea>
      </div>
      <v-btn round large class="cover elevation-0 bg-pink white--text" @click.stop="searchData()">Buscar</v-btn>
    </div>
  </v-card>
  </v-slide-x-transition>
</template>

<script>
import axios from 'axios'
import vueSelect from './cSelectData.vue'
export default {
  props:['regular_codetracking'],
  data () {
    return {
      url: 'http://200.37.50.50/',
      pais: { name: 'Perú', value: 'P'},
      servicio: { name: 'Courier Nacional', value: '2'},
      NroRastreo: '',
      servicePais: [
        { name: 'Perú', value: 'P'},
        { name: 'Bolivia', value: 'B'}
      ],
      arrService: [
        { name: 'Courier Nacional', value: '2'},
        { name: 'FedEx', value: '1'}
      ]
    }
  },
  mounted(){
    if(this.regular_codetracking){
      this.NroRastreo = this.regular_codetracking;
    }
  },
  methods: {
    searchData: function () {
      // let search = [
      //   {
      //     'cmbPais': this.pais.value,
      //     'selReporte': this.servicio.value,
      //     'codigos': this.NroRastreo
      //   }
      // ]
      let form = document.createElement( "form" );
      form.setAttribute( "name", "formulario" );
      form.setAttribute( "id", "TrackForm" );
      form.setAttribute( "action", "http://200.37.50.50/Servicios/trackRedir.asp" );
      form.setAttribute( "method", "post" );
      form.setAttribute( "target", "_blank" );

      let cmbPais = document.createElement( "input" );
      cmbPais.setAttribute( "name", "cmbPais" );
      cmbPais.setAttribute( "type", "hidden" );
      cmbPais.setAttribute( "value", this.pais.value );

      let selReporte = document.createElement( "input" );
      selReporte.setAttribute( "name", "selReporte" );
      selReporte.setAttribute( "type", "hidden" );
      selReporte.setAttribute( "value", this.servicio.value);

      let codigos = document.createElement( "input" );
      codigos.setAttribute( "name", "codigos" );
      codigos.setAttribute( "type", "hidden" );
      codigos.setAttribute( "value", this.NroRastreo);

      form.appendChild( cmbPais );
      form.appendChild( selReporte );
      form.appendChild( codigos );
      document.getElementsByTagName( "body" )[0].appendChild( form );
      document.formulario.submit();
      this.removeChildForm()
    },
    removeChildForm: function () {
      let formula = document.getElementById("TrackForm")
      formula.parentNode.removeChild(formula)
      return false
    },
    selectService: function (item) {
      this.servicio = item
    },
    selectPais: function (item) {
      this.pais = item
    },
    closeModal: function (){
      this.$emit('closeTrackingModal')
    }

  },
  components: {
    'vue-select': vueSelect
  }

}
</script>

<style>

</style>
