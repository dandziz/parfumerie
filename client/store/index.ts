import { createStore } from 'vuex'
import Brand from './modules/brand'

const store = createStore({
  state () {},
  mutations: {},
  modules: {
    brand: Brand
  }
})

export default store;
