import type { Commit } from 'vuex';
import { Brand, State } from '~assets/model'

const Brand = {
  namespaced: true,
  state: {
    brands: []
  },
  mutations: {
    setBrands(state: State, brands: Array<Brand>) {
      state.brands = brands
    }
  },
  actions: {
    setBrands({ commit } : { commit: Commit }, brands: Array<Brand>) {
      commit('setBrands', brands)
    }
  },
  getters: {},
}
export default Brand
