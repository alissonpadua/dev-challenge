import axios from 'axios'
const API_URL = 'http://195.1.1.230:8000/api/v1'

const HttpClient = () => {
  let instance = axios.create({
    baseURL: API_URL
  })
  instance.interceptors.request.use(
    (config) => {
      return config
    },
    (error) => {
      return Promise.reject(error)
    }
  )
  instance.interceptors.response.use((response) => {
    return response;
  }, (error) => {
    if (401 === error.response.status) {
      window.location = "/login"
    } else {
      return Promise.reject(error);
    }
  });
  return instance
}

export default HttpClient()
