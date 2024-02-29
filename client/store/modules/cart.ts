import type { Commit } from 'vuex';
import type { Cart } from '@/models'
import type { CART_STATE } from '../types'

const Cart = {
  namespaced: true,
  state: {
    carts: []
  },
  mutations: {
    setCarts(state: CART_STATE, carts: Array<Cart>) {
      state.carts = carts
    },
    addPerfume(state: CART_STATE, cart: Cart) {
      state.carts.push(cart)
    },
    addQuantity(state: CART_STATE, id: number, quantity: number) {
      //state.carts.push(cart)
    },
    deleteQuantity(state: CART_STATE, cart: Cart) {
      //state.carts.push(cart)
    },
  },
  actions: {
    setCarts({ commit } : { commit: Commit }, carts: Array<Cart>) {
      commit('setCarts', carts)
    },
    addPerfume({ commit } : { commit: Commit }, cart: Cart) {
      commit('addPerfume', cart)
    }
  },
  getters: {},
}
export default Cart
