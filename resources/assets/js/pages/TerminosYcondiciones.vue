<template>
    <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhUnirse: isValid}" class="cover-height  bg-smoke">
        <div style="position:inline-block; width:100%;max-width:1440px">
          <v-layout style="height:100%;background:none" row wrap class="wrapper-cover "
          >



            <v-flex xs12 sm12 md12 lg12 lg12 class=" col-unirse__text e_1531154083">
              <div class="">
                <div class="  justify-center ">
                  <p class="bold send-medium mb-3 mt-3 black--text black--weight text-center el_1531152339" v-text="terminos_titulo">TERMINOS Y CONDICIONES DEL SITIO WEB</p>
                  <v-layout class="terminos_pagec" wrap="false" row justify-space-between>
                    <div class="" v-html="terminos_terminos">

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
import terminos from '../components/cTerminos'
export default {
  data () {
    return {
      isValid:false,
      windowHeight: null,
      windowWidth: null,
      terminos_titulo:'',
      terminos_terminos:''
    }
  },
  mounted () {
    var self = this;
    this.get_terminos();
    //alert(this.$parent.getConfigHome);
    this.getWindowHeight();
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
      setTimeout(function(){
        self.nombre = ' ';
      },3000);
    });

  },
  methods: {
    getWindowHeight(event) {
      // console.log(event)
      this.windowHeight = document.documentElement.clientHeight
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowHeight)
    },
    get_terminos:function(){

      var vm = this;
      vm.modalTerminos = true;
      axios({
        method:'get',
        url:'/ajax/terminos',
        params: {
        }
      })
  		.then(function(response){
        let res = response.data;
        console.log(res);
        vm.terminos_titulo = res[0].titulo;
        vm.terminos_terminos = res[0].descripcion;

  		}).catch(function (error) {
        console.log(error);
      });

    },


  },
  components: {
    terminos
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
}
@media screen and (max-width: 1100px){

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
}
.unirse-checkbox span{
  font-family: 'Carnas-Bold';
  font-size: 16px;
  cursor: pointer;
}
.el_1531152339 {
  font-family: Carnas-Bold;
  font-size: 1.8rem;
}
.e_1531154083 strong u {
  font-weight: 400;
  font-family: Carnas-Bold;
}
.terminos_pagec span{
  font-family: Carnas-Extra-Light !important;
}
.terminos_pagec *{
  background:transparent !important;
}
.terminos_pagec {
    padding: 0 40px;
    margin-bottom: 30px;
    ul{
      margin-bottom: 20px;
    }
    u {
        margin-bottom: 9px;
        display: inline-block;
    }
}
</style>
