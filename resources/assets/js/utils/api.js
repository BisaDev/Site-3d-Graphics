export default class ApiManiak {
  getProjects() {
    return axios.get('/api/v1/projects');
  }
  getProject(id) {
    return axios.get('/api/v1/projects/' + id);
  }
}