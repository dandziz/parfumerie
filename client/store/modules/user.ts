import type { Commit } from 'vuex';
import type { User } from '@/models'
import type { USER_STATE } from '../types'

const initUser: User = {
  id: -1,
  name: '',
  email: '',
  phone_number: '',
  description: '',
  role: '',
  default_address: '',
}

const User = {
  namespaced: true,
  state: {
    user: {...initUser},
    numberOfAddresses: 0,
  },
  mutations: {
    setUser(state: USER_STATE, user: User) {
      state.user = user
    },
    updateDefaultAddress(state: USER_STATE, address: string) {
      state.user.default_address = address
    },
    setNumberOfAddresses(state: USER_STATE, count: number) {
      state.numberOfAddresses = count
    },
    addAddress(state: USER_STATE) {
      state.numberOfAddresses += 1
      setNumberOfAddresses(JSON.stringify(state.numberOfAddresses))
    },
    deleteAddress(state: USER_STATE) {
      state.numberOfAddresses -= 1
      setNumberOfAddresses(JSON.stringify(state.numberOfAddresses))
    },
    logout(state: USER_STATE) {
      state.user = {...initUser}
    },
  },
  actions: {
    setUser({ commit } : { commit: Commit }, user: User) {
      commit('setUser', user)
    },
    updateDefaultAddress({ commit } : { commit: Commit }, address: string) {
      commit('updateDefaultAddress', address)
    },
    setNumberOfAddresses({ commit } : { commit: Commit }, count: number) {
      commit('setNumberOfAddresses', count)
    },
    addAddress({ commit } : { commit: Commit }) {
      commit('addAddress')
    },
    deleteAddress({ commit } : { commit: Commit }) {
      commit('deleteAddress')
    },
    logout({ commit } : { commit: Commit }) {
      commit('logout')
    },
  },
  getters: {},
}
export default User
