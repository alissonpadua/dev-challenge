import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/sale')
  },
  async find (id) {
    return httpClient.get('/sale/' + id)
  },
  async create (sale) {
    return httpClient.post('/sale', sale)
  }

}
