export default {
    namespaced: true,
    state: {
        authenticatedUser: {},
        authenticatedUserJobs: [],
        notJobsPopup: false,
        selectJobPopup: false
    },
    getters: {
        item(state){
            return state.authenticatedUser
        },
        getAuthenticatedUserJobs(state){
            return state.authenticatedUserJobs
        },
        getNotJobsPopup(state){
            return state.notJobsPopup
        },
        getSelectJobPopup(state){
            return state.selectJobPopup
        }
    },
    mutations: {
        load(state, user){
            state.authenticatedUser = user
        },
        loadAuthenticatedUserJobs(state){
            let url = '/get_open_jobs';
            fetch(url)
                .then(function (response) {
                    let status = response.status;
                    if (status !== 200) {
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (jobs) {
                    if (jobs.length > 0){
                        console.log('У вас есть задания')
                        state.authenticatedUserJobs = jobs;
                        state.selectJobPopup = true;
                        return state.authenticatedUserJobs;
                    }else {
                        console.log('У Вас нет доступных заданий');
                        state.notJobsPopup = true;
                    }
                }).then(function (result) {
                console.log(0)
            })
        },
        closePopup(state){
            state.notJobsPopup = false
        },
        closeSelectJobPopup(state){
            state.selectJobPopup = false
        }
    },
    actions:{
        load(store, user) {
            store.commit('load', user)
        },
        proposedJob(store){
            store.commit('proposedJob', {});
        },
        loadAuthenticatedUserJobs(store){
            store.commit('loadAuthenticatedUserJobs')
        },
        closePopup(store){
            store.commit('closePopup')
        },
        closeSelectJobPopup(store){
            store.commit('closeSelectJobPopup');
        }
    }
}
