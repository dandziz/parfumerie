import ability from '@/configs/casl'
import { UserRole } from '~/enums'
import { isUserLoggedIn } from '~/utils/utils'

export default defineNuxtRouteMiddleware((to, from) => {
  const authRequired = ['/login', '/register'].includes(to.path)
  const auth = getNameRoute(to.name as string)
  const isLoggedIn = isUserLoggedIn()
  let userData = getUserInformation()
  if (auth != -1) {
    const roleAndPermission = auth as string[]
    if (!ability.can(roleAndPermission[1], roleAndPermission[0])) {
      if (!isLoggedIn)
        return navigateTo('/login')
      else
        return navigateTo('/')
    }
  }
  if (authRequired && isLoggedIn && userData && userData.role == UserRole.ADMIN)
    return navigateTo('/admin')
  if (authRequired && isLoggedIn && userData && userData.role == UserRole.USER)
    return navigateTo('/')
})
