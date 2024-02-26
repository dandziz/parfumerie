import type { PerfumeGender } from "~/enums";
import type { Image, Price } from ".";

export interface Perfume {
  id?: number;
  code: string;
  name: string;
  slug: string;
  gender: number;
  origin: string;
  description: string;
  product_information?: string;
  start_date?: Date;
  rate?: number;
  status: number | boolean;
  brand_id: number | string;
  supplier_id: number | string;
  brand_name?: string;
  supplier_name?: string;
  user_id?: number;
  updated_at?: Date;
  created_at?: Date;
  display_price?: string;
  avatar?: string;
  media?: Image[],
  price?: Price[]
}

export interface PerfumeForm
  extends Pick<
    Perfume,
    | "code"
    | "name"
    | "slug"
    | "gender"
    | "origin"
    | "description"
    | "status"
    | "brand_id"
    | "supplier_id"
    | "product_information"
  > {}
