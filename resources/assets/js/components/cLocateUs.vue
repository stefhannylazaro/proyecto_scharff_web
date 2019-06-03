<template>
  <v-container fluid class="pa-0 max-w960">
    <v-layout v-if="showSucursales" row wrap>
      <v-flex xs12  class="bg-locate-us">
        <div class="text-center locate-first">
          <h3 class="font-bold mb-3">Ubícanos</h3>
          <!--<div id="ubi_ubicanos_v_descripcion"> -->
          <div id="">
            <p class="font-bold text-center mb-1">Call center:</p>
            <p class="font-bold mb-3" style="font-size:13px">De lunes a viernes de 08:30 a 18:300 y sábados de 09:00 a 13:00</p>
            <p class="font-bold mb-4">Perú:<span class="color-pink"><a style="text-decoration: none; color: inherit;" href="tel: 511 5171600"> (+511) 517-1600</a></span> <span class="future-br"></span>Bolivia:  <span class="color-pink"><a style="text-decoration: none; color: inherit;" href="tel: (+51) 01-517-1600">(+591) 311 6211</a></span></p>

            <p class="font-bold text-center mb-1">Whatsapp:</p>
            <p class="font-bold mb-3" style="font-size:13px">Todos los diás a cualquier hora (24/7)</p>
            <p class="font-bold mb-0">Perú:<span class="color-pink"><a style="text-decoration: none; color: inherit;" href="tel: 998 140 976"> 998140976</a></span> <span class="future-br"></span></p>
          </div>

          <!-- <v-btn @click="showSucursales = !showSucursales">holi2</v-btn> -->
          <div class="my-5">
            <!-- <v-btn round large outline class="cover" @click="showSucursales = !showSucursales"><v-icon>place</v-icon>Perú sucursales</v-btn> -->
            <v-btn
              round outline
              @click="showSucursal('peru')"
              class="btn-sucursales btn-sucursales--peru">
                <v-icon style="font-size:16px;" class="pr-2">place</v-icon>
                Perú sucursales
            </v-btn>
            <v-btn
              round outline
              @click="showSucursal('bolivia')"
              class="btn-sucursales">
                <v-icon style="font-size:16px;" class="pr-2">place</v-icon>
                Bolivia sucursales
            </v-btn>
          </div>
        </div>
      </v-flex>
    </v-layout>
    <v-layout v-if="!showSucursales" row wrap>
      <v-flex xs12 sm7 class=" px-3 py-5 pl-4">

        <h3 style="font-size:1.7rem;" class="font-bold text-center" :class="{'align-text-right': showMaps}">Ubícanos</h3>
        <div id="ubi_ubicanos_h_descripcion" class="mb-2 text-center" :class="{'align-text-right': showMaps}">
          <p class="font-medium ma-0">Call center: <span class="color-pink"><a style="text-decoration: none; color: inherit;" href="tel: (+51) 01-517-1600">(+51) 01-517-1600</a></span></p>
          <span class="px-1" v-if="showMaps"><strong>|</strong></span>
          <p class="font-medium ma-0"> Whatsapp: <span  class="color-pink"><a style="text-decoration: none; color: inherit;" href="tel: 998 140 976">998 140 976</a></span></p>
        </div>
        <div v-if="showPeruSuc">
          <div>
            <p class="font-bold g-pais">Perú<span class="color-pink pr-4">/Sucursales</span></p>
          </div>
          <div class="g-wrapper pb-3">
            <div v-for="(item, i) in SucursalesPeruOne" :key="i" class="g-sucursales mb-2">
              <p @click="setLocateMap(item)" class="font-bold mb-1"><v-icon :class="{activeSucursal: i == 0}" style="font-size:16px;">place</v-icon>{{item.departamento}}.<span class="g-sub-text">{{item.ciudad}}</span></p>
              <p @click="setLocateMap(item)" class="ma-0 font-light g-sub-text pl-3">{{item.dirOne}}<br>{{item.dirTwo}}<br></p>
              <a class="font-light g-sub-text pl-3" style="text-decoration:none;color:inherit;" :href="'tel:'+item.tel">{{item.tel}}</a>
            </div>
          </div>
          <div class="mt-3" :class="{'text-center': !showMaps}">
            <v-btn
              round outline
              @click="showSucursal('bolivia')"
              class="btn-sucursales">
                <v-icon style="font-size:16px;" class="pr-2">place</v-icon>
                Bolivia sucursales
            </v-btn>
          </div>
        </div>
        <div v-if="showBoliviaSuc">
          <div>
            <p class="font-bold g-pais">Bolivia<span class="color-pink pr-3">/Sucursales</span></p>
          </div>
          <div class="g-wrapper">
            <div v-for="(item, i) in SucursalesBolivia" :key="i" class="g-sucursales mb-2">
              <p @click="setLocateMap(item)" class="font-bold mb-1"><v-icon style="font-size:16px;">place</v-icon>{{item.departamento}}.<span class="g-sub-text">{{item.ciudad}}</span></p>
              <p @click="setLocateMap(item)" class="ma-0 font-light g-sub-text pl-3">{{item.dirOne}}<br>{{item.dirTwo}}<br></p>
              <a class="font-light g-sub-text pl-3" style="text-decoration:none;color:inherit;" :href="'tel:'+item.tel">{{item.tel}}</a>
            </div>
          </div>
          <div class="mt-3" :class="{'text-center': !showMaps}" >
            <v-btn
              round outline
              @click="showSucursal('peru')"
              class="btn-sucursales">
                <v-icon style="font-size:16px;" class="pr-2">place</v-icon>
                Perú sucursales
            </v-btn>
          </div>
        </div>

      </v-flex>
      <v-flex v-show="showMaps" xs12 sm5>
        <gmap-map
          :center="mapCenter"
          :zoom="15"
          map-type-id="roadmap"
          style="width: auto; height: 100%;min-height: 20rem;"
          >
          <gmap-marker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :clickable="true"
            :draggable="true"
            :icon="iconMaker"

            @click="center=m.position">
          </gmap-marker>
        </gmap-map>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data () {
    return {

      SucursalesPeruOne: [
      ],
      SucursalesBolivia: [
      ],
      mapCenter: { icon: './images/collage.png'},
      center: {lat: 10.0, lng: 10.0},
      markers: [],
      showSucursales: true,
      showPeruSuc: false,
      showBoliviaSuc: false,
      windowWidth: null,
      showMaps: true,
      iconMaker: {
        url:'./images/marker.png',
        size: {width: 46, height: 46, f: 'px', b: 'px'},
        scaledSize: {width: 46, height: 46, f: 'px', b: 'px'}
      },
      sucursales:''
    }
  },
  watch:{
    windowWidth: function (el) {
      if(el<600){
        this.showMaps = false
      } else {
        this.showMaps = true
      }
    },
    loadSucursales: function (el) {
      if(el) {
        console.log('ele');
        console.log(el);
        el.forEach((ele)=>{
          if(ele.pais =='PERÚ'){
            this.SucursalesPeruOne.push(ele);
            this.markers.push({position:ele.position});
          }else if(ele.pais == 'BOLIVIA'){
            this.SucursalesBolivia.push(ele);
            this.markers.push({position:ele.position});
          }
        });
        console.log('this.SucursalesPeruOne[0]');
        console.log(this.SucursalesPeruOne[0]);

        this.mapCenter.lat = (this.SucursalesPeruOne[0].position.lat);
        this.mapCenter.lng =(this.SucursalesPeruOne[0].position.lng);
console.log(this.mapCenter.lat);
      }
    },
  },
  computed: {
    loadSucursales: function () {
      var sucursales = this.$store.getters.loadStateSucursales;
      if(sucursales&&sucursales.constructor == Array){
        sucursales = sucursales.map((el)=>{
          if(el.direccion){
            let direccionAr = JSON.parse(el.direccion);
            el.departamento = direccionAr.departamento;
            el.dirOne = direccionAr.dirOne;
            el.dirTwo = direccionAr.dirTwo;
            el.tel = direccionAr.tel;

          }
          el.position = {
            lat:parseFloat(el.latitud),
            lng:parseFloat(el.longitud)
          };
          return el;
        })

        return sucursales;
      }
    },
  },
  mounted () {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
    })
    this.getWindowWidth()
  },
  methods: {
    setLocateMap: function (item) {
      let position = item.position
      this.mapCenter = {
        lat: position.lat,
        lng: position.lng
      }
    },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
    },
    showSucursal: function (name) {
      this.showSucursales = false
      switch (name){
        case 'peru':
          this.showPeruSuc = true
          this.showBoliviaSuc = false
          break
        case 'bolivia':
          this.showPeruSuc = false
          this.showBoliviaSuc = true
          break
      }
    }
  }

}
</script>

<style>

</style>
