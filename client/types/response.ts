import type { AxiosHeaders, AxiosRequestConfig } from "axios"

export type RESPONSE_NOT_DATA = {
  status: boolean,
  message: string,
}

type PAGINATION = {
  total: number,
  per_page: number,
  current_page: number,
  last_page: number,
}

export type GET_LIST_RESPONSE<T> = {
  status: boolean,
  message: string,
  pagination: PAGINATION,
  data: T[]
}

export type ERROR_RESPONSE_MESSAGE<T> = {
  [K in keyof T]: string[];
};

export type ERROR_RESPONSE_FORMATTED<T> = {
  [K in keyof T]: string;
};

type RESPONSE_API = {
  headers: { [key: string]: string };
  status: number;
};

export type RESPONSE_API_ERROR<T> = RESPONSE_NOT_DATA & {
  error: ERROR_RESPONSE_MESSAGE<T>;
};

export type RESPONSE_ERROR = {
  error: { [key: string]: string };
  headers: { [key: string]: string };
  status: number;
  message: string;
};

export type RESPONSE_API_SUCCESS<T> = RESPONSE_API & {
  data: T;
};

export type RESPONSE_DATA_SUCCESS<T> = {
  status: boolean;
  message: string;
  data: T;
};

export type PARAMS = {
  [key: string]: string | number;
};

export type HEADERS = PARAMS;
