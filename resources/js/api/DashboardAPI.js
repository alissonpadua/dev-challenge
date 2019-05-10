import httpClient from './HttpClient'

export default {

  async sales () {
    return httpClient.get('/dashboard/sales')
  },

  async products () {
    return httpClient.get('/dashboard/products')
  }

}
