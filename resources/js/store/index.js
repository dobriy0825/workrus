import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
import job from './modules/job';
import menu from "./modules/menu";

export const store = new Vuex.Store({
    modules: {
        menu
    },
    state: {
        authenticatedUser: {},
        authenticatedUserJobs: [],
        proposedJob: [],
        worker: '',

        hiredJobs: [],
        proposedJobs: [],
        reviews: [],
        myProposedJob: []
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
        },
        getAuthenticatedUser(state){
            return state.authenticatedUser
        },
        getWorker(state){
            return state.worker
        },
        getProposedJobs(state){
            return state.proposedJobs;
        },
        getHiredJobs(state){
            return state.hiredJobs;
        },
        getReviews(state){
            return state.reviews;
        },
        getMyProposedJob(state){
            return state.myProposedJob
        }

    },
    mutations: {
        clearAuthenticatedUserJobs(state){
            state.authenticatedUserJobs = [];
        },
        addAuthenticatedUserJobs(state) {
            fetch('/get_open_jobs').then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (jobs) {
                if (jobs) {
                    if (jobs.length === 1) {
                        return jobs[0].id
                    }else {
                        state.authenticatedUserJobs = jobs;
                    }
                }else {
                    throw new Error('У Вас нет доступных заданий');
                }
            }).then(function (id) {
                let form = new FormData();
                form.append('job_id', id);
                form.append('worker_id', window.location.pathname.split('/')[2]);
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
                    state.proposedJob = state.authenticatedUserJobs;
                    return res
                })
            });
        },
        addAuthenticatedUser(state, user){
            state.authenticatedUser = '';
            state.authenticatedUser = user;
        },
        addWorker(state, worker){
            state.worker = worker
        },
        addProposedJobs(state){
            let url = '/get_proposed_jobs/' + this.getters.getWorker.id;
            fetch(url).then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (jobs) {
                state.proposedJobs = jobs
            })
        },
        addHiredJobs(state){
            let url = '/get_hired_jobs/' + this.getters.getWorker.id;
            fetch(url).then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (jobs) {
                state.hiredJobs = jobs
            })
        },
        hiredJobs(state, id){
            let form = new FormData();
            form.append('job_id', id);
            form.append('worker_id', window.location.pathname.split('/')[2]);
            fetch('/hired_jobs', {
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
            })
        },
        addReviews(state){
            let url = '/get_reviews/' + this.getters.getWorker.id;
            fetch(url).then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (reviews) {
                state.reviews = reviews
            })
        },
        addProposedJob(state){
            let url = '/get_proposed_job/' + this.getters.getWorker.id;
            fetch(url).then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (jobs) {
                state.proposedJobs = jobs
            })
        },

        addMyProposedJob(state){
            state.proposedJobs.forEach(function (item) {
                if (item.user_id === this.authenticatedUser.id){
                    state.myProposedJob = item;
                }
            })
        }
    },

    actions: {
        addAuthenticatedUserJobs(store){
            store.commit('clearAuthenticatedUserJobs');
            store.commit('addAuthenticatedUserJobs');
        },
        addAuthenticatedUser(store, user){
            store.commit('addAuthenticatedUser', user)
        },
        addWorker(store, worker){
            store.commit('addWorker', worker)
        },
        addProposedJobs(store){
            store.commit('addProposedJobs')
        },
        addHiredJobs(store){
            store.commit('addHiredJobs')
        },

        hiredJobs(store, id){
            store.commit('hiredJobs', id)
        },
        addReviews(store){
            store.commit('addReviews')
        },
        addMyProposedJob(store){
            store.commit('addMyProposedJob')
        }
    }
});
