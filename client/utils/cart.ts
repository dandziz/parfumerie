import type { Perfume, Cart } from "~/models";
import { PerfumeGenderName } from "~/enums";
import AxiosRepository from "~/httpRequest/AxiosRepository";
const axios = new AxiosRepository()

export function convertPerfumeName(perfume: Perfume, capacity: string): string {
  return perfume.name + ' - ' + PerfumeGenderName[perfume.gender] + ' / ' + perfume.origin + ' / ' + capacity
}

export async function addPerfumeIntoCart(value: Cart): Promise<boolean | Cart> {
  try {
    const response = await axios.post<Cart, Cart>('user/carts', value)
    return response.data.data
  } catch (e) {
    return false
  }
}
