import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/product')
  },
  async create (product) {
    return httpClient.post('/product', product)
  }

}
