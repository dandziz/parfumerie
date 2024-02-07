export const isUserLoggedIn = () => !!(localStorage.getItem('user') && localStorage.getItem('access_token'))
