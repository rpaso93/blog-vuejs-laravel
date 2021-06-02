import axios from "axios";

const MUTATIONS = {
    "1": "Published",
    "2": "Inactive",
    "3": "Drafts"
};

const state = {
    posts: {
        published: [],
        drafts: [],
        inactive: []
    }
};

const getters = {
    getPostById: state => payload => {
        return state.posts[payload.type].find(post => post.id === payload.id);
    }
};

const actions = {
    store: async ({ commit }, apiPayload) => {
        try {
            const response = await axios.post("/api/post/store", {
                title: apiPayload.title,
                content: apiPayload.content,
                status_id: apiPayload.status_id
            });
            console.log(response.data);
            const storePayload = response.data;
            const mutation = "add" + MUTATIONS[apiPayload.status_id];
            commit(mutation, storePayload);
            return Promise.resolve(true);
        } catch (error) {
            return Promise.reject(error);
        }
    },
    update: async ({ commit }, apiPayload) => {
        try {
            const response = await axios.put(
                `/api/post/updateContent/${apiPayload.id}`,
                {
                    title: apiPayload.post.title,
                    content: apiPayload.post.content
                }
            );
            const mutation = "update" + MUTATIONS[apiPayload.status_id];
            commit(mutation, response.data);
            return Promise.resolve(true);
        } catch (error) {
            return Promise.reject(error);
        }
    },
    updateStatus: async ({ commit }, apiPayload) => {
        try {
            const response = await axios.put(
                `/api/post/updateStatus/${apiPayload.id}`,
                {
                    status_id: apiPayload.status_id
                }
            );
            const deleteMutation = "delete" + MUTATIONS[apiPayload.old_status];
            commit(deleteMutation, apiPayload.id);
            const addMutation = "add" + MUTATIONS[apiPayload.status_id];
            commit(addMutation, response.data);
            return Promise.resolve(true);
        } catch (error) {
            return Promise.reject(error);
        }
    },
    getPosts: async ({ commit }, apiPayload) => {
        try {
            const response = await axios.get(
                `api/post/user/posts/${apiPayload}`
            );
            const mutation = "load" + MUTATIONS[apiPayload];
            commit(mutation, response.data.data);
        } catch (error) {
            return Promise.reject(error);
        }
    },
    deletePost: async ({ commit }, apiPayload) => {
        try {
            const response = await axios.delete(
                `api/post/delete/${apiPayload.id}`
            );
            const mutation = "delete" + MUTATIONS[apiPayload.status_id];
            commit(mutation, apiPayload.id);
        } catch (error) {
            return Promise.reject(error);
        }
    }
};

const mutations = {
    addPublished(state, payload) {
        state.posts.published = [{ ...payload }, ...state.posts.published];
    },
    addDrafts(state, payload) {
        state.posts.drafts = [{ ...payload }, ...state.posts.published];
    },
    addInactive(state, payload) {
        state.posts.inactive = [{ ...payload }, ...state.posts.inactive];
    },
    loadPublished(state, payload) {
        state.posts.published = [...payload];
    },
    loadDrafts(state, payload) {
        state.posts.drafts = [...payload];
    },
    loadInactive(state, payload) {
        state.posts.inactive = [...payload];
    },
    deletePublished(state, payload) {
        state.posts.published = state.post.published.filter(
            post => post.id !== payload.id
        );
    },
    deleteDrafts(state, payload) {
        state.posts.drafts = state.post.drafts.filter(
            post => post.id !== payload.id
        );
    },
    deleteInactive(state, payload) {
        state.posts.inactive = state.post.inactive.filter(
            post => post.id !== payload.id
        );
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
