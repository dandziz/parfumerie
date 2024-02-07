import { useStore } from "vuex";

function importUserInformation(): void {
  const user = getUserInformation()
  const store = useStore()
  if (user) {
    store.dispatch("user/setUser", user)
  }
}

export { useStore, importUserInformation }
