<template>
  <div>
    <div id="clup-main-image">
      <div class="gi-4" style="background:url('images/club/img_scharff club.png');">
        <h2>¡BIENVENIDO!</h2>
        <h4>DESCUBRE LA EXPERIENCIA SCHARFF A TRAVÉS DE ESTE CLUB EXCLUSIVO</h4>
        <p>PRÓXIMAMENTE</p>
      </div><!-- /.gi-4 -->
      <a href="#" class="icon-position-center" v-scroll-to="'#gi-5'"><i aria-hidden="true" class="material-icons icon icon--large">keyboard_arrow_down</i></a>
    </div>
     <div id="gi-5">
        <h2>CONOCE TUS BENEFICIOS</h2>
        <div class="gi-6">
          <div>
            <img src="images/club/eventos.png" alt="" />
            <strong>EVENTOS</strong>
            <span>ÚNICOS</span>
          </div>
          <div>
            <img src="images/club/workshops.png" alt="" />
            <strong>WORKSHOPS</strong>
            <span>PARA TU EQUIPO</span>
          </div>
          <div>
            <img src="images/club/actividades.png" alt="" />
            <strong>ACTIVIDADES</strong>
            <span>EXCLUSIVAS</span>
          </div>
        </div><!-- /.gi-6 -->
    </div><!-- /.gi-5 -->
    <div class="gi-7">
      <p>MUY PRONTO SABRÁS DÓNDE Y CUÁNDO</p>
    </div><!-- /.gi-5 -->
  </div>



</template>

<script>
export default {

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
#clup-main-image {
  background: #131314;
  background-size:cover;
    position: relative;
}
#clup-main-image *{
  color: #d9d6d6;
position: relative;
}
#clup-main-image .icon-position-center{
  position: absolute;
}
.gi-4 {
  text-align: center;
  padding: 218px 50px 150px;
  position: relative;
  font-family: Carnas-Extra-Light;
}
.gi-4 h2{
font-size: 55px;
  margin-bottom: 19px;
}
.gi-4 h4{
  font-size: 17px;
  margin-bottom: 54px;
}
.gi-4 p{
  font-size: 23px;
}
.icon-position-center {
  margin-left: -18px;
}
#gi-5 {
  font-family: Carnas-Extra-Light;
  color: #d9d6d6;
  background: #000000;
  padding: 50px;
}
#gi-5 strong{

}
#gi-5 h2{
  text-align: center;
  font-size: 29px;
}
.gi-6 {
  margin-top: -121px;
  display: flex;
  align-items :center;
}
.gi-6>div{
  width:33%
}
.gi-6 strong,
.gi-6 span{
  display:block;
  font-size:28px;
  display:block;
  padding-left: 39px;
}
.gi-6 span{
  font-size:20px;
}
.gi-6 img{
  margin-bottom: -126px;
  max-width:100%;
  transition:opacity .2s;
  width:100%;
}
.gi-7 p{
  text-align: center;
  font-size: 19px;
  font-family: Carnas-Extra-Light;
  color: #d9d6d6;
}
.gi-7 {
  background: black;
  padding: 74px 50px 101px;
}
.scharff-club +.sub-menu-principal .items-menu {
  background-color: #000!important;
  border-color: #000!important;
  box-shadow: 3px 1px 2px rgba(128, 128, 128, 0.19);
}
.scharff-club +.sub-menu-principal .item-menu span{
  color:#fff;
}
.scharff-club +.sub-menu-principal .item-menu img{
 -webkit-filter: invert(1);
   filter: invert(1);
  }
  .scharff-club +.sub-menu-principal .item-menu.menu--cotizador span{
    color: #000;
  }



@media screen and (max-width: 900px){
  .gi-4 {
    padding: 180px 50px 150px;
  }
  .gi-6 strong, .gi-6 span {
    font-size: 21px;
  }
  .gi-6 span {
    font-size: 16px;
  }
  .gi-6 {
    margin-top: -52px;
  }
}
@media screen and (max-width: 830px){
  .gi-6 {
    flex-flow: column wrap;
  }
  .gi-6 > div {
    width: 300px;
    max-width: 100%;
      margin-top: -9px;
  }
  .gi-6 {
    margin-top: -19px;
  }
  .gi-6 strong, .gi-6 span {
    text-align: center;
    padding-left:0;
  }
}
@media screen and (max-width: 690px){
  .gi-4 {
    padding: 119px 50px 89px;
  }
}
@media screen and (max-width: 530px){
.gi-4 h2 {
  font-size: 31px;
}
#gi-5 h2 {
  font-size: 25px;
}
  }
</style>
