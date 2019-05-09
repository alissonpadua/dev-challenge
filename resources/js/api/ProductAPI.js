import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/product')
  },
  async find (id) {
    return httpClient.get('/product/' + id)
  },
  async create (product) {
    return httpClient.post('/product', product)
  },
  async update (product) {
    return httpClient.put('/product/' + product.id, product)
  },
  async delete (id) {
    return httpClient.delete('/product/' + id)
  },

}
