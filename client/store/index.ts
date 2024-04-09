import { createStore } from 'vuex'
import Brand from './modules/brand'
import User from './modules/user'
import Cart from './modules/cart';

const store = createStore({
  state () {},
  mutations: {},
  modules: {
    brand: Brand,
    user: User,
    cart: Cart
  }
})

export default store;
