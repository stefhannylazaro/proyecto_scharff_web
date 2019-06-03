<template>
    <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhUnirse: isValid}" class="cover-height  bg-smoke">
        <div style="position:inline-block; width:100%;max-width:1440px">
          <v-layout style="height:100%;" row wrap class="wrapper-cover bg-slotTree"
          :style="'background-image:url(images/inner-a/img_principal_unirse.png)'">
            <v-flex xs12 sm9 md8 lg6 lg6 class="cover-col col-unirse__text">
              <div class="coverThreeLeft">
                <div class="container-left d-flex justify-center ">
                  <p class="send send-medium mb-3 mt-3 black--text">¡Tu también puedes ser <br>un Scharffer!</p>
                  <h2 class="mb-2">Postula</h2>
                  <h3 class="black--weight mb-4">REGISTRA TUS DATOS</h3>
                  <v-layout class="unirse-scharffer__form" wrap="false" row justify-space-between>
                    <v-flex xs12 sm6 md6 lg5>
                      <label for="" class="unirse-scharffer__form--label" >
                        Nombre:
                      </label>
                      <v-text-field
                        name="input-1-3"
                        single-line
                        v-model="nombre"
                        :error="errores.indexOf('nombre') >= 0"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6 lg5>
                      <label for="" class="unirse-scharffer__form--label">
                        Apellidos:
                      </label>
                      <v-text-field
                        name="input-1-3"
                        single-line
                          v-model="apellidos"
                          :error="errores.indexOf('apellidos') >= 0"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6 lg5>
                      <label for="" class="unirse-scharffer__form--label">
                        Correo:
                      </label>
                      <v-text-field
                        name="input-1-3"
                        single-line
                          v-model="correo"
                          :error="errores.indexOf('correo') >= 0"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6 lg5>
                      <label for="" class="unirse-scharffer__form--label">
                        Celular:
                      </label>
                      <v-text-field
                        name="input-1-3"
                        single-line
                          v-model="celular"
                          :error="errores.indexOf('celular') >= 0"
                      ></v-text-field>
                    </v-flex>


                    <v-flex xs12 sm7 md7 lg7 lg7 class="mb-5">
                      <h3 class="pt-3 pb-3" :class="{'red--text':errores.indexOf('tipo_scharffer') >= 0}">Selecciona el tipo de scharffer que deseas ser:</h3>
                      <div class="tipos-scharffer">


                        <div class="tipos-scharffer__item" :class="{'active':tipo_scharffer==1}" @click="tipo_scharffer=1">
                          <picture>
                            <img src="/images/iconos/icon_biciclete.png" alt="">
                          </picture>
                          <span>Bicicleta</span>
                        </div>

                        <div class="tipos-scharffer__item" :class="{'active':tipo_scharffer==2}" @click="tipo_scharffer=2">
                          <picture>
                            <img src="/images/iconos/icon_moto.png" alt="">
                          </picture>
                          <span>Moto</span>
                        </div>

                        <div class="tipos-scharffer__item" :class="{'active':tipo_scharffer==3}" @click="tipo_scharffer=3">
                          <picture>
                            <img src="/images/iconos/icon_auto.png" alt="">
                          </picture>
                          <span>Auto</span>
                        </div>

                        <!-- <div class="tipos-scharffer__item" :class="{'active':tipo_scharffer=='taxi'}" @click="tipo_scharffer='taxi'">
                          <picture>
                            <img src="/images/iconos/icon_taxi.png" alt="">
                          </picture>
                          <span>Taxi</span>
                        </div> -->
                      </div>
                    </v-flex>

                    <!-- new -->
                    <v-flex xs12 sm4 md4 lg3 class="mb-5 unirse-scharffer__form--date">
                      <label for="" class="unirse-scharffer__form--label">
                        Fecha de Nacimiento:
                      </label>
                      <v-menu
                        ref="menu2"
                        :close-on-content-click="false"
                        v-model="menu"
                        :nudge-right="40"
                        :return-value.sync="date"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        min-width="290px"
                        locale="es-es"
                        style="max-width: 100%;"
                      >
                        <v-text-field
                          slot="activator"
                          v-model="fecha_nacimiento"
                          readonly
                          :error="errores.indexOf('fecha_nacimiento') >= 0"
                          name="input-1-3"
                        ></v-text-field>
                        <v-date-picker
                          v-model="fecha_nacimiento"
                          :max="new Date().toISOString().substr(0, 10)"
                          min="1950-01-01"
                          @change="save"
                          locale="es-es"
                        >
                        </v-date-picker>
                        <v-btn flat color="primary" @click="menu = false">Aceptar</v-btn>
                      </v-menu>
                    </v-flex>
                    <!-- new -->

                    <!-- <v-flex xs12 sm4 md4 lg3 class="mb-5 unirse-scharffer__form--date ">
                      <label for="" class="unirse-scharffer__form--label">
                        Fecha de Nacimiento:
                      </label>

                      <template>
                        <v-layout row wrap>
                          <v-menu
                            ref="menu"
                            :close-on-content-click="false"
                            v-model="menu"
                            :nudge-right="40"
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                            locale="es-es"
                            style="max-width: 100%;"
                          >
                            <v-text-field
                              slot="activator"
                              v-model="fecha_nacimiento"
                              single-line
                              readonly
                              :error="errores.indexOf('fecha_nacimiento') >= 0"
                              name="input-1-3"
                            ></v-text-field>
                            <v-date-picker
                              ref="picker"
                              v-model="fecha_nacimiento"
                              :max="new Date().toISOString().substr(0, 10)"
                              min="1950-01-01"
                              @change="save"
                              locale="es-es"
                            >
                            </v-date-picker>
                            <v-btn flat color="primary"  @click="menu = false">Aceptar</v-btn>
                          </v-menu>
                        </v-layout>
                      </template>


                    </v-flex> -->

                    <div class="unirse-checkbox" style="display:flex">
              				<v-checkbox
              					class=" input-create check pt-0 "
              					label=""
              					v-model="certifico_datos"
              					required
                        tabindex="8"
              				></v-checkbox>
              				<span class="pt-1 pl-1" @click="certifico_datos=!certifico_datos;postular_alarma=''">Certifico que los datos declarados son verdaderos y de caracter personal.</span>
              			</div>

                    <div v-if="postular_alarma!=''&&errores.length>0" style="width: 100%;" class="text-center pt-3"><small class="red--text">{{postular_alarma}}</small></div>
                    <div v-if="postular_success!=''&&errores.length==0" style="width: 100%;" class="text-center pt-3"><span class="" style="font-family: Carnas-Bold;">{{postular_success}}</span></div>
                    <div class="py-3 justify-center flex--block">

                      <v-btn round large color="bg-pink" :disabled="postularScharfferLoading" :loading="postularScharfferLoading" class="cover white--text elevation-0" @click.native="postularScharffer">QUIERO SER SCHARFFER</v-btn>
                    </div>
                  </v-layout>


                </div>
              </div>
            </v-flex>
          </v-layout>




        </div>
      </v-flex>

    </v-layout>


  </v-container>
