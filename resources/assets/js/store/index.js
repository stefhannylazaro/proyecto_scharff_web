import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state: {
		stateLogin: false,
		stateRegister: false,
		stateTracking: false,
		stateParent:-1,
		stateHeaderFixed:false,
		statefLatLng:{lat:0,lng:0},
		stateAdminPanel:'',
		stateAddedCards:[],
		stateTarjetaPredeterminada:null,
		stateAddCardBtnLoading:null,
		stateShowCardForm:false,
		stateAddCardQueFue:['',''],
		stateSucursales:[],
		stateOpciones:{},
		statePromociones:null,
		stateDataUsuario: false,
		stateLoadInfoTarjeta: true,
		stateCodigoPedidos:null
	},
	mutations: {
		setStateLogin (state, value) {
			state.stateLogin = value
		},
		setStateRegister (state, value) {
			console.log('aqui'+value)
			state.stateRegister = value
		},
		setStateTracking (state, value) {
			state.stateTracking = value
		},
		setStateParent (state, value) {
			state.stateParent = value
		},
		setStateHeaderFixed (state, value) {
			state.stateHeaderFixed = value
		},
		setStatefLatLng (state, value) {
			state.statefLatLng = value
		},
		setStateAdminPanel (state, value) {
			state.stateAdminPanel = value
		},
		setStateAddedCards (state, value) {
			state.stateAddedCards = value
		},
		addStateAddedCards (state, value) {
			state.stateAddedCards.push(value);
		},
		setStateTarjetaPredeterminada (state, value) {
			state.stateTarjetaPredeterminada = value;
		},
		setStateAddCardBtnLoading (state, value) {
			state.stateAddCardBtnLoading = value;
		},
		setStateShowCardForm (state, value) {
			state.stateShowCardForm = value;
		},
		setStateAddCardQueFue (state, value) {
			state.stateAddCardQueFue = value;
		},
		setStateSucursales (state, value) {
			state.stateSucursales = value;
		},
		setStateOpciones (state, value) {
			state.stateOpciones = value;
		},
		setStatePromociones (state, value) {
			state.statePromociones = value;
		},
		setStateDataUsuario (state, value) {
      state.stateDataUsuario = value;
    },
		setStateLoadInfoTarjeta (state, value) {
      state.stateLoadInfoTarjeta = value;
    },
		setStateCodigoPedidos (state, value) {
      state.stateCodigoPedidos = value;
    }
	},
	actions: {},
	getters: {
		loadStateLogin ( state ) {
			return state.stateLogin
		},
		loadStateRegister ( state ) {
			return state.stateRegister
		},
		loadStateTracking ( state ) {
			return state.stateTracking
		},
		loadStateParent ( state ) {
			return state.stateParent
		},
		loadStateHeaderFixed ( state ) {
			return state.stateHeaderFixed
		},
		loadStatefLatLng ( state ) {
			return state.statefLatLng
		}
		,loadStateAdminPanel ( state ) {
			return state.stateAdminPanel
		}
		,loadStateAddedCards ( state ) {
			return state.stateAddedCards
		}
		,loadStateTarjetaPredeterminada ( state ) {
			return state.stateTarjetaPredeterminada
		}
		,loadStateAddCardBtnLoading ( state ) {
			return state.stateAddCardBtnLoading
		}
		,loadStateShowCardForm ( state ) {
			return state.stateShowCardForm
		}
		,loadStateAddCardQueFue ( state ) {
			return state.stateAddCardQueFue
		}
		,loadStateSucursales ( state ) {
			return state.stateSucursales
		}
		,loadStateOpciones ( state ) {
			return state.stateOpciones
		}
		,loadStatePromociones ( state ) {
			return state.statePromociones
		}
		,loadStateDataUsuario ( state ) {
        return state.stateDataUsuario
    }
		,loadStateLoadInfoTarjeta ( state ) {
        return state.stateLoadInfoTarjeta
    }
		,loadStateCodigoPedidos ( state ) {
        return state.stateCodigoPedidos
    }
	}
})
