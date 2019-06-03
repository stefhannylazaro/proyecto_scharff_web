<template>
	<v-container fluid class="bg-express-full d-align-center">
		<v-container>
			<v-layout>
				<v-flex xs12 sm6 class="d-column-justify-center order-0 d-align-center">
					<h3 v-if="showTitle" class="text-center white--text aux font-bold  cImg-text-title">
						{{title}}
			        </h3>
			        <p class="text-center white--text font-bold pb-3 cImg-text-subtitle ma-0">
			        	{{subTitle}}
			        </p>
			        <p style="max-width: 21rem;" class="text-center white--text font-light cImg-text-content ma-0">
			          {{content}}
			        </p>
			        <div class="py-3 d-justify-center">
			        	<v-btn round large color="black" class="cover white black--text elevator-0" @click.stop.prevent="$emit('login_attemp')">
			        		Solicitar envío
			        	</v-btn>
			        </div>
				</v-flex>
			</v-layout>
		</v-container>


	</v-container>


</template>
<script>
export default {
	data() {
		return{
			title:'¡Únete a nuestro equipo de Scharffers!',
			subTitle: '¿Deseas enviar?',
			content: 'Haz tus envíos de la manera más fácil, desde casa, o estés donde estés.',
			showTitle: false,
			bgIsSmoke: false,
		}
	}
}

</script>
<style lang="scss">

</style>
