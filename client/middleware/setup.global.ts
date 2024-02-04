import ability from '@/configs/casl'

export default defineNuxtRouteMiddleware((to, from) => {
  const auth = getNameRoute(to.name as string)
  if (auth != -1 ) {
    const roleAndPermission = auth as string[]
    if (!ability.can(roleAndPermission[1], roleAndPermission[0])) {
      return navigateTo('/login')
    }
  }
})
