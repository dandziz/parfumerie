import type { Cart } from "~/models"

export type CART_STATE = {
  carts: Cart[]
}

export type CHANGE_CART_PAYLOAD = {
  id: number,
  action: string,
  quantity?: number,
}
