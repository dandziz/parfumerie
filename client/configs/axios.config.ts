/* eslint-disable regex/invalid */
import axios, { type AxiosInstance } from "axios";
import ability from "./casl";

const axiosIns: AxiosInstance = axios.create({
  // You can add your headers here
  // ================================
  baseURL: 'http://localhost:8000/api/',

  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
});

// ℹ️ Add request interceptor to send the authorization header on each subsequent request after login

axiosIns.interceptors.request.use((config) => {
  // Retrieve token from localStorage
  const token = localStorage.getItem("access_token");

  // If token is found
  if (token) {
    config.headers = config.headers || {};

    config.headers.Authorization = token ? `Bearer ${JSON.parse(token)}` : "";
  }
  config.headers.Accept = "*/*";
  if (!config.headers["Content-Type"]) {
    config.headers["Content-Type"] = "application/json";
  }

  return config;
});

// ℹ️ Add response interceptor to handle 401 response
axiosIns.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (!localStorage.getItem("user") && !localStorage.getItem("access_token") && !localStorage.getItem("user_ability"))
      return Promise.reject(error);

    // Handle error
    if (error.response.status === 401) {
      // ℹ️ Logout user and redirect to login page
      // Remove "userData" from localStorage
      localStorage.removeItem("user");

      // Remove "accessToken" from localStorage
      localStorage.removeItem("access_token");

      // Remove "userAbility" from localStorage
      localStorage.removeItem("user_ability");

      ability.update([{action: 'read', subject: 'guest'}])

      // If 401 response returned from api
      //router.push('/login')
    } else if (error.response.status === 500) {
      //router.push('/server-error')
    }

    return Promise.reject(error);
  }
);

export default axiosIns
