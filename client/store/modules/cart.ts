import type { Commit } from 'vuex';
import type { Cart } from '@/models'
import type { CART_STATE, CHANGE_CART_PAYLOAD } from '../types'
import axios from "@axios";

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
      let flag = true
      for(let i = 0; i < state.carts.length; i++) {
        if (state.carts[i].perfume_id == cart.perfume_id 
          && state.carts[i].price_id == cart.price_id) {
          state.carts[i].quantity += cart.quantity
          flag = false
        }
      }
      if (flag) state.carts.push(cart)
    },
    handleChanges(state: CART_STATE, payload: CHANGE_CART_PAYLOAD) {
      const { id, action, quantity } = payload
      for(let i = 0; i < state.carts.length; i++) {
        if (state.carts[i].id == id) {
          if (action == 'increase') state.carts[i].quantity += 1
          else if (action == 'reduce') state.carts[i].quantity -= 1
          else  state.carts[i].quantity = quantity as number
          break
        }
      }
    },
    handleDelete(state: CART_STATE, id: number) {
      state.carts = state.carts.filter((cart) => cart.id != id)
    }
    /*
    deleteQuantity(state: CART_STATE, cart: Cart) {
      //state.carts.push(cart)
    }, */
  },
  actions: {
    setCarts({ commit } : { commit: Commit }, carts: Array<Cart>) {
      commit('setCarts', carts)
    },
    addPerfume({ commit } : { commit: Commit }, cart: Cart) {
      commit('addPerfume', cart)
    },
    handleChanges({ commit } : { commit: Commit }, payload: CHANGE_CART_PAYLOAD) {
      commit('handleChanges', payload)
    },
    handleDelete({ commit } : { commit: Commit }, id: number) {
      commit('handleDelete', id)
    },
  },
  getters: {
    getNumberOfPerfume(state: CART_STATE) {
      return state.carts.reduce((total, currentValue) => {
        return total + currentValue.quantity
      }, 0)
    },
    getTotalMoney(state: CART_STATE) {
      return state.carts.reduce((total, currentValue) => {
        if (currentValue.unit_price)
          return total + (currentValue.quantity * currentValue.unit_price)
        else
          return total
      }, 0)
    }
  },
}
export default Cart
