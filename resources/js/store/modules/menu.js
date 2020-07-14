export default {
    namespaced: true,
    state: {
        menu: [
            {
                value: 'Предложенные задания',
                authenticatedUserWorker: 'auth',
                content: 'addProposedJobs'
            },
            {
                value: 'Принятые задания',
                authenticatedUserWorker: 'auth',
                content: 'addHiredJobs'
            },
            {
                value: 'Ваше задание',
                authenticatedUserWorker: 'not auth',
                content: 'addMyProposedJob'
            },
            {
                value: 'Отзывы',
                authenticatedUserWorker: 'all',
                content: 'addReviews'
            },
        ],
    },
    getters: {
        items(state) {
            return state.menu
        },
    }
}
