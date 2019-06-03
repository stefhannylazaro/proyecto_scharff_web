<template>
	<v-container fluid class="bg-map-img">
		<v-layout style="display:none">
			<v-flex class="d-flex justify-center align-center py-5">
				<div class="c-search-locker">
					<h3 class="font-regular pb-5 pt-5">BUSCA TU LOCKER</h3>
					<div class="s-input font-light mb-5">
						<img src="../../img/geo.png" alt="">
						<input type="text" placeholder="ingresa tu distrito">
					</div>
				</div>
			</v-flex>
		</v-layout>

		<div class="busca-tulocker-ww">
			<h3 class="font-regular pb-2 text-center" style="font-size: 22px;font-family: Carnas-Bold;">BUSCA TU LOCKER</h3>
			<div class="dir_selected-w" v-if="dir_selected">
				<v-icon style="font-size:16px;margin-bottom:.3rem">place</v-icon>
				<label  v-text="dir_selected"></label>
			</div>
			<div class="mapaylista mapaylista--out">
				<div class="listalockers-w">
					<v-card>


						<v-list two-line color="cyan" dark>
							<template v-for="(el, index) in lockersListItems">

								<v-list-tile :key="el.nombre" @click="selecListLocker(el)" :class="{'lockerSelected':lockerIDSelected==el.id}">

									<v-list-tile-content>
										<v-list-tile-title v-html="el.nombre"></v-list-tile-title>
									</v-list-tile-content>
								</v-list-tile>
							</template>
						</v-list>
					</v-card>
				</div>

				<div class="mapalockers-w">
					<gmap-map

						:center="currentLocation"
						:zoom="14"
						map-type-id="roadmap"
						class="px-4"
						style="width: 100%; height: 100%;min-height: 16rem;"
						>
						<gmap-marker
							:key="index"
							v-for="(m, index) in markers"
							:position="m.position"
							:clickable="true"
							:draggable="false"
							:icon_="'/images/mapa.png'"

							@click="clickOnLocker(m.id)">
							<gmap-info-window>
                <strong>{{m.direccion}}</strong>
            </gmap-info-window>
						</gmap-marker>

					</gmap-map>
				</div>

			</div>

		</div>



	</v-container>
</template>




<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';

export default {
	data () {
		return {
			currentLocation: {lat:-12.061844, lng: -76.99153409999997},
			direccion: 'Guillermo Prescott, Miraflores,',
			dir_selected:'',
			lockersListItems: [
			],
			markers: [
			],
			lockerIDSelected:0,
		}
	},
	mounted(){
		this.loadLockersApi();
	},
	methods:{
		selecListLocker:function(el){
      console.log(el);
      this.lockerIDSelected = el.id;
      this.currentLocation= {lat:parseFloat(el.lat), lng: parseFloat(el.lng)};
      console.log('el.direccion');
      console.log(el.direccion);
      this.dir_selected = el.direccion;
    },
		loadLockersApi:function(){

      var vm = this;







      axios({
        method:'get',
        url:apiRutas.locker_lista,
        params: {
          token:apiRutas.token_aux
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      }).then(function(response){
        let res = response.data;

        res.data.forEach(function(el){
          vm.markers.push({
            position:{
              lat: parseFloat(el.ubicacion_lat),
              lng: parseFloat(el.ubicacion_lng),

            },id: el.id,
						direccion:el.direccion
          })
          vm.lockersListItems.push({
            nombre:el.nombre,
            id:el.id,
            lat: parseFloat(el.ubicacion_lat),
            lng: parseFloat(el.ubicacion_lng),
            direccion: (el.direccion),
          })
        });

      });
    },
	}
}
</script>

<style>
.mapaylista {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.listalockers-w {
    width: 300px;
    height: 330px;
    overflow-y: scroll;
    background: #424242;
}
.mapalockers-w {
    width: calc(100% - 300px);
}
.bg-map-img{
	padding: 0;
}
.list--two-line .list__tile {
    height: 64px;
}
.mapaylista--out h3{
	background: #424242;
	color: #fff;
	padding-left: 17px;
	position: relative;
	font-weight: 400;
	font-family: 'Carnas-black';
	font-size: 19px;
}
.mapaylista--out{
	padding-top: 24px;
	width: 1200px;
	margin: auto;
}
li.lockerSelected {
    background: #272727;
}
.bg-map-img {
    background: none;
}
.listalockers-w li{
	cursor:pointer;
}
.dir_selected-w {
    font-family: Carnas-Light;
    text-align: center;
    margin-bottom: -13px;
    margin-top: 10px;
}
.busca-tulocker-ww {
    padding: 100px 0;
	}
</style>
