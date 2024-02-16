import type { PerfumeGender } from "~/enums";

export interface Perfume {
  id: number;
  code: string;
  name: string;
  slug: string;
  gender: PerfumeGender | string;
  origin: string;
  description: string;
  product_information: string;
  start_date: Date;
  rate: number;
  status: number;
  brand_id: number | string;
  supplier_id: number | string;
  brand_name: string;
  supplier_name: string;
  user_id: number;
  updated_at: Date;
  created_at: Date;
}
