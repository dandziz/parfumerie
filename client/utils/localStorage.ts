import type { UserAbility, Actions } from "~/configs/casl/AppAbility";
import type { User } from "~/models";

export function setToken(token: string) {
  localStorage.setItem('access_token', JSON.stringify(token))
}

export function getToken(): string | undefined {
  const token = localStorage.getItem("access_token");
  return token ? JSON.parse(token) : undefined
}

export function setUserAbility(userAbility: string): void {
  localStorage.setItem('user_ability', userAbility)
}

export function getUserAbility(): UserAbility[] | undefined {
  const userAbility = localStorage.getItem('user_ability')
  const ability = userAbility ? JSON.parse(userAbility) : undefined
  if (ability) {
    const arr: UserAbility[] = []
    ability[1].forEach((element: Actions) => {
      arr.push({ action: element, subject: ability[0] })
    });
    return arr
  }
  return undefined
}

export function setUserInformation(user: string): void {
  localStorage.setItem('user', user)
}

export function setNumberOfAddresses(number: string): void {
  localStorage.setItem('address', number)
}

export function getUserInformation(): User | undefined {
  const user = localStorage.getItem('user')
  return user ? JSON.parse(user) : undefined
}

export function getNumberOfAddresses(): number | undefined {
  const address = localStorage.getItem('address')
  return address ? JSON.parse(address) : undefined
}

export function logout(): void {
  localStorage.removeItem('user');
  localStorage.removeItem('user_ability');
  localStorage.removeItem('access_token');
  localStorage.removeItem('address');
}
