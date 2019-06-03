<template>
    <v-app>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 :class="{hVhUnirse: isValid}" class="bg-smoke" style="padding-top: 12px;">
        <div style="position:inline-block; width:100%;max-width:1440px;margin: auto;">
          <v-layout row wrap class="wrapper-cover bg-slotTree el_1531158870"
          style="background-image: url('images/mano-paquete.png');">

            <v-flex xs12 sm12 md12 lg12 lg12 class="cover-col col-unirse__text e_1531154083">
              <div class="coverThreeLeft">
                <div class="container-left d-flex justify-center ">
                  <h2 class="send send-medium  mt-3 black--text">Resuelve <br>tus dudas!</h2>
                  <p class="bold send-medium mb-3 mt-1 black--text black--weight el_1531156457">Preguntas frecuentes</p>
                  <v-layout class="unirse-scharffer__form" wrap="false" row justify-space-between>

                  </v-layout>

                </div>
              </div>



            </v-flex>
          </v-layout>
          <v-layout row wrap class="el_1531159219 mt-2" v-if="blockes_faq_loaded" >

            <v-flex xs4 v-for="(bloque,ind) in blockes_faq" :key="ind">
              <div class="bloque_preguntas-w">
                <div class="bloque_preguntas">
                  <img class="bloque_preguntas-img" :src="bloque.icon">
                  <h4 v-text="bloque.categoria"></h4>
                  <div class="bloque_preguntas-preguntas" ss-container>
                    <div class="bloque_preguntas-preguntas-div" v-for="(pregunta,indd) in bloque.preguntas" :key="indd">
                      <h5 @click="abrePregunta(ind+'-'+indd)" :class="{'active':ind+'-'+indd==pregunta_abierta}"><i class="material-icons icon">keyboard_arrow_down</i>{{pregunta.pregunta}}</h5>

                      <div class="bloque_pregunta-respuesta" v-text="pregunta.respuesta">

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </v-flex>
          </v-layout>


          <v-layout row wrap class="el_1531159219 el_1531159219b mt-2" v-else>

            <v-flex xs4 v-for="(indn,aaa) in 3" :key="indn">
              <div class="bloque_preguntas-w">
                <div class="bloque_preguntas-loader-w animated-background">


                  <div class="shadow_mask_1531941579">
                    <div class="svg-w">
                      <svg viewbox="0 0 300 50" width="100%">
                        <defs>
                          <mask id="mask" x="0" y="0" width="90" height="50">
                            <rect x="0" y="0" width="300" height="140" fill="#fea"></rect>
                            <circle cx="75" cy="70" r="40"></circle>
                          </mask>
                        </defs>
                        <rect x="0" y="0" width="300" height="150" mask="url(#mask)" fill="#f6f6f6" fill-opacity="1"></rect>
                      </svg>
                    </div>
                  </div>
                  <div class="shadow_1531941580"></div>
                  <div class="shadow_1531941581"></div>
                  <div class="shadow_1531941582"></div>
                  <div class="shadow_1531941583"></div>
                  <div class="shadow_1531941584"></div>
                  <div class="shadow_1531941585"></div>
                  <div class="shadow_1531941586"></div>
                  <div class="shadow_1531941587"></div>
                  <div class="shadow_1531941588"></div>
                  <div class="shadow_1531941589"></div>

                  <div class="shadow_1531941590"></div>
                  <div class="shadow_1531941591"></div>
                  <div class="shadow_1531941592"></div>
                  <div class="shadow_1531941593"></div>
                  <div class="shadow_1531941594"></div>
                  <div class="shadow_1531941595"></div>
                  <div class="shadow_1531941596"></div>
                  <div class="shadow_1531941597"></div>
                  <div class="shadow_1531941598"></div>
                  <div class="shadow_1531941599"></div>

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
      terminos_terminos:'',

      blockes_faq:[
  //       {
  //         categoria:'Contacto y postulaciones',
  //         icon:'/images/icon-faq1.png',
  //         preguntas:[
  //           {
  //             pregunta:'¿Qué articulos puedo envíar por scharff expres?',
  //             respuesta:'Puedes enviar toda clase de articulos que cumplan con estas características:\
  // - Valor menor a S/. 500\
  // - Su peso no supero los 6 Kg.\
  // - Sus medias sean aproximadamente: 40 x 40 x 40 cm.',
  //           },
  //           {
  //             pregunta:'¿Qué articulos puedo envíar por scharff expres?',
  //             respuesta:'Puedes enviar toda clase de articulos que cumplan con estas características:\
  //           - Valor menor a S/. 500\
  //           - Su peso no supero los 6 Kg.\
  //           - Sus medias sean aproximadamente: 40 x 40 x 40 cm.',
  //           }
  //         ]
  //       },
  //
  //       {
  //         categoria:'Contacto y postulaciones',
  //         icon:'/images/icon-faq1.png',
  //         preguntas:[
  //           {
  //             pregunta:'¿Qué articulos puedo envíar por scharff expres?',
  //             respuesta:'Puedes enviar toda clase de articulos que cumplan con estas características:\
  // - Valor menor a S/. 500\
  // - Su peso no supero los 6 Kg.\
  // - Sus medias sean aproximadamente: 40 x 40 x 40 cm.',
  //           }
  //         ]
  //       }
      ],
      blockes_faq_loaded:false,
      pregunta_abierta:null


    }
  },
  mounted () {
    var self = this;
    this.get_faqs();
    //alert(this.$parent.getConfigHome);
    this.getWindowHeight();
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowHeight);
      setTimeout(function(){
        self.nombre = ' ';
      },3000);
    });




    ///setTimeout(function(){

    ///},3000)










  },
  methods: {
    getWindowHeight(event) {
      // console.log(event)
      this.windowHeight = document.documentElement.clientHeight
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowHeight)
    },
    get_faqs:function(){
      var ar = [];
      var catOp = {};

      var vm = this;
      // setTimeout(function(){
      //     vm.runScrollScript();
      // },3000)





      vm.modalTerminos = true;
      axios({
        method:'get',
        url:'/api/faq/index',
        params: {}
      })
  		.then(function(response){
        let res = response.data;
        //console.log(res);
        let faqs = res.faqs;
        let cats = res.cats;
        faqs.forEach(function(el){

          catOp = {};
          catOp.categoria = cats[el.categoria].categoria;
          catOp.icon = cats[el.categoria].icono;

          catOp.preguntas = [];
          catOp.preguntas.push({
            pregunta:el.pregunta,
            respuesta:el.respuesta
          })

          ar.push(catOp);
        });


        var output = [];

        ar.forEach(function(value) {
          var existing = output.filter(function(v, i) {
            return v.categoria == value.categoria;
          });
          if (existing.length) {
            var existingIndex = output.indexOf(existing[0]);
            output[existingIndex].preguntas = output[existingIndex].preguntas.concat(value.preguntas);
          } else {
            if (typeof value.preguntas == 'string')
              value.preguntas = [value.preguntas];
            output.push(value);
          }
        });
        vm.blockes_faq = output;
        vm.blockes_faq_loaded = true;
        // setTimeout(function(){
        //   vm.blockes_faq_loaded = true;
        // },2000)
        vm.$nextTick(function() {
          vm.runScrollScript();
        });


  		}).catch(function (error) {
        console.log(error);
      });

    },
    procesarArray(){

    },
    abrePregunta:function(ele_nid){
      if(this.pregunta_abierta==ele_nid){
        this.pregunta_abierta=null;
      }else{
        this.pregunta_abierta = ele_nid;
      }


    },
    runScrollScript:function(){

      (function(n, t) {
          function u(n) {
              //console.log('n');
              //console.log(n);
              //console.log(n.hasOwnProperty("data-simple-scrollbar") );
              var aa = new SimpleScrollbar(n);
              //console.log(aa);
              n.hasOwnProperty("data-simple-scrollbar") || Object.defineProperty(n, "data-simple-scrollbar", aa)
          }

          function e(n, i) {
              function f(n) {
                  var t = n.pageY - u;
                  u = n.pageY;
                  r(function() {
                      i.el.scrollTop += t / i.scrollRatio
                  })
              }

              function e() {
                  n.classList.remove("ss-grabbed");
                  t.body.classList.remove("ss-grabbed");
                  t.removeEventListener("mousemove", f);
                  t.removeEventListener("mouseup", e)
              }
              var u;
              n.addEventListener("mousedown", function(i) {
                  return u = i.pageY, n.classList.add("ss-grabbed"), t.body.classList.add("ss-grabbed"), t.addEventListener("mousemove", f), t.addEventListener("mouseup", e), !1
              })
          }

          function i(n) {
              for (this.target = n, this.bar = '<div class="ss-scroll">', this.wrapper = t.createElement("div"), this.wrapper.setAttribute("class", "ss-wrapper"), this.el = t.createElement("div"), this.el.setAttribute("class", "ss-content"), this.wrapper.appendChild(this.el); this.target.firstChild;) this.el.appendChild(this.target.firstChild);
              this.target.appendChild(this.wrapper);
              this.target.insertAdjacentHTML("beforeend", this.bar);
              this.bar = this.target.lastChild;
              e(this.bar, this);
              this.moveBar();
              this.el.addEventListener("scroll", this.moveBar.bind(this));
              this.el.addEventListener("mouseenter", this.moveBar.bind(this));
              this.target.classList.add("ss-container")
          }

          function f() {
              for (var i = t.querySelectorAll("*[ss-container]"), n = 0; n < i.length; n++) u(i[n])
          }
          var r = n.requestAnimationFrame || n.setImmediate || function(n) {
              return setTimeout(n, 0)
          };
          i.prototype = {
              moveBar: function() {
                  var t = this.el.scrollHeight,
                      i = this.el.clientHeight,
                      n = this;
                  this.scrollRatio = i / t;
                  r(function() {
                      n.bar.style.cssText = "height:" + i / t * 100 + "%; top:" + n.el.scrollTop / t * 100 + "%;right:-" + (n.target.clientWidth - n.bar.clientWidth) + "px;"
                  })
              }
          };
          if (  document.readyState === "complete"
             || document.readyState === "loaded"
             || document.readyState === "interactive") {
               i.initEl = u;
               i.initAll = f;
               n.SimpleScrollbar = i
               f();
               //console.log("uno");
          }else{
            t.addEventListener("DOMContentLoaded", f);
            i.initEl = u;
            i.initAll = f;
            n.SimpleScrollbar = i
                //console.log("dos");
                //console.log(document.readyState);
          }



      })(window, document)
    }


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
.widthTen{
  width: 30rem;
}
@media screen and (max-width: 559px){
  .widthTen{
    width: 23rem!important
  }
}
.bloque_preguntas {
  background: #fff;
  padding: 21px 32px 68px;

}
.bloque_preguntas-preguntas{
  height: 272px;
  overflow-y: hidden;
}
.bloque_preguntas-w {
    padding: 21px;
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
.e_1531154083 .send {
    font-family: Carnas-Bold;
    line-height: 1.3;
    margin-bottom: 5px;
  }
  .el_1531156457 {
    font-family: Carnas-medium;
    font-size: 1.8rem;
}
.el_1531158870{
    height: 100%;
    background-position: right center;
    padding-left: 40px;
    background-size: auto;
    background-color: #fff;
}
.el_1531159219{

}
.bloque_preguntas-img {
    margin: auto;
    display: block;
    width: 51px;
    margin-bottom: 20px;
    margin-top: 10px;
}

.bloque_preguntas h4 {
    font-size: 20px;
    color: #ff535a;
    text-transform: uppercase;
    font-weight: 500;
    font-family: Carnas-Regular;
    margin-bottom: 16px;
    text-align: center;
}
.bloque_preguntas-preguntas h5{
    font-family: Carnas-Regular;
    font-size: 17px;
    font-weight: 300;
    cursor:pointer;
        color: #404040;
}
.bloque_preguntas-preguntas h5.active{

}
.bloque_preguntas-preguntas h5 i.material-icons{
  color: #ff535a;
}
.bloque_preguntas-preguntas h5 {
    font-family: Carnas-Regular;
    font-size: 17px;
    font-weight: 300;
    position: relative;
    padding-left: 35px;
    line-height: 1.3;
}
.bloque_preguntas-preguntas h5 i.material-icons {
  color: #ff535a;
  position: absolute;
  left: 0;
  font-size: 28px;
  top: -3px;
  transition: all .2s;
}
.bloque_preguntas-preguntas-div {
    margin-bottom: 18px;
}
.bloque_pregunta-respuesta {
    padding-left: 35px;
    padding-top: 5px;
    display: none;
    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 1s; /* Firefox < 16 */
        -ms-animation: fadein 1s; /* Internet Explorer */
         -o-animation: fadein 1s; /* Opera < 11.1 */
            animation: fadein 1s;
}
@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.bloque_preguntas-preguntas h5.active+.bloque_pregunta-respuesta{
  display: block;
}
.e_1531154083 {
    padding-top: 79px;
    padding-bottom: 65px;
}
.bloque_pregunta-respuesta {
    margin-bottom: 14px;
    color: #656565;
}
.el_1531159219{
    margin-bottom: 60px;
    margin-right: -20px;
    margin-left: -20px;
}
.bloque_preguntas-preguntas h5.active{
          color: #000;
}
.bloque_preguntas-preguntas h5.active i{
  -webkit-transform: rotate(-180deg);
    -moz-transform: rotate(-180deg);
    -o-transform: rotate(-180deg);
    -ms-transform: rotate(-180deg);
    transform: rotate(-180deg);
    color:black;
}
.bloque_preguntas-preguntas:before {
    content: '';
    height: 94%;
    position: absolute;
    right: 2px;
    top: 0;
    width: 0;
    border-left: 1px solid #cecece;
}
.bloque_preguntas-preguntas {
position:relative;
}




@media screen and (max-width: 1140px){
  .bloque_preguntas-w {
      padding: 21px 10px;
  }
  .bloque_preguntas {
    padding: 21px 20px 46px;
  }
  .bloque_preguntas h4 {
    font-size: 17px;
  }
  .bloque_preguntas-preguntas h5 {
    font-size: 15px;
  }
  .el_1531158870 {
      background-position: left;
  }
}




@media screen and (max-width: 1001px){

  .el_1531159219 .flex.xs4 {
      flex-basis: 50%;
      max-width: 50%;
  }
  .bloque_preguntas {
      background: #fff;
      padding: 21px 20px 46px;
      width: 389px;
      max-width: 100%;
      margin: auto;
  }
}
@media screen and (max-width: 728px){
  .el_1531159219 .flex.xs4 {
      flex-basis: 100%;
      max-width: 100%;
  }
  .e_1531154083 .coverThreeLeft {
      padding-bottom: 0px;
      padding-top: 0;
  }
  .bloque_preguntas-preguntas {
    height: auto;
    max-height: 272px;
  }

}





.ss-wrapper {
    overflow : hidden;
    height   : 100%;
    position : relative;
    z-index  : 1;
    max-width: 100%;
    float: left;
}

.ss-content {
    height          : 100%;
    width           : 100%;
    padding         : 0 32px 0 0;
    position        : relative;
    right           : -18px;
    overflow        : auto;
    -moz-box-sizing : border-box;
    box-sizing      : border-box;
}

.ss-scroll {
  position: relative;
  background: #ff535a;
  width: 6px;
  border-radius: 11px;
  top: 0;
  z-index: 1;
  cursor: pointer;
  opacity: 1;
  -webkit-transition: opacity 0.25s linear;
  transition: opacity 0.25s linear;
  margin-bottom: 0 !important;
}

.ss-container:hover .ss-scroll {
  opacity: 1;
}

.ss-grabbed {
     user-select: none;
     -o-user-select: none;
     -moz-user-select: none;
     -khtml-user-select: none;
     -webkit-user-select: none;
}
.ss-scroll[style*="100"] {
    display:none;
}
.bloque_preguntas-loader-w > div {
    position: absolute;
    background: #f6f6f6;
}
.shadow_1531941580 {
  width: 100%;
height: 8px;
}
.shadow_1531941581 {
  top: 3px;
      background: #f6f6f6 !important;
      height: 116px;
      width: 36%;
}
.shadow_1531941582 {
  top: 29px;
  background: #f6f6f6 !important;
  height: 76px;
  width: 43%;
  right: 0;
}
.shadow_1531941582 {
  top: 6px;
  background: #f6f6f6 !important;
  height: 102px;
  width: 37%;
}
.shadow_1531941583 {
  top: 129px;
  background: #f6f6f6 !important;
  height: 15px;
  width: 100%;
}
.shadow_1531941584 {
  top: 104px;
  background: #f6f6f6 !important;
  height: 36px;
  width: 155px;
}
.shadow_1531941585 {
  top: 104px;
  background: #f6f6f6 !important;
  height: 36px;
  width: 153px;
  right: 0;
}
.shadow_1531941586 {
  top: 128px;
      background: #f6f6f6 !important;
      height: 16px;
      width: 100%;
}
.shadow_1531941587 {
  top: 140px;
  background: #f6f6f6 !important;
  height: 323px;
  width: 10%;
}
.bloque_preguntas-loader-w.animated-background {
  height: 470px;
}
.shadow_1531941588 {
  top: 141px;
  background: #f6f6f6 !important;
  height: 323px;
  width: 10%;
  right: 0;
}
.shadow_1531941589 {
  top: 169px;
  background: #f6f6f6 !important;
  height: 26px;
  width: 100%;
}
.shadow_1531941590 {
  top: 220px;
  background: #f6f6f6 !important;
  height: 26px;
  width: 100%;
}
.shadow_1531941591 {
  top: 272px;
  background: #f6f6f6 !important;
  height: 26px;
  width: 100%;
}
.shadow_1531941592 {
  top: 323px;
  background: #f6f6f6 !important;
  height: 26px;
  width: 100%;
}
.shadow_1531941593 {
  top: 373px;
  background: #f6f6f6 !important;
  height: 26px;
  width: 100%;
}
.shadow_1531941594 {
  top: 422px;
  background: #f6f6f6 !important;
  height: 55px;
  width: 100%;
}
.shadow_mask_1531941579 {
    z-index: 1;
    width: 100%;
}
.svg-w {
    margin: auto;
    width: 150px;
    height: 140px;
    padding-top: 0px;
}
.bloque_preguntas-loader-w .shadow_mask_1531941579{
  background: transparent;
}
.shadow_mask_1531941579 path{
  transition:fill .5s;
  fill:#fea;
}

@media screen and (max-width: 1100px){
  .shadow_1531941584,.shadow_1531941585 {
      width: 36%;
  }
}

@media screen and (max-width: 1001px){

  .el_1531159219b>div:nth-child(3){
    display: none;
  }
}
@media screen and (max-width: 728px){
  .el_1531159219b .flex.xs4 {

      max-width: 499px;
      margin: auto;
  }
  .el_1531159219b>div:nth-child(2){
    display: none;
  }

}
</style>
