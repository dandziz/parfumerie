import { createStore } from 'vuex'
import Brand from './modules/brand'
import User from './modules/user'

const store = createStore({
  state () {},
  mutations: {},
  modules: {
    brand: Brand,
    user: User
  }
})

export default store;
