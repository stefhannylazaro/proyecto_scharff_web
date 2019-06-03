import { shallowMount } from '@vue/test-utils'
import Vue from 'vue'
import Vuex from 'vuex'
import VueScrollTo from 'vue-scrollto'
import Vuetify from 'vuetify/dist/vuetify.min.js'
import VeeValidate from 'vee-validate'
import FBSignInButton from 'vue-facebook-signin-button'

Vue.use(Vuex)
Vue.use(VeeValidate)
Vue.use(VueScrollTo)
Vue.use(Vuetify)

import cTerminos from '../../../resources/assets/js/components/cTerminos.vue'


describe('cTerminos', () => {
  // it('renders props.msg when passed', () => {
  //   const msg = 'new message'
  //   const wrapper = shallowMount(cTerminos, {
  //     propsData: { msg }
  //   })
  //   expect(wrapper.text()).toBe(msg)
  // })

  it('renders default message if not passed a prop', () => {
    const defaultMessage = 'Aceptar'
    const wrapper = shallowMount(cTerminos)

    const button = wrapper.find('#toggle-message')
    button.trigger('click')
    const MessageComponent = wrapper.find(Message)
    expect(MessageComponent.props()).toEqual({msg: 'message'})


    expect(wrapper.text()).toBe(defaultMessage)
  })
})
