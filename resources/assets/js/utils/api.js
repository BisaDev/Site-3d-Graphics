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

  logout(user) {},

  sendProjectData(data = []) {
    return axios.post(this.api + '/projects', data, this.config)
  },

  fetchProject(id) {
    return axios.get(this.api + `/projects/${id}/edit`, this.config)
  },
}
