export interface Cart {
  id?: number,
  name: string,
  unit_price?: number,
  quantity: number,
  user_id?: number,
  perfume_id: number,
  price_id: number,
  created_at?: Date,
  updated_at?: Date,
  img_link?: string,
  slug?: string,
}
