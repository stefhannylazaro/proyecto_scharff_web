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
        <v-divider></v-divider>
        <v-stepper-step step="4" class="stepper-control"></v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content step="1" class="regular-step1">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Datos de origen del envío</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container regular-block">
            <v-layout xs12 row wrap>
              <div class="white-bg xs12 row wrap layout">


              <v-flex xs12 sm6 md6>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one">
                    <strong class="primary-color mg-s" style="padding-top:0;padding-bottom: 8px;">DIRECCIÓN DE ORIGEN</strong> <br>
                    <GmapAutocomplete
                    :options="{
                        componentRestrictions: {'country': ['pe']}
                    }"
                    placeholder="Av. Calle o Jr.*" @place_changed="setPlace('origen')" id="origenInput"></GmapAutocomplete>


                    <input type="hidden" placeholder="Av. Calle o Jr." v-model="origen">
                    <multiselect
                      v-model="departmentSelectA"
                      :options="departmentsListA"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': departmentInvalidA}"
                      placeholder="Departamento*">
                    </multiselect>

                    <multiselect
                      v-model="provinceSelectA"
                      :options="provinceListA"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': provinceInvalidA}"
                      placeholder="Provincia*">
                    </multiselect>

                    <multiselect
                      v-model="districtSelectA"
                      :options="districtListA"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': districtInvalidA}"
                      placeholder="Distrito*">
                    </multiselect>

                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->
                </div>
              </v-flex>
              <v-flex xs12 sm6 md6 style="z-index: 1;">
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-left">

                    <input type="text" class="numero-interior-piso" placeholder="Número, interior, piso u oficina" v-model="interior_remitente">
                    <textarea class="origen-envio__textarea" name="name" rows="8" cols="80" v-model="observaciones_origen" placeholder="Escribe alguna observación o referencia"></textarea>
                    <strong class="gray--text mg-s">DATOS DEL REMITENTE</strong><br>

                    <input type="text" placeholder="Nombres y apellidos*" v-model="nombre_remitente" class="mt-1">
                    <input type="text" class="short-input" placeholder="Celular*" v-model="celular_remitente">

                    <span style="display:none" class="short-input"><input type="text" placeholder="Número/Interior" v-model="numero_remitente">

                      <v-tooltip right>
                        <i class="material-icons" slot="activator">help_outline</i>
                        <span>Tooltip</span>
                      </v-tooltip>

                    </span>



                  </div>
                  <div class="justify-end gray--text">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>
                </div>
              </v-flex>
              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn v-if="checkStep1()" round outline class="btn-send-next" @click.native="e1 = 2">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >siguiente</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>







        <v-stepper-content step="2" class="regular-step1">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Datos de destino del envío</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container regular-block">
            <v-layout xs12 row wrap>
              <div class="white-bg xs12 row wrap layout">


              <v-flex xs12 sm6 md6>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one">
                    <strong class="primary-color mg-s" style="padding-top:0;padding-bottom: 8px;">DIRECCIÓN DE DESTINO</strong> <br>

                    <GmapAutocomplete
                    :options="{
                        componentRestrictions: {'country': ['pe']}
                    }"
                    placeholder="Av. Calle o Jr.*" @place_changed="setPlace('origen')" id="destinoInput"></GmapAutocomplete>


                    <input type="hidden" placeholder="Av. Calle o Jr." v-model="destino"><br>
                    <multiselect
                      v-model="departmentSelectB"
                      :options="departmentsListB"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': departmentInvalidB}"
                      placeholder="Departamento*">
                    </multiselect>

                    <multiselect
                      v-model="provinceSelectB"
                      :options="provinceListB"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': provinceInvalidB}"
                      placeholder="Provincia*">
                    </multiselect>


                    <multiselect
                      v-model="districtSelectB"
                      :options="districtListB"
                      label="name"
                      :searchable="true"
                      :close-on-select="true"
                      :show-labels="false"
                      class="input--modifier" v-bind:class="{'select-invalid': districtInvalidB}"
                      placeholder="Distrito*">
                    </multiselect>

                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->
                </div>
              </v-flex>
              <v-flex xs12 sm6 md6>



                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-left">

                    <input type="text" class="numero-interior-piso" placeholder="Número, interior, piso u oficina" v-model="interior_destinatario">
                    <textarea class="origen-envio__textarea" name="name" rows="8" cols="80" v-model="observaciones_destinatario" placeholder="Escribe alguna observación o referencia"></textarea>
                    <strong class="gray--text mg-s">DATOS DEL DESTINATARIO</strong><br>


                    <input type="text" placeholder="Nombres y apellidos*" v-model="nombre_destinatario" class="mt-1">
                    <input type="text" class="short-input" placeholder="Celular*" v-model="celular_destinatario">

                  </div>
                  <div class="justify-end gray--text">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>
                </div>
              </v-flex>
              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 1">Atras</v-btn>
                <v-btn v-if="checkStep2()" round outline class="btn-send-next" @click.native="irAlPaso3">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >siguiente</v-btn>
              </v-flex>

            </v-layout>
          </v-container>
        </v-stepper-content>









        <v-stepper-content step="3" class="regular-step2 regular-step2b">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Sobre tu envío</h2>
          </v-flex>
          <v-container class="regular-block nopadding-w390 enviar-container">
            <v-layout xs12 row wrap>
              <div class="white-bgb xs12 row wrap layout ">

                <v-flex xs12 sm6 md4 class="">
                  <div class="font-regular  ep-form-package">
                    <div class="text-step-two text-step-one text-center">
                      <strong class="regular-form-el001"><img src="/images/icon_dimension.png" alt=""> ¿Cuánto mide?</strong>

                      <img src="/images/img_dimensiones.png" alt="" class="envio-regular__step1--img">
                      <div class="cuanto-mideb">
                        <label class="pt-1" for=""><span>Ancho: </span><input type="number" name="" min="1" value="" placeholder="1" v-model="dim_ancho"> cm</label>
                        <label class="pt-1" for=""><span>Altura: </span><input type="number" name="" min="1" value="" placeholder="1" v-model="dim_altura"> cm</label>
                        <label class="pt-1" for=""><span>Profundidad: </span><input type="number" min="1" name="" value="" placeholder="1" v-model="dim_profundidad"> cm</label>
                      </div>

                      <strong class="mt-4"><img src="/images/icon_dimension.png" alt=""> Detalles:</strong>
                      <div class="cuanto-mideb cuanto-midec">
                        <label for="">Valor del paquete: s/. <input type="number" name="" min="0" value="" placeholder="" v-model="valor_paquete"></label>
                      </div>

                    </div>

                  </div>
                </v-flex>

              <v-flex xs12 sm6 md4 class="centrado-total">
                <div class="font-regular  ep-form-package">
                  <div class="text-step-two text-step-one text-center">
                    <div class="text-step-two text-step-one text-center">
                      <strong class=""><img src="/images/icon_peso.png" alt=""> ¿Cuánto pesa?</strong><br>
                      <input v-model="cuantoPesa" type="number" name="" min="1" value="">kg.

                    </div>

                    <br>

                    <strong class="pb-1"><img src="/images/tiempo_entrega_icon.png" alt=""> <span>Tiempo de <br> entrega</span></strong><br>

                    <!-- <h1>{{tiempo_entrega}}</h1>
                    <h2>{{tiempos_disponibles}}</h2>hola -->
                    <div class="dos-btns">
                      <span v-if="tiempos_disponibles['24']=='x'" @click="cambiaTiempo_entrega(0)" class="dos-btns--left" :class="{'dos-btns--active':tiempo_entrega==0}">{{tiempos_textos[0]}}</span>
                      <span v-if="tiempos_disponibles['72']=='x'" @click="cambiaTiempo_entrega(1)" class="dos-btns--right" :class="{'dos-btns--active':tiempo_entrega==1}">{{tiempos_textos[1]}}</span>
                      <span v-if="tiempos_disponibles['72+']=='x'" @click="cambiaTiempo_entrega(2)" class="dos-btns--right" :class="{'dos-btns--active':tiempo_entrega==2}">{{tiempos_textos[2]}}</span>
                    </div>
                    <br>
                    <!-- <p>
                    Entrega regular ({{tiempos_textos[1]}}) <br>
                    Entrega económica ({{tiempos_textos[2]}})</p> -->

                  </div>
                </div>
              </v-flex>



              <v-flex xs12 sm12 md4 class="centrado-total calculando-tarifa-block">
                <div class="font-regular  ep-form-package">
                  <div class="text-step-two text-step-one  text-center pt-5">
                    <img src="/images/icon_total.png" alt="">
                    <strong class="">Costo total:</strong>
                    <p class="costo-total" v-text="formatearCosto(costo_total)"></p>
                    <strong class="tarifaNotice" v-if="tarifaNotice!=''" v-html="tarifaNotice"></strong>
                  </div>
                  <div class="pt-5" style="font-size: 12px;">
                    <v-tooltip bottom>
                        <v-checkbox color="error" slot="activator" :label="'Quiero adquirir seguro para proteger mi envío*'" v-model="seguro_envio_check"></v-checkbox>
                      <span>El precio del seguro es del 0.5% del valor de la <br>carga con una cobertura de hasta 15,000 USD</span>
                    </v-tooltip>
                  </div>

                </div>

                <div class="tarifa-loading-screen" :class="{'tarifa-loading-screen-active':ajustandoTarifa}">


                  <v-progress-circular :size="50" indeterminate color="primary"></v-progress-circular>

                </div>


              </v-flex>

              <div class="text-right denocontarconseguro">
                <small>* De no contar con seguro, Scharff solo se hace responsable de un valor de 10 veces el precio del flete.</small>
              </div>
              </div>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 2">Atras</v-btn>
                <v-btn v-if="checkTarifaAprobada()" round outline class="btn-send-next" @click.native="irAlPaso4">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >siguiente</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>

        <v-stepper-content step="4" class="regular-step1 regular-step1m3">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Resumen de pedido</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container regular-block">
            <v-layout xs12 row wrap>
              <div class="white-bg xs12 row wrap layout">


              <v-flex xs12 sm6 md6>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-bottom_em">
                    <strong class="orange--text mg-s">ORIGEN</strong>

                    <p>{{origen + ', '+departmentSelectA.name+','+provinceSelectA.name+', '+districtSelectA.name}}</p>
                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->
                </div>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-left">
                    <strong class="green--text">DESTINO</strong>
