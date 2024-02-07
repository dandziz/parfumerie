import type { Commit } from 'vuex';
import type { User } from '@/models'
import type { USER_STATE } from '@types'

const initUser: User = {
  id: -1,
  name: '',
  email: '',
  phone_number: '',
  description: '',
  role: '',
}

const User = {
  namespaced: true,
  state: {
    user: {...initUser}
  },
  mutations: {
    setUser(state: USER_STATE, user: User) {
      state.user = user
    },
    logout(state: USER_STATE) {
      state.user = {...initUser}
    },
  },
  actions: {
    setUser({ commit } : { commit: Commit }, user: User) {
      commit('setUser', user)
    },
    logout({ commit } : { commit: Commit }) {
      commit('logout')
    },
  },
  getters: {},
}
export default User
