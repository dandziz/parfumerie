import axios from "@config/axios.config";
import type { AxiosError } from "axios";
import type {
  ERROR_RESPONSE_FORMATTED,
  ERROR_RESPONSE_MESSAGE,
  HEADERS,
  PARAMS,
  RESPONSE_API_ERROR,
  RESPONSE_API_SUCCESS,
  RESPONSE_DATA_SUCCESS,
  RESPONSE_NOT_DATA
} from "~/types";

class AxiosRepository {
  private axiosInstance = axios;

  private renderErrorResponse<T>(
    error: ERROR_RESPONSE_MESSAGE<T>
  ): ERROR_RESPONSE_FORMATTED<T> {
    const formattedError: ERROR_RESPONSE_FORMATTED<T> =
      {} as ERROR_RESPONSE_FORMATTED<T>;

    for (const key in error) {
      if (error.hasOwnProperty(key)) {
        const errorArray = error[key];

        formattedError[key] = errorArray.join(". ");
      }
    }

    return formattedError;
  }

  private handleApiError<D>(
    error: AxiosError<RESPONSE_API_ERROR<D>>
  ): ERROR_RESPONSE_FORMATTED<D> | string {
    if (error?.response?.data?.error) {
      return this.renderErrorResponse<D>(
        error?.response.data.error
      ) as ERROR_RESPONSE_FORMATTED<D>;
    } else {
      return "";
    }
  }

  public async get<T>(
    url: string,
    params?: PARAMS,
    headers?: HEADERS
  ): Promise<RESPONSE_API_SUCCESS<T>> {
    try {
      const response: RESPONSE_API_SUCCESS<T> = await this.axiosInstance.get(
        url,
        {
          params,
          headers,
        }
      );

      return Promise.resolve(response as RESPONSE_API_SUCCESS<T>);
    } catch (e) {
      const error = e as AxiosError<RESPONSE_NOT_DATA>;

      return Promise.reject({
        error: "message.getDataFailed",
        headers: error.response?.headers,
        status: error.response?.status,
        message: error.response?.data?.message as string,
      });
    }
  }

  public async post<T, D>(
    url: string,
    data?: D,
    params?: PARAMS,
    headers?: HEADERS
  ): Promise<RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>>> {
    try {
      const config = {
        params: {
          ...params
        },
        headers: {
          ...headers,
        }
      }
      console.log(config);
      const response: RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>> =
        await this.axiosInstance.post(url, data, config);

      return Promise.resolve(response);
    } catch (e) {
      const error = e as AxiosError<RESPONSE_API_ERROR<D>>;
      const response = error.response;
      return Promise.reject({
        error: this.handleApiError<D>(error),
        headers: response?.headers,
        status: response?.status,
        message: response?.data?.message,
      });
    }
  }

  public async put<T, D>(
    url: string,
    data?: D,
    params?: PARAMS,
    headers?: HEADERS
  ): Promise<RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>>> {
    try {
      const response: RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>> =
        await this.axiosInstance.put(url, data, {
          params,
          headers,
        });

      return Promise.resolve(response);
    } catch (e) {
      const error = e as AxiosError<RESPONSE_API_ERROR<D>>;

      return Promise.reject({
        error: this.handleApiError<D>(error),
        headers: error.response?.headers,
        status: error.response?.status,
        message: error.response?.data?.message,
      });
    }
  }

  public async patch<T, D>(
    url: string,
    data?: D,
    params?: PARAMS,
    headers?: HEADERS
  ): Promise<RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>>> {
    try {
      const response: RESPONSE_API_SUCCESS<RESPONSE_DATA_SUCCESS<T>> =
        await this.axiosInstance.patch(url, data, {
          params,
          headers,
        });

      return Promise.resolve(response);
    } catch (e) {
      const error = e as AxiosError<RESPONSE_API_ERROR<D>>;

      return Promise.reject({
        error: this.handleApiError<D>(error),
        headers: error.response?.headers,
        status: error.response?.status,
        message: error.response?.data?.message,
      });
    }
  }

  public async delete<T>(
    url: string,
    name?: string,
    params?: PARAMS,
    headers?: HEADERS
  ): Promise<RESPONSE_API_SUCCESS<T>> {
    try {
      const response: RESPONSE_API_SUCCESS<T> = await this.axiosInstance.delete(
        url,
        {
          params,
          headers,
        }
      );

      return Promise.resolve(response);
    } catch (e) {
      const error = e as AxiosError;

      return Promise.reject({
        error: "message.deleteFailed",
        headers: error.response?.headers,
        status: error.response?.status,
        message: error.response?.data as string,
      });
    }
  }
}

export default AxiosRepository;
