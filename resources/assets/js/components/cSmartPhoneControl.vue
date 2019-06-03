<template>
	<v-container class="d-justify-center">
		<v-layout row wrap class="smarphone-wrapper" style="max-width: 700px!important;">
	    <v-flex sm6 xs12 class="smarphone-control d-align-center">
	    	<div class="px-4 pl-5 py-5" style="position: relative;">
		      <div class="control-item"
		      	:class="{'control-item__active': isActive(1)}"
		      	@click="setActive(1)">
		        <span class="round-item">1</span>
		        <div>
		          <h4 class="content-title">
		            Punto de recojo
		          </h4>
		          <transition name="slide-x-transition">
			          <p
			          	class="ma-0 content-item font-extra-light"
			          	v-show="e==1">
			            Ingresa tu dirección e información sobre donde se recogerá tu envíó <br>
			            <a href="" class="black--text font-bold" @click.stop.prevent="openLoginRm">Haz tu envio aquí</a>
			          </p>
			        </transition>
		        </div>
		      </div>
		      <div
		      	class="control-item mt-5"
		      	:class="{'control-item__active': isActive(2)}"
		      	@click="setActive(2)">
		        <span class="round-item">2</span>
		        <div>
		          <h4 class="content-title">
		           Punto de entrega
		          </h4>
		          <transition name="slide-x-transition">
			          <p
			          	class="ma-0 content-item font-extra-light"
			          	v-show="e==2">
			            Ingresa la información de destino donde se entregara tu envío <br>
									<a href="" class="black--text font-bold" @click.stop.prevent="openLoginRm">Haz tu primer envío aquí</a>
			          </p>
		        </transition>
		        </div>
		      </div>
		      <div class="control-item mt-5"
		      	:class="{'control-item__active': isActive(3)}"
		      	@click="setActive(3)">
		        <span class="round-item">3</span>
		        <div>
		          <h4 class="content-title">
		           Confirma tu envío
		          </h4>
		          <transition name="slide-x-transition">
			          <p
			          	class="ma-0 content-item font-extra-light"
			          	v-show="e==3">
			            Listo! Llegará un scharffer a recoger y entregar tu paquete. Te notificaremos sobre el estado de tu envío. <br>
									<a href="" class="black--text font-bold" @click.stop.prevent="openLoginRm">Haz tu primer envío aquí</a>
			          </p>
			        </transition>
		        </div>
		      </div>
		      <i class="line--divisor" :class="{'smal-line': e==3}"></i>
		      <i class="hidden-line-aux"></i>
				</div>
	    </v-flex>
	    <v-flex sm6 xs12 class="smarphone-images">
	      <div class="position-relative smartphone-images-wrapper">
	      	<!-- one -->
	      	<transition name="fade-ex-transition">
		      	<div v-show="e==1" class="d-justify-center mt-3 position-absolute">
	            <img :src="stepOne.url">
	          </div>
	        </transition>
          <!-- two -->
          <transition name="fade-ex-transition">
	          <div v-show="e==2" class="d-justify-center mt-3 position-absolute">
	            <img :src="stepTwo.url">
	          </div>
	        </transition>
          <!-- tree -->
	        <transition name="fade-ex-transition">
	          <div v-show="e==3" class="d-justify-center mt-3 position-absolute">
	            <img :src="stepTree.url">
	          </div>
	        </transition>

	      </div>
	    </v-flex>
	  </v-layout>
	</v-container>
</template>
<script>
import { EventBus } from '../config/ebus.js';
export default {
	data() {
		return {
			e: 1,
			stepOne: {url:'./images/express/paso1.png', alt: 'smartphone express'},
      stepTwo: {url:'./images/express/paso2.png', alt: 'smartphone express'},
      stepTree: {url:'./images/express/paso3.png', alt: 'smartphone express'},
		}
	},
	methods:{
		isActive: function(i){
			if(this.e == i) {
				return true
			}
		},
		setActive: function(i){
			this.e = i
		},
		openLoginRm(){
      EventBus.$emit('openLoginRm','express');
    }
	}
}

</script>
<style lang="scss">
@import "../../scss/vars.scss";
.control-item{
	z-index: 2;
	transition: all 1s;
	display: flex;
	position: relative;
	// align-items: center;
	cursor: pointer;

	.round-item{
		// background: $primary-color;
		// border-radius: 50%;
		// height: 2rem;
		// width: 2.1rem;
		display: flex;
		justify-content: center;
		align-items: center;
		color: white;
		margin-right: 2rem;
		position: relative;
		font-size: 1.5rem;
		font-family: Carnas-bold;
		font-weight: 500;
		&:before{
			content: '';
	    background: $primary-color;
	    width: 2.5rem;
	    height: 2.5rem;
	    position: absolute;
	    border-radius: 50%;
	    z-index: -1;
	    border: solid .2rem $primary-color;
		}
	}
	.content-title{
		color: rgba(0, 0, 0, 0.5);
		font-size: 1.5rem;
		font-family: Carnas-bold;
    font-weight: 500;
	}
	.content-item{
		font-size: 1rem;
		max-width: 17rem;
	}
}
.smarphone-control .control-item{
	z-index: 1;
}
.control-item__active{
	.round-item{
		// background: white;
		// border-radius: 50%;
		// border: solid .2rem $primary-color;
		// height: 2rem;
		height: 1.9rem;
		// display: flex;
		// justify-content: center;
		// align-items: center;
		color: $primary-color;
		// box-sizing: border-box;
		// margin-right: 1rem;
		&:before{
			content: '';
	    background: white;
	    // width: 2.5em;
	    // height: 2.5rem;
	    position: absolute;
	    border-radius: 50%;
	    z-index: -1;
	    border: solid .2rem $primary-color;
		}
	}
	.content-title{
		color: black;
	}
	// .content-item{
	// 	font-size: .9rem;
	// }
}

.smartphone-images-wrapper{
	height: 449px;
	display: flex;
	justify-content: center;
	width: 100%;
	div{
		position: relative;
		img{
			position: absolute;
		}
	}
}
.line--divisor{
	content: '';
	width: .2rem;
	height: 17rem;
	background: $primary-color;
	position: absolute;
	top: 5.6rem;
	left: 3.8rem;
	z-index: 0;
}
.smal-line{
	height: 11.2rem;
}
.hidden-line-aux:before{
	content: '';
	position: absolute;
	background-color: white;
	width: 1rem;
	height: 4.9rem;
	bottom: 6px;
	left: 3.5rem;

}

</style>
