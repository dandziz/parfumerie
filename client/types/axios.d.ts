import type { AxiosHeaders, AxiosRequestConfig } from "axios"

type Data<T> = {
  status: boolean,
  messages: string,
  data: Array<T>
}

export type Response<T> = {
  headers: AxiosHeaders,
  status: number,
  request: XMLHttpRequest,
  statusText: string,
  config: AxiosRequestConfig,
  data: Data<T>
}
