<template>
	<v-container fluid :class="{'bg-smoke': bgIsSmoke}">
		<v-container class="d-justify-center">
			<v-layout row wrap style="max-width:830px;" class="el_1532013477">
				<v-flex xs12 sm6 class="text-center order-1 el_1532013954">
					<img  class="cImg-text-height cla_1531957198" :src="imgBase.url" :alt="imgBase.alt">
				</v-flex>

				<v-flex xs12 sm6 class="d-column-justify-center d-align-end order-0 el_1532014292">
							<h3 v-if="showTitle" class="text-sm-right text-xs-center title-pink aux font-bold  cImg-text-title">
								{{title}}
			        </h3>
			        <p style="max-width: 30rem;" class=" text-sm-right text-xs-center font-bold pb-3 cImg-text-subtitle">
			        	{{subTitle}}
			        </p>
			        <p style="max-width: 100%rem;" class="text-sm-right text-xs-center font-light cImg-text-content">
			          {{content}}
			        </p>
			        <div class="py-3 text-right" style="width:100%">
			        	<slot name="btnComponent"></slot>
			        </div>
				</v-flex>
			</v-layout>
		</v-container>
	</v-container>
</template>
<script>
	export default {
		props:['bgIsSmoke','imgBase','showTitle','title','subTitle','content'],
		data() {
			return{
			}
		}
	}
</script>
<style lang="scss">
	.cImg-text-height{
		max-height: 30rem
	}
	@media screen and (max-width:430px) {
		.cImg-text-height{
			max-height: 23rem;
		}
	}
	@media screen and (max-width:430px) {
		.cImg-text-height{
			max-height: 20rem;
		}
	}
	.cImg-text-title{
		font-size: 4rem;
	}
	.cImg-text-subtitle{
		font-size: 2.5rem;
	}
	.cImg-text-content{
		font-size: 1.3rem;
	}
	@media screen and (max-width:855px) {
			.cla_1531957198{
		    max-height: 30rem;
		    width: 271px;
		    height: auto;
		    max-width: 100%;
			}
			.el_1532013954{
				text-align: left;
			}
	}
	@media screen and (max-width:599px) {
			.cla_1531957198{
				width: auto;
				height: auto;
				max-width: 100%;
			}
			.el_1532013954{
				text-align: center;
			}
			.el_1532014292 .cImg-text-subtitle{
				width:100% !important;
				max-width:100% !important;
			}
			.el_1532014292 .text-right{
				text-align: center;
			}
	}
</style>
