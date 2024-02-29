import { useStore } from "vuex";

function importUserInformation(): void {
  const user = getUserInformation()
  const address = getNumberOfAddresses()
  const store = useStore()
  if (user) {
    store.dispatch("user/setUser", user)
  }
  if (address) {
    store.dispatch("user/setNumberOfAddresses", address)
  }
}

export { useStore, importUserInformation }
