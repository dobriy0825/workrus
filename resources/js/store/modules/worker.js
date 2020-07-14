
export default {
    namespaced: true,
    state: {
        worker: {},
        proposedJobs: [],
        hiredJobs: [],
        reviews: [],
        userJob: {}
    },
    getters: {
        item(state){
            return state.worker
        },
        getProposedJobs(state){
            return state.proposedJobs;
        },
        getHiredJobs(state){
            return state.hiredJobs;
        },
        getUserJob(state){
            return state.userJob
        }
    },
    mutations: {
        loadWorker(state, worker){
            state.worker = worker
        },
        proposedJob(state, payload){

        },
        loadProposedJobs(state, data){
            state.proposedJobs = data;
            state.userJob = data;
        },
        hiredJobs(state, payload){

        },
        deleteProposedJob(state, payload){

        },
        loadHiredJobs(state, worker_id){
            let url = '/get_hired_jobs/' + worker_id;
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
    },
    actions: {
        loadWorker(store, worker){
            store.commit('loadWorker', worker)
        },
        loadProposedJobs(store, worker_id){
            let url = '/get_proposed_jobs/' + worker_id;
            fetch(url).then(function (response) {
                let status = response.status;
                if (status !== 200){
                    throw new Error('error');
                }
                return response.json();
            }).then(function (jobs) {
                return jobs;
            }).then(function (data) {
                store.commit('loadProposedJobs', data)
            })

        },
        proposedJob(store, payload){
            let form = new FormData();
            form.append('job_id', payload.job_id);
            form.append('worker_id', payload.worker_id);
            let options = {
                method: 'post',
                body: form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                }
            };
            fetch('/proposed_job', options)
                .then(function (response) {
                    let status = response.status;
                    if (status !== 200){
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (data) {
                console.log('Задание предложено');
                return data
            }).then(function (data) {
                let url = '/get_proposed_jobs/' + payload.worker_id;
                fetch(url).then(function (response) {
                    let status = response.status;
                    if (status !== 200){
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (jobs) {
                    return jobs;
                }).then(function (data) {
                    store.commit('loadProposedJobs', data)
                })
            })
        },
        deleteProposedJob(store, payload){
            let form = new FormData();
            form.append('job_id', payload.job_id);
            form.append('worker_id', payload.worker_id);
            let options = {
                method: 'post',
                body: form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                }
            };
            let url = '/delete_proposed_job';
            fetch(url, options).then(function (response) {
                let status = response.status;
                if (status !== 200) {
                    throw new Error('error');
                }
                console.log('Задание отозвано')
            }).then(function () {
                let url = '/get_proposed_jobs/' + payload.worker_id;
                fetch(url).then(function (response) {
                    let status = response.status;
                    if (status !== 200){
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (data) {
                    store.commit('loadProposedJobs', data)
                })

            })
        },
        loadHiredJobs(store, worker_id){
            store.commit('loadHiredJobs', worker_id)
        },
        hiredJobs(store, payload){
            let form = new FormData();
            form.append('job_id', payload.job_id);
            form.append('worker_id', payload.worker_id);
            let options = {
                method: 'post',
                body: form,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                }
            };
            fetch('/hired_jobs', options)
                .then(function (response) {
                    let status = response.status;
                    if (status !== 200){
                        throw new Error('error');
                    }
                    return response.json();
                }).then(function (res) {
                    let url = '/get_proposed_jobs/' + payload.worker_id;
                    fetch(url).then(function (response) {
                        let status = response.status;
                        if (status !== 200){
                            throw new Error('error');
                        }
                        return response.json();
                    }).then(function (data) {
                        store.commit('loadProposedJobs', data)
                    })
            })
        },

        loadUserJob(store, user_id){
            store.commit('loadUserJob', user_id)
        }
    }
}
