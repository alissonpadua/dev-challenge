import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/paymode')
  },
  async find (id) {
    return httpClient.get('/paymode/' + id)
  }

}
