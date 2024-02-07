import type { Commit } from 'vuex';
import type { Brand } from '@/models'
import type { BRAND_STATE } from '@types'

const Brand = {
  namespaced: true,
  state: {
    brands: []
  },
  mutations: {
    setBrands(state: BRAND_STATE, brands: Array<Brand>) {
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
