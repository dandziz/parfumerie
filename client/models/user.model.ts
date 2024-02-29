export interface User {
  id: number;
  name: string;
  email: string;
  phone_number: string;
  description: string;
  role: string;
  default_address?: string;
}
