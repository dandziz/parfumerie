import { type User } from "~/models";

export type LOGIN_FIELDS = Pick<User, "email"> & {
  password: string;
};
