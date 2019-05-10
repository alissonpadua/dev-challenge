import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/seller')
  },
  async find (id) {
    return httpClient.get('/seller/' + id)
  },
  async create (seller) {
    return httpClient.post('/seller', seller)
  },
  async update (seller) {
    return httpClient.put('/seller/' + seller.id, seller)
  },
  async delete (id) {
    return httpClient.delete('/seller/' + id)
  },

}
