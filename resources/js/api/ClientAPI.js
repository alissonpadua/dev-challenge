import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/client')
  },
  async find (id) {
    return httpClient.get('/client/' + id)
  }

}
