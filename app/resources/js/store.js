import { createStore } from 'vuex'

const store = createStore({
    state: {
        user: {
            data: {},
            token: localStorage.getItem('auth_token'),
            userDetail: localStorage.getItem('admin')
        }
    },
    mutations: {
        setToken(state, token) {
            state.user.token = token;
            localStorage.setItem('auth_token', token);
        },
        setUser(state, user) {
            state.user.userDetail = user;
            localStorage.setItem('user', user);
        },
    },
})

export default store;