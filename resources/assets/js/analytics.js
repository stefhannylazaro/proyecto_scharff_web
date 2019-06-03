import Vue from 'vue'
import VueAnalytics from 'vue-ua'
import router from './router'
// import VueRouter from 'vue-router'
// const router = new VueRouter({routes, mode, linkActiveClass})
// If you're using vue-router and want route integration, create your routes before enabling vue-ua.







console.log(process.env.NODE_ENV);

//analytics if not development




if(window.location.href.indexOf('holascharff') !== -1) {
  console.log(process.env.NODE_ENV);

  Vue.use(VueAnalytics, {
    appName: 'scharff',
    appVersion: '84',
    trackingId: 'UA-116143279-1',//produccion
    //trackingId: 'UA-116861434-1',//pruebasLocal
    vueRouter: router,
    trackPage:true
  })
  console.log("analytics cargado");

}else if(process.env.NODE_ENV=='development'||window.location.href.indexOf('localhost') !== -1) {

  Vue.use(VueAnalytics, {
    appName: 'scharff',
    appVersion: '84',
    trackingId: 'UA-116861434-1',//pruebasLocal
    vueRouter: router,
    debug: true,
    trackPage:true
  })
  console.log("analytics cargado dev");

}