<p>{{destino + ', '+departmentSelectB.name+','+provinceSelectB.name+', '+districtSelectB.name}}</p>
                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->
                </div>
              </v-flex>

              </div>





              <div class="white-bg xs12 row wrap layout">


              <v-flex xs12 sm12 md12>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-bottom_em">
                    <strong class="">SOBRE TU ENVÍO</strong>

                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->


                  <v-layout row wrap>
                    <v-flex xs12 sm6 md3 justify-space-between class="layout re-">
                      <span>Peso: {{cuantoPesa}}KG</span>
                    </v-flex>

                    <v-flex xs12 sm6 md3>
                      <span>Dimensiones:  {{dim_ancho + 'cm x'+dim_altura+ 'cm x'+dim_profundidad+ 'cm'}}</span>
                    </v-flex>

                    <v-flex xs12 sm12 md6 class="">
                      <span v-if="tiempo_entrega==0">Tiempo de entrega: {{tiempos_textos[0]}}</span>
                      <span v-if="tiempo_entrega==1">Tiempo de entrega: {{tiempos_textos[1]}}</span>
                      <span v-else-if="tiempo_entrega==2">Tiempo de entrega: {{tiempos_textos[2]}}</span>
                    </v-flex>
                  </v-layout>

                </div>
              </v-flex>

              </div>


              <div class="white-bg xs12 row wrap layout">


              <v-flex xs12 sm12 md12>
                <div class="font-regular min-width-step-two ep-form-package">
                  <div class="text-step-two text-step-one line-bottom_em">




                    <v-layout row wrap justify-space-between>
                      <v-flex xs12 md6 class="cupon-box">
                        <div v-if="tiene_cupon" >
                          <div class="text-step-two text-step-one line-bottom_em">
                            <strong>CUPÓN DE DESCUENTO</strong>
                          </div>
                          <div class="cupon-elementos">
                            <div class="cupon-input-w">
                              <input type="text" :disabled="se_aplico_cupon" name="" class="input-cupon" value="" v-model="cupon_descuento">
                              <i class="material-icons" v-if="cupon_descuento!=''" @click="resetearCupon" >
                                close
                              </i>
                            </div>
                            <v-btn round outline class="btn-aplicar-cupon" :disabled="se_aplico_cupon" @click.native="actualizarDelCupon">Aplicar cupón</v-btn>
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
                            <input type="number" :class="{facturacion_error:facturacion_error_ruc}" placeholder="RUC" v-model="facturacion_ruc">
                            <input type="text" :class="{facturacion_error:facturacion_error_razonsocial}" placeholder="Razón social"  v-model="facturacion_razonsocial">
                            <div class="text--red" v-if="facturacion_notice!=''" v-text="facturacion_notice"></div>
                          </div>
                        </div>
                        <!-- asd -->
                      </v-flex>
                      <!-- <v-flex :md6="tiene_cupon" :md12="!tiene_cupon" class="text-md-right"> -->
                      <v-flex md6 class="text-md-right">
                          <span class="subheading bold">Subtotal: <span class="montos-labels">{{formatearCosto(costo_base)}}</span></span>
                          <span class="subheading bold">Concepto(seguro): <span class="montos-labels">{{formatearCosto(precio_seguro)}}</span></span>
                          <span class="subheading bold">Concepto(IGV): <span class="montos-labels">{{formatearCosto(precio_igv)}}</span></span>
                          <span v-if="descuentob!=0" class="subheading bold">{{promocion_label}}  <span class="montos-labels"> s/. -{{formatoCosto(descuentob)}}</span></span>
                          <span class="display-1 bold">Total: <span class="montos-labels">{{formatearCosto(costo_total)}}</span></span>
                      </v-flex>
                    </v-layout>


                  </div>
                  <!--<div class="justify-end">
                    <span style="font-size:10px;">Campos Obligatorios *</span>
                  </div>-->
                </div>
              </v-flex>

              </div>

              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 3">Atras</v-btn>
                <v-btn round outline class="btn-send-next" @click.native="abrirPanelPagar">Finalizar</v-btn>
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
                        S/.{{amountPayable}}
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
        <v-card class="wrapper-info-finish">
          <div class="font-regular">
            <img class="icon-close-modal" src="../../img/close_icon.png" alt="">
            <h3 class="font-bold pb-2">Gracias por hacer tu envío</h3>
            <p>Te hemos enviado a tu correo un código para que puedas hacer tu rastreo del envío.</p>
            <img style="width:8rem;" :src="iconSend.url" :alt="iconSend.alt">
          </div>
        </v-card>
        <div class="back-modal-active" @click.stop="createReservation()">_</div>
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
        <h3 class="font-bold">Total:</h3>
        <h2 class="font-bold monto-info mb-2 px-4 ">{{formatearCosto(costo_total)}}</h2>
        <p style="" class="px-4 ">Recuerda que recibirás una correo confirmando tu envío.</p>







