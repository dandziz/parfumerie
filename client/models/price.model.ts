
export interface Price {
  id?: number;
  perfume_id?: number;
  capacity: string;
  quantity: boolean;
  import_price: number | string;
  price: number | string;
  updated_at?: Date;
  created_at?: Date;
  deleted_at?: Date;
}
