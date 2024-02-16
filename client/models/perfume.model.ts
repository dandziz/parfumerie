import type { PerfumeGender } from "~/enums";

export interface Perfume {
  id: number;
  code: string;
  name: string;
  slug: string;
  gender: PerfumeGender;
  origin: string;
  description: string;
  brand_id: number;
  supplier_id: number;
  user_id: number;
  updated_at: Date;
  created_at: Date;
}
