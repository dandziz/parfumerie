export interface Address {
  id: number;
  name: string;
  phone_number: string;
  company: string;
  address: string;
  province: string;
  district: string;
  ward: string;
  zip_code: string;
  default: boolean;
  user_id: number;
  updated_at?: Date;
  created_at?: Date;
  full_address?: string;
}
