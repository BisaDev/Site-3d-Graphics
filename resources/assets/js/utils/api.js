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

    getAreas() {
        return axios.get(this.api + '/areas')
    },

    getProjects() {
        return axios.get(this.api + '/projects')
    },

    getProject(id) {
        return axios.get(this.api + `/projects/${id}`)
    },

    getProjectBySlug(slug) {
        return axios.get(this.api + `/project/${slug}`)
    },

    getProjectNext(id) {
        return axios.get(this.api + `/project/${id}/next`)
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

    getConfigModels() {
        return axios.get(this.api + `/getConfigModels`, this.config)
    },

    deleteProject(id) {
        return axios.delete(this.api + `/projects/${id}`, this.config);
    },

    getRecruitmentData() {
        return axios.get(this.api + '/recruitment')
    },

    sendApplyForm(data) {
        return axios.post(this.api + '/apply', data)
    },

    getThanksGif() {
        return axios.get(this.api + '/thanks-gif')
    },

    getPositionData(position) {
        return axios.get(this.api + `/positions/${position}`)
    }
}
