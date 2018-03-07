import cookies from './cookies'

export default {
  api: '/api/v1',
  config: {
    headers: {
      Accept: 'application/json',
      Authorization:
        'Bearer ' +
        (cookies.getItem('credentials')
          ? JSON.parse(cookies.getItem('credentials')).access_token
          : ''),
    },
  },

  //@todo group public and private routes

  getProjects() {
    return axios.get(this.api + '/projects')
  },

  getProject(id) {
    return axios.get(this.api + `/projects/${id}`)
  },

  login(data) {
    return axios.post('auth/token', {
      username: data.user,
      password: data.password,
    })
  },

  logout(user) {

  },

  createProject(data) {
      //POST to CREATE entity
      return axios.post(this.api + '/projects', data, this.config)
  },

  editProject(data) {
      let id = data.id

      //PUT to ALTER entity
      return axios.put(this.api + `/projects/${id}`, data, this.config)
  },

  fetchProject(id) {
    return axios.get(this.api + `/projects/${id}/edit`, this.config)
  },
}
