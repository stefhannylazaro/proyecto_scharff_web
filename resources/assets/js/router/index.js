import Vue from 'vue'
import VueRouter from 'vue-router'
import { EventBus } from '../config/ebus.js'

// Paginas principales
import user from '../pages/UserView.vue'
import admin from '../pages/adminView.vue'

//Paginas dentro del User
import Home from '../pages/Home.vue'
import userStop from '../pages/User-Scharff-stop.vue'
import complaintsBook from '../pages/ComplaintsBook.vue'
import company from '../pages/Company.vue'
import express from '../pages/User-express.vue'
import club from '../pages/User-club.vue'
import domestica from '../pages/Domestica.vue'
import aduanas from '../pages/Aduanas.vue'
import almacenes from '../pages/Almacenes.vue'
import carga from '../pages/Carga.vue'
import distribucion from '../pages/Distribucion.vue'
import envioRegularP from '../pages/Envio-regular.vue'
import empresa from '../pages/Empresa.vue'
import paraTi from '../pages/ParaTi.vue'
import lab from '../pages/Lab.vue'
import UnirseScharffer from '../pages/UnirseScharffer.vue'
import TerminosYcondiciones from '../pages/TerminosYcondiciones.vue'
import PreguntasFrecuentes from '../pages/PreguntasFrecuentes.vue'
import Registro from '../pages/Registro.vue'

//Paginas dentro del admin
import adminHome from '../components/cAdminHome.vue'
import reservaLocker from '../components/cReservaLocker.vue'
import enviarPaquete from '../components/cEnviarPaquete.vue'
import historial from '../components/cHistorial.vue'
import envioRegular from '../components/cEnvioRegular.vue'

import goAndBuy from '../components/cGoAndBuy.vue'

import gobuy from '../pages/Go-buy.vue'
import noFound from '../pages/NoFound.vue'


import axios from 'axios'



//Paginas dentro de la AdminView
Vue.use(VueRouter);




const router = new VueRouter({
  routes: [

    {
      path: '/',
      component: user,
      children: [
        {
          path: '',
          component: Home,
          name: 'home',
        },
        {
          path: '/scharff-stop',
          name: 'scharff-stop',
          component: userStop
        },
        {
          path: '/libro-reclamaciones',
          name: 'complaints-book',
          component: complaintsBook
        },
        {
          path: '/empresas',
          name: 'scharff-company',
          component: company
        },
        {
          path: '/express',
          name: 'scharff-express',
          component: express
        },
        {
          path: '/scharff-club',
          name: 'scharff-club',
          component: club
        },
        {
          path: '/carga-domestica',
          name: 'domestica',
          component: domestica
        },
        {
          path: '/aduanas',
          name: 'aduanas',
          component: aduanas
        },
        {
          path: '/almacen',
          name: 'almacenes',
          component: almacenes
        },
        {
          path: '/carga-internacional',
          name: 'carga',
          component: carga
        },
        {
          path: '/distribucion',
          name: 'distribucion',
          component: distribucion
        },
        {
          path: '/envio-regular',
          name: 'envioRegularP',
          component: envioRegularP
        },
        {

          path: '/empresa',
          name: 'empresa',
          component: empresa
        },
        {
          path: '/para-ti',
          name: 'para-ti',
          component: paraTi
        },
        {
          path: '/lab',
          name: 'lab',
          component: lab
        },
        {
          path: '/unirse-scharffer',
          name: 'unirseScharffer',
          component: UnirseScharffer
        },
        {
          path: '/terminos-y-condiciones',
          name: 'terminos-y-condiciones',
          component: TerminosYcondiciones
        },
        {
          path: '/preguntas-frecuentes',
          name: 'preguntas-frecuentes',
          component: PreguntasFrecuentes
        },
        {
          path: '/registro',
          name: 'registro',
          component: Home
          //component: Registro
        },
        {
          path: '/go-buy',
          name: 'go-buy',
          component: gobuy
        },
        {
          path: '/cargainternacional',
          redirect: { name: 'carga' }
        },
        {
          path: '/cargadomestica',
          redirect: { name: 'domestica' }
        },

      ]
    },
    { path: '/ScharffClub', redirect: '/scharff-club' },
    { path: '/scharffclub', redirect: '/scharff-club' },
    {
      path: '/admin',
      component: admin,
      children: [
        {
          path: '/admin',
          component: adminHome,
          name: 'admin',
        },
        {
          path: '/admin/reservar-locker',
          name: 'locker',
          component: reservaLocker
        },
        {
          path: '/admin/enviar-paquete',
          name: 'package',
          component: enviarPaquete
        },
        {
          path: '/admin/historial/:panel?/:item_id?',
          name: 'historial',
          component: historial
        },
        {
          path: '/admin/envio-regular',
          name: 'envio-regular',
          //component: env==='production'?adminHome:envioRegular
          component: envioRegular
        },
        {
          path: '/admin/go-buy/:panel?/:item_id?',
          name: 'go-buy-admin',
          //component: env==='production'?adminHome:goAndBuy
          component: goAndBuy
        }
      ]
    },
    {
      path: '*',
      name: 'no-found',
      component: user,
      children: [
        {
          path: '',
          component: noFound,
          name: 'no-found'
        },
      ]
    },

  ],
  mode: 'history'
})

if(typeof Array.prototype.includes !== 'function'){
  Array.prototype.includes = function(obj) {
    var i = this.length;
    while (i--) {
        if (this[i] === obj) {
            return true;
        }
    }
    return false;
  }
}



export default router
