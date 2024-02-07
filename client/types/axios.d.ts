import type { AxiosHeaders, AxiosRequestConfig } from "axios"

type DATA<T> = {
  status: boolean,
  message: string,
  data: Array<T>
}

export type RESPONSE<T> = {
  headers: AxiosHeaders,
  status: number,
  request: XMLHttpRequest,
  statusText: string,
  config: AxiosRequestConfig,
  data: DATA<T>
}

export type RESPONSE_NOT_DATA = {
  status: boolean,
  message: string,
}
