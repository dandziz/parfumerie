import { useStore } from "vuex";

function importUserInformation(): boolean {
  const user = getUserInformation()
  const address = getNumberOfAddresses()
  const store = useStore()
  let flag = false
  if (user) {
    store.dispatch("user/setUser", user)
    flag = true
  }
  if (address) {
    store.dispatch("user/setNumberOfAddresses", address)
  }
  return flag
}

export { useStore, importUserInformation }