<!--
        <div
          class="tarjetas-agregadas"
          v-for="(el, idx) in addedCards"
          :key="idx">
          <div class="tarjeta-agregada" @click="select_this(idx)" :class="{'tarjeta-seleccionada' : el.tarjeta_predeterminada==1}">
            <i class="material-icons tarjeta-agregada-icon-left">credit_card</i>
            <p>
              <span>{{el.tarjeta_marca}}</span>
              <strong>**** **** **** {{el.tarjeta_numero}}</strong>
            </p>
            <span class="selected-card" v-if="el.tarjeta_predeterminada==1"><i class="material-icons">check_circle</i></span>
          </div>

        </div>



        <div class="agregar-tarjeta px-4" @click.natural="showCardForm=1;deseleccionarTarjeta()" >
          <img src="/images/mas.png" alt="">Agregar tarjeta de crédito
        </div>


        <v-slide-x-transition>
        <div  class="agregar-tarjeta-form pb-4" v-if="showCardForm==1">


          <div class="stepper-add-card">
            <div class="">
              <div class="card-wrapper-regular"></div>
              <div class="d-align-around container-pay-icons">
                <div
                  class="pay-icon"
                  v-for="(el, idx) in iconPay"
                  :class="{selected: iconActive(el.name)}"
                  :key="idx"
                  @click="selectPayMethod(el.name)">
                  <img :src="el.url" :alt="el.name">
                </div>
              </div>

              <div class="input-payment-methods card-form-regular pb-3">
                <input type="hidden"
                :id="$store.getters.loadStateAdminPanel == 'regular'?'card[email]':''"
                :value="userEmailAccount" class="hidden" />

                <input type="text"
                placeholder="Número de tarjeta" style="width:100%;" v-model="tarjeta_numero" name="number" >

                <input type="hidden"
                :id="$store.getters.loadStateAdminPanel == 'regular'?'card[number]':''"
                placeholder="Número de tarjeta" style="width:100%;" :value="tarjeta_numero_formated">

                <input type="text" name="" style="width:100%;" name="expiry" v-model="expiry_origen" placeholder="Mes / Año">

                <input type="hidden"
                :id="$store.getters.loadStateAdminPanel == 'regular'?'card[exp_month]':''"   placeholder="Mes" style="width: 40%;" v-model="monthCard">

                <input type="hidden"
                :id="$store.getters.loadStateAdminPanel == 'regular'?'card[exp_year]':''"   placeholder="Año" style="width: 58%;" v-model="yearCard">

                <input type="number"
                :id="$store.getters.loadStateAdminPanel == 'regular'?'card[cvv]':''" name="cvc" placeholder="cvv" style="width:100%;" v-model="cvvCard">



              </div>
            <v-btn v-if="vaidMethodPay()" round  color="black"  class="cover white--text elevation-0 btn-cover-banner" >Agregar</v-btn>

            <v-btn v-else round :loading="addCardBtnLoading" :disabled="addCardBtnLoading" class=" btn-active elevation-0 btn--round" @click.stop="agregarTarjeta">Agregar</v-btn>

            <div class="red--text" v-if="errorAddCard!=''" v-text="errorAddCard"></div>
            </div>
          </div>
        </div>
        </v-slide-x-transition> -->




        <metodos-pagos :propAdminPanel="'regular'">
        </metodos-pagos>


        <div class="pb-2">
          <v-btn v-if="!cardSelected" round disabled large class="cover btn-active elevation-0">Pagar</v-btn>
          <v-btn v-else round large :disabled="pagarBtnLoading" :loading="pagarBtnLoading" class="cover btn-active elevation-0" @click="generarPedido()">Pagar</v-btn>
        </div>
        <div class="text--red" v-if="errorGenerarPedido!=''" v-html="errorGenerarPedido"></div>

      </div>
    </v-navigation-drawer>
    <div v-if="drawerRight" class="back-modal-active-admin" style="position:fixed;" @click.stop="drawerRight = false">_</div>


    </v-flex>
  </v-layout>
</template>

<script>
import Multiselect from 'vue-multiselect'
import metodosPagos from './cMetodosPagos'
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
import { EventBus } from '../config/ebus.js'

