import ability from '@/configs/casl'
import { UserRole } from '~/enums'
import { isUserLoggedIn } from '~/utils/utils'

export default defineNuxtRouteMiddleware((to, from) => {
  const authRequired = ['/login', '/register'].includes(to.path)
  const auth = getNameRoute(to.name as string)
  const isLoggedIn = isUserLoggedIn()
  let userData = getUserInformation()
  if (auth != -1) {
    const listOfAuth = auth as string[][]
    let check = false
    for(let item of listOfAuth) {
      if (ability.can(item[1], item[0])) {
        check = true
      }
    }
    if (!check) {
      if (!isLoggedIn)
        return navigateTo('/login')
      else
        return navigateTo('/')
    }
  }
  if (authRequired && isLoggedIn && userData && userData.role == UserRole.USER)
    return navigateTo('/')
})
