<template>
  <v-layout>
    <v-flex xs12>
    <v-stepper class="elevation-0 bg-gray-one" v-model="e1">
      <v-stepper-header class="px-5 stepper-width-head elevation-0 align-elements-reservation">
        <v-stepper-step step="1" :complete="e1 > 1" class="stepper-control"></v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="2" :complete="e1 > 2" class="stepper-control"></v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="3" class="stepper-control"></v-stepper-step>
      </v-stepper-header>

      <!-- <div class="">
        Hola mundo <br>
        {{userAddress}} <br>
        {{currentLocation}} <br>
        {{clientAddress}} <br>
        {{currentLocationClient}} <br>
      </div> -->
      <v-stepper-items>
        <v-stepper-content step="1">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-bold" >¿Dónde esta el paquete?</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container">
            <v-layout xs12 row wrap>
              <div class="white-bg xs12 row wrap layout">
                <div class="caja-favoritos-a" @mouseover="openFavA=true" v-if="fab_a" @mouseleave="openFavA=false">
                  <div  class="">
                    <img src="/images/icon_favorite.png" alt="">
                    <label for="">Mis favoritos</label>
                  </div>
                  <div class="fakefavselect" v-if="openFavA">
                    <div v-for="(el, idx) in fab_a" :key="idx" :value="idx" @click="handleFavA(idx)">{{el.favoritoorigen_emisor}}</div>
                  </div>

                </div>


              <v-flex xs12 sm6 md5>
                <div class="font-regular min-width-step-two el_1534873960 ep-form-package pl1">
                  <div class="text-step-two text-step-one text-step-one-rw">

                    <strong>Ingresa los datos de recojo de tu paquete</strong>


                    <div class="autocompleteInput-w">
                      <GmapAutocomplete
                      :options="{
                          componentRestrictions: {'country': ['pe']}
                      }"
                      placeholder="Dirección de recojo *" @place_changed="setPlace" id="autocompleteInput"></GmapAutocomplete>
                    </div>
                    <input type="text"  style="margin-bottom: 1px;" placeholder="Número, Interior, piso u oficina" v-model="interior_recojo"><br>
                    <textarea class="origen-envio__textarea" name="name" rows="8" cols="80" v-model="observaciones_origen" placeholder="¿Qué quieres enviar?"></textarea>
                    <v-layout row wrap align-center v-if="order_capacities&&order_capacities.constructor==Array&&order_capacities.length>0">
                      <v-flex xs4 class="el_1538781517">
                        <span>Tamaño de paquete</span>
                      </v-flex>

                      <v-flex xs12 sm8 d-flex class="el_1538781516">
                        <multiselect
                          v-model="order_capacity_elegido"
                          :options="order_capacities"
                          label="name"
                          :searchable="true"
                          :close-on-select="true"
                          :show-labels="false"
                          class="input--modifier input-nb"
                          placeholder="Selecciona">
                        </multiselect>
                      </v-flex>
                    </v-layout>
                    <br>
                    <strong>Contacto de recojo</strong>
                    <input type="text" placeholder="Nombre y apellidos *" :class="{'express-input-error':error.userName}" v-model="userName">
                    <small v-if="error.userName" v-text="error.userName"></small><br>
                    <input type="number" min="0" class="sinflechas" placeholder="Celular o Teléfono *" v-model="userPhone" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)" ><br>


                    <div class="inputs_dinamicos" v-html="inputs_dinamicos"></div>


                    <v-checkbox class="checkox-space-empty" label="Guardar como favorito" v-model="remember" light color="red"></v-checkbox>

                    <input type="hidden" placeholder="Ingresa tu dirección" v-model="userAddress" v-on:change="searchLocation('user', userAddress)"><br>


                  </div>

                </div>
              </v-flex>
              <v-flex xs12 sm6 md7 class="ep-map-container">
                <div>



                  <div class="info-stepper more-info-send-package justify-end d-align-center" style="display:none">
                    <img :src="infoIcon.url" :alt="infoIcon.alt">
                    <a class="pl-2 black--text more-info-text">Saber más</a>
                  </div>
                  <br>
                  <div class="currentLocation-w"
                  style="width: 100%;height: 100%;min-height: 24.8rem;background: #f4f4f4;">
                    <gmap-map v-if="currentLocation.lat!=0"
                      :center="currentLocation"
                      :zoom="16"
                      map-type-id="roadmap"
                      places
                      autocomplete
                      class="px-4"
                      style="width: 100%; height: 100%;min-height:24.8rem"
                      >

                      <gmap-marker
                        :position="currentLocation"
                        :clickable="true"
                        :draggable="true"
                        @dragend="getLocationDragged">
                      </gmap-marker>
                    </gmap-map>
                  </div>

                </div>
              </v-flex>
              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn v-if="preIrAlPaso2()" round outline class="btn-send-next" @click.native="e1 = 2">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >siguiente</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>







        <v-stepper-content step="2">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">¿Dónde hay que entregarlo?</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container">
            <v-layout xs12 row wrap>
              <div class="xs12 row wrap white-bg layout">
                <div class="caja-favoritos-a" v-if="fab_a">
                  <div @mouseover="openFavB=true" class="">
                    <img src="/images/icon_favorite.png" alt="">
                    <label for="">Mis favoritos</label>
                  </div>
                  <div class="fakefavselect" v-if="openFavB">
                    <div v-for="(el, idx) in fab_a" :key="idx" :value="idx" @click="handleFavB(idx)">{{el.favoritoorigen_emisor}}</div>
                  </div>

                </div>



              <v-flex xs12 sm6 md5>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two envio-step-two text-step-one-rw">
                    <strong>Ingresa los datos de entrega de su pedido</strong>
                    <div class="autocompleteInputb-w">
                      <GmapAutocomplete
                      :options="{
                          componentRestrictions: {'country': ['pe']}
                      }"
                      placeholder="Dirección de destino *" @place_changed="setPlaceb" id="autocompleteInputb"></GmapAutocomplete>
                    </div>
                    <input type="text"  style="margin-bottom: 1px;" placeholder="Número, Interior, piso u oficina" v-model="interior_envio"><br>
                    <textarea class="destino-envio__textarea" name="name" rows="8" cols="80" v-model="clientComments" placeholder="Instrucciones u observaciones de envío"></textarea>

                    <strong>Contacto de entrega</strong>


                    <input type="text" placeholder="Nombres y apellidos*" v-model="clientName" :class="{'express-input-error':error.clientName}" >
                    <small v-if="error.clientName" v-text="error.clientName"></small><br>
                    <template v-if="usuario_corporativo==1">
                      <input type="text" placeholder="Correo Electrónico*" v-model="contactoEmail"><br>
                    </template>
                    <input type="number" min="0" class="sinflechas" placeholder="Celular o Teléfono *" v-model="clientPhone" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)"><br>



                    <!--<input type="text" min="0" placeholder="Empresa (Opcional)" v-model="clientNameCompany"><br>-->
                    <v-checkbox class="checkox-space-empty" label="Guardar como favorito" v-model="rememberClient" light color="red"></v-checkbox>
                    <input type="hidden" placeholder="Dirección de entrega" v-model="clientAddress" v-on:change="searchLocation('client', clientAddress)"><br>


                  </div>

                </div>
              </v-flex>
              <v-flex xs12 sm6 md7 class="ep-map-container" >
                <div>
                  <div class="info-stepper more-info-send-package justify-end d-align-center" style="display:none">
                    <img :src="infoIcon.url" :alt="infoIcon.alt">
                    <a class="pl-2 black--text more-info-text" >Saber más</a>
                  </div>
                  <br>
                  <div class="currentLocation-w" style="width: 100%; height: 100%; min-height: 23.8rem; background: rgb(244, 244, 244);">
                    <gmap-map
                      v-if="e1 == 2"
                      :center="currentLocationClient"
                      :zoom="16"
                      map-type-id="roadmap"
                      class="px-4"
                      style="width: 100%; height: 100%;"
                      :style="usuario_corporativo==1?'min-height: 25.2rem;':'min-height: 23.8rem;'"
                      >
                      <gmap-marker
                        :position="currentLocationClient"
                        :draggable="true"
                        @dragend="getLocationDraggedClient">
                      </gmap-marker>
                    </gmap-map>
                  </div>
                </div>
              </v-flex>


              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 1">ATRAS</v-btn>
                <v-btn v-if="isValidWhereWeDeliver()" :loading="calculandoDetalles" :disabled="calculandoDetalles" round outline class="btn-send-next" @click.native="calcularDistanciaB()">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >siguiente</v-btn>
                <div class="text--red" v-if="noticeCalcularDistanciaB!=''" v-text="noticeCalcularDistanciaB"></div>
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Resumen de pedido</h2>
          </v-flex>

          <!--asddddddd-->
          <v-container class="nopadding-w390 enviar-container">
            <v-layout xs12 row wrap>
              <div class="xs12 row wrap white-bg layout font-regular min-width-step-two ep-form-package">
                <v-flex xs12 sm12 md12 class="summary-origen-destino-w">
                  <v-layout class="row wrap border-b">
                    <v-flex xs12 md6 class="pdd-m pdd-b0 text-step-two envio-step-two text-step-one-rw">
                      <div class="border-r">
                        <strong class="subtitle primary-color">Origen</strong>
                        <p class="mg-b0">{{userAddress}}</p>
                      </div>
                    </v-flex>
                    <v-flex xs12 md6 class="pdd-m text-step-two envio-step-two text-step-one-rw">
                      <div class="">
                        <strong class="subtitle green--text">Destino</strong>
                        <p class="mg-b0">{{clientAddress}}</p>
                      </div>
                    </v-flex>
                  </v-layout>
                </v-flex>
                <v-flex xs12 sm12 md12 v-if="order_capacities&&order_capacities.constructor==Array&&order_capacities.length>0">
                  <div class="pdd-m border2-b">
                    <div class="">
                      <strong class="subtitle">Tamaño del paquete</strong>
                      <p class="mg-b0">{{order_capacity_elegido.field_name}}</p>
                    </div>
                  </div>
                </v-flex>
                <v-flex xs12 sm12 md12 class="summary-mount-w">
                  <v-layout row wrap justify-space-between class="summary-mount">
                    <v-flex xs12 md6 class="text-left cupon-box" style="padding-left:20px;">
                      <div>
                        <div class="text-step-two text-step-one line-bottom_em"><strong>CUPÓN DE DESCUENTO</strong></div>
                        <div class="cupon-elementos">
                          <div class="cupon-input-w">
                            <input type="text" :disabled="se_aplico_cupon" name="" class="input-cupon" value="" v-model="cupon_descuento">
                            <i class="material-icons" v-if="cupon_descuento!=''" @click="resetearCupon" >
                            close
                            </i>
                          </div>
                          <v-btn round outline class="btn-aplicar-cupon" :disabled="se_aplico_cupon" @click.native="aplicarCupon">Aplicar cupón</v-btn>


                          <transition name="fade">
                            <span v-if="cupon_mensaje!='' && !se_aplico_cupon" v-text="cupon_mensaje"></span>
                          </transition>
                          <span v-if="se_aplico_cupon">
                            <i class="material-icons">
                            check
                            </i>
                          </span>
                        </div>
                      </div>
                      <!-- asd ruc-->
                      <div class="block-factura">
                        <v-checkbox
                          class="input-create check"
                          label="¿Desea factura?"
                          v-model="checkboxFactura"
                        ></v-checkbox>
                        <div class="input-factura" v-if="checkboxFactura">
                          <input type="number" class="sinflechas" :class="{facturacion_error:facturacion_error_ruc}" placeholder="RUC" v-model="facturacion_ruc">
                          <input type="text" :class="{facturacion_error:facturacion_error_razonsocial}" placeholder="Razón social"  v-model="facturacion_razonsocial">
                          <div class="text--red" v-if="facturacion_notice!=''" v-text="facturacion_notice"></div>
                        </div>
                      </div>
                      <!-- asd -->
                    </v-flex>
                    <!-- <v-flex xs12 :md6="tiene_cupon" :md12="!tiene_cupon"> -->
                    <v-flex xs12 md6>
                      <span class="subheading bold">Subtotal: <span class="montos-labels">s/.{{formatoCosto(costo_total)}}</span></span>
                      <div class="" v-if="promocion_id!=-1">
                        <span v-if="descuento!=0" class="subheading bold gray-color">{{promocion_promo_label}} <span class="montos-labels">s/.-{{formatoCosto(descuento)}}</span></span>
                      </div>
                      <div class="" v-if="cupon_id!=-1">

                          <span v-if="descuento_cupon!=0" class="subheading bold">{{promocion_cupon_label}} <span class="montos-labels">s/.-{{formatoCosto(descuento_cupon)}}</span></span>
                          <!-- <span class="subheading bold">Concepto(IGV): </span> -->
                      </div>
                      <span class=" total">Total: <span class="montos-labels"> s/.{{(costo_total_final)}}</span></span>

                      <!-- <div class="">SUBTOTAL: S/. <span>{{costo_total}}</span></div>
                      <div class="gray-color">DESCUENTOS: S/. <span>{{descuento}}</span></div>
                      <div class="total">TOTAL: S/. <span>{{costo_total_final}}</span></div> -->
                    </v-flex>
                  </v-layout>
                </v-flex>
              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 2">ATRAS</v-btn>
                <v-btn v-if="isValidWhereWeDeliver()" round outline class="btn-send-next" @click.native="abrirPanelPagar">Pagar</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >Pagar</v-btn>
                <div class="text--red" v-if="noticeCalcularDistanciaC!=''" v-text="noticeCalcularDistanciaC"></div>
              </v-flex>
            </v-layout>
          </v-container>
          <!--asd-->
        </v-stepper-content>

        <v-stepper-content step="4">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 v-if="pikerdisponible" class="font-medium">Scharffer encontrado</h2>
            <h2 v-else class="font-medium">Buscando un scharffer...</h2>

          </v-flex>
          <v-container class="nopadding-w390 enviar-container">
            <v-layout xs12 row wrap>

              <v-flex xs12 sm12 md12 class="ep-map-container ep-map-container-st3">
                <div>

                  <gmap-map
                    v-if="e1 == 4 && currentLocation.lat != 0"
                    :center="{lat:((currentLocation.lat+currentLocationClient.lat)/2),lng:((currentLocation.lng+currentLocationClient.lng)/2)}"
                    :zoom="14"

                    class="px-4 "
                    style="width: 100%; height: 100%;min-height: 22rem;"
                    ref="example"
                    >
                    <gmap-marker
                      :position="currentLocation"
                      :clickable="true"
                      :icon="mapicon_a"
                      @click="mapinfo_a=!mapinfo_a">
                      <gmap-info-window v-if="mapinfo_a">
                        <strong>Origen envío</strong>
                      </gmap-info-window>
                    </gmap-marker>
                    <gmap-marker
                      :position="currentLocationClient"
                      :clickable="true"
                      :icon="mapicon_b"
                      @click="mapinfo_b=!mapinfo_b">
                      <gmap-info-window v-if="mapinfo_b">
                        <strong>Destino envío</strong>
                      </gmap-info-window>
                    </gmap-marker>
                    <gmap-polyline
                        v-bind:path.sync="path"
                        v-bind:clickable="true"
                         v-bind:options="{ strokeColor:'#ffb517'}"
                        >
                    </gmap-polyline>

                  </gmap-map>

                  <div v-if="!pikerdisponible" class="text-center st-3-scharffer">
                    <img src="/images/moto3.png" width="90" alt="" style="padding-bottom:2px;padding-right: 0;"><br>
                    <strong><small v-text="unMinuto">00:15</small></strong>
                    <div class="pt-3 pb-2">
                      {{usuario_corporativo?'':'Tarifa: S/.'+costo_total_final+' ('+parseFloat(shippingDistance/1000).toFixed(2)+' Km).'}}
                      Tiempo de entrega: {{tiempoEstimado}}
                    </div>

                    <v-btn round outline class="elevation-0 " :loading="cancelarEnvioLoading" :disabled="cancelarEnvioDisabled"  style="min-width: 174px;" @click.native="cancelarEnvio">cancelar envío</v-btn>
                    <div v-if="pedido_cancelado_success!=''" class="pb-3 pt-1" style="font-family:Carnas-Bold">{{pedido_cancelado_success}}</div>
                  </div>


                  <div v-else class="text-center st-3-scharffer">
                    <img src="/images/icon-jm.png" alt="" width="65" height="58">
                    <strong v-if="picker_encontrado_nombre">{{picker_encontrado_nombre}}</strong>
                    <strong v-else>Picker</strong>
                    <div class="pt-3">
                      <v-btn round class="cover btn-active elevation-0" @click="payService()">SEGUIR ENVÍO</v-btn>
                      <v-btn round outline class="" @click="$emit('createReservation', false)">Ver historial</v-btn>
                    </div>
                  </div>
                </div>


                <div class="st3-3notificador-hidden" @click="notificarAlPickerAgain(pedido_id)"></div>
              </v-flex>


            </v-layout>
          </v-container>
        </v-stepper-content>
        <v-stepper-content step="5">
          <v-container>
            <v-layout row wrap>
              <v-flex xs12 class="font-light text-center section-one-stepper">
                <h2 class="font-medium pb-3">Tu pedido es</h2>
              </v-flex>
              <v-flex xs12 white>
                <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
                  <div>
                    <h4 class="red--text">Origen</h4>
                    <p>
                      {{userAddress}}
                    </p>
                  </div>
                  <div class="info-time-delivery d-align-between">
                    <img :src="iconTimerOrange.url" :alt="iconTimerOrange.alt">
                    <p class="text-end pr-3">
                      TIEMPO APROX. DE RECOJO 4:09 PM
                    </p>
                  </div>
                </v-card>
                <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
                  <div>
                    <h4 class="green--text">Destino</h4>
                    <p>
                      {{clientAddress}}
                    </p>
                  </div>
                  <div class="info-time-delivery d-align-between">
                    <img :src="iconTimer.url" :alt="iconTimer.alt">
                    <p class="text-end pr-3">
                      TIEMPO APROX. DE RECOJO 4:09 PM
                    </p>
                  </div>
                </v-card>
                <v-card class="elevation-0 d-align-between ma-3 ">
                  <div>
                    <h4>PAGO</h4>
                    <p class="d-align-center">
                      <i class="mr-1">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                          <path fill="#4caf50" d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7Z" />
                        </svg>
                      </i>
                      {{dondePagar}}
                    </p>
                  </div>
                  <div class="info-time-delivery d-align-between">
                    <img :src="iconMoney.url" :alt="iconMoney.alt">
                    <div style="width:10rem" class="align-elements-end pr-3">
                      <span>
                        Monto a cancelar
                      </span>
                      <span>
                        S/.{{costo_total_final}}
                      </span>
                    </div>
                  </div>
                </v-card>
              </v-flex>
              <v-flex xs12 class="d-justify-center py-3">
                <v-btn v-if="true" round outline class="btn-send-next" color="grey" @click.native="e1 = 2">ATRAS</v-btn>
                <v-btn v-if="true" round outline class="btn-send-next" @click.native="drawerRight = true">CONTINUAR</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>

    <v-dialog
      v-model="modalComplete"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login">
        <div class="back-modal-active" @click.stop="modalOtraOportunidad=false;$router.push({ name: 'historial', params: { panel: 'express', panel_id: ''}});">_</div>
        <v-card class="wrapper-info-finish el_1538001878">
          <div class="font-regular">
            <img src="/images/moto3.png" width="90" alt="" style="padding-bottom:2px;padding-right: 0;"><br>
            <h3 class="font-bold pb-2">Tu pedido ha sido registrado</h3>
            <p>En breve te informaremos el status de tu envío.</p>

            <v-btn
              round
              class=" elevation-0 pink white--text" @click.native="nuevoPedido" style="min-width: 174px;">
                Aceptar
            </v-btn>
            <v-btn round outline class="elevation-0" :loading="cancelarEnvioLoading" :disabled="cancelarEnvioDisabled" style="min-width: 174px;" @click.native="cancelarEnvio">cancelar envío</v-btn>
          </div>

        </v-card>

      </div>
    </v-dialog>




    <v-dialog
      v-model="modalOtraOportunidad"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login modalOtraOportunidad">
        <div class="back-modal-active" @click.stop="modalOtraOportunidad=false;$router.push({ name: 'historial', params: { panel: 'express', panel_id: ''}});">_</div>
        <v-card class="wrapper-info-finish">
          <div class="font-regular">
            <div  class="text-center st-3-scharffer">
              <img src="/images/moto3.png" width="90" alt="" style="padding-bottom:2px;padding-right: 0;"><br>
              <div class="pt-3 pb-2">
                Parece que nuestros scharffers están
                con muchas entregas. Deseas:
              </div>

              <v-btn
                round
                class=" elevation-0 pink white--text" :loading="notificarAlPickerLoading" :disabled="notificarAlPickerLoading" @click.native="notificarAlPickerAgain(pedido_id)">
                  Volver a intentar *
              </v-btn>
              <div v-if="notificarAlPickerNotice!=''" class="pb-2">{{notificarAlPickerNotice}}</div>
              <v-btn round outline class="elevation-0" :loading="cancelarEnvioLoading" :disabled="cancelarEnvioDisabled" style="min-width: 174px;" @click.native="cancelarEnvio">cancelar envío</v-btn>
              <div v-if="pedido_cancelado_success!=''" class="pb-3 pt-1" style="font-family:Carnas-Bold">{{pedido_cancelado_success}}</div>
              <small class="el--block">* Notifica a los scharffers nuevamente de tu envio.</small>
            </div>
          </div>
        </v-card>

      </div>
    </v-dialog>




    <v-dialog
      v-model="modalDetalles"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login">
        <v-card class="wrapper-info-detalle">
          <v-layout row wrap>
            <v-flex xs12 class="font-light text-center section-one-stepper">
              <h2 class="font-medium pb-3">Detalle de envío</h2>
            </v-flex>
            <v-flex xs12 white>
              <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
                <div class="text-left">
                  <h4 class="red--text">Origen</h4>
                  <p class="small-text" v-html="detailClientAddress">
                  </p>
                </div>
                <div class="info-time-delivery d-align-between">
                  <img :src="iconTimerOrange.url" :alt="iconTimerOrange.alt">
                  <p class="text-end pr-3">
                    TIEMPO APROX. DE RECOJO 4:09 PM
                  </p>
                </div>
              </v-card>
              <v-card class="elevation-0 d-align-between ma-3 border-bottom-list">
                <div class="text-left">
                  <h4 class="green--text">Destino</h4>
                  <p class="small-text" v-html="detailClientAddress">
                  </p>
                </div>
                <div class="info-time-delivery d-align-between">
                  <img :src="iconTimer.url" :alt="iconTimer.alt">
                  <p class="text-end pr-3">
                    TIEMPO APROX. DE RECOJO 4:09 PM
                  </p>
                </div>
              </v-card>
              <v-card class="elevation-0 d-align-between ma-3 ">
                <div>

                </div>
                <div class="info-time-delivery d-align-between">
                  <img :src="iconMoney.url" :alt="iconMoney.alt">
                  <div style="width:10rem" class="align-elements-end pr-3">
                    <span>
                      Monto a cancelar
                    </span>
                    <span>
                      <strong>
                        S/.{{detailAmountPayable}}.60
                      </strong>
                    </span>
                  </div>
                </div>
              </v-card>
            </v-flex>
            <v-flex xs12 class="d-justify-center py-3">
              <v-btn round outline class="btn-send-next" @click.native="modalDetalles=false">CANCELAR</v-btn>
            </v-flex>
          </v-layout>
        </v-card>

        <div class="back-modal-active" @click.stop="createReservation()">_</div>
      </div>
    </v-dialog>


    <v-navigation-drawer
      temporary
      v-model="drawerRight"
      disable-route-watcher
      disable-resize-watcher
      hide-overlay
      stateless
      touchless
      right
      light
      fixed
      class=" pb-3 drawer-admin-border d-flex justify-center" style="padding-top:103px;">
      <div class="text-center font-regular">
        <template v-if="panel_pago==1">
            <h3 class="font-bold">Total:</h3>
            <h2 class="font-bold monto-info mb-2 px-4 ">S./{{costo_total_final}}</h2>

            <p style="" class="px-4 ">Recuerda que recibirás una notificación cuando el picker este en el punto de recojo.</p>

            <metodos-pagos :propAdminPanel="'package'">
            </metodos-pagos>

            <div class="pb-2">
              <v-btn v-if="!cardSelected" round disabled large class="cover btn-active elevation-0">Pagar</v-btn>
              <v-btn v-else round large :disabled="pagarBtnLoading" :loading="pagarBtnLoading" class="cover btn-active elevation-0" @click="generarPedido()">Pagar</v-btn>
            </div>
            <div class="text--red" v-if="errorGenerarPedido!=''" v-html="errorGenerarPedido"></div>
        </template>

        <template v-if="panel_pago==2">
            <h3 class="font-bold" style="margin-top: 20px;">Selecciona tu método de pago</h3>
            <div class="list-opcion">
              <a v-if="tiene_prepago" v-bind:class="{ active: !contraEntregaActive}" @click="contraEntregaActive=false">Prepago</a>
              <a v-if="tiene_contraentrega" v-bind:class="{active:contraEntregaActive}" @click="contraEntregaActive=true;">Contraentrega </a>
            </div>
            <div class="text-center">
                <br><br>
                <p v-if="!usuario_corporativo">Completa los siguientes campos</p>
              <v-layout row wrap align-center v-if="contraEntregaActive">
                <v-flex xs12 sm6 d-flex class="block-center">

                  <multiselect
                    v-model="order_payment_selected"
                    :options="order_payment_options"
                    label="name"
                    :searchable="true"
                    :close-on-select="true"
                    :show-labels="false"
                    class="input--modifier input-nb"
                    placeholder="Selecciona">
                  </multiselect>


                </v-flex>
                <div class="alertaContraentrega" v-if="alertaContraentrega">
                    Debes seleccionar un método de pago

                </div>
                <table class="description-pago-express mb-4"  v-if="cash_change_available">

  <!--
                  vm.importe_servicio_empresa_x = 0;
                  vm.tiene_importe_servicio_empresa_x = true;

                  vm.tiene_total_ya_tiene = true;

                  vm.opcion_sumar_delivery_al_total = 1;

                  vm.total_a_recaudar = true;
                  vm.sumar_delivery = true;
                  vm.total_recaudar_mas_delivery = true;

                  vm.importe_pago = 0;
                  vm.tiene_importe_pago = true; -->


                  <tr>
                    <td class="pd-descripcion-label">Importe Servicio Empresa:&nbsp;s/.</td>
                    <td>
                      <span class="border-b">
                        <input type="text" @blur="decimalizar_importe_servicio_empresa_x" v-model="importe_servicio_empresa_x">

                        <!-- XXXXXXX- - - - - - - client_cost -->
                      </span>
                    </td>
                  </tr>





                  <tr>
                    <td class="pd-descripcion-label">Importe Delivery Scharff:&nbsp;s/.</td>
                    <td>
                      <span class="border-b" v-text="costo_total_final">
                      <!-- <input type="text" v-model="costo_total_final"> -->
                      </span>
                    </td>
                  </tr>

                  <tr>
                    <td class="pd-descripcion-label">Sumar delivery:</td>
                    <td  class="el_1537310325">
                      <v-checkbox class="checkox-space-empty" label="" v-model="opcion_sumar_delivery_al_total" light color="red"></v-checkbox>
                      <!-- XXXXXXX- - - - - - - payment_includes_delivery -->
                    </td>
                  </tr>


                  <tr>
                    <td class="pd-descripcion-label">Total a recaudar:&nbsp;s/.</td>
                    <td>
                        <span class="border-b" v-text="total_a_recaudar">
                          <!-- <input type="text" v-model="total_a_recaudar"> -->
                        </span>
                    </td>
                  </tr>

                  <!-- 1.1 + 1.5 -->
                  <tr v-if="order_payment_selected && order_payment_selected.code == 'efec'">
                    <td class="pd-descripcion-label">Importe de Pago:&nbsp;s/.</td>
                    <td>
                      <span class="border-b">
                        <input type="text"  @blur="decimalizar_importe_pago"  v-model="importe_pago">
                        <!-- XXXXXXX- - - - - - - client_cost -->
                      </span>
                    </td>
                  </tr>


                  <!-- <tr>
                    <td class="descripcion-label">Adicional:</td>
                    <td><span class="border-b"><input type="text"></span></td>
                  </tr> -->







                </table>
                <div class="text--red errorPagarRecaudo" v-if="errorPagarRecaudo!=''" v-html="errorPagarRecaudo"></div>


              </v-layout>
              <v-layout row wrap align-center v-if="!contraEntregaActive">
                <table class="description-pago-express mb-4" style="width:100%">
                    <tr>
                        <td class="pd-descripcion-label">Importe de Pago:&nbsp;s/.</td>
                        <td>
                          <span class="border-b" v-text="costo_total_final">

                            <!-- XXXXXXX- - - - - - - client_pays_with -->
                          </span>

                        </td>
                    </tr>
                  </table>

              </v-layout>
              <!-- <table class="description mb-4" v-if="!usuario_corporativo"> -->


            </div>
            <div class="pb-2">

              <v-btn v-if="!cardSelected || !pagarRecaudoListo" round disabled large class="cover btn-active elevation-0" >Pagar</v-btn>
              <v-btn v-else round large :disabled="pagarBtnLoading" :loading="pagarBtnLoading" class="cover btn-active elevation-0" @click="generarPedido()">Pagar</v-btn>
            </div>
            <div class="text--red" v-if="errorGenerarPedido!=''" v-html="errorGenerarPedido"></div>
        </template>




      </div>
    </v-navigation-drawer>
    <div v-if="drawerRight" class="back-modal-active-admin" style="position:fixed;" @click.stop="drawerRight = false">_</div>


    </v-flex>
  </v-layout>