export default {
  data() {
    return {
      tarjeta_numero: '',
      monthCard: '',
      yearCard: '',
      cvvCard: '',

      e1: 1,
      remember: false,
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


      currentLocation: {lat: -12.111062, lng: -77.0315913},
      currentLocationClient: {lat: -12.1157347, lng: -77.01902280000002},
      infoIcon: { url: '/images/icon_info.svg' , alt: 'icon info'},
      // searchAddressInput: ''
      iconMoney: {url: '/images/icon_money.svg', alt: 'icon money' },
      iconTimer: {url: '/images/icon_time_green.svg', alt: 'icon time green' },
      iconTimerOrange: {url: '/images/icon_time_orange.svg', alt: 'icon time orange' },
      iconSend: {url: '/images/icon_mail_qr.svg', alt: 'icon mail qr'},
      // iconPay: [
      //   { url: '/images/visa.png', name: 'visa'},
      //   { url: '/images/american_express.png', name: 'american_express'},
      //   { url: '/images/master_card.png', name: 'master_card'},
      //   { url: '/images/diners_club.png', name: 'diners_club'},
      // ],
      dondePagar:'',
      // deliveryTime: '',
      // deliveryTimeList: [
      //   {name: 'Express (Picker)', value: 10},
      //   {name: 'Express (Picker)', value: 30},
      //   {name: 'Express (Picker)', value: 40}
      // ],
      // shippingDistance: 10,
      // shippingDuration: 20,
      amountPayable: 0,
      drawerRight: false,
      modalComplete: false,
      //payMethodSelected: '',
      //showCardForm:0,
      //cardSelected:0,
      // addedCards:[
      //
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
      unMinuto:'1:00',
      place: null,
      placeb: null,
      userEmailAccount:'',




      pagarBtnLoading:false,
      departmentSelectA: '',
      departmentsListA: [],
      provinceSelectA: '',
      provinceListA: [],
      districtSelectA: '',
      districtListA: [],
      departmentInvalidA:false,
      provinceInvalidA:false,
      districtInvalidA:false,

      departmentSelectB: '',
      departmentsListB: [],
      provinceSelectB: '',
      provinceListB: [],
      districtSelectB: '',
      districtListB: [],
      departmentInvalidB:false,
      provinceInvalidB:false,
      districtInvalidB:false,

      destino:'',
      origen:'',

      getDepartments: '/ajax/departamentos',
      getProvince: '/ajax/provincias',
      getDistrict: '/ajax/distritos',

      e1ok:false,
      cuantoPesa:"1",
      dim_ancho:'1',
      dim_profundidad:'1',
      dim_altura:"1",
      tiempo_entrega:'1',


      //
      // interior_destinatario
      // observaciones_destinatario
      // nombre_destinatario
      // celular_destinatario
      //

      nombre_remitente:'',
      celular_remitente:'',
      numero_remitente:'',
      interior_remitente:'',
      interior_destinatario:'',//aaa
      observaciones_destinatario:'',//aaa
      observaciones_origen:'',
      nombre_destinatario:'',//aaa
      celular_destinatario:'',//aaa
      cupon_descuento:'',
      costo_total:0,
      errorGenerarPedido:'',
      // btnIrPaso3Notice:'',
      // btnIrPaso3Loading:false,
      //expiry_origen:'',
      tarifaNotice:'',
      tarifaTimeout:'',
      ajustandoTarifa:false,
      valor_paquete:'',
      seguro_envio_check:false,
      descuento_seguro:0,
      tarifaAprobada:false,
      costo_base:0,
      tiempos_textos:[],
      tiempos_disponibles:{
        '24':'',
        '72':'',
        '72+':''
      },


      destino_pais:'PE',
      origen_ubigeo:'',
      destino_ubigeo:'',
      zona:'',
      peso_volumetrico:'',
      precio_igv:'',
      precio_seguro:'',




      tiene_cupon:'',
      se_aplico_cupon:false,

      promocion_id:-1,
      promo_cuantos_usos_van:0,
      descuento:0,
      descuentob:0,
      promocion_label:'',
      datarescupon:null,
      cupon_id:null,
      cupon_mensaje:'',
      checkboxFactura: false,


      facturacion_ruc:'',
      facturacion_razonsocial:'',
      facturacion_notice:'',
      facturacion_ruc_aux:'',
      facturacion_razonsocial_aux:'',



//72hrs




    }
  },
  mounted() {
    this.geolocate();
    //this.listarTarjetas();
    //console.log('this.bar');
    //console.log(this.bar);
    var vm = this;
    // EventBus.$off('tokenizar_tarjeta');
    // EventBus.$on('tokenizar_tarjeta', vm.tokenizar_tarjeta_cont);
    //
    // EventBus.$off('sincronizar_tarjetas_r');
    // EventBus.$on('sincronizar_tarjetas_r', vm.sincronizar_tarjetas_r);



    window.$ = window.jQuery = require('jquery');
    $('#origenInput').on('blur',function(){
      setTimeout(function(){
        vm.origen = $('#origenInput').val();
      },1000)

    });
    $('#destinoInput').on('blur',function(){
      setTimeout(function(){
        vm.destino = $('#destinoInput').val();
      },1000)
    });


    var pro = localStorage.getItem("user_p_info");
    pro = JSON.parse(pro);

    var vm = this;

    vm.user_id = pro.id;
    vm.userEmailAccount = pro.usuario_email;



    vm.loadData();



    // EventBus.$on('sincronizar_tarjetas_r', function(){
    //   alert("asdasd")
    // });
    vm.tiempos_textos[0]='24hrs';
    vm.tiempos_textos[1]='72hrs';
    vm.tiempos_textos[2]='72+hrs';





    var pro = this.getLocalUser();

    this.facturacion_ruc = pro.usuario_ruc?pro.usuario_ruc:'';
    this.facturacion_razonsocial = pro.usuario_razonsocial?pro.usuario_razonsocial:'';
    this.facturacion_ruc_aux = pro.usuario_ruc?pro.usuario_ruc:'';
    this.facturacion_razonsocial_aux = pro.usuario_razonsocial?pro.usuario_razonsocial:'';



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
    cardSelected:function(){
      let a = this.$store.getters.loadStateTarjetaPredeterminada;
      if(a==null||a==''||a==-1){
        return false
      }
      return a;
    },

  },
  watch: {
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
    departmentSelectA: function (el) {
      if(el != ''){
        this.provinceSelectA = '';
        this.districtSelectA = '';

        // get_departamentos
        // get_provincias
        // get_distritos

        this.consumeService(apiRutas.get_provincias, 'provinceA', el.id);
        this.departmentInvalidA=false;
      }
    },
    provinceSelectA: function (el) {
      if(el != ''){
        this.districtSelectA = '';
        this.consumeService(apiRutas.get_distritos, 'districtA', el.id);
        this.provinceInvalidA=false;
      }
    },
    districtSelectA: function (el) {
      if(el != '') {
        this.districtInvalidA=false;
      }
    },
    departmentSelectB: function (el) {
      if(el != ''){
        this.provinceSelectB = '';
        this.districtSelectB = '';
        this.consumeService(apiRutas.get_provincias, 'provinceB', el.id);
        this.departmentInvalidB=false;
      }
    },
    provinceSelectB: function (el) {
      if(el != ''){
        this.districtSelectB = '';
        this.consumeService(apiRutas.get_distritos, 'districtB', el.id);
        this.provinceInvalidB=false;
      }
    },
    districtSelectB: function (el) {
      if(el != '') {
        this.districtInvalidB=false;
      }
    },
    // deliveryTime: function(el) {
    //   this.amountPayable = el.value
    // },
    userAddress: function(el) {
      if(el.length > 10) {
        this.searchLocation()
      }
    },
    userPhone: function(el) {
      if(el.length > 8) {
        //console.log(el.length)
        this.validUserPhone = true
      } else {
        this.validUserPhone = false
      }
    },
    clientPhone: function(el) {
      if(el.length > 8) {
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


    dim_ancho: function(el) {
      this.ajustar_tarifa_dale(2000);

    },
    dim_altura: function(el) {
      this.ajustar_tarifa_dale(2000);
    },
    dim_profundidad: function(el) {
      this.ajustar_tarifa_dale(2000);
    },
    cuantoPesa: function(el) {
      this.ajustar_tarifa_dale(2000);
    },
    // tiempo_entrega: function(el) {
    //   this.ajustar_tarifa_dale(100);
    // },
    valor_paquete: function(el) {
      this.ajustar_tarifa_dale(2000);
    },
    seguro_envio_check: function(el) {
      this.ajustar_tarifa_dale(100);
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
      this.drawerRight = true;
    },
    resetearCupon:function(){
      this.se_aplico_cupon = false;
      this.cupon_descuento='';
      this.promocion_id = -1;
      // alert(this.total_pagado_final);
      this.costo_total = parseFloat(this.costo_total) + parseFloat(this.descuentob);
      // alert(this.total_pagado_final);
      // alert(this.descuento);
      this.descuentob = 0;

    },
    aplicarCupon:function(){

    },
    formatearCosto:function(valor_raw){
      if(valor_raw=='--'){
        return '--';
      }

      var twoPlacedFloat = parseFloat(valor_raw).toFixed(2);
      return 's/. ' + twoPlacedFloat;
    },
    formatearCostoLimpio:function(valor_raw){
      if(valor_raw=='--'){
        return '--';
      }


      var twoPlacedFloat = parseFloat(valor_raw).toFixed(2);
      return twoPlacedFloat;
    },
    // sincronizar_tarjetas_r:function(data){
    //   var vm = this;
    //   alert("ya al");
    //   console.log("recibiendo SINCRONI");
    //   vm.addedCards = data;
    //
    //   console.log(data);
    //   console.log(vm.addedCards);
    //   vm.addedCards.forEach(function(el){
    //     el.semi_seleccionada=0;
    //     if(el.tarjeta_predeterminada==1){
    //       vm.cardSelected = el.tarjeta_id;
    //       vm.cardClickeada = el.tarjeta_id;
    //       el.tarjeta_seleccionada=1;
    //     }else{
    //       el.tarjeta_seleccionada=0;
    //     }
    //   });
    // },
    // tokenizar_tarjeta_cont:function(datoscard){
    //   console.log('a entrado regular pre');
    //   if(this.$store.getters.loadStateAdminPanel === 'regular'){
    //     console.log("a entrado regular");
    //     this.saveCardInApi(datoscard);
    //   }
    // },
    // saveCardInApi:function(dataCard){
    //   var vm = this;
    //
    //   if(dataCard.object=='error'){
    //     vm.errorAddCard = dataCard.user_message;
    //     vm.addCardBtnLoading = false;
    //     return false;
    //   }
    //
    //   var pro = localStorage.getItem("user_p_info");
    //   pro = JSON.parse(pro);
    //   var token = pro.token;
    //
    //
    //   var servicio_addcard = apiRutas.crearTarjeta+'?token='+token;
    //
    //   var q_token = dataCard.id;
    //
    //
    //
    //   axios({
    //     url:servicio_addcard,
    //     method:'post',
    //     data: {
    //       token_culqui:q_token
    //     },
    //     auth : {
    //       username: 'admin@pickapp.com',
    //       password: 'PickJanaq18',
    //     }
    //   })
    //   .then(function(response){
    //     vm.addCardBtnLoading = false;
    //     let res = response.data;
    //     console.log(res);
    //     if(res.tipo==1){
    //       //vm.addedCards.push({
    //       //  tarjeta_numero:dataCard.last_four,
    //       //  tarjeta_marca:dataCard.iin.card_brand,
    //       //  tarjeta_cardid:q_token,
    //       //  tarjeta_id:res.data,
    //       //  tarjeta_predeterminada:1
    //       //});
    //       vm.listarTarjetasApi('sincro');
    //       vm.showCardForm = 0;
    //       vm.cardSelected=res.data;
    //       vm.addCardResult.result = 'success';
    //       vm.addCardResult.message = 'Se ha ingresado la tarjeta';
    //
    //     }else if(res.tipo==3){
    //       vm.errorAddCard = res.mensajes[0];
    //       vm.addCardResult.result = 'error';
    //       vm.addCardResult.message = res.mensajes[0];
    //       //console.log(res.mensajes[0]);
    //     }else{
    //       //console.log("Error ingresando tarjeta");
    //       vm.errorAddCard = res.mensajes[0];
    //       vm.addCardResult.result = 'error';
    //       vm.addCardResult.message = res.mensajes[0];
    //       //console.log(res.mensajes[0]);
    //     }
    //
    //   }).catch(function (error) {
    //     console.log(error);
    //     vm.errorAddCard = "Error ingresando la tarjeta";
    //     vm.addCardBtnLoading = false;
    //   });
    //
    // },
    // listarTarjetasApi(src){
    //   var vm = this;
    //   var servicio_tarjetas = apiRutas.getTarjetaList+'/1/5';
    //   //var p_token = localStorage.getItem("p_token");
    //
    //
    //   var pro = localStorage.getItem("user_p_info");
    //   pro = JSON.parse(pro);
    //   var token = pro.token;
    //
    //   axios({
    //     url:servicio_tarjetas,
    //     method:'get',
    //     params: {
    //       token:token
    //     },
    //     auth : {
    //       username: 'admin@pickapp.com',
    //       password: 'PickJanaq18',
    //     }
    //   })
    //   .then(function(response){
    //     let res = response.data;
    //     //console.log('tarjetas');
    //     //console.log(res);
    //     if(res.tipo == 1){
    //       vm.addedCards = res.data;
    //       vm.addedCards.forEach(function(el){
    //         if(el.tarjeta_predeterminada==1){
    //           vm.cardSelected = el.tarjeta_id;
    //         }
    //       });
    //     }
    //     if(src=='sincro'){
    //       EventBus.$emit('sincronizar_tarjetas_m',vm.addedCards);
    //     }
    //
    //   }).catch(function (error) {
    //     console.log(error);
    //   });
    //
    //
    //
    // },
    checkStep1:function(){

      return this.districtSelectA != ''&& this.nombre_remitente && this.celular_remitente&&this.origen;
    },
    checkStep2:function(){
      return this.districtSelectB != ''&& this.nombre_destinatario && this.celular_destinatario&&this.destino;
    },
    checkStep3:function(){
      return this.cuantoPesa != '' &&
              this.dim_ancho != '' &&
              this.dim_profundidad != '' &&
              this.dim_altura != '' &&
              this.tiempo_entrega != '';
    },
    loadData:function(){
      this.consumeService(apiRutas.get_departamentos, 'departments');
      console.log("llega");
    },
    consumeService: function (urlService, container, value) {
      let vm = this;
      let fullUrl;
      // console.log(value)
      if(value != undefined) {
        fullUrl = urlService + '/' + value;
      } else {
        fullUrl = urlService;
      }


      axios({
        method:'get',
        url:fullUrl,
        params: {
          token:apiRutas.token_aux
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data
        // console.log(response)
        switch (container) {
          case 'departments':
            vm.departmentsListA = res.data;
            vm.departmentsListB = res.data;
            break;
          case 'provinceA':
            vm.provinceListA = res.data;
            break;
          case 'districtA':
            vm.districtListA = res.data;
            break;
          case 'provinceB':
            vm.provinceListB = res.data;
            break;
          case 'districtB':
            vm.districtListB = res.data;
            break;
        }
      })
      .catch(function (err){
        console.log(err)
      })
    },
    // selectPayMethod: function(el) {
    //   this.payMethodSelected = el
    // },
    // iconActive: function(el) {
    //   if(this.payMethodSelected == el) {
    //     return true
    //   } else {
    //     return false
    //   }
    // },
    // vaidMethodPay: function() {
    //   if( this.tarjeta_numero.length >= 16 &&
    //       this.monthCard.length < 3 &&
    //       this.yearCard.length == 4 &&
    //       this.cvvCard.length >= 3) {
    //         //console.log(this.tarjeta_numero.length)
    //         //console.log(this.monthCard.length)
    //         //console.log(this.yearCard.length)
    //         //console.log(this.cvvCard.length)
    //
    //         return false
    //   } else {
    //     return true
    //   }
    //
    // },
    isValidWhereIsPackage: function() {
      if( this.userAddress != '' &&
          this.userName != '' &&
          this.validUserPhone == true) {
            return true
          } else {
            return false
          }
    },
    isValidWhereWeDeliver: function() {
      if( this.clientAddress != '' &&
          this.clientName != '' &&
          this.validClientPhone) {
            return true
          } else {
            return false
          }
    },
    createReservation: function() {
      this.modalComplete = false
      this.$router.push({name: 'historial', params: { panel: 'regular' }})

    },
    geolocate: function () {
      if ("geolocation" in navigator) {
        /* geolocation is available */
        //console.log('si')
      } else {
        //console.log('no')
        /* geolocaiton IS NOT available */
      }
      //console.log('aqui!')
      navigator.geolocation.getCurrentPosition((position) => {
        this.currentLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        }
      })
    },
    searchLocation: function(value, dir) {
      console.log("search");
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

    },

    generarPedido:function(){
      this.pagarBtnLoading = true;
      this.errorGenerarPedido='';
      var vm = this;
      //console.log('generar pedido');
    //  console.log(vm.clientComments);
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      var usuario_email = pro.usuario_email;


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
      }





      var datacodigopedidos = this.$store.getters.loadStateCodigoPedidos;
      axios({
        method:'post',
        url:apiRutas.regular_crear+'?token='+token,
        data: {
          origen_calle:vm.origen,
          origen_ubigeo:vm.districtSelectA.ubigeo,
          origen_id:vm.districtSelectA.id,
          codigo_ciudad_origen:vm.districtSelectA.codigo_ciudad,
          origen_interior:vm.interior_remitente,
          origen_referencia:vm.observaciones_origen,
          origen_remitente:vm.nombre_remitente,
          origen_celular:vm.celular_remitente,
          destino_calle:vm.destino,
          destino_ubigeo:vm.districtSelectB.ubigeo,
          destino_id:vm.districtSelectB.id,
          codigo_ciudad_destino:vm.districtSelectB.codigo_ciudad,
          destino_interior:vm.interior_destinatario,
          destino_referencia:vm.observaciones_destinatario,
          destino_remitente:vm.nombre_destinatario,
          destino_celular:vm.celular_destinatario,
          ancho:vm.dim_ancho,
          altura:vm.dim_altura,
          profundidad:vm.dim_profundidad,
          peso:vm.cuantoPesa,
          tiempo:vm.tiempo_entrega,
          costo_total:vm.formatearCostoLimpio(vm.costo_total),
          cupon_descuento:vm.cupon_descuento,
          tarjeta_id:vm.cardSelected,
          destino_direccion_full:vm.departmentSelectB.name+','+vm.provinceSelectB.name+', '+vm.districtSelectB.name,
          origen_direccion_full:vm.departmentSelectA.name+','+vm.provinceSelectA.name+', '+vm.districtSelectA.name,




          destino_pais:vm.destino_pais,
          zona:vm.zona,
          distrito:vm.districtSelectB.name,
          provincia:vm.provinceSelectB.name,
          departamento:vm.departmentSelectB.name,
          peso_volumetrico:vm.peso_volumetrico,
          usuario_email,
          cupon_id:vm.cupon_id,
          promocion_id:vm.promocion_id,
          descuento:vm.descuentob,
          tiene_cupon:vm.tiene_cupon?1:0,



          regular_ruc:vm.facturacion_ruc,
          regular_razonsocial:vm.facturacion_razonsocial,
          emitir_factura:vm.checkboxFactura?1:0,
          update_rucrazonsocial,

          datacodigopedidos
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data;
        //console.log(res);
        if(res.tipo==1){
          vm.drawerRight = false;
          vm.modalComplete = true;
          if(response.data.updated_rucrazonsocial){
            var pro = vm.getLocalUser();
            pro.usuario_ruc = vm.facturacion_ruc;
            pro.usuario_razonsocial = vm.facturacion_razonsocial;
            vm.setLocalUser(pro);
          }
          vm.$store.commit('setStateCodigoPedidos', 2);
        }else{
          vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
          vm.reportarLog('registrar_pago',"Error durante pago - envio regular");
        }
        vm.pagarBtnLoading = false;

      }).catch(function (error) {
        console.log(error);
        vm.pagarBtnLoading = false;
        vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
        vm.reportarLog('registrar_pago',"Error consumo api - envio regular");
      });
    },
    setPlace(src) {
      console.log(src);

      if(src=='origen'){
        this.origen = document.getElementById("origenInput").value;
      }
      if(src=='destino'){
        this.destino = document.getElementById("destinoInput").value;
      }

    },
    ayuda_numero_remite:function(){

    },
    irAlPaso4:function(){
      this.consultarDescuentosPromos();
      this.e1 = 4;
    },
    consultarDescuentosPromos:function(){


      var sihubocalculodepromo = false;
      var dataPromociones = this.$store.getters.loadStatePromociones;
      //var cuanto = dataPromociones.promo_cuantos_usos_van['scharff-stop'];

      if(dataPromociones&&dataPromociones.hay_promo==1){
        var arrayPromos = dataPromociones.promo_servicios['envios-regulares'];

        if(arrayPromos && arrayPromos.length>0){

               //se va elegir el que tenga mayor prioridad
               var promo_item = null;
               var prioridad_aux = 1000;
               var promoArray_index = -1000;

               for(var i = 0;i<arrayPromos.length;i++){
                 if(arrayPromos[i].promocion_prioridad<prioridad_aux){
                   prioridad_aux = arrayPromos[i].promocion_prioridad;
                   promoArray_index = i;
                 }
               }
               promo_item = arrayPromos[promoArray_index]

               this.tiene_cupon = promo_item.tiene_cupon==1?true:false;


               //console.log("AQUIIIIIIIII+1111")
               console.log(promo_item.promocion_id)


            if(promo_item.promocion_id){
               this.promocion_id = promo_item.promocion_id;

               //this.soloPromocion = !this.tiene_cupon;
               sihubocalculodepromo = true;
               if(!this.tiene_cupon){
                  this.ajustar_tarifa(() => {
                   var descuento_aux = 0;
                   console.log("PromoTRANSACCIONES: "+promo_item.promocion_transacciones);
                   console.log("PromoUSOS: "+this.promo_cuantos_usos_van);

                   if(promo_item.promocion_descuento_tipo =='porcentaje'){
                     descuento_aux = this.costo_total*(promo_item.promocion_descuento/100);
                   }else if(promo_item.promocion_descuento_tipo =='flat'){
                     descuento_aux = promo_item.promocion_descuento;
                   }

                   if(promo_item.promocion_transacciones!=null){
                     if(this.promo_cuantos_usos_van>=promo_item.promocion_transacciones){

                       this.promocion_id = -1;
                       this.descuentob = 0;
                       descuento_aux = 0;
                     }
                   }

                   console.log('promo_item');
                   console.log(promo_item);
                   console.log(this.costo_total);
                   console.log(this.descuentob);
                   console.log(descuento_aux);
                   if(descuento_aux<=this.costo_total&&descuento_aux!=0){
                     this.descuentob = this.formatoCosto(descuento_aux);

                     //this.promocion_descuento = promo_item.promocion_descuento;
                     //this.tipo_descuento = promo_item.promocion_descuento_tipo;
                     this.costo_total = this.formatoCosto(this.costo_total - this.descuentob);
                     this.promocion_label = "Promoción("+promo_item.promocion_nombre+") ";
                   }else{
                     this.descuentob = 0;
                     this.promocion_label = "Promoción(error)";
                   }



                  });

               }else{
                 //this.ajustar_tarifa();
                 this.actualizarDelCupon();
               }
            }
        }
      }

      if(!sihubocalculodepromo){
        this.ajustar_tarifa();
      }



    },

    actualizarDelCupon:function(){
      this.ajustar_tarifa(()=>{

        if(this.datarescupon=='no-cupon'){
          this.descuentob = 0;
          this.promocion_label = '';
          this.cupon_id = this.datarescupon.cupon_id;
          this.promocion_id = -1;
          this.cupon_mensaje = 'Cupón incorrecto';
          setTimeout(()=>{
            this.cupon_mensaje = '';
          },3000);
        }else if(this.datarescupon=='limite-alcanzado'){
          this.descuentob = 0;
          this.promocion_label = '';
          this.cupon_id = this.datarescupon.cupon_id;
          this.promocion_id = -1;
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

          if(this.datarescupon.promocion_transacciones!=null){
            if(this.promo_cuantos_usos_van>=this.datarescupon.promocion_transacciones){

              this.promocion_id = -1;
              this.descuentob = 0;
              descuento_aux = 0;
            }
          }

          if(descuento_aux<=this.costo_total&&descuento_aux!=0){
            this.descuentob = this.formatoCosto(descuento_aux);
            //this.promocion_descuento = promo_item.promocion_descuento;
            //this.tipo_descuento = promo_item.promocion_descuento_tipo;
            this.costo_total = this.formatoCosto(this.costo_total - this.descuentob);
            this.promocion_label = this.datarescupon.promocion_nombre;
            this.cupon_id = this.datarescupon.cupon_id;
            this.promocion_id = this.datarescupon.promocion_id;
            this.se_aplico_cupon = true;
          }else{
            this.descuentob = 0;
            this.promocion_label = "Cupón(error)";
          }
        }
      });
    },


    irAlPaso3:function(){
      console.log('irAlPaso3');
      var vm = this;
      vm.tiempo_entrega = 10;
      vm.e1 = 3;
      vm.ajustar_tarifa_dale(1000);

      //this.btnIrPaso3Loading = true;
      //this.btnIrPaso3Notice = '';


    },
    ajustar_tarifa_dale:function (timewait) {

      //var millisecBeforeRedirect = 10000;
      console.log("AJUSTANDOOO-");
      var vm = this;
      if(vm.ajustandoTarifa){
        return false;
      }
      vm.ajustandoTarifa = true;

      window.clearTimeout(vm.tarifaTimeout);
      vm.tarifaTimeout = window.setTimeout(
        function(){
          console.log("ajustar_tarifa");
          vm.consultarDescuentosPromos();
        },timewait);
    },
    ajustar_tarifa:function(_callback){
      this.tarifaNotice='';
      this.tarifaAprobada = false;




      var vm = this;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      var vm = this;

      // var zona1_ar = ['Barranco','Bellavista','Breña','Callao','Carmen de la Legua','Jesus María','La Perla','La Punta','La Victoria','Lima','Lince','Magdalena del mar','Miraflores','Pueblo Libre','San Borja','San Isidro','San Luis','San Miguel','Santiago de Surco','Surquillo','La Molina'
      // ];
      //
      // var zona2_ar = ['Puente Piedra','Ancon','Santa Rosa','Ate','Chaclacayo','El Agustino','Santa Maria del Mar','Lurigancho','Santa Anita','Cieneguilla','San Martin de Porres','Comas ','Los Olivos','Carabayllo','Independencia','Villa el Salvador','San Juan de Miraflores','Chorrillos','Villa Maria del Triunfo ','San Juan de Lurigancho','Rimac','Ventanilla','Lurin','Pachacamac','Pucusana','Punta Hermosa','San Bartolo','Punta Negra'
      // ]
      //
      // var zona1_ar = zona1_ar.map(function (zona) {return zona.toLowerCase();});
      // var zona2_ar = zona2_ar.map(function (zona) {return zona.toLowerCase();});
      //
      // var zona=0;
      // if(zona1_ar.includes(this.districtSelectB.name.toLowerCase())){
      //   zona = 1;
      // };
      // if(zona2_ar.includes(this.districtSelectB.name.toLowerCase())){
      //   zona = 2;
      // };

      var temp_distrito_name = vm.districtSelectB.name.toLowerCase();
      var temp_provincia_name = vm.provinceSelectB.name.toLowerCase();
      var temp_departamento_name = vm.departmentSelectB.name.toLowerCase();
      if(typeof(temp_distrito_name)=='string'){
        temp_distrito_name = temp_distrito_name.toLowerCase()
      }

      axios({
        method:'get',
        url:apiRutas.regular_tarifa,
        params: {
          token:token,
          ancho:vm.dim_ancho,
          altura:vm.dim_altura,
          profundidad:vm.dim_profundidad,
          peso:vm.cuantoPesa,
          tiempo:vm.tiempo_entrega,
          destino_ubigeo:vm.districtSelectB.id,
          valor_paquete:vm.valor_paquete,
          seguro_envio_check:vm.seguro_envio_check,
          //zona,
          destino_distrito:temp_distrito_name,
          destino_provincia:temp_provincia_name,
          destino_departamento:temp_departamento_name,


          cupon:vm.cupon_descuento,
          promo_id:vm.promocion_id

        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      }).then(function(response){
        let res = response.data;

        if(res.tipo==1){
          vm.precio_igv = res.data.precio_igv;
          vm.precio_seguro = res.data.precio_seguro;
          vm.costo_base = res.data.precio;
          vm.costo_total = vm.costo_base + vm.precio_seguro + vm.precio_igv;
          console.log('vm.costo_total');
          console.log(vm.costo_total);
          console.log(vm.costo_total);
          console.log(vm.precio_seguro);
          //vm.descuento = res.data.descuento;
          vm.tarifaAprobada = true;
          console.log('res.casos_tiempo');
          console.log(res.casos_tiempo);
          vm.tiempos_disponibles = res.casos_tiempo;
          vm.tiempo_entrega = res.tiempo_elegido_i;
          vm.origen_ubigeo = res.data.origen_ubigeo;
          vm.destino_ubigeo = res.codigo_ubigeo_destino;
          vm.peso_volumetrico = res.peso_dimensional;
          vm.zona = res.zona;


          vm.datarescupon = response.data.data.cupon_comoes;
          vm.promo_cuantos_usos_van = response.data.data.promo_comoes;
          //alert(vm.promo_cuantos_usos_van);
          //aqui
          console.log('res.data.ambito');
          console.log(res.ambito);


          if(_callback!=null){
            _callback();
          }
        }else if(res.tipo==2){
          vm.costo_total = '--';
          vm.costo_base = '--';
          vm.descuento = '--';
          if(res.mensajes[0]=='no-zona'){
            vm.tarifaNotice = 'Error de zona';
          }else if(res.mensajes[0]=='sobrepeso'){
            vm.tarifaNotice = 'Este es un peso mayor';
          }else if(res.mensajes[0]=='error-tiempo'){
            vm.tarifaNotice = 'Tiempo incorrecto';
          }else if(res.mensajes[0]=='valor-sobrepasa'){
            vm.tarifaNotice = 'Para envios con valor mayor de <span>$/ 15000,</span> contactanos.';
          }else{
            vm.tarifaNotice = "Error calculando tarifa";
            console.log(res.mensajes[0]);
          }
          vm.tarifaAprobada = false;
        }

        vm.ajustandoTarifa = false;
        //vm.btnIrPaso3Loading = false;
      }).catch(function (error) {
        console.log(error);
        vm.ajustandoTarifa = false;
        vm.costo_total = '--';
        vm.costo_base = '--';
        vm.descuento = '--';
        //vm.btnIrPaso3Loading = false;
        //vm.btnIrPaso3Notice = 'No se pudo calcular el costo, intente nuevamente';
        vm.tarifaNotice = 'No se pudo calcular el costo, intente nuevamente';
      });

    },
    checkTarifaAprobada:function(){
      if(this.ajustandoTarifa){
        return false;
      }
      return this.tarifaAprobada;
    },
    cambiaTiempo_entrega:function(ind){
      if(this.tiempo_entrega!=ind){
          this.tiempo_entrega=ind;
          this.ajustar_tarifa_dale(1000);
      }
    }
  },
  components: { 'metodos-pagos':metodosPagos,Multiselect },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
.regular-block .multiselect {
  width: 100%;

}
@media screen and (max-width: 600px) {
  div.text-step-one>strong {
   margin-bottom: 3px;
   padding-top: 0px !important;
  }

  .min-width-step-two {
    padding: 1rem;
  }
  .regular-step1m3 .line-bottom_em {
    padding-bottom: 0 !important;
  }
  .mg-s {
    margin-top: 2rem !important;
  }

}
@media screen and (max-width: 740px) {
  .cuanto-mideb {
    text-align: left;
  }
  .pt-1 {
    span {
      width: 84px;
      display: inline-block;
    }
  }
  .denocontarconseguro {
    text-align: left !important;
    position: static !important;
    margin: 8px 16px;
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
.regular-step1m3 .line-bottom_em input.input-cupon{
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
.block-factura .input-factura input.facturacion_error {
    border-bottom: 1px solid red;
}

</style>