</v-app>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      windowHeight: null,
      windowWidth: null,
      isValid:false,
      isTrue: false,
      coverResposive: false,

      tipo_scharffer:null,
      certifico_datos:false,
      nombre:'',
      apellidos:'',
      correo:'',
      celular:'',
      postular_alarma:'',
      fecha_nacimiento:null,
      postularScharfferLoading:false,
      date: null,
      menu: false,
      modal: false,
      menu2: false,
      errores:[],
      postular_success:''
    }
  },
  mounted () {
    var self = this;



    //alert(this.$parent.getConfigHome);
    this.getWindowHeight();
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
      // setTimeout(function(){
      //   self.nombre = ' ';
      // },3000);
    });

  },
  watch: {
    // menu (val) {
    //   console.log(val);
    //   val && this.$nextTick(() => (this.$refs.picker.activePicker = 'YEAR'))
    // },
    nombre: function (el) {
      if(el){
          var index = this.errores.indexOf('nombre');
          if (index > -1) {
            this.errores.splice(index, 1);

          }
      }
    },
    apellidos: function (el) {
      if(el){
        var index = this.errores.indexOf('apellidos');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }

    },
    correo: function (el) {
      if(el){
        var index = this.errores.indexOf('correo');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }
    },
    celular: function (el) {
      if(el){
        var index = this.errores.indexOf('celular');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }
    },
    tipo_scharffer: function (el) {

      if(el){
        var index = this.errores.indexOf('tipo_scharffer');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }
    },


    fecha_nacimiento: function (el) {
      console.log("un cambio");
      if(el){
        console.log("un cambio positivo");
        var index = this.errores.indexOf('fecha_nacimiento');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }
    },
    certifico_datos: function (el) {

      if(el){
        var index = this.errores.indexOf('certifico_datos');
        if (index > -1) {
          this.errores.splice(index, 1);
        }
      }
    },


    // windowHeight: function (el) {
    //   if(el > 700){
    //     this.isValid = true
    //   } else {
    //     this.isValid = false
    //   }
    //   if(this.windowWidth< el){
    //     this.isValid = false
    //   }
    //   // if()
    // },
    windowWidth: function (el){
      if(el < 600){
        this.isValid = true
        this.coverResposive = true
        // this.isTrue = true
      } else {
        this.isValid = true
        this.coverResposive = false
        // this.isTrue = false
      }
    }
  },
  methods: {
    save (date) {
      this.$refs.menu.save(date)
    },
    getWindowHeight(event) {
      // console.log(event)
      this.windowHeight = document.documentElement.clientHeight
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowHeight)
    },
    postularScharffer:function(){
      this.postularScharfferLoading = true;
      var vm = this;
      vm.postular_alarma = '';
      vm.postular_success = '';

      if(!vm.certifico_datos){
          vm.errores.push('certifico_datos');
          vm.postular_alarma = 'Debes aceptar la condición.'
          this.postularScharfferLoading = false;
          return false;
      }
      var pasa = true



      if(vm.nombre==''){
        vm.errores.push('nombre');
        console.log('Nombre');
        pasa=false;
      }

      if(vm.apellidos==''){
        vm.errores.push('apellidos');
        console.log('appe');
        pasa=false;
      }

      if(vm.correo==''){
        vm.errores.push('correo');
        console.log('correo');
        pasa=false;
      }

      if(vm.celular==''){
        vm.errores.push('celular');
        console.log('celular');
        pasa=false;
      }


      if(vm.tipo_scharffer==''||vm.tipo_scharffer==null){
        vm.errores.push('tipo_scharffer');
        console.log('celular');
        pasa=false;
      }


      if(vm.fecha_nacimiento==''||vm.fecha_nacimiento==null){
        vm.errores.push('fecha_nacimiento');
        console.log('celular');
        pasa=false;
      }


      if(!pasa){
        vm.postularScharfferLoading = false;
        vm.postular_alarma = 'Debes completar los datos solicitados.'
        return false;
      }


      let opciones = this.$store.getters.loadStateOpciones.opciones;
      let postulantes_email_admin = '';
      opciones.forEach((el)=>{
        if(el.slug==='postulantes_email_admin'){
          postulantes_email_admin = el.valor;
        }
      });

      console.log(postulantes_email_admin);
      console.log('postulantes_email_admin');

      var tipo_scharfer_label = '';
      if(vm.tipo_scharffer==1){
        tipo_scharfer_label = 'Bicicleta';
      }else if(vm.tipo_scharffer==2){
        tipo_scharfer_label = 'Moto';
      }else if(vm.tipo_scharffer==3){
        tipo_scharfer_label = 'Auto';
      }


      axios.post('/api/postulante/create', {
        nombre:vm.nombre,
        apellidos:vm.apellidos,
        correo:vm.correo,
        celular:vm.celular,
        fecha_nacimiento:vm.fecha_nacimiento,
        tipo_scharfer:vm.tipo_scharffer,
        staff:postulantes_email_admin,
        tipo_scharfer_label
      })
      .then(function(response){
        let res = response.data;

  			if(res) {
  			  if(res.status==1){
            setTimeout(function(){
              vm.postular_success='Tu postulación se guardó con exito.';
              vm.postularScharfferLoading = false;
              vm.tipo_scharffer=null;
              vm.nombre='';
              vm.apellidos='';
              vm.correo='';
              vm.celular='';
              vm.fecha_nacimiento=null;
            },2000)

          }else{
            vm.postularScharfferLoading = false;
          }
  			}

      }).catch(function (error) {
        console.log(error);
        vm.postularScharfferLoading = false;
      });


    }

  },
  components: {
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.minSize{
  height: 30rem;
  width: 100%;
}
.gi-20 h4{
  font-size: 23px;
  margin-bottom: 23px;
    font-family: Carnas-Bold;
    font-weight: 500;
}
.gi-20 strong{
     font-family: Carnas-Bold;
     font-weight: 500;
}
.gi-20 span{
color:#ff535a;
}
.widthTen{
  width: 30rem;
}
@media screen and (max-width: 559px){
  .widthTen{
    width: 23rem!important
  }
}


.solo-mobil{
  display:none;
}
@media screen and (max-width: 600px){
  .no-mobil{
    display:none;
  }
  .solo-mobil{
    display:inline-flex;
  }
  .coverThreeLeft {
    padding-bottom: 100px;
  }
}

.hVhSections{
  min-height: calc(100vh - 21px);
}
.hVhUnirse{
  min-height: calc(100vh - 79px);
}

.bg-slotTree .cover-col{
  justify-content: flex-start;
  padding-left: 109px;
}
@media screen and (max-width: 1100px){
  .bg-slotTree .cover-col {
      padding-left: 30px;
  }
  .bg-slotTree .cover-col p br{
    display: none;
  }
  .bg-slotTree .cover-col .send {
      font-size: 2.4rem;
  }
}
@media screen and (max-width: 900px){
  .bg-slotTree .cover-col {
      padding-left: 0;
  }
}



.send-medium {
    font-size: 2.4rem;
}

.black--weight{
font-family: Carnas-Black;
    font-weight: 400;
}
.unirse-scharffer__form input{
  background-color: #ffffff;
border: 1px solid #bdbdbd;
padding-left:11px;
}
.unirse-scharffer__form .error--text input {
    border: 1px solid #ff0000;
}
.input-group.input-group--error .input-group__details:before {
    background-color: transparent;
}
.unirse-scharffer__form .input-group--text-field label {
    left: 11px;
    top: 8px;
}
.unirse-scharffer__form .unirse-scharffer__form--label{
font-family: 'Carnas-Medium';
font-size: 14px;
}
.unirse-scharffer__form .input-group{
  padding-top: 7px;
  margin-bottom: 8px;
}
.tipos-scharffer__item picture{
  border: 1px solid transparent;
      padding: 8px;
      max-width: 100%;
      width: 68px;
      text-align: center;
      border-radius: 11px;
      margin: auto;
      margin-bottom: 4px;
      min-height: 56px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
      cursor: pointer;
}
.tipos-scharffer__item picture img{
  opacity: .5;
}
.tipos-scharffer__item:hover picture{
  border: 1px solid #ffa7ab;
}
.tipos-scharffer__item.active picture{
  border: 1px solid #ff535a;
}
.tipos-scharffer__item.active picture img{
  opacity: 1;
}
.tipos-scharffer__item{
    text-align: center;
}
.tipos-scharffer {
    display: flex;
    flex: 1 1 auto;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    justify-content: space-between;
    width: 276px;
}

.unirse-scharffer__form h3 {
    font-family: 'Carnas-Medium';
    font-weight: 300;
}
.tipos-scharffer__item span{
  font-family: 'Carnas-Light';
  font-weight: 300;
}

.unirse-scharffer__form .flex--block{
  display: flex;
      width: 100%;
}
@media screen and (max-width: 900px){
  .cover-col.col-unirse__text{
    padding-left: 30px;
  }
}
@media screen and (max-width: 1264px){
  .unirse-scharffer__form .lg5{
    padding-right: 30px;
  }
  .unirse-scharffer__form--date{
    padding-right: 30px;
  }
}
.hVhUnirse .bg-slotTree{
  background-position: right center;
  min-height:300px;
}
@media screen and (max-width: 750px){

  .cover-col.col-unirse__text {
      padding-right: 30px;
  }
  .unirse-scharffer__form .lg5{
    padding-right: 0;
  }
  .unirse-scharffer__form--date{
    padding-right: 0;
  }
  .hVhUnirse .bg-slotTree{
    background-position: left;
  }
  .hVhUnirse .col-unirse__text{
    flex-basis: 100%;
    max-width: 100%;
  }
  .hVhUnirse .layout.unirse-scharffer__form{
    width: 100%;
    padding-right: 0;
}
}
.col-unirse__text{
  padding-top:45px;
  padding-bottom:45px;
}
@media screen and (max-width: 600px){
  .col-unirse__text{
    padding-top:0;
    padding-bottom:0;
  }
  .menu__content.menuable__content__active{
    max-width: 290px !important;
    right: 0;
    left: 0 !important;
    margin: 0 auto;
  }
}

.unirse-checkbox span{
font-family: 'Carnas-Bold';
font-size: 16px;
cursor: pointer;
}
.unirse-scharffer__form--date .dialog--active.dialog--persistent {
    background: #fff;
    width: 290px;
    text-align: center;
}
.unirse-scharffer__form--date .menu__content {
    position: absolute;
    top: 40px !important;
    background: #fff;
    left: 0 !important;
  }
  .unirse-scharffer__form--date  .picker__title.primary {
    background: #ff535a;
    height: 82px;
    padding: 14px;
}
.unirse-scharffer__form--date  .picker--date__table .btn.btn--active {
    color: #000;
}
.unirse-scharffer__form--date .picker--date__title-year {
    font-size: 31px;
}
.unirse-scharffer__form--date .picker--date__title-date {
    font-size: 21px;
}
.menu__content.menuable__content__active{
  background: #fff;
}
.menuable__content__active .btn--flat.primary--text{
  float:right;
}

</style>