</template>

<script>
  import Multiselect from 'vue-multiselect'
  import axios from 'axios'
  import metodosPagos from './cMetodosPagos'
  import { EventBus } from '../config/ebus.js'
  import * as apiRutas from '../config/apiRutas';
export default {
  data() {
    return {
      //showP: true,
      //showC: false,
      contraEntregaActive: false,

      tarjeta_numero: '',
      monthCard: '',
      yearCard: '',
      cvvCard: '',

      e1: 1,
      remember: false,
      rememberUsando:false,
      userAddress: '',
      userName: '',
      userPhone: '',
      userEmail: '',
      userComments: '',

      validUserPhone: false,
      validUserEmail: false,
      validClientPhone: false,

      clientAddress: '',
      clientName: '',
      clientPhone: '',
      clientNameCompany: '',
      clientComments: '',
      rememberClient: false,
      rememberClientUsando: false,

      // pedido_distancia:8443
      // pedido_latituddesde:-8.1185989
      // pedido_latitudhasta:-8.0647013
      // pedido_longituddesde:-79.0396937
      // pedido_longitudhasta:-79.0614895


      cupon_descuento: '',
      currentLocation: {lat: 0, lng: 0},
      currentLocationClient: {lat: -12.1157347, lng: -77.01902280000002},
      infoIcon: { url: '/images/icon_info.svg' , alt: 'icon info'},
      // searchAddressInput: ''
      iconMoney: {url: '/images/icon_money.svg', alt: 'icon money' },
      iconTimer: {url: '/images/icon_time_green.svg', alt: 'icon time green' },
      iconTimerOrange: {url: '/images/icon_time_orange.svg', alt: 'icon time orange' },
      iconSend: {url: '/images/icon_mail_qr.svg', alt: 'icon mail qr'},
      iconPay: [
        { url: '/images/visa.png', name: 'visa'},
        { url: '/images/american_express.png', name: 'american_express'},
        { url: '/images/master_card.png', name: 'master_card'},
        { url: '/images/diners_club.png', name: 'diners_club'},
      ],
      dondePagar:'',
      deliveryTime: '',
      deliveryTimeList: [
        {name: 'Express (Scharffer)', value: 10},
        {name: 'Express (Scharffer)', value: 30},
        {name: 'Express (Scharffer)', value: 40}
      ],
      shippingDistance: 10,
      shippingDuration: 20,
      costo_total: 0,
      drawerRight: false,
      modalComplete: false,
      payMethodSelected: '',
      showCardForm:0,
      // cardSelected:0,
      // addedCards:[
      // ],
      modalDetalles:false,

      detailUserAddress:'Estadio Nacional, Calle Jose Diaz, Cercado de Lima, Peru <br/> Numero - 123456789',
      detailClientAddress:'Estadio Nacional, Calle Jose Diaz, Cercado de Lima, Peru <br/> Numero - 123456789 ',
      detailAmountPayable:'8',


      errorAddCard:'',
      addCardResult:{result:'',message:''},
      addCardBtnLoading:false,
      scharffer_found:false,

      tiempoEstimado:'60 - 120min',
      unMinuto:'2:00',
      place: null,
      placeb: null,
      userEmailAccount:'',




      pagarBtnLoading:false,
      pikerdisponible:false,

      calculandoDetalles:false,

      interior_recojo:'',
      observaciones_origen:'',
      interior_envio:'',

      mapicon_a:'http://maps.google.com/mapfiles/markerA.png',
      mapicon_b:'http://maps.google.com/mapfiles/markerB.png',
      modalOtraOportunidad:false,
      path:[],
//[{"lat":-8.109063400000002,"lng":-79.0215054},{"lat":-8.1065694,"lng":-79.02296679999999},{"lat":-8.1061622,"lng":-79.02228699999999},{"lat":-8.1032987,"lng":-79.02376389999999},{"lat":-8.0867129,"lng":-79.0407066},{"lat":-8.0718623,"lng":-79.0492294},{"lat":-8.059904099999999,"lng":-79.0531262},{"lat":-8.0611423,"lng":-79.0570197},{"lat":-8.0596968,"lng":-79.0575035},{"lat":-8.059225999999999,"lng":-79.0576439}],
      fab_a:null,
      theFavA:'',
      theFavB:'',
      openFavA:false,
      openFavB:false,
      //bobounds:{north: -8.109063400000002, east: -79.0215054, south: -8.059225999999999, west: -79.0576439},
      //currentLocationClient: {lat: -8.059225999999999, lng: -79.0576439},
      fakemarks:null,
      mapinfo_a:false,
      mapinfo_b:false,


      pedido_id:0,

      usuario_corporativo:false,
      elinterval:null,
      contactoEmail:'',
      pedido_cancelado_success:'',
      cancelarEnvioLoading:false,
      cancelarEnvioDisabled:false,
      eliminarTarjetaLoading:false,
      predeterminarApiLoading:false,
      expiry_origen:'',
      noticeCalcularDistanciaB:'',
      noticeCalcularDistanciaC:'',
      errorGenerarPedido:'',
      notificarAlPickerLoading:false,

      notificarAlPickerNotice:'',


      inputs_dinamicos:'',
      inputs_dinamicos_ar:null,
      pedido_codigo:null,
      inputsDinamicosCargados:false,
      inputs_dinamicos_validos:false,

      contador_definitivo_interval:0,
      selectPay: '',
      itemsPay: [
          { field_name: 'Efectivo', id: '1' },
          { field_name: 'Asd', id: '2' }
      ],
      //pedido_id:1102
      selectPackage: '',
      //itemsPackage: []
      itemsPackage: [
          { field_name: 'Pequeno', id: '1' },
          { field_name: 'Mediano', id: '2' },
          { field_name: 'Grande', id: '3' }
      ],
      order_capacity_elegido:'',
      order_capacities: [],
      order_payment_options: [],
      tiene_prepago:false,
      tiene_contraentrega:false,
      order_payment_selected:'',

      procedeContraentrega:true,
      alertaContraentrega:false,
      prepago_code:true,
      panel_pago:1, //1: muestra el panel de pago lateral (el default), 2: muestra el panel de acuerdo al servicio pickapp

      autolocationSiVa:true,





      dataPromociones:null,
      tiene_cupon:false,
      promocion_id:-1,
      soloPromocion:false,
      promocion_promo_label:'',
      descuento:0,
      total_pagado_final:0,






      timeoutLlenandoCupon:false,
      datarescupon:null,
      promo_cuantos_usos_van:null,
      cupon_id:null,
      se_aplico_cupon:false,
      cupon_mensaje:'',





      cash_change_available:false,
      importe_servicio_empresa_x: '',
      //tiene_importe_servicio_empresa_x: true,
      //tiene_total_ya_tiene: true,
      opcion_sumar_delivery_al_total: true,
      total_a_recaudar: 0,
      //sumar_delivery: true,
      total_recaudar_mas_delivery: false,
      importe_pago: '',
      //tiene_importe_pago: true


      multiple_orders:false,
      prueba_decimal:0,
      descuento_cupon: 0,
      promocion_cupon_label :'',
      promocion_cupon_id :-1,
      checkboxFactura: false,

      facturacion_ruc:'',
      facturacion_razonsocial:'',
      facturacion_notice:'',
      facturacion_ruc_aux:'',
      facturacion_razonsocial_aux:'',


      promocion_minimo:0,
      promocion_cupon_minimo:0,


      error:{
        userName:'',
        clientName:'',
      }

    }
  },
  mounted() {
    //this.runMinuto();
    //setTimeout(()=>{
        this.geolocateLocal();
    //},6000)

    //this.listarTarjetas();
    //console.log('this.bar');
    //console.log(this.bar);




    var vm = this;




    window.$ = window.jQuery = require('jquery');
    $('.autocompleteInput-w').on('keyup','input',function(){
      vm.userAddress = $('#autocompleteInput').val();
    });
    $('#autocompleteInput').on('blur',function(){
      //console.log($('#autocompleteInput').val());
      if($('#autocompleteInput').val()!=''){
        setTimeout(()=>{
          vm.searchLocation('user', $('#autocompleteInput').val());
        },1000);
      }
    });
    $('#autocompleteInput').keyup(function(e){
      if(e.keyCode == 13){
          if($('#autocompleteInput').val()!=''){
            setTimeout(()=>{
              vm.searchLocation('user', $('#autocompleteInput').val());
            },1000)
          }
      }
    });

    $('.autocompleteInputb-w').on('keyup','input',function(){
      vm.clientAddress = $('#autocompleteInputb').val();
    });

    $('#autocompleteInputb').on('blur',function(){

      if($('#autocompleteInputb').val()!=''){
        setTimeout(()=>{
          vm.searchLocation('client', $('#autocompleteInputb').val());
        },1000)
      }

    });

    $('#autocompleteInputb').keyup(function(e){
      if(e.keyCode == 13){
          if($('#autocompleteInputb').val()!=''){
            setTimeout(()=>{
              vm.searchLocation('client', $('#autocompleteInputb').val());
            },1000)
          }
      }
    });

    var pro = localStorage.getItem("user_p_info");
    pro = JSON.parse(pro);
    vm.userEmailAccount = pro.usuario_email;




    //EventBus.$on('payload', function(payload){
      // vm.pikerdisponible = true;
      // vm.e1 = 3;
      // console.log("payload");
      // console.log(payload.data);
    //});
    console.log("AA");
    // EventBus.$off('tokenizar_tarjeta');
    // EventBus.$on('tokenizar_tarjeta', this.tokenizar_tarjeta_cont);



    var p_token = localStorage.getItem("p_token");
    var pro = localStorage.getItem("user_p_info");
    pro = JSON.parse(pro);
    var token = pro.token;

    axios({
      url:apiRutas.pickapp_favoritos_origen,
      method:'get',
      params: {
        token:token
      },
      auth : {
        username: 'admin@pickapp.com',
        password: 'PickJanaq18',
      }
    })
    .then(function(response){
      let res = response.data;
      //fab_a
      if(res.data.length>0){
        vm.fab_a = res.data;
      }

    }).catch(function (error) {
      console.log(error);
    });



    if(pro.usuario_escorporativo){
      vm.usuario_corporativo = true;
      vm.procedeContraentrega = false;
    }



    //
    // EventBus.$off('sincronizar_tarjetas_r');
    // EventBus.$on('sincronizar_tarjetas_r', this.sincronizar_tarjetas_r);


     vm.apisCompany();

     var pro = this.getLocalUser();

     this.facturacion_ruc = pro.usuario_ruc?pro.usuario_ruc:'';
     this.facturacion_razonsocial = pro.usuario_razonsocial?pro.usuario_razonsocial:'';
     this.facturacion_ruc_aux = pro.usuario_ruc?pro.usuario_ruc:'';
     this.facturacion_razonsocial_aux = pro.usuario_razonsocial?pro.usuario_razonsocial:'';


     //
     // setTimeout(()=>{
     //   this.nuevoPedido();
     // },5000)

  },
  watch: {
    userName:function(el){
      if(el==''){
        this.error.userName = '';
      }else{
        if(el.trim().indexOf(' ') != -1){
          this.error.userName=''
        }else{
          this.error.userName = 'Ingresa al menos un nombre y un apellido';
        }
      }
    },
    clientName:function(el){
      if(el==''){
        this.error.clientName = '';
      }else{
        if(el.trim().indexOf(' ') != -1){
          this.error.clientName=''
        }else{

          this.error.clientName = 'Ingresa al menos un nombre y un apellido';
        }
      }
    },
    facturacion_ruc:function(el){
      if(el.length==0||el.length==11){
        this.facturacion_notice = '';
      }
    },
    facturacion_razonsocial:function(el){
      if(el){
        this.facturacion_notice = '';
      }
    },
    importe_servicio_empresa_x:function(el){
      if(el){
        console.log(el.replace(/[^\d.]/g, ''));
        this.importe_servicio_empresa_x = el.replace(/[^\d.]/g, '');
      }
    },
    importe_pago:function(el){
      if(el){
        console.log(el.replace(/[^\d.]/g, ''));
        this.importe_pago = el.replace(/[^\d.]/g, '');
      }
    },
    importe_mas_delivery:function(el){
      this.total_a_recaudar = el;
    },
    expiry_origen: function (el) {
      let a = el.replace(/\s+/g, '');
      if(a.indexOf('/') !== -1){
        var a_ar = a.split("/");
        this.monthCard = a_ar[0];
        if((''+a_ar[1]).length<=2){
          this.yearCard = '20'+a_ar[1];
        }else{
          this.yearCard = a_ar[1];
        }


      }else{
        this.monthCard = '';
        this.yearCard = '';
      }
    },
    deliveryTime: function(el) {
      this.costo_total = el.value
    },
    userAddress: function(el) {
      if(el.length > 10) {
        this.searchLocation()
      }
    },
    userPhone: function(el) {
      if(el.length > 5) {
        //console.log(el.length)
        this.validUserPhone = true
      } else {
        this.validUserPhone = false
      }
    },
    clientPhone: function(el) {
      if(el.length > 5) {
        //console.log(el.length)
        this.validClientPhone = true
      } else {
        this.validClientPhone = false
      }
    },
    userEmail: function() {
      let valid = this.errors.has('userEmail')
      if(!valid) {
        this.validUserEmail = true
      } else {
        this.validUserEmail = false
      }
    },
    getStoredfLatLng:function(el){

      if(el.lat!=0){
        console.log("se ejecutó");
        console.log("se ejecutó");
        console.log("se ejecutó");
        console.log("se ejecutó");
        console.log("se ejecutó");
        console.log("se ejecutó");
        console.log("se ejecutó");
        this.geolocateLocal();
      }
    },



    order_payment_selected:function(el){
      this.alertaContraentrega = false;
    },
    contraEntregaActive:function(el){
      this.alertaContraentrega = false;
    },




  },
  methods: {
    abrirPanelPagar:function(){
      if(this.checkboxFactura && (this.facturacion_ruc.length!=11 || this.facturacion_razonsocial=='')){
        if(this.facturacion_ruc.length!=11&& this.facturacion_razonsocial!=''){
          this.facturacion_notice = "Ingresa un RUC válido";
        }else{
          this.facturacion_notice = "Ingresa tus detalles de facturación";
        }
        return false;
      }
      this.drawerRight = true
    },
    nuevoPedido:function(){
      if(window.location.hash){
        let n_envio = window.location.hash.substring(1);
        n_envio = parseInt(n_envio)+1;
        window.location.hash = n_envio;
      }else{
        window.location.hash = '1';
      }

    },
    decimalizar_importe_servicio_empresa_x:function(){
      if(this.importe_servicio_empresa_x===""){
        return false;
      }
      if(this.importe_servicio_empresa_x.indexOf('.') !== -1){
        var z = this.importe_servicio_empresa_x;
        var a = this.importe_servicio_empresa_x.split(".");

        var v = a[1];
        if(v==""){
          z = a[0]+'.00';
        }else if(v.length==1){
          z = a[0]+'.'+a[1]+'0';
        }else if(v.length==2){
          z = a[0]+'.'+a[1];
        }else if(v.length>2){
          z = a[0]+'.'+a[1]+'0';
          z = a[0]+'.'+a[1].substr(0, 2);
        }
        z = z<0?-z:z;
        this.importe_servicio_empresa_x =  z;

      }else{
        var num = parseFloat(this.importe_servicio_empresa_x);
        var z = num.toFixed(2);
        z = z<0?-z:z;
        this.importe_servicio_empresa_x = z;
      }
    },
    decimalizar_importe_pago:function(){
      if(this.importe_pago===""){
        return false;
      }
      if(this.importe_pago.indexOf('.') !== -1){
        var z = this.importe_pago;
        var a = this.importe_pago.split(".");

        var v = a[1];
        if(v==""){
          z = a[0]+'.00';
        }else if(v.length==1){
          z = a[0]+'.'+a[1]+'0';
        }else if(v.length==2){
          z = a[0]+'.'+a[1];
        }else if(v.length>2){
          z = a[0]+'.'+a[1]+'0';
          z = a[0]+'.'+a[1].substr(0, 2);
        }
        z = z<0?-z:z;
        this.importe_pago =  z;

      }else{
        var num = parseFloat(this.importe_pago);
        var z = num.toFixed(2);
        z = z<0?-z:z;
        this.importe_pago = z;
      }
    },

    aplicarCupon:function(){

      this.consultarCuponExpress(()=>{
        this.actualizarDelCupon();
      });

    },
    actualizarDelCupon:function(){
      this.e1 = 3;
      if(this.datarescupon=='no-cupon'){
        this.cupon_mensaje = 'Cupón incorrecto';
        setTimeout(()=>{
          this.cupon_mensaje = '';
        },3000);
      }else if(this.datarescupon=='limite-alcanzado'){
        this.descuento_cupon = 0;
        this.promocion_cupon_label = '';
        this.cupon_id = this.datarescupon.cupon_id;
        this.promocion_cupon_id = -1;
        this.cupon_mensaje = 'Ya usaste este cupón';
        setTimeout(()=>{
          this.cupon_mensaje = '';
        },3000);
      }else if(this.datarescupon){
        var descuento_aux = 0;
        if(this.datarescupon.promocion_descuento_tipo =='porcentaje'){
          descuento_aux = this.costo_total*(this.datarescupon.promocion_descuento/100);
        }else if(this.datarescupon.promocion_descuento_tipo =='flat'){
          descuento_aux = this.datarescupon.promocion_descuento;
        }

        // if(descuento_aux<=this.costo_total){


        if(this.datarescupon.promocion_minimo){
          this.promocion_cupon_minimo = this.datarescupon.promocion_minimo;
        }
        if(this.promocion_cupon_minimo>this.costo_total){
          this.promocion_cupon_minimo=this.costo_total
        }
        if(this.costo_total-descuento_aux<this.promocion_cupon_minimo){
          descuento_aux = this.costo_total - this.promocion_cupon_minimo;
        }


        this.descuento_cupon = this.formatoCosto(descuento_aux);

        //this.promocion_descuento = promo_item.promocion_descuento;
        //this.tipo_descuento = promo_item.promocion_descuento_tipo;

        this.promocion_cupon_label = this.datarescupon.promocion_nombre;
        this.cupon_id = this.datarescupon.cupon_id;
        this.promocion_cupon_id = this.datarescupon.promocion_id;
        //alert("a llegado");

        console.log(this.total_pagado_final)
        console.log('this.total_pagado_final')
        this.se_aplico_cupon = true;

      }
    },
    resetearCupon:function(){
      this.se_aplico_cupon = false;
      this.cupon_descuento='';
      this.promocion_cupon_id = -1;
      // alert(this.total_pagado_final);
      //this.costo_total = parseFloat(this.costo_total) + parseFloat(this.descuento);
      // alert(this.total_pagado_final);
      // alert(this.descuento);
      this.descuento_cupon = 0;

    },
    activarPrepago: function (){
      console.log("hola");
      var vm = this;
      /*if(vm.showP == false) {
        vm.showP= true;
        vm.showC= false;
        console.log(vm.showP);
      }
      if(vm.showC == false) {
        vm.showC= true;
        vm.showP= false;
      }
      console.log(vm.showP);*/
      if(vm.contraEntregaActive) {
        vm.contraEntregaActive=false;
      }
    },
    apisCompany:function(){
      var p_token = localStorage.getItem("p_token");
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      var empresa_id = pro.empresa_id;


      if(this.usuario_corporativo){
        var servicio_pickapp2_extrafiels = apiRutas.pickapp2_company+'/'+empresa_id+'/settings?token='+token;
      }else{
        var servicio_pickapp2_extrafiels = apiRutas.pickapp2_company+'/default/settings?token='+token;
        //var servicio_pickapp2_extrafiels = apiRutas.pickapp2_company+'/'+empresa_id+'/settings?token='+token;
      }
      if(this.usuario_corporativo&&empresa_id == 0){
        return false;
      }

      var vm = this;
      axios({
        url:servicio_pickapp2_extrafiels,
        method:'get',
      })
      .then(function(response){
        let res = response.data;

          vm.order_contact_optional_bool = res.order_contact_optional_bool;
          if(res.order_additional_fields.length>0){
            vm.addAdicionalFields(res.order_additional_fields);
            vm.inputs_dinamicos_ar = res.order_additional_fields;
          }

          if(res.cash_change_available){
            vm.cash_change_available = true;
          }

          if(res.multiple_orders){
            vm.multiple_orders = res.multiple_orders;
          }




          if(res.order_capacities.length>0){
            //asd
            console.log("hola");
            console.log(vm.order_capacities.constructor);
            vm.order_capacities = res.order_capacities;
            if(vm.order_capacities.constructor === Array){
              console.log("holamas");
              vm.order_capacities.map(x => {
                x.name=x.field_name + ' ('+x.description+')';
                if(x.field_name=='pequeno'){
                  x.name = 'pequeño' + ' ('+x.description+')';
                }
                if(x.field_name==x.description){
                  x.name = x.field_name;
                }

                return x;
              });

              console.log(vm.order_capacities);
              if(vm.order_capacities.length==1){
                vm.order_capacity_elegido = vm.order_capacities[0];
              }
            }



          }
            //vm.itemsPackage = res.order_capacities;
          if(res.order_payment_options.length>0){
            vm.order_payment_options = res.order_payment_options;
            console.log('order_payment_options');
            console.log(vm.order_payment_options);
            vm.order_payment_options =  vm.order_payment_options.map(x => {
              if(x.code == 'prepagado'){
                vm.tiene_prepago = true;
                vm.prepago_code = x.code;
                return null;
              }else{
                vm.tiene_contraentrega = true;
                x.name=x.field_name;
                if(x.name=='pos visa'){
                  x.name = 'visa';
                }else if(x.name=='pos mastercard'){
                  x.name = 'mastercard';
                }
                return x;
              }
            }).filter(x => {
                return x != null;
            });
            if(vm.tiene_prepago||vm.tiene_contraentrega){
              vm.panel_pago = 2;//el panel segun el servicio (con prepago y/o contraentrega)
            }
            if(!vm.tiene_prepago&&vm.tiene_contraentrega){
              vm.contraEntregaActive = true;
            }

          }



          //PARAPRUEBAS
          // vm.panel_pago = 2;
          // vm.tiene_prepago = true;
          // vm.tiene_contraentrega = true;
          // vm.cash_change_available = true;

          //
          //
          //
          // vm.importe_servicio_empresa_x = '';
          // vm.tiene_importe_servicio_empresa_x = true;
          //
          // vm.tiene_total_ya_tiene = true;
          //
          // vm.opcion_sumar_delivery_al_total = 1;
          //
          // vm.sumar_delivery = true;
          // vm.total_recaudar_mas_delivery = true;
          //
          // vm.importe_pago = '';
          // vm.tiene_importe_pago = true;
          // vm.multiple_orders = true;
          //END-PARAPRUEBAS
//
// 2.1.Importe Servicio Empresa X: Importe del Servicio Ejemplo: S/ 100.00
// 2.2 Importe Delivery Scharff: Importe que ya se muestra Ejemplo: S/15 (calculo segun tarifa scharff por kilometraje)
// 2.3 Una Opcion que indique que se suma el Delivery al Importe Total.
// 2.4.-Campo Total a Recaudar
// 2.5.-En caso se elija la opcion sumar Delivery, En el Total Recaudado deberá aparecer la suma de 1.1 + 1.5
// 2.6.-Importe de Pago es decir  cuánto cancela del Cliente, este importe debe habilitarse siempre que sea efectivo
//













        //fab_a

      }).catch(function (error) {
      });

      //----------
      // var encendedor = true;
      //
      //
      // var lapromesa = new Promise(
      //   function (resolve, reject){
      //     if(encendedor){
      //       resolve("Si");
      //     }else{
      //       reject("No");
      //     }
      //   }
      // );
      //
      // console.log('lapromesa');
      // console.log(lapromesa);






    },
    addAdicionalFields:function(fields){
      var inputstring='';
      var vm = this;
      fields.forEach(function(el){
        if(el.field_type==1){
          inputstring += '<input class="'+el.field_type+'" type="text" id="adicional_'+ el.id +'" placeholder="'+ el.field_name +'"/>';
        }else if(el.field_type==2){
          inputstring += '<input class="'+el.field_type+'" type="number" id="adicional_'+ el.id +'" placeholder="'+ el.field_name +'"/>';
        }else if(el.field_type==3){
          if(el.values.length>0){
            var opciones = '<option value="" disabled selected>'+el.field_name+'</option>';

            for(var key in el.values){

                opciones += '<option value="'+el.values[key]+'">'+el.values[key]+'</option>';
                // The value is obj[key]
            }
            //console.log('<select name="" id="">');
            //console.log(opciones);
            //console.log('</select>');

            inputstring += '<div class="gselect-w"><i class="material-icons icon">keyboard_arrow_down</i><select name="adicional_'+ el.id +'" id="adicional_'+ el.id +'" class="generated-select">'+opciones+'</select></div>';
          }
        }

      });

      this.inputs_dinamicos = '<strong class="el_1531782097">Datos adicionales</strong>'+inputstring;

      var vm = this;
      this.$nextTick(function() {
          vm.biddingInputsDinamicos();
          vm.inputsDinamicosCargados = true;
      });
    },
    biddingInputsDinamicos:function(){
      var vm = this;
      console.log('biddingInputsDinamicos');
      vm.inputs_dinamicos_ar.forEach(function(el){
        console.log('#adicional_'+el.id);
        $('#adicional_'+el.id).on('input',function(){
            vm.validarInputsDinamicos();
        });

      });






    },
    validarInputsDinamicos:function(){
      console.log("llegan");
      var vm = this;
      var auxVal = '';
      var pasa = true;
      var elselector = '';
      vm.inputs_dinamicos_ar.forEach(function(el){
        elselector = '#adicional_'+el.id
        console.log(elselector);
        auxVal = $(elselector).val();
        if(!auxVal){
          $(elselector).removeClass('ginput-valido');
          pasa = false;
        }else{
          $(elselector).addClass('ginput-valido');
        }

      });
      vm.inputs_dinamicos_validos = pasa;
    },
    getLocationDragged:function(e){
      this.currentLocation.lat = e.latLng.lat();
      this.currentLocation.lng = e.latLng.lng();
      this.searchAddress('drag_origen');
    },
    getLocationDraggedClient:function(e){
      this.currentLocationClient.lat = e.latLng.lat();
      this.currentLocationClient.lng = e.latLng.lng();
      this.searchAddress('drag_destino');
    },
    cancelarEnvio:function(){
      this.cancelarEnvioLoading = true;
      this.cancelarEnvioDisabled = true;
      var vm = this;

      var p_token = localStorage.getItem("p_token");
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;


      var servicio_cancelar_pedido = apiRutas.pickapp_eliminarPedido+'/'+this.pedido_id;

      axios({
        url:servicio_cancelar_pedido,
        method:'get',
        params: {
          token:token
        }
      })
      .then(function(response){
        let res = response.data;
        //fab_a
        if(res.tipo==1){
          //console.log("AAAAA");
          vm.pedido_cancelado_success = 'El pedido ha sido cancelado';
          clearInterval(vm.elinterval);
        }else{
          //console.log("CCCCC");
          vm.pedido_cancelado_success = 'No se pudo cancelar el pedido';
          vm.cancelarEnvioDisabled = false;
        }
        vm.cancelarEnvioLoading = false;

        setTimeout(function(){

          vm.modalOtraOportunidad=false;
          if($('.vue-map-container').length){
              vm.$router.push({ name: 'historial', params: { panel: 'express', panel_id: ''}});
          }
        },4000);
      }).catch(function (error) {
        vm.pedido_cancelado_success = 'No se pudo cancelar el pedido';
        setTimeout(function(){
          vm.modalOtraOportunidad=false;
          if($('.vue-map-container').length){
              vm.$router.push({ name: 'historial', params: { panel: 'express', panel_id: ''}});
          }
        },4000);
        vm.cancelarEnvioLoading = false;
        vm.cancelarEnvioDisabled = false;
        clearInterval(vm.elinterval);
      });

    },
    handleFavA:function(idx){
      //console.log(this.theFavA)
      var favMaterialA = this.fab_a[idx];
      var vm = this;
      vm.userAddress = favMaterialA.favoritoorigen_distrito+' '+favMaterialA.favoritoorigen_calle;
      $('#autocompleteInput').val(vm.userAddress);
      //favMaterialA.favoritoorigen_distritoid
      vm.userName = favMaterialA.favoritoorigen_emisor;
      var pointAux = {lat:parseFloat(favMaterialA.favoritoorigen_latitud),lng:parseFloat(favMaterialA.favoritoorigen_longitud)}

      //favMaterialA.favoritoorigen_numerocalle
      //favMaterialA.favoritoorigen_referencia

      vm.interior_recojo = favMaterialA.favoritoorigen_numerocalle;
      vm.currentLocation = pointAux;
      vm.openFavA = false;
      vm.rememberUsando = true;


    },
    handleFavB:function(idx){
      var favMaterialA = this.fab_a[idx];
      var vm = this;
      vm.clientAddress = favMaterialA.favoritoorigen_distrito+' '+favMaterialA.favoritoorigen_calle;
      $('#autocompleteInputb').val(vm.clientAddress);
      //favMaterialA.favoritoorigen_distritoid
      vm.clientName = favMaterialA.favoritoorigen_emisor;
      var pointAux = {lat:parseFloat(favMaterialA.favoritoorigen_latitud),lng:parseFloat(favMaterialA.favoritoorigen_longitud)}

      //favMaterialA.favoritoorigen_numerocalle
      //favMaterialA.favoritoorigen_referencia
      vm.interior_envio  = favMaterialA.favoritoorigen_numerocalle;
      vm.currentLocationClient = pointAux;
      vm.openFavB = false;
      vm.rememberClientUsando = true;
    },
    escapeSelector:function (selector) {
      selector = encodeURI(selector);
      selector = selector.replace(/[^a-zA-Z]/g, "");
        return "".replace.call(selector,
                /(^[^_a-zA-Z\u00a0-\uffff]|[^-_a-zA-Z0-9\u00a0-\uffff])/g,
                "\\$1");
    },
    preIrAlPaso2: function() {
      //antes de pasar al paso 2

      var pasa = true;
      var vm = this;
      console.log("this.inputsDinamicosCargados");
      console.log(this.inputsDinamicosCargados);

      if(vm.order_contact_optional_bool&&this.inputsDinamicosCargados&&this.inputs_dinamicos_ar){
        if(vm.inputs_dinamicos_validos){
          pasa = true;
        }else{
          pasa = false;
        };





      }else{
        let checkUserName = this.userName.trim().indexOf(' ') != -1;
        pasa = this.userAddress != '' &&
            this.userName != '' &&
            this.validUserPhone && checkUserName;

      }






      if( pasa ) {
        return true
      } else {
        return false
      }
    },
    isValidWhereWeDeliver: function() {
      let checkUserName = this.clientName.trim().indexOf(' ') != -1;
      if( this.clientAddress != '' &&
          this.clientName != '' &&
          this.validClientPhone && checkUserName) {
            return true
          } else {
            return false
          }
    },
    payService: function() {
      //this.$router.push({name: 'historial', params: { panel: 'express',item_id: this.pedido_id}})
      this.$router.push({name: 'historial', params: { panel: 'express',item_id: this.pedido_codigo}})
      //
      // this.drawerRight = false
      // this.modalComplete = true
    },
    createReservation: function() {
      this.modalComplete = false
      // this.el = 1
      this.$emit('createReservation', false)

    },
    geolocateLocal: function () {
      var vm = this;

      var jalaposicion = vm.$store.getters.loadStatefLatLng;
      console.log(jalaposicion);
      // if(!vm.autolocationSiVa){
      //   return false;
      // }
      if(jalaposicion.lat!=0){
        console.log('aplicando local');
        this.currentLocation = jalaposicion;
        this.searchAddress();
      } else {
        //console.log('no')
        this.currentLocation = {lat: -12.111062, lng: -77.0315913};
      }
      //console.log('aqui!')
    },
    cargaBounds:function(){
      var vm = this;
      console.log("CARGA BOUNDS");

      let x = [];
      this.path.forEach(function(item) {
        x.push({position: {lat:item.lat, lng:item.lng}, data: item});
        console.log(item.lat);
        console.log(typeof(item.lng));
        console.log("aaaaaaa");
      });
      vm.fakemarks = x;
      vm.$refs.example.$mapCreated.then((map) => {
        const bounds = new google.maps.LatLngBounds();
        for (let m of vm.fakemarks) {
          bounds.extend(m.position)
        }
        map.fitBounds(bounds);
      });
    },
    searchLocation: function(value, dir) {
      console.log("searching");
      let geocoder = new google.maps.Geocoder()
      geocoder.geocode({'address': dir,
          componentRestrictions: {
          country: 'pe'
        }}, (results, status) => {
        if (status === 'OK') {
          switch(value){
            case 'user':
              this.currentLocation.lat = results[0].geometry.location.lat()
              this.currentLocation.lng = results[0].geometry.location.lng()
              break
            case 'client':
              this.currentLocationClient.lat = results[0].geometry.location.lat();
              this.currentLocationClient.lng = results[0].geometry.location.lng();
          }

        }
      })

    },searchAddress: function(src_event) {
      console.log("searching address");
      let geocoder = new google.maps.Geocoder();
      let latlng = '';
      if(src_event=='drag_destino'){
        latlng = this.currentLocationClient;
      }else{
        latlng = this.currentLocation;
      }



      var vm = this;
      geocoder.geocode({
        'latLng': latlng
      }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            console.log(results[0].formatted_address);

            if(vm.userAddress==''||src_event=='drag_origen'){
              vm.userAddress = results[0].formatted_address;
              document.getElementById("autocompleteInput").value = results[0].formatted_address;
            }
            if(src_event=='drag_destino'){
              vm.clientAddress = results[0].formatted_address;
              document.getElementById("autocompleteInputb").value = results[0].formatted_address;
            }

          } else {
            //alert('No results found');
          }
        } else {
          //alert('Geocoder failed due to: ' + status);
        }
      });



    },

    calcularDistanciaB:function(){
      this.noticeCalcularDistanciaB = '';
      var vm = this;
      vm.calculandoDetalles = true;

      try {
      var directionsService = new google.maps.DirectionsService;
      directionsService.route({
        origin:vm.currentLocation.lat+','+vm.currentLocation.lng,
        destination:vm.currentLocationClient.lat+','+vm.currentLocationClient.lng,
        travelMode: 'DRIVING',
        provideRouteAlternatives:true
       }, function(response, status) {
           if (status === 'OK') {


               console.log(response);
               let res = response;
              let rutas = res.routes;
              let elmenor = res.routes[0].legs[0].distance.value;
              let elmenorIX = 0;

              rutas.forEach((ruta,index)=>{
                if(ruta.legs[0].distance.value < elmenor ){
                  elmenor = ruta.legs[0].distance.value;
                  elmenorIX = index;
                }
              })
              console.log(elmenorIX);
               vm.shippingDistance =res.routes[elmenorIX].legs[0].distance.value;

                  console.log('start_location');
                 res.routes[0].legs[0].steps.forEach(function(step){
                   let lati=step.start_location.lat();
                   let lngi=step.start_location.lng();
                   let a = {lat:lati,lng:lngi};
                   vm.path.push(a);
                 })
                 vm.path.push(vm.currentLocationClient);


                 //vm.e1 = 3;
                 //vm.tiempoEstimado =res.routes[0].legs[0].duration.text;

                 vm.calcularPrecio();

           } else {
             vm.noticeCalcularDistanciaB = 'No se pudo calcular la distancia, Inténtalo nuevamente.'
               vm.calculandoDetalles=false;
           }
       });

} catch (e) {
    vm.noticeCalcularDistanciaB = 'No se pudo calcular la distancia, Inténtalo nuevamente.'
    vm.calculandoDetalles=false;
}

    },

    calcularPrecio:function(){
      this.noticeCalcularDistanciaC = '';
      if(this.usuario_corporativo&&this.panel_pago==1){
        console.log("PEDIDO DIRECTO");
        this.generarPedido();
        return false;
      }


      var vm = this;
      var servicio_precio = apiRutas.pickapp_getTarifa+'/'+this.shippingDistance;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;

      axios.get(servicio_precio, {
        params: {
          token:token
          //capacity_code:selectPackage.state
        }
      })
      .then(function(response){
        let res = response.data;

        if(res.tipo == 1){
          vm.costo_total = res.data;
          vm.verificarPromocion();

        }

        vm.calculandoDetalles = false;
        vm.noticeCalcularDistanciaB = '';
      }).catch(function (error) {
        vm.calculandoDetalles = false;
        vm.noticeCalcularDistanciaB = 'Un error ha ocurrido';
        console.log(error);
      });



    },
    verificarPromocion:function(){





      var sihubocalculodepromo = false;
      var dataPromociones = this.$store.getters.loadStatePromociones;
      //var cuanto = dataPromociones.promo_cuantos_usos_van['scharff-stop'];

      if(dataPromociones&&dataPromociones.hay_promo==1){
        var arrayPromos = dataPromociones.promo_servicios['scharff-express'];

        if(arrayPromos && arrayPromos.length>0){

               //se va elegir el que tenga mayor prioridad
               var promo_item = null;
               var hay_cupon = false;

               arrayPromos = arrayPromos.sort(function compare(a,b) {
                 if (a.promocion_prioridad < b.promocion_prioridad)
                 return -1;
                 if (a.promocion_prioridad > b.promocion_prioridad)
                 return 1;
                 return 0;
               });

               sihubocalculodepromo = true;

               this.consultarCuponExpress(() => {

                 var descuento_aux = 0;
                 var aux_ar_promos_total = [];
                 this.promo_cuantos_usos_van.forEach((el)=>{
                    aux_ar_promos_total[el.promocion_id] = el.total;
                 });
                 //alert("que pasab");
                 for (let el of arrayPromos) {
                   let total_promos_user = aux_ar_promos_total[el.promocion_id];
                   if(total_promos_user==null){
                     total_promos_user=0;
                   }
                   console.log("fuera");
                   console.log(total_promos_user);
                   console.log(el.promocion_transacciones);
                   console.log(el.promocion_id);
                   console.log(el.tiene_cupon);
                   if(el.tiene_cupon!=1){
                     if(total_promos_user<el.promocion_transacciones||el.promocion_transacciones==null){
                       console.log("paso");
                       console.log(el.promocion_transacciones);
                       console.log(el.promocion_id);
                       console.log(el.tiene_cupon);
                       console.log(el);

                       promo_item = el;
                       break;
                     }
                   }else{
                     hay_cupon = true;
                   }
                 }


                 if(promo_item!=null){

                     console.log(promo_item.promocion_id);
                     console.log("PromoTRANSACCIONES: "+promo_item.promocion_transacciones);


                     var promo_cuantos_usos_van_val = aux_ar_promos_total[promo_item.promocion_id];



                     console.log("PromoUSOS: "+promo_cuantos_usos_van_val);
                     console.log("PromoUSOSESTEPROMO: "+promo_item.promocion_id);



                     this.promocion_id = promo_item.promocion_id;







                     if(promo_item.promocion_descuento_tipo =='porcentaje'){
                       descuento_aux = this.costo_total*(promo_item.promocion_descuento/100);
                       //alert(descuento_aux);
                     }else if(promo_item.promocion_descuento_tipo =='flat'){
                       descuento_aux = promo_item.promocion_descuento;
                     }
                     if(promo_item.promocion_transacciones!=null){
                       if(promo_cuantos_usos_van_val>=promo_item.promocion_transacciones){

                         this.promocion_id = -1;
                         this.descuento = 0;
                         descuento_aux = 0;
                       }
                     }



                     this.promocion_id = promo_item.promocion_id;

                     console.log('promo_item');
                     console.log(promo_item);
                     console.log(this.costo_total);
                     console.log(this.descuento);
                     console.log(descuento_aux);
                     if(descuento_aux!=0){


                       this.promocion_promo_label = "Promoción: "+promo_item.promocion_nombre;


                       if(promo_item.promocion_minimo){
                         this.promocion_minimo = promo_item.promocion_minimo;
                       }
                       if(this.promocion_minimo>this.costo_total){
                         this.promocion_minimo=this.costo_total;
                       }
                       if(this.costo_total-descuento_aux<this.promocion_minimo){
                         descuento_aux = this.costo_total - this.promocion_minimo;
                       }




                       this.descuento = this.formatoCosto(descuento_aux);
                       //this.costo_total = this.formatoCosto(this.costo_total-this.descuento);
                       this.promocion_promo_label = "Promoción("+promo_item.promocion_nombre+")";
                     }else{
                       this.descuento = 0;
                       this.promocion_promo_label = "Promoción(error)";
                     }
                 }
                 // if(!hay_cupon){
                 //   this.tiene_cupon = false;
                 // }else{
                 //   //alert("y este");
                 //   //alert(this.cupon_descuento);
                 //   this.tiene_cupon = true;
                 //   if(this.cupon_descuento!=''){
                 //     //alert("si pasa");
                 //     this.consultarCuponExpress();
                 //   }
                 // }

                 this.actualizarDelCupon();

               });
               this.e1 = 3;
               ///}else{
               //   this.consultarCuponExpress();
               // }
            //}
        }
      }
      if(!sihubocalculodepromo){
        //alert("por aca sale");
        this.e1 = 3;
      }














    },
    consultarCuponExpress:function(_callback){
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      var vm = this;


      axios({
        method:'get',
        url:apiRutas.pedido_tarifa,
        params: {
          token:token,
          cupon:vm.cupon_descuento,
          promo_id:vm.promocion_id
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      }).then(function(response){
        console.log('response.data');
        console.log(response.data);
        vm.datarescupon = response.data.data.cupon_comoes;
        vm.promo_cuantos_usos_van = response.data.data.promo_cuantos_usos_van;

        if(_callback!=null){
          _callback();
        }
      }).catch(function (error) {
        //alert("UN ERROR Y PASA");
        console.log(error);
        console.log(error.toString());
        vm.e1 = 3;
      });
    },

    loadTarifaExpressApi:function(_callback){

    },
    generarPedido:function(){
      if(this.costo_total_final<0){
        this.errorGenerarPedido='Error en el monto a pagar.';
        return false;
      }

      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;



      this.errorGenerarPedido='';
      if(this.tiene_contraentrega&&pro.usuario_escorporativo==1){
        this.procedeContraentrega = true;
        if(this.contraEntregaActive&&!this.order_payment_selected){
          this.procedeContraentrega = false;
          this.alertaContraentrega=true;
          return;

        }
      }




      this.pagarBtnLoading = true;
      this.errorGenerarPedido='';

      var vm = this;
      console.log("PEDIDO DIRECTOB");
      //console.log('generar pedido');
      //console.log(vm.clientComments);

      let auxCard = vm.cardSelected;
      if(vm.cardSelected==0||!vm.cardSelected){
        auxCard=null;
      }

      if(vm.rememberUsando){
        vm.remember=0;
      }

      if(vm.rememberClientUsando){
        vm.rememberClient=0;
      }
      vm.rememberUsando=false;
      vm.rememberClientUsando=false;








      var servicio_generarPedido = apiRutas.pickapp_generarPedido+'?token='+token;

//http://scharff-express.apiblueprint.org/pickapp/api/rest/settings/id?token=6c2ce248885b7441db50cff36f5a82d4
//http://scharff-express.apiblueprint.org/pickapp/api/rest/settings/1?token=6c2ce248885b7441db50cff36f5a82d4

      var email_paraenviar = null;

      if(pro.usuario_escorporativo==1){
        email_paraenviar = vm.contactoEmail;
        auxCard=null;
      }
      if(vm.order_capacity_elegido!=''){
        var capacity_code_paraenviar = vm.order_capacity_elegido.code;

      }else{
        var capacity_code_paraenviar = null;
      }

      if(vm.order_payment_selected!=''){
        var payment_option_code_paraenviar = vm.order_payment_selected.code;
        // alert(1);
        // console.log(vm.order_payment_selected.code);
        // console.log('vm.order_payment_selected.code');
      }else{
        var payment_option_code_paraenviar = null;
          // alert(2);
      }
      if(vm.tiene_prepago&&(!vm.contraEntregaActive)&&vm.prepago_code){
        payment_option_code_paraenviar = vm.prepago_code;
          // alert(3);
      }







      if(!vm.cash_change_available){
        vm.client_cost = null;
        vm.payment_includes_delivery = null;
        vm.client_pays_with = null;
      }
      if(payment_option_code_paraenviar=='prepagado'){
        vm.importe_pago = "";
        vm.importe_servicio_empresa_x = "";
      }




      // pedido_distancia:8443,
      // pedido_latituddesde:-8.1185989,
      // pedido_latitudhasta:-8.0647013,
      // pedido_longituddesde:-79.0396937,
      // pedido_longitudhasta:-79.0614895,


      //alert(payment_option_code_paraenviar);
      var objeto_por_enviar = {
        pedido_quienpaga:1,
        pedido_tipopago:1,
        guardarorigenfavorito:vm.remember?1:0,
        guardardestinofavorito:vm.rememberClient?1:0,
        pedido_referenciadesde:"",
        pedido_nombreemisor:vm.userName,
        pedido_latituddesde:vm.currentLocation.lat,
        pedido_longituddesde:vm.currentLocation.lng,
        pedido_calledesde:vm.userAddress,
        pedido_numeroemisor:vm.userPhone,
        pedido_callehasta:vm.clientAddress,
        pedido_latitudhasta:vm.currentLocationClient.lat,
        pedido_longitudhasta:vm.currentLocationClient.lng,
        // pedido_distancia:8443,
        // pedido_latituddesde:-8.1185989,
        // pedido_latitudhasta:-8.0647013,
        // pedido_longituddesde:-79.0396937,
        // pedido_longitudhasta:-79.0614895,
        pedido_personacontactoreceptor:vm.clientName,
        pedido_numeroreceptor:vm.clientPhone,
        pedido_nombrereceptor:vm.clientName,
        pedido_descripcion:vm.clientComments,
        pedido_distancia:vm.shippingDistance,
        tarjeta_id:auxCard,
        pedido_numerocalledesde:vm.interior_recojo,
        pedido_numerocallehasta: vm.interior_envio,
        pedido_comentarioorigen:vm.observaciones_origen,
        pedido_bccorigen:email_paraenviar,
        capacity_code:capacity_code_paraenviar,
        payment_option_code:payment_option_code_paraenviar,
        pedido_cuantopaga:vm.costo_total,





        client_cost: vm.importe_servicio_empresa_x,
        payment_includes_delivery: vm.opcion_sumar_delivery_al_total?1:0,
        client_pays_with: vm.importe_pago

      }

      if(payment_option_code_paraenviar=='prepagado'){
        objeto_por_enviar.payment_includes_delivery = "";
      }


      console.log(objeto_por_enviar);
      console.log('objeto_por_enviar');


      if(vm.inputs_dinamicos_ar){
        var valorDinamico = '';

        objeto_por_enviar.additional_fields = [];
        objeto_por_enviar.pedido_comentarioorigen += '\n';
        objeto_por_enviar.pedido_descripcion += '\n';

        vm.inputs_dinamicos_ar.forEach(function(el){
          valorDinamico = document.getElementById('adicional_'+el.id).value;
          objeto_por_enviar.additional_fields.push({
            id:el.id,
            value:valorDinamico
          });
          if(valorDinamico!=''){
            objeto_por_enviar.pedido_comentarioorigen += el.field_name+':'+valorDinamico+'\n';
            objeto_por_enviar.pedido_descripcion += el.field_name+':'+valorDinamico+'\n';
          }

        });
      }

      var infoContatenar = '';
      if(vm.cash_change_available){
        if(vm.order_payment_selected.code == 'efec' && vm.importe_pago ){
          infoContatenar = '\nForma de pago: '+'Efectivo';
          infoContatenar += '\nTotal recaudo s./ '+vm.total_a_recaudar;
          infoContatenar += '\nImporte Efectivo s./ '+vm.importe_pago;



          //
          // forma de pago,
          // total recaudo,
          // monto de cuanto paga el cliente
        }else{
          //let forma_pago_nombre = vm.order_payment_selected.code=='posv'?'Visa':'MasterCard'
          if(payment_option_code_paraenviar!='prepagado'){
            if(vm.order_payment_selected.description!=undefined){
              infoContatenar = '\nForma de pago: '+vm.order_payment_selected.description;
            }
            infoContatenar += '\nTotal recaudo s./ '+vm.total_a_recaudar;
          }
        }
      }else{
        if(pro.usuario_escorporativo==0){
          objeto_por_enviar.payment_option_code = 'prepagado';
        }

      }

      objeto_por_enviar.pedido_descripcion += infoContatenar;
      objeto_por_enviar.pedido_comentarioorigen += infoContatenar;

      console.log('objeto_por_enviar');

      console.log(objeto_por_enviar);
      // vm.pagarBtnLoading = false;
      // return false;



      if(vm.descuento>0||vm.descuento_cupon>0){

        let todoeldescuento = parseFloat(vm.descuento) + parseFloat(vm.descuento_cupon);
        let descPorcentaje = parseFloat(todoeldescuento);
        let descPorcentajeA = ((descPorcentaje*100)/vm.costo_total).toFixed(0);
        let descPorcentajeB = ((descPorcentaje*100)/vm.costo_total).toFixed(1);
        // objeto_por_enviar.descPorcentajeA = parseFloat(descPorcentajeA);
        // objeto_por_enviar.descPorcentajeB = parseFloat(descPorcentajeB);
        if(descPorcentajeA === descPorcentajeB){
          objeto_por_enviar.porcentaje_descuento = parseFloat(descPorcentajeA);
        }else{
          objeto_por_enviar.porcentaje_descuento = parseFloat(descPorcentajeB);
        }

      }else{
        objeto_por_enviar.porcentaje_descuento = 0;
      }





      axios.post(servicio_generarPedido, objeto_por_enviar)
      .then(function(response){
        let res = response.data;

        //console.log(res);
        if(res.tipo==1){



          vm.pedido_id = res.data;
          //alert(222);


          if(vm.multiple_orders){
            vm.modalComplete = true;
            vm.drawerRight=false;
            vm.pagarBtnLoading = false;
            vm.calculandoDetalles = false;
            vm.notificarAlPicker(res.data);
            // vm.runMinuto();
            // setTimeout(function(){
            //   vm.cargaBounds();
            // },1500)
          }else{
            vm.e1=4;
            vm.drawerRight=false;
            vm.pagarBtnLoading = false;
            vm.calculandoDetalles = false;
            vm.notificarAlPicker(res.data);
            vm.runMinuto();
            setTimeout(function(){
              vm.cargaBounds();
            },1500)
          }

          console.log("==================00000000=======00000=========");
          console.log(vm.promocion_cupon_id);
          console.log(vm.promocion_id);
          console.log(vm.descuento);


          if((vm.descuento>0&&vm.promocion_id>0)||(vm.promocion_cupon_id>0&&vm.descuento_cupon>0)){
            vm.agregarDescuentoApi();
          }

          vm.realizarFacturacion();

        }else{
          vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
          vm.pagarBtnLoading = false;
          vm.calculandoDetalles = false;
          vm.reportarLog('registrar_pago',"Error durante pago - express");
        }
      }).catch(function (error) {
        console.log("Ocurrio un error pagar");
        vm.pagarBtnLoading = false;
        vm.calculandoDetalles = false;
        vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
        vm.reportarLog('registrar_pago',"Error consumo api - express");
      });
      //console.log(auxCard);



    },
    realizarFacturacion:function(){
      var update_rucrazonsocial = 0;
      if(this.facturacion_ruc_aux != this.facturacion_ruc){
        update_rucrazonsocial = 1;
      }
      if(this.facturacion_razonsocial_aux != this.facturacion_razonsocial){
        if(update_rucrazonsocial==1){
          update_rucrazonsocial = 3;
        }else{
          update_rucrazonsocial = 2;
        }
      };


      var token = this.getLocalUser().token;
      var vm = this;
      axios({
        method:'post',
        url:apiRutas.pedido_extrainfo+'?token='+token,
        data: {
          pedido_ruc:this.facturacion_ruc,
          pedido_razonsocial:this.facturacion_razonsocial,
          emitir_factura:this.checkboxFactura?1:0,
          update_rucrazonsocial,
          pedido_id:this.pedido_id
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      }).then(function(response){

        if(response.data.updated_rucrazonsocial){
          var pro = vm.getLocalUser();
          pro.usuario_ruc = vm.facturacion_ruc;
          pro.usuario_razonsocial = vm.facturacion_razonsocial;
          vm.setLocalUser(pro);
        }
      }).catch(function(error){
        console.log(error);
      });
    },
    agregarDescuentoApi:function(){

      var vm = this;

      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      var usuario_email = pro.usuario_email;

      //alert(apiRutas.pedido_agregardesc+'?token='+token);
      axios({
        method:'post',
        url:apiRutas.pedido_agregardesc+'?token='+token,
        data: {
          pedido_id:vm.pedido_id,
          promocion_id:vm.promocion_id,
          promocion_cupon_id:vm.promocion_cupon_id,
          cupon_descuento:vm.cupon_descuento,
          tiene_cupon:vm.tiene_cupon?1:0,
          descuento:vm.descuento,
          descuento_cupon:vm.descuento_cupon,
          cupon_id:vm.cupon_id,

        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      }).then(function(response){
        console.log(response);
        if(response.data.tipo==1){

        }
      }).catch(function(error){
        console.log(error);
      });


    },
    notificarAlPickerAgain:function(pedido_id){
      this.notificarAlPickerLoading = true;
      this.notificarAlPickerNotice = '';
      var vm = this;
      var servicio_notificarPicker = apiRutas.pickapp_notificarPedido+'/'+pedido_id;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;


      axios.get(servicio_notificarPicker, {
        params: {
          token:token
        }
      }).then(function(response){
        vm.notificarAlPickerLoading = false;
        vm.notificarAlPickerNotice = 'Se ha vuelto a notificar a los scharffers.';

        setTimeout(function(){
          vm.cargaBounds();
          vm.runMinuto();
        },2500)


      }).catch(function (error) {
        vm.notificarAlPickerLoading = false;
        vm.notificarAlPickerNotice = 'Inténtalo nuevamente';
        console.log(error);
      });
    },
    notificarAlPicker:function(nPedido){
      var vm = this;
      var servicio_notificarPicker = apiRutas.pickapp_notificarPedido+'/'+nPedido;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;


      axios.get(servicio_notificarPicker, {
        params: {
          token:token
        }
      })
      .then(function(response){
        let res = response.data;
        // vm.e1=4;
        // vm.drawerRight=false;
        // vm.pagarBtnLoading = false;
        // vm.calculandoDetalles = false;
        // vm.runMinuto();
        // setTimeout(function(){
        //   vm.cargaBounds();
        // },1500)




      }).catch(function (error) {
        console.log(error);
        vm.pagarBtnLoading = false;
        vm.calculandoDetalles = false;
      });
    }
    ,runMinuto:function(){
      this.modalOtraOportunidad = false;
      var vm = this;
      var countdown = 119;

      console.log("antes del interval");
      clearInterval(vm.elinterval);
      vm.elinterval = setInterval(function() {

        if(countdown>70){

          vm.unMinuto = '01:'+(countdown-60);
        }else if(countdown>=60&&countdown<70){
          vm.unMinuto = '01:0'+(countdown-60);
        }else if(countdown<60&&countdown>=10){
          vm.unMinuto = '00:'+(countdown);
        }else if(countdown<10){
          vm.unMinuto = '00:0'+(countdown);
        }



        if(countdown%10==0){
          vm.buscaPicker();
          console.log("intervalo 10");
        }

        console.log("dentro del interval");
        console.log(countdown);
        countdown--;
        if(countdown<0){

          clearInterval(vm.elinterval);
          vm.modalOtraOportunidad = true;
        }else if(vm.pikerdisponible){
          clearInterval(vm.elinterval);
          vm.e1 = 4;
        }

      }, 1000);






    },buscaPicker:function(){
      var vm = this;
      var pedido_id = this.pedido_id;

      console.log("buscaa");
      console.log($('.vue-map-container').length);
      if(!$('.vue-map-container').length){
        console.log("Si hay vue-map-container");
        vm.contador_definitivo_interval++;
        console.log(vm.contador_definitivo_interval);
        if(vm.contador_definitivo_interval>2){
          console.log("Ya saliovm.contador_definitivo_interval");
          vm.cancelarEnvio();
        }
      }




      var servicio_pedidosList = apiRutas.pickapp_getMisPedidos+'/1/10';
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;

      axios.get(servicio_pedidosList, {
        params: {
          token:token
        }
      })
      .then(function(response){
        let res = response.data;
        //console.log('loadPedidosList');
        //console.log(res.data);
        var buscarAqui = res.data;
        buscarAqui.forEach(function(el){
          if(el.pedido_id==vm.pedido_id){
            vm.encontrado();
            vm.picker_encontrado_nombre = el.pedido_transportista;
            vm.picker_encontrado_id = el.pedido_transportistaid;
            vm.pedido_codigo = el.pedido_codigo;

          }
        })


        vm.loading_table = false;
        //console.log(vm.items);

      }).catch(function (error) {
        console.log(error);
        vm.loading_table = false;
      });




    },encontrado(){
      console.log("Encontrado");
      this.pikerdisponible = true;
    }
    ,setPlace(place) {
      console.log('place');
      console.log(place);
      //vm.userAddress = $('#autocompleteInput').val();
      this.userAddress = document.getElementById("autocompleteInput").value;

      if(place.hasOwnProperty('geometry')){
        this.place = place;
        var a_lat = place.geometry.location.lat();
        var l_lng = place.geometry.location.lng();

        this.currentLocation={lat: a_lat, lng: l_lng};
      }

    },setPlaceb(place) {
      //vm.userAddress = $('#autocompleteInput').val();
      this.clientAddress = document.getElementById("autocompleteInputb").value;


      if(place.hasOwnProperty('geometry')){
        this.placeb = place;
        var a_lat = place.geometry.location.lat();
        var l_lng = place.geometry.location.lng();

        this.currentLocationClient={lat: a_lat, lng: l_lng};
      }
    },
  },
  computed:{
    facturacion_error_ruc:function(){
      if(this.checkboxFactura){
        if(this.facturacion_notice!=''&&(this.facturacion_ruc.length!=11)){
          return true;
        }
      }
      return false;
    },
    facturacion_error_razonsocial:function(){
      if(this.checkboxFactura){
        if(this.facturacion_notice!=''&&this.facturacion_razonsocial==''){
          return true;
        }
      }
      return false;
    },
    errorPagarRecaudo:function(){
      if(this.importe_pago!=''&&!this.pagarRecaudoListo){
        return 'El importe de pago debe ser mayor o igual al monto total a recaudar';
      }
      return '';
    },
    pagarRecaudoListo:function(){
      console.log('pagarRecaudoListo');
      console.log(this.importe_pago);
      console.log(this.total_a_recaudar);
      if(this.contraEntregaActive && this.order_payment_selected.code == 'efec'){
        if(parseFloat(this.importe_pago)>=parseFloat(this.total_a_recaudar)){
          return true;
        }else{
          return false
        }
      }else{
        return true;
      }


    },
    costo_total_final:function(){
      return this.formatoCosto(this.costo_total - this.descuento - this.descuento_cupon);
    },
    importe_mas_delivery:function(){
      var importe_mas_delivery
      if(this.opcion_sumar_delivery_al_total){
        if(this.importe_servicio_empresa_x!=""){
          importe_mas_delivery   = parseFloat(this.costo_total_final) + parseFloat(this.importe_servicio_empresa_x);
        }else{
          importe_mas_delivery   = parseFloat(this.costo_total_final);
        }
      }else{
        if(this.importe_servicio_empresa_x!=""){
          importe_mas_delivery = parseFloat(this.importe_servicio_empresa_x);
          console.log('queraro');
          console.log(importe_mas_delivery);
          console.log('importe_mas_delivery------');
        }else{
          importe_mas_delivery = 0;
          console.log('importe_mas_delivery------');
        }
      }


      console.log('importe_mas_delivery');
      console.log(importe_mas_delivery);
      console.log(this.opcion_sumar_delivery_al_total);
      console.log(this.importe_servicio_empresa_x);

      return this.formatoCosto(importe_mas_delivery);
    },
    getStoredfLatLng:function(){
      return this.$store.getters.loadStatefLatLng;
    },
    tarjeta_numero_formated () {
      return this.tarjeta_numero.replace(/\s+/g, '');
    },
    expiry_formated () {
      return this.monthCard + this.yearCard;
    },
    cardSelected:function(){
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      if(pro.usuario_escorporativo==1){
        return true;
      }
      let a = this.$store.getters.loadStateTarjetaPredeterminada;
      if(a==null||a==''||a==-1){
        return false
      }
      return a;
    },
  },

  components: { 'metodos-pagos':metodosPagos,Multiselect },

}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style lang="scss">
@import "../../scss/vars.scss";
.primary-color, .primary--text {
  color: $primary-color !important;
}
.text-step-one>strong {
  font-size: 15px;
}
.gray-color {
  color: gray;
}
.block-center{
  margin: 0 auto;
}
.pdd-m {
  padding: 20px;
}
.pdd-b0{
  padding-bottom: 0;
}
.mg-b0{
  margin-bottom: 0;
}
.border-r {
  border-right: 1px solid #ada9a9;
}
.border-b {
  border-bottom: 1px solid #ada9a9 !important;
}
.border2-b {
  border-bottom: 2px solid;
}
.list-opcion {
  margin-top: 15px;
}
.input-group.input-group--solo {/**/
  border: 1px solid #9e9c9c;
  box-shadow: none;
  min-height: auto;
  height: 34px;
  label {
    top: 2px;
  }
}
.input-cupon{
  border-bottom: 1px solid;
  outline: none;
  max-width: 100%;
}
strong.subtitle {
  font-size: 17px;
}
.summary-mount {
  padding: 10px 0;
  text-align: right;
}
.summary-mount .total {
  font-size: 18px;
  font-weight: 500;
  margin-top: 9px;
  font-family: 'Carnas-Bold';
}
table.description-pago-express {
  border-collapse: collapse;
  margin: 1em 2em 4em;
  td {
    padding-bottom: 0;
    span.border-b {
    width: 100%;
    display: inline-block;
    }
  }
}

table.description-pago-express, .description-pago-express td, .description-pago-express th {
  border: none;
}
.description-pago-express td:nth-child(1) {
  text-align: right;
  padding-right: 15px;
  min-width: 80px;
}
.mount-total {
  font-size: 20px;
  font-weight: bold;
}
.modalOtraOportunidad .el--block{
  position: absolute;
  right: 4px;
  bottom: 5px;
}
.modalOtraOportunidad {
    padding-bottom: 8px;
}
.generated-select{
    width: 100%;
    border-bottom: solid 1px #000;
    margin-bottom: 1.9rem;
    border-radius: 0;
    padding-left: 14px;
}
.gselect-w select{
    color: #777777;
}
.gselect-w select.ginput-valido{
  color:#000;
}
.gselect-w{
  position: relative;
}
.el_1531782097{
  padding-top: 9px;
    padding-bottom: 17px;
    font-size: 17px;
    display: inline-block;
}
.gselect-w i{
  position: absolute;
  right: 3px;
  top: 3px;
  pointer-events: none;
  font-size: 18px;
}
.gselect-w select:focus {
    outline: none;
}
/**/
.list-opcion a {
    padding: 10px 25px;
    border: 1px solid #b3afaf;
    display: inline-block;
    margin: 0;
    text-decoration: none;
    margin-right: -4px;
}

.list-opcion a.active {
    background: #ff535a;
    color: white !important;
    border-color: #ff535a;
}
.min-width-step-two.el_1534873960{
  padding-top: 2.7rem;
  padding-bottom: 1.2rem;
}
.origen-envio__textarea{
  margin-bottom: 2px;
}
.summary-origen-destino-w+
.summary-mount-w{
  padding-top: 10px;
}
.input-nb .multiselect__input{
  border-bottom: none;
}
.input--modifier .multiselect__tags {
    padding: 4px 35px 0 3px;
}
.navigation-drawer .input--modifier .multiselect__tags {
    padding-top: 5px;
}
.alertaContraentrega {
    text-align: center;
    display: block;
    width: 100%;
    padding: 10px 10px 0;
    font-size: 12px;
    color: red;
}
.el_1538781516{
  padding-left: 10px;
}
@media screen and (max-width: 960px) {
  .border-r {
    border: none;
  }
  .min-width-step-two {
    padding: 2rem;
  }
}

@media screen and (max-width: 840px) {
  .flex.sm8.el_1538781516,.flex.xs4.el_1538781517{
    padding-left: 0;
    width: 100%;
    flex-basis: 100%;
    max-width: 100%;
  }
  .flex.xs4.el_1538781517{
    padding-top: 7px;
  }
}

span.montos-labels {
    display: inline-block;
    min-width: 109px;
}
.btn-aplicar-cupon {
  border-color: gray !important;
}
.btn-aplicar-cupon .btn__content{
font-family: Carnas-Regular;
    color: gray;
    text-transform: initial;
  }
.cupon-input-w input.input-cupon{
  width: 162px;
  max-width: 100%;
  margin-right: 18px;
}
.btn-aplicar-cupon+span{
display: inline-block;
vertical-align: middle;
}
.cupon-input-w i{
display: none;
}
.cupon-input-w:hover i{
display: block;
}
.fade-leave-active {
transition: opacity .5s;
}
.fade-leave-to{
opacity: 0;
}
div.text-step-one>strong {
    font-size: 15px;
}
.summary-mount .subheading{
  display: block;
}
.pd-descripcion-label{
  padding-bottom: 7px;
  padding-top: 13px;
  margin-bottom: 6px;
  display: inline-block;
}
.el_1537310325{
  padding-top: 16px;
}
.wrapper-info-finish.el_1538001878{
      padding: 2.5rem 4rem;
}
.errorPagarRecaudo{
      padding:0 2rem 11px;
}
.pagarRecaudoPre.btn.btn--disabled{
  pointer-events: all;
}
.block-factura .input-factura input.facturacion_error {
    border-bottom: 1px solid red;
}
.text-step-one-rw.text-step-one input.express-input-error, .text-step-one-rw.text-step-two input.express-input-error{
      margin-bottom: 0.2rem;
}
.text-step-one-rw.text-step-one input.express-input-error+small,
.text-step-one-rw.text-step-two input.express-input-error+small{
  color: #ff5e65;
  display: inline-block;
  margin-bottom: 10px;
}
</style>
