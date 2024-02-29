import { type User } from "~/models";

export type LOGIN_FIELDS = Pick<User, "email"> & {
  password: string;
};

export type LOGIN_SOCIAL = {
  provider: string;
  token: string;
};

export type TOKEN = {
  access_token: string,
  token_type: string
}

export type DATA_SUCCESS = {
  token: TOKEN,
  user: User,
  user_ability: Array<string | string[]>,
  address: number
}
