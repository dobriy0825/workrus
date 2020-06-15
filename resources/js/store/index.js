import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        count: 0,
        authenticatedUserJobs: [],
        proposedJobs: [],
    },
    getters: {
        count: (state) => {
            return state.count
        },
        getAuthenticatedUserJobs(state){
            return state.authenticatedUserJobs;
        },
        getProposedJob(state){
            return state.proposedJobs;
        }
    },
    mutations: {
        clearAuthenticatedUserJobs(state){
            state.authenticatedUserJobs = [];
        },
        addAuthenticatedUserJobs(state) {
            // let query = await fetch('/get_open_jobs');
            // let status = query.status;
            // if (status !== 200) {
            //     throw new Error('error');
            // }
            // state.authenticatedUserJobs = await query.json();
            fetch('/get_open_jobs').then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (res) {
                state.authenticatedUserJobs = res;
                return res[0].id;
            }).then(function (id) {
                let form = new FormData();
                form.append('job_id', id);
                form.append('worker_id', window.location.pathname.split('/')[2])
                fetch('/proposed_job', {
                    method: 'post',
                    body: form,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                    }
                }).then(function (response) {
                    let status = response.status;
                    if (status !== 200){
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (res) {
                    state.proposedJobs = state.authenticatedUserJobs;
                })
            });
        },
        async addProposedJob(state){
            let form = new FormData();
            form.append('job_id', state.authenticatedUserJobs[0].id);
            form.append('worker_id', window.location.pathname.split('/')[2]);
            let query = await fetch('/proposed_job', {
                method: 'post',
                body: form
            });
            let status = query.status;
            if (status !== 200) {
                throw new Error('error');
            }
            console.log(state.authenticatedUserJobs);
            state.proposedJobs = state.authenticatedUserJobs;
        }
    },
    actions: {
        addAuthenticatedUserJobs(store){
            store.commit('clearAuthenticatedUserJobs');
            store.commit('addAuthenticatedUserJobs');
        },
        addProposedJobs(store){
            store.commit('addProposedJob');
        }
    }
});
