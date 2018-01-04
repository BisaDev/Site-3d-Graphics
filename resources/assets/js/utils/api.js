export default {
    api: '/api/v1',

    getProjects() {
        return axios.get(this.api + '/projects');
    },

    getProject(id) {
        return axios.get(this.api + '/projects/' + id);
    }
}