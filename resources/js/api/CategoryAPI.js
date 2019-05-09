import httpClient from './HttpClient'

export default {

  async all () {
    return httpClient.get('/category')
  }

}
